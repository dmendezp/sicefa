<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 
use Modules\AGROCEFA\Entities\Variety;


class VarietyController extends Controller
{
/*     public function getVarietyForSelectedUnit()
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
    } */
}
