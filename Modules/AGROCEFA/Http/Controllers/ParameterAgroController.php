<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ParameterAgroController extends Controller
{
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
}
