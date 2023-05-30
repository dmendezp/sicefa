<?php

namespace Modules\PTVENTA\Http\Controllers;

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
        $view = ['titlePage'=>'PTVENTA - Inicio', 'titleView'=>'Caja'];
        return view('ptventa::cash.index', compact('view'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ptventa::create');
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
            'final_balance' => 'required|numeric',
        ]);

        $arqueo = new CashCount();
        $arqueo->person_id = Auth::user()->person_id;
        $arqueo->date = $request->date;
        $arqueo->initial_balance = $request->initial_balance;
        $arqueo->final_balance = $request->final_balance;
        $arqueo->difference = $request->final_balance - $request->initial_balance;
        $arqueo->state = "Abierta";
        $arqueo->save();

        return redirect()->route('ptventa.cash.index')->with('success', 'Arqueo de caja guardado correctamente.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('ptventa::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('ptventa::edit');
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
