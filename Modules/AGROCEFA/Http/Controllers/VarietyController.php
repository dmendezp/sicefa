<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Variety;

class VarietyController extends Controller
{
    public function index()
    {
        $varieties = Variety::all();
        return view('agrocefa::varieties.index', compact('varieties'));
    }

    public function create()
    {
        return view('agrocefa::varieties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lifecycle' => 'required',
        ]);

        Variety::create([
            'name' => $request->input('name'),
            'lifecycle' => $request->input('lifecycle'),
        ]);

        return redirect()->route('agrocefa.varieties.index')->with('success', 'Variedad creada exitosamente.');
    }

    public function edit($id)
    {
        $variety = Variety::findOrFail($id);
        return view('agrocefa::varieties.edit', compact('variety'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'lifecycle' => 'required',
        ]);

        $variety = Variety::findOrFail($id);
        $variety->update([
            'name' => $request->input('name'),
            'lifecycle' => $request->input('lifecycle'),
        ]);

        return redirect()->route('agrocefa.varieties.index')->with('success', 'Variedad actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $variety = Variety::findOrFail($id);
        $variety->delete();

        return redirect()->route('agrocefa.varieties.index')->with('success', 'Variedad eliminada exitosamente.');
    }
}