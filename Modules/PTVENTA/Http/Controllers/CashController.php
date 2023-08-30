<?php

namespace Modules\PTVENTA\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Modules\PTVENTA\Entities\CashCount;
use Modules\PTVENTA\Http\Controllers\InventoryController;

class CashController extends Controller
{
    /**
     * Show the form for closing the cash count.
     * @return Renderable
     */
    public function index()
    {
        $view = ['titlePage' => trans('ptventa::cash.Cash Control'), 'titleView' => trans('ptventa::cash.Cash Control')];
        $app_puw = (new InventoryController())->getAppPuw(); // Obtner la unidad productiva y bodega de la aplicación
        $active_cash = CashCount::where('productive_unit_warehouse_id', $app_puw->id)
                                        ->where('state', 'Abierta')
                                        ->first();
        $cash_counts = CashCount::where('productive_unit_warehouse_id', $app_puw->id)
                                ->orderBy('updated_at', 'DESC')
                                ->get();
        return view('ptventa::cash.index', compact('view', 'active_cash', 'cash_counts'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $app_puw = (new InventoryController())->getAppPuw(); // Obtner la unidad productiva y bodega de la aplicación
        // Verificar si hay una caja abierta
        $open_cash_count = CashCount::where('productive_unit_warehouse_id', $app_puw->id)
                                    ->where('state', 'Abierta')
                                    ->first();
        if ($open_cash_count) {
            return redirect()->route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.cash.index')->with('error', ' ');
        }
        $cashCount = new CashCount();
        $cashCount->person_id = Auth::user()->person_id;
        $cashCount->productive_unit_warehouse_id = $app_puw->id;
        $cashCount->opening_date = Carbon::now();
        $cashCount->initial_balance = 0;
        $cashCount->final_balance = null;
        $cashCount->closing_date = null;
        $cashCount->total_sales = null;
        $cashCount->state = 'Abierta';
        $cashCount->save();
        return redirect()->route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.cash.index')->with('success', ' ');
    }

    public function close(Request $request)
    {
        $request->merge(['final_balance' => revertPriceFormat(e($request->input('final_balance')))]); // Limpiar el valor de final_balance
        try {
            DB::beginTransaction();
            // Validar los datos recibidos
            $validatedData = $request->validate([
                'final_balance' => 'required'
            ]);

            $cashCount = CashCount::find($request->input('cash_count_id'));

            $cashCount->final_balance = $validatedData['final_balance'];
            $cashCount->closing_date = Carbon::now();
            $cashCount->state = 'Cerrada';

            $cashCount->save();

            $app_puw = (new InventoryController())->getAppPuw(); // Obtner la unidad productiva y bodega de la aplicación
            CashCount::create([
                'person_id' => Auth::user()->person_id,
                'productive_unit_warehouse_id' =>  $app_puw->id,
                'opening_date' => Carbon::now(),
                'initial_balance' => 0,
                'final_balance' => null,
                'closing_date' => null,
                'total_sales' => null,
                'state' => 'Abierta',
            ]);

            DB::commit(); // Confirmar cambios realizados durante la transacción

            return redirect()->back()->with('success', trans('ptventa::cash.Text4'));
        } catch (Exception $e) { // Capturar error durante la transacción
            // Transacción rechazada
            DB::rollBack(); // Devolver cambios realizados durante la transacción
            $message = trans('ptventa::cash.Text5');
            return redirect()->back()->with('error', $message);
        }
    }
}
