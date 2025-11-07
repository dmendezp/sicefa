<?php

namespace Modules\CAFETO\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Modules\SICA\Entities\CashCount;

class CashController extends Controller
{
    public function index()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_cash_index_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_cash_index_title_view')];
        $app_puw = PUW::getAppPuw(); // Obtner la unidad productiva y bodega de la aplicación
        $active_cash = CashCount::where('productive_unit_warehouse_id', $app_puw->id)
            ->where('state', 'Abierta')
            ->first();
        $cash_counts = CashCount::where('productive_unit_warehouse_id', $app_puw->id)
            ->orderByDesc('id')
            ->get();
        return view('cafeto::cash.index', compact('view', 'active_cash', 'cash_counts'));
    }

    public function store(Request $request)
    {
        $app_puw = PUW::getAppPuw(); // Obtner la unidad productiva y bodega de la aplicación
        // Verificar si hay una caja abierta
        $open_cash_count = CashCount::where('productive_unit_warehouse_id', $app_puw->id)
            ->where('state', 'Abierta')
            ->first();
        if ($open_cash_count) {
            return redirect()->route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.cash.index')->with('error', ' ');
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
        return redirect()->route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.cash.index')->with('success', ' ');
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

            /* Abrir caja automaticamente deshabilitado
            $app_puw = PUW::getAppPuw(); // Obtner la unidad productiva y bodega de la aplicación
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
            */
            DB::commit(); // Confirmar cambios realizados durante la transacción

            return redirect()->back()->with('success', trans('cafeto::cash.TextSuccess'));
        } catch (Exception $e) { // Capturar error durante la transacción
            // Transacción rechazada
            DB::rollBack(); // Devolver cambios realizados durante la transacción
            $message = trans('cafeto::cash.TextFailed');
            return redirect()->back()->with('error', $message);
        }
    }
}
