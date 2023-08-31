<?php

namespace Modules\AGROCEFA\Http\Controllers\Parameters;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Specie; 
use Modules\SICA\Entities\Activity;
use Modules\AGROCEFA\Entities\Crop;
use Modules\SICA\Entities\ActivityType;
use Modules\AGROCEFA\Http\Controllers\Parameters\ActivityController;

class ParameterAgroController extends Controller
{   
    public function parametersview()
    {       
        $activityController = new ActivityController();
        $crop = Crop::all();
        $selectedUnitId = Session::get('selectedUnitId'); // Obtén el ID de la unidad seleccionada
        $activityTypes= ActivityType::all(); //Listar Tipos de Actividad
        $species= Specie::all();// listar especies
        $activities = $activityController->getActivitiesForSelectedUnit(); // Llama a la función y obtiene las actividades

        return view('agrocefa::parameters', [
            'activities' => $activities, // Pasa las actividades a la vista
            'species' => $species,
            'crop' => $crop,
            'activityTypes' => $activityTypes,
            'selectedUnitId' => $selectedUnitId,
        ]);
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

    /* Funcion editar especie */

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
        return redirect()->route('agrocefa.parameters')/* ->with('success', 'Especie actualizada correctamente.') */;
    }

    /* Funcion eliminar especie*/

    public function destroy($id)
    {
        try {
            $species = Specie::findOrFail($id);
            $species->delete();

            return redirect()->route('agrocefa.parameters')->with('success', 'Especie eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('agrocefa.parameters')->with('error', 'Error al eliminar la especie.');
        }
    }
    
}