<?php

namespace Modules\LOMBRISOFT\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\LOMBRISOFT\Entities\WormBed;

class WormBedController extends Controller
{
    public function index()
    {
        $camas = WormBed::all();
        return view('lombrisoft::admin.listacamas', compact('camas'));
    }

    public function create()
    {
        return view('lombrisoft::admin.create');
    }

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

        return redirect()->route('lombrisoft.admin.camas.index')
               ->with('success', 'Cama creada correctamente.');
    }

    public function show($id)
    {
        $cama = WormBed::findOrFail($id);
        return view('lombrisoft::admin.show', compact('cama'));
    }

    public function edit($id)
    {
        $cama = WormBed::findOrFail($id);
        return view('lombrisoft::admin.edit', compact('cama'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'numero' => 'required|integer',
            'estado' => 'required|string',
            'fecha_inicio' => 'required|date',
        ]);

        $cama = WormBed::findOrFail($id);
        $cama->update([
            'number' => $request->input('numero'),
            'status' => $request->input('estado'),
            'start_date' => $request->input('fecha_inicio'),
        ]);

        return redirect()->route('lombrisoft.admin.camas.index')
               ->with('success', 'Cama actualizada correctamente.');
    }

    public function destroy($id)
    {
        $cama = WormBed::findOrFail($id);
        $cama->delete();

        return redirect()->route('lombrisoft.admin.camas.index')
               ->with('success', 'Cama eliminada correctamente.');
    }
}