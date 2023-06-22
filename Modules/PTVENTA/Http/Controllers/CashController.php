<?php

namespace Modules\PTVENTA\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\PTVENTA\Entities\CashCount;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\Warehouse;

class CashController extends Controller
{
    /**
     * Show the form for closing the cash count.
     * @return Renderable
     */
    public function index()
    {
        $view = ['titlePage' => trans('ptventa::cash.Cash Closing'), 'titleView' => trans('ptventa::cash.Cash Closing')];
        $cashCounts = CashCount::where('state', 'Abierta')->get();
        $cashCountAll = CashCount::orderBy('closing_date', 'desc')->get();
        $warehouse = Warehouse::where('name','Punto de venta')->first();

        $movement_type = MovementType::where('name','Venta')->first();
        $sales = Movement::whereDate('registration_date', Carbon::today()->toDateString())
                            ->where('movement_type_id',$movement_type->id)
                            ->orderBy('registration_date','DESC')
                            ->get();
        return view('ptventa::cash.cashCount', compact('view', 'cashCounts','warehouse','cashCountAll', 'sales'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $warehouse = Warehouse::where('name','Punto de venta')->first();

        // Verificar si hay una caja abierta
        $openCashCount = CashCount::where('warehouse_id', $warehouse->id)->where('state', 'Abierta')->first();
        if ($openCashCount) {
            return redirect()->route('ptventa.cashCount.index')->with('error', ' ');
        }

        $cashCount = new CashCount();
        $cashCount->person_id = Auth::user()->person_id;
        $cashCount->warehouse_id = Warehouse::where('name','Punto de venta')->first()->id;
        $cashCount->opening_date = Carbon::now();
        $cashCount->initial_balance = 0;
        $cashCount->final_balance = null;
        $cashCount->closing_date = null;
        $cashCount->state = 'Abierta';
        $cashCount->save();

        return redirect()->route('ptventa.cashCount.index')->with('success', ' ');
    }

    public function close(Request $request)
    {
        try {
            DB::beginTransaction();
            // Validar los datos recibidos
            $validatedData = $request->validate([
                'final_balance' => 'required',
            ]);

            $cashCount = CashCount::find($request->input('cash_count_id'));

            $cashCount->final_balance = $validatedData['final_balance'];
            $cashCount->closing_date = Carbon::now();
            $cashCount->state = 'Cerrada';

            $cashCount->save();

            CashCount::create([
                'person_id' => Auth::user()->person_id,
                'warehouse_id' =>  Warehouse::where('name','Punto de venta')->first()->id,
                'opening_date' => Carbon::now(),
                'initial_balance' => 0,
                'final_balance' => null,
                'closing_date' => null,
                'state' => 'Abierta',
            ]);

            DB::commit(); // Confirmar cambios realizados durante la transacción

            return redirect()->back()->with('success', trans('ptventa::cash.Successfully_closed_cash.'));
        } catch (Exception $e) { // Capturar error durante la transacción
            // Transacción rechazada
            DB::rollBack(); // Devolver cambios realizados durante la transacción
            return redirect()->back()->with('error', trans('ptventa::cash.Failed_closed_cash.'));
        }
    }
}
