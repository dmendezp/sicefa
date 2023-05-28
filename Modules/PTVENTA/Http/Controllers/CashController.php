<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PTVENTA\Entities\Arqueo;

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
            'fecha' => 'required|date',
            'saldo_inicial' => 'required|numeric',
            'saldo_final' => 'required|numeric',
        ]);

        $arqueo = new Arqueo();
        $arqueo->fecha = $request->fecha;
        $arqueo->saldo_inicial = $request->saldo_inicial;
        $arqueo->saldo_final = $request->saldo_final;
        $arqueo->diferencia = $request->saldo_final - $request->saldo_inicial;
        $arqueo->save();

        return redirect()->route('arqueo.create')->with('success', 'Arqueo de caja guardado correctamente.');
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
