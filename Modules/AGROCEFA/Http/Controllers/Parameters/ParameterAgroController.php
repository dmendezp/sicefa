<?php

namespace Modules\AGROCEFA\Http\Controllers\Parameters;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Specie; 
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\ActivityType;

class ParameterAgroController extends Controller
{   
    public function parametersview()
    {   
        $selectedUnitId = Session::get('selectedUnitId'); // Obtén el ID de la unidad seleccionada
        $activityTypes= ActivityType::all(); //Listar Tipos de Actividad
        $species= Specie::all();// listar especies
        $activities = $this->getActivitiesForSelectedUnit(); // Llama a la función y obtiene las actividades

        return view('agrocefa::parameters', [
            'activities' => $activities, // Pasa las actividades a la vista
            'species' => $species,
            'activityTypes' => $activityTypes,
            'selectedUnitId' => $selectedUnitId,
        ]);
    }
    //Funcion listar Actividad por Unidad
    public function getActivitiesForSelectedUnit()
    {
        // Obtén el ID de la unidad productiva seleccionada de la sesión
        $selectedUnitId = Session::get('selectedUnitId');

        // Verifica si hay un ID de unidad seleccionada en la sesión
        if ($selectedUnitId) {
            // Obtiene todas las actividades asociadas a la unidad productiva seleccionada
            $activities = Activity::with('activity_type') // Cargar la relación activityType
                                  ->where('productive_unit_id', $selectedUnitId)
                                  ->get();

            return $activities; // Retorna el arreglo de actividades
        } else {
            // Si no hay ID de unidad seleccionada en la sesión, retorna un arreglo vacío o realiza alguna acción
            return [];
        }
    }
    public function createActivity(Request $request)
    {
    // Obtén el ID de la unidad productiva seleccionada de la sesión
    $selectedUnitId = Session::get('selectedUnitId');

    // Validar los datos del formulario aquí si es necesario
    $activity = new Activity();
    $activity->productive_unit_id = $selectedUnitId; // Usar el ID de la unidad de la sesión
    $activity->activity_type_id = $request->input('activity_type_id');
    $activity->name = $request->input('name'); // Nombre de la actividad
    $activity->description = $request->input('description');
    $activity->period = $request->input('period');

    $activity->save();

    return redirect()->route('agrocefa.parameters')->with('success', 'Actividad registrada exitosamente.');
    }
    // Funcion Editar Actividad
    public function editActivity(Request $request, Activity $activity)
    {
    // Validar los datos del formulario aquí si es necesario
    
    $activity->activity_type_id = $request->input('activity_type_id');
    $activity->name = $request->input('name'); // Nombre de la actividad
    // Otros campos que quieras actualizar
    $activity->save();

    return redirect()->route('agrocefa.parameters')->with('success', 'Actividad actualizada exitosamente.');
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
