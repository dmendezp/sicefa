<?php

namespace Modules\PTVENTA\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\PTVENTA\Entities\CashCount;

class CashController extends Controller
{
 /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $cashCounts = CashCount::orderBy('updated_at', 'desc')->get();
        $view = ['titlePage' => trans('ptventa::cash.Cash'), 'titleView' => trans('ptventa::cash.Cash')];
        return view('ptventa::cash.index', compact('view', 'cashCounts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ptventa::cash.create');
    }
    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        // Verificar si hay una caja abierta
        $openCashCount = CashCount::where('state', 'Abierta')->first();
        if ($openCashCount) {
            return redirect()->route('ptventa.cash.index')->with('error');
        }
        $request->validate([
            'initial_balance' => 'required|numeric',
        ]);
    
        $cashCount = new CashCount();
        $cashCount->person_id = Auth::user()->person_id;
        $cashCount->opening_date = Carbon::now();
        $cashCount->initial_balance = $request->initial_balance;
        $cashCount->final_balance = $request->final_balance;
        $cashCount->difference = '0';
        $cashCount->closing_date = $request->closing_date;
        $cashCount->state = 'Abierta';
        $cashCount->save();
    
        return redirect()->route('ptventa.cash.index')->with('success');
    }
    

    /**
     * Show the form for closing the cash count.
     * @return Renderable
     */
    public function closeCash()
    {
        $view = ['titlePage' => trans('ptventa::cash.Cash Closing'), 'titleView' => trans('ptventa::cash.Cash Closing')];
        $cashCounts = CashCount::where('state', 'Abierta')->get();
        return view('ptventa::cash.cashCount', compact('view', 'cashCounts'));
    }

    public function close(Request $request)
    {
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
    
        return redirect()->back()->with('success', trans('ptventa::cash.Successfully closed box.'));
    }
    

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('ptventa::cash.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('ptventa::cash.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
