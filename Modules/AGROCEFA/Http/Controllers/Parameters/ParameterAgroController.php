<?php

namespace Modules\AGROCEFA\Http\Controllers\Parameters;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Specie; 

class ParameterAgroController extends Controller
{   
    public function parametersview()
    {
        $species= Specie::all();// listar especies
        return view('agrocefa::parameters', compact('species'));
    }
    
    public function create(Request $request, $unitId)
    {
    // Validar los datos del formulario aquí si es necesario

    $activity = new Activity();
    $activity->unit_id = $unitId;
    $activity->activity_type_id = $request->input('activity_type_id');
    // Otros campos que quieras asignar
    $activity->save();

    // Redireccionar a la vista deseada después de guardar
    return redirect()->route('agrocefa.index', ['unitId' => $unitId])->with('success', 'Actividad registrada exitosamente.');
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
            return redirect()->route('agrocefa.parameters');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear la especie. Por favor, inténtalo de nuevo.');
        }
    }
}
