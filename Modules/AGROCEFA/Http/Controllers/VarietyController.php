<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Variety;

class VarietyController extends Controller
{

    private function buildDynamicRoute()
    {
        // Almacenar el rol en la sesión
        session(['rol' => Auth::user()->rol]);

        // Construir la ruta dinámicamente
        return 'agrocefa.' . session('rol') . '.parameters.index';
    }

    public function index()
    {
        $varieties = Variety::with('specie')->get();
        return view('agrocefa::parameters.parameter ', compact('varieties'));
    }

    public function species()
{
    return $this->belongsTo(Species::class)->withDefault(); // Con withDefault(), se establecerá una especie vacía si no hay una relación.
}


    public function create()
    {
        return view('agrocefa::varieties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'specie_id' => 'required',
        ]);

        Variety::create([
            'name' => $request->input('name'),
            'specie_id' => $request->input('specie_id'),
        ]);

        return redirect()->route($this->buildDynamicRoute())->with('success', 'Variedad creada exitosamente.');
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'specie_id' => 'required',
        ]);

        $variety = Variety::findOrFail($id);
        $variety->update([
            'name' => $request->input('name'),
            'specie_id' => $request->input('specie_id'),
        ]);

        return redirect()->route($this->buildDynamicRoute())->with('success', 'Variedad actualizada exitosamente.');
    }

    public function delete($id)
    {
        $variety = Variety::findOrFail($id);
        $variety->delete();

        return redirect()->route($this->buildDynamicRoute())->with('error', 'Variedad eliminada exitosamente.');
    }
}