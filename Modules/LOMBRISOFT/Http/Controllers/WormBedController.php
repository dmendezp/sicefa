<?php

namespace Modules\LOMBRISOFT\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\LOMBRISOFT\Entities\WormBed;

class WormBedController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $camas = WormBed::all();
        return view('lombrisoft::admin.listacamas', compact('camas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('lombrisoft::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|integer',
            'estado' => 'required|string',
            'fecha_inicio' => 'required|date',
        ]);

        WormBed::create([
            'number' => $request->input('numero'),
            'status' => $request->input('estado'),
            'start_date' => $request->input('fecha_inicio'),
        ]);

        return redirect()->route('lombrisoft.admin.camas')->with('success', 'Cama creada correctamente.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('lombrisoft::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $cama = WormBed::findOrFail($id);
        return view('lombrisoft::admin.edit', compact('cama'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'numero' => 'required|integer',
            'estado' => 'required|string',
            'fecha_inicio' => 'required|date',
        ]);

        $cama = WormBed::findOrFail($id);
        $cama->number = $request->input('numero');
        $cama->status = $request->input('estado');
        $cama->start_date = $request->input('fecha_inicio');
        $cama->save();

        return redirect()->route('lombrisoft.admin.camas')->with('success', 'Cama actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $cama = WormBed::findOrFail($id);
        $cama->delete();

        return redirect()->route('lombrisoft.admin.camas')->with('success', 'Cama eliminada correctamente.');
    }
}
