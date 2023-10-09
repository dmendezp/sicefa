<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\AssingTransportRoutes;
use Modules\SICA\Entities\Apprentice;

class AssingTransportRoutesController extends Controller
{
    public function mostrarAsignaciones()
{
    $asignaciones = AssingTransportRoutes::all();

    return view('bienestar::assign-transportation-routes', ['asignaciones' => $asignaciones]);
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

}
