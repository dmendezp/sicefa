<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\PostulationBenefit;
use Modules\BIENESTAR\Entities\RouteTransportation;
use Modules\BIENESTAR\Entities\AssignTransportRoute;
use Illuminate\Database\QueryException;
use Modules\SICA\Entities\Quarter;
use Modules\BIENESTAR\Entities\Convocation;

class AssingFormTransporRoutesController extends Controller
{
    public function index()
    {
        // Obtener el trimestre más reciente
        $latestQuarter = Quarter::orderBy('end_date', 'desc')->first();
    
        // Verificar si se encontró el trimestre más reciente
        if ($latestQuarter) {
            // Filtrar las convocatorias por el rango de fechas del trimestre más reciente
            $convocations = Convocation::whereBetween('start_date', [$latestQuarter->start_date, $latestQuarter->end_date])
                ->orWhereBetween('end_date', [$latestQuarter->start_date, $latestQuarter->end_date])
                ->get();
        } else {
            // Manejar el caso en el que no haya trimestres disponibles
            $convocations = [];
        }
    
        // Obtener los registros de RoutesTransportations
        $routesTransportations = RouteTransportation::all();
        
        // Obtener los registros de asignaciones de rutas de transporte
        $assignments = AssignTransportRoute::all();
        
        // Filtrar los registros de PostulationsBenefits por benefit_id igual a "Transporte"
        $postulationsBenefits = PostulationBenefit::whereHas('benefit', function ($query) {
            $query->where('name', 'Transporte');
        })->get();
    
        // Pasar los registros a la vista
        return view('bienestar::assing-form-transportation-routes', [
            'postulationsBenefits' => $postulationsBenefits,
            'routesTransportations' => $routesTransportations,
            'assignments' => $assignments, // Pasar las asignaciones de rutas a la vista
            'convocations' => $convocations, // Pasar las convocatorias filtradas a la vista
        ]);
    }
    

    
    public function updateInline(Request $request)
    {
        try {
            // Obtén los datos de la solicitud AJAX
            $apprenticeId = $request->input('apprentice_id');
            $routeTransportationId = $request->input('route_transportation_id');
            $postulationBenefitId = $request->input('postulation_benefit_id');
            $isChecked = $request->input('checked');
    
            // Verificar si existe un registro
            $assignment = AssignTransportRoute::where('apprentice_id', $apprenticeId)
                ->where('postulation_benefit_id', $postulationBenefitId)
                ->first();
    
            // Recuperar la ruta anterior si existe
            $previousRouteId = null;
            if ($assignment) {
                $previousRouteId = $assignment->route_transportation_id;
            }
    
            // Realizar las operaciones según el estado del radio button
            if ($isChecked === 'true') {
                if (!$assignment) {
                    // Si está marcado y no existe, crear un nuevo registro
                    $assignment = new AssignTransportRoute();
                    $assignment->apprentice_id = $apprenticeId;
                    $assignment->postulation_benefit_id = $postulationBenefitId;
                }
    
                // Actualizar el routeTransportationId
                $assignment->route_transportation_id = $routeTransportationId;
                $assignment->save(); // Guardar la asignación
    
                // Restaurar la quota de la ruta anterior si existe
                if ($previousRouteId) {
                    $previousRoute = RouteTransportation::find($previousRouteId);
                    if ($previousRoute) {
                        $previousRoute->quota += 1; // Incrementar la quota
                        $previousRoute->save(); // Guardar la actualización de la quota
                    }
                }
    
                // Reducir la quota de la nueva ruta
                $newRoute = RouteTransportation::find($routeTransportationId);
                if ($newRoute) {
                    $newRoute->quota -= 1; // Reducir la quota
                    $newRoute->save(); // Guardar la actualización de la quota
                }
            } elseif ($isChecked == 'false' && $assignment) {
                // Si se desmarca y existe, deshabilitar lógicamente el registro
                try {
                    $assignment->delete(); // Aplicar soft delete a la asignación
                } catch (Exception $e) {
                    // Manejo de errores de eliminación lógica
                    error_log('Error al eliminar la asignación: ' . $e->getMessage());
                    return response()->json([
                        'error' => 'Error al eliminar la asignación: ' . $e->getMessage(),
                        'message' => 'Hubo un error al eliminar la asignación de la ruta.',
                    ], 500); // Salir si hay un error
                }
    
                // Restaurar la cuota de la ruta anterior si existe
                if ($previousRouteId) {
                    $previousRoute = RouteTransportation::find($previousRouteId);
                    if ($previousRoute) {
                        try {
                            $previousRoute->quota += 1; // Incrementar la cuota
                            $previousRoute->save(); // Guardar la actualización de la cuota
                        } catch (Exception $e) {
                            // Manejo de errores de actualización de cuota
                            error_log('Error al actualizar la cuota de la ruta: ' . $e->getMessage());
                        }
                    } else {
                        // Manejo si no se encuentra la ruta
                        error_log('No se encontró la ruta con ID: ' . $previousRouteId);
                    }
                } else {
                    // Manejo si $previousRouteId es nulo o inválido
                    
                    error_log('El ID de la ruta anterior es nulo o inválido.');
                }
            }
    
            return response()->json([
                'success' => 'Registros actualizados con éxito.',
                'message' => '¡Asignación de ruta actualizada correctamente!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al actualizar los registros: ' . $e->getMessage(),
                'message' => 'Hubo un error al actualizar la asignación de la ruta.',
            ], 500);
        }
    }
    


}