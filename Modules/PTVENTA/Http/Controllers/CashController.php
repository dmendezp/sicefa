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
        return view('ptventa::cash.cashCount', compact('view', 'cashCounts','warehouse','cashCountAll'));
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
            $cashCount->difference = $cashCount->final_balance - $cashCount->initial_balance;
            $cashCount->closing_date = Carbon::now();
            $cashCount->state = 'Cerrada';
            
            $cashCount->save();
            
            CashCount::create([
                'person_id' => Auth::user()->person_id,
                'warehouse_id' =>  Warehouse::where('name','Punto de venta')->first()->id,
                'opening_date' => Carbon::now()->addDay(),
                'initial_balance' => 0,
                'final_balance' => null,
                'difference' => null,
                'closing_date' => null,
                'state' => 'Abierta',
            ]);

            DB::commit(); // Confirmar cambios realizados durante la transacción

            return redirect()->back()->with('success', trans('ptventa::cash.Successfully closed cash.'));
        } catch (Exception $e) { // Capturar error durante la transacción
            // Transacción rechazada
            DB::rollBack(); // Devolver cambios realizados durante la transacción
            return redirect()->back()->with('error', trans('ptventa::cash.Failed closed cash.'));
        }
    }
}
