<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\PostulationsBenefits;
use Modules\BIENESTAR\Entities\RoutesTransportations;
use Modules\BIENESTAR\Entities\AssingTransportRoutes;
use Illuminate\Database\QueryException;

class AssingFormTransporRoutesController extends Controller
{
    // Método para mostrar el formulario
    public function index()
{
    // Obtener los registros de RoutesTransportations
    $routesTransportations = RoutesTransportations::all();
    
    // Obtener los registros de asignaciones de rutas de transporte
    $assignments = AssingTransportRoutes::all();
    
    // Filtrar los registros de PostulationsBenefits por benefit_id igual a "Transporte"
    $postulationsBenefits = PostulationsBenefits::whereHas('benefit', function ($query) {
        $query->where('name', 'Transporte');
    })->get();

    // Pasar los registros a la vista
    return view('bienestar::assing-form-transportation-routes', [
        'postulationsBenefits' => $postulationsBenefits,
        'routesTransportations' => $routesTransportations,
        'assignments' => $assignments, // Pasar las asignaciones de rutas a la vista
    ]);
}

    
public function updateInline(Request $request)
{
    try {
        $routesData = $request->input('routes');

        foreach ($routesData as $postulationId => $routeIds) {
            foreach ($routeIds as $routeId) {
                // Buscar la asignación existente o crear una nueva si no existe
                $assignment = AssingTransportRoutes::where('apprentice_id', $postulationBenefit->postulation->apprentice->apprentice_id)
                    ->where('route_transportation_id', $routeId)
                    ->where('convocation_id', $postulationBenefit->postulation->convocation_id)
                    ->first();

                if (!$assignment) {
                    $assignment = new AssingTransportRoutes();
                    $assignment->apprentice_id = $postulationBenefit->postulation->apprentice->apprentice_id;
                    $assignment->route_transportation_id = $routeId;
                    $assignment->convocation_id = $postulationBenefit->postulation->convocation_id;
                    $assignment->postulation_benefit_id = $postulationId;
                }

                // Guardar la asignación
                $assignment->save();
            }
        }

        return response()->json(['success' => 'Asignaciones guardadas exitosamente.'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al guardar asignaciones.'], 500);
    }
}


}