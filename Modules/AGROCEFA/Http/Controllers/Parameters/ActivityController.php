<?php

namespace Modules\AGROCEFA\Http\Controllers\Parameters;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\ActivityType;

class ActivityController extends Controller
{

    private function buildDynamicRoute()
    {
        // Construir la ruta dinámicamente
        return 'agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.index';
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

    return redirect()->route($this->buildDynamicRoute())->with('success', 'Actividad Registrada.');
    }

    // Funcion Editar Actividad
    public function editActivity(Request $request, $id)
    {
        // Validar los datos del formulario si es necesario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'period' => 'required|string',
        ]);
    
        // Encontrar la actividad a actualizar
        $activity = Activity::findOrFail($id);
    
        // Actualizar los datos de la actividad
        $activity->name = $request->input('name');
        $activity->activity_type_id = $request->input('activity_type_id');
        $activity->description = $request->input('description');
        $activity->period = $request->input('period');
        $activity->save();

        return redirect()->route($this->buildDynamicRoute());
    }
    // Funcion Eliminar Actividad
    public function deleteActivity($id)
    {
    // Obtener la actividad por su ID
    $activity = Activity::findOrFail($id);

    // Realizar la eliminación
    $activity->delete();

    return redirect()->route($this->buildDynamicRoute())->with('error', 'Actividad Eliminada');
    }
}
