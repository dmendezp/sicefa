<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Specie; 


class SpecieController extends Controller
{
    public function index()
    {
        $species= Specie::all();
        return view('agrocefa::parameters', compact('species'));
    }

    public function editView($id)
    {
        $specie = Specie::findOrFail($id);
        return view('agrocefa::species.edit', compact('specie'));
    }
    
    public function deleteView($id)
    {
        $specie = Specie::findOrFail($id);
        return view('agrocefa::species.delete', compact('specie'));
    }

    public function create()
    {
        return view('agrocefa::species.create');
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario si es necesario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lifecycle' => 'required|in:Transitorio,Permanente',
        ]);
    
        // Encontrar la especie a actualizar
        $specie = Specie::findOrFail($id);
    
        // Actualizar los datos de la especie
        $specie->name = $request->input('name');
        $specie->lifecycle = $request->input('lifecycle');
        $specie->save();
    
        // Redireccionar a la vista de lista de especies o a otra página según sea necesario
        return redirect()->route('agrocefa.species.index')/* ->with('success', 'Especie actualizada correctamente.') */;
    }
    

    public function destroy($id)
    {
        try {
            $species = Specie::findOrFail($id);
            $species->delete();

            return redirect()->route('agrocefa.species.index')->with('success', 'Especie eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('agrocefa.species.index')->with('error', 'Error al eliminar la especie.');
        }
    }

    public function store(Request $request)
    {
        // Validación de los datos enviados desde el formulario
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'lifecycle' => 'required|in:Transitorio,Permanente',
            // Agrega más reglas de validación según tus necesidades
        ]);

        // Crear una nueva instancia de Specie y asignar los valores validados
        $specie = new Specie();
        $specie->name = $validatedData['name'];
        $specie->lifecycle = $validatedData['lifecycle'];
        // Asigna más valores si hay más campos en el formulario

        // Intenta guardar el nuevo registro en la base de datos
        try {
            $specie->save();
            return redirect()->route('agrocefa.species.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear la especie. Por favor, inténtalo de nuevo.');
        }
    }



}