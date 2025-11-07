<?php

namespace Modules\AGROCEFA\Http\Controllers\Parameters;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Variety;

class VarietyController extends Controller
{

    private function buildDynamicRoute()
    {
        // Construir la ruta dinámicamente
        return 'agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.index';
    }

    public function index()
    {
        $varieties = Variety::with('specie')->get();
        return view('agrocefa::parameters.parameter ', compact('varieties'));
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

        return redirect()->route($this->buildDynamicRoute())->with('success', 'Variedad Registrada');
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

        return redirect()->route($this->buildDynamicRoute())->with('success', 'Variedad Actualizada');
    }

    public function delete($id)
    {
        $variety = Variety::findOrFail($id);
        $variety->delete();

        return redirect()->route($this->buildDynamicRoute())->with('success', 'Variedad Eliminada');
    }
}