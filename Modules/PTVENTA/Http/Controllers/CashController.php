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
<<<<<<< HEAD
        $cashCounts = CashCount::orderBy('updated_at', 'DESC')->get(); 
        $view = ['titlePage'=>'PTVENTA - Inicio', 'titleView'=>'Caja'];
=======
        $cashCounts = CashCount::orderBy('updated_at', 'desc')->get(); 
        $view = ['titlePage' => 'Caja', 'titleView' => 'Caja'];
>>>>>>> 09e835e6ed03f7b412b33603148b4223f27f0af9
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
        $request->validate([
            'date' => 'required|date',
            'initial_balance' => 'required|numeric',
        ]);

        $cashCount = new CashCount();
        $cashCount->person_id = Auth::user()->person_id;
<<<<<<< HEAD
        $cashCount->date = $request->date;
=======
        $cashCount->opening_date = Carbon::now();
>>>>>>> 09e835e6ed03f7b412b33603148b4223f27f0af9
        $cashCount->initial_balance = $request->initial_balance;
        $cashCount->final_balance = $request->final_balance;
        $cashCount->difference = $request->final_balance - $request->initial_balance;
        $cashCount->closing_time = $request->closing_time;
<<<<<<< HEAD
        $cashCount->state = "Abierta";
=======
        $cashCount->state = 'Abierta';
>>>>>>> 09e835e6ed03f7b412b33603148b4223f27f0af9
        $cashCount->save();

        return redirect()->route('ptventa.cash.index')->with('success', 'Arqueo de caja guardado correctamente.');
    }

    /**
     * Show the form for closing the cash count.
     * @return Renderable
     */
    public function closeCash()
    {
        $view = ['titlePage' => 'Cierre de Caja', 'titleView' => 'Cierre de Caja'];
        $cashCounts = CashCount::where('state', 'Abierta')->get();
        return view('ptventa::cash.cashCount', compact('view', 'cashCounts'));
    }

    public function close(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'final_balance' => 'required',
            'closing_time' => 'required',
        ]);

        $cashCount = CashCount::find($request->input('cash_count_id'));

        $cashCount->final_balance = $validatedData['final_balance'];
        $cashCount->closing_time = $validatedData['closing_time'];
        $cashCount->state = 'Cerrada';
        $cashCount->save();

        return redirect()->back()->with('success', 'Caja cerrada exitosamente.');
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
