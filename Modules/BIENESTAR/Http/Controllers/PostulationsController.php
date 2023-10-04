<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\Postulations;
use Modules\BIENESTAR\Entities\Convocations;
use Modules\SICA\Entities\Apprentice;
use Modules\BIENESTAR\Entities\TypesOfBenefits;
use Modules\BIENESTAR\Entities\Questions;
use Modules\BIENESTAR\Entities\Benefits;
use Modules\BIENESTAR\Entities\PostulationsBenefits;
use Modules\BIENESTAR\Entities\Answers;
use Illuminate\Http\JsonResponse;


class PostulationsController extends Controller
{
    public function index()
    {
        return view('bienestar::postulations');
    }
    
    public function buscar(Request $request)
    {
        // Obtener el término de búsqueda del formulario
        $query = $request->input('q');

        // Realizar la búsqueda en tu modelo
        $resultados = TuModelo::where('campo_a_buscar', 'LIKE', '%' . $query . '%')->get();

        // Puedes modificar el campo_a_buscar y TuModelo según tus necesidades

        // Devolver los resultados a la vista
        return view('vista_de_resultados', compact('resultados'));
    }
}