<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\Postulations;
use Modules\BIENESTAR\Entities\Convocations;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Person;
use Modules\BIENESTAR\Entities\TypesOfBenefits;
use Modules\BIENESTAR\Entities\Questions;
use Modules\BIENESTAR\Entities\Benefits;
use Modules\BIENESTAR\Entities\PostulationsBenefits;
use Modules\BIENESTAR\Entities\Answers;
use Illuminate\Http\JsonResponse;


class PostulationsController extends Controller
{
    public function index(){
        return view('bienestar::postulations');
    }
    
    public function buscar(Request $request)
{
    // Obtén el número de documento ingresado en el formulario
    $numeroDocumento = $request->input('busqueda');

    // Realiza la búsqueda en la base de datos usando tu modelo Person
    $resultados = Person::where('document_number', $numeroDocumento)->first();

    if (!$resultados) {
        // No se encontraron resultados, establece la variable de sesión
        session()->flash('no_resultados', true);
    } else {
        // Si se encontraron resultados, busca las postulaciones del aprendiz
        $apprendices = Apprentice::where("person_id", $resultados->id)->pluck("id");
        $postulations = Postulations::whereIn("apprentice_id", $apprendices)->get();
    }

    // Devuelve la vista con los resultados de la búsqueda
    return view('bienestar::postulations', compact('resultados', 'postulations'));
}

}