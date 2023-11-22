<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\AssignTransportRoute;
use Modules\SICA\Entities\Apprentice;
use Modules\BIENESTAR\Entities\RouteTransportation;



class AssingTransportRoutesController extends Controller
{
    public function mostrarAsignaciones(Request $request)
    {
        $nombreRutaSeleccionada = $request->input('ruta');

        // Obtener todas las rutas de transporte
        $rutas = RouteTransportation::all();

        // Si se ha seleccionado una ruta, filtrar las asignaciones por esa ruta
        if ($nombreRutaSeleccionada) {
            $asignaciones = AssignTransportRoute::whereHas('routes_trasportation', function ($query) use ($nombreRutaSeleccionada) {
                $query->where('name_route', $nombreRutaSeleccionada);
            })->get();
        } else {
            // Si no se ha seleccionado ninguna ruta, mostrar todas las asignaciones
            $asignaciones = AssignTransportRoute::all();
        }

        return view('bienestar::assign-transportation-routes', [
            'asignaciones' => $asignaciones,
            'rutas' => $rutas,
        ]);
    }

public function showAssignmentForm($apprenticeId)
{
    // Obtener los detalles del aprendiz en función de $apprenticeId
    $apprentizData = Apprentice::with('person')->find($apprenticeId);

    // Verificar si se encontró el aprendiz
    if (!$apprentizData) {
        // Puedes manejar la situación si no se encuentra el aprendiz
        // Por ejemplo, redirigiendo o mostrando un mensaje de error
    }

    // Construir el nombre completo del aprendiz
    $fullName = $apprentizData->person->first_name . ' ' . $apprentizData->person->first_last_name . ' ' . $apprentizData->person->second_last_name;

    // Pasar los datos del aprendiz y el nombre completo a la vista
    return view('bienestar.assign-transportation-routes', ['apprentizData' => $apprentizData, 'fullName' => $fullName]);
}

public function obtenerRegistrosFiltrados(Request $request)
{
    $rutaSeleccionada = $request->input('ruta');

    $registrosFiltrados = AssignTransportRoute::whereHas('routes_trasportation', function ($query) use ($rutaSeleccionada) {
        $query->where('name_route', $rutaSeleccionada);
    })->get();

    return view('bienestar::partials.tabla-registros', ['registros' => $registrosFiltrados]);
}

}
