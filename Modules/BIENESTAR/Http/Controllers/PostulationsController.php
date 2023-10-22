<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Support\Facades\DB;

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

    public function search(Request $request)
    {
        $documentNumber = $request->input('search');

        // Realizar la consulta
        $resultados = DB::table('apprentices')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('courses', 'apprentices.course_id', '=', 'courses.id')
            ->join('programs', 'courses.program_id', '=', 'programs.id')
            ->select(
                'people.document_number',
                'people.first_name',
                'people.first_last_name',
                'people.second_last_name',
                'courses.code',
                'programs.name',
                'people.socioeconomical_status',
                'people.sisben_level',
                'people.personal_email',
                'people.population_group_id'
            )
            ->where('people.document_number', $documentNumber)
            ->get();

        if ($resultados->isEmpty()) {
            return redirect()->route('cefa.bienestar.postulations')->with('error', 'No se encontraron resultados para el número de documento proporcionado.');
        }

        return view('bienestar::postulations', compact('resultados'));
    }

    public function consulta(Request $request)
    {
        $selectedBenefits = $request->input('benefits'); // Obtiene los beneficios seleccionados

        if (is_array($selectedBenefits) && count($selectedBenefits) > 0) {
            // Si se seleccionaron beneficios, construye la consulta
            $query = DB::table('answers_questions')
                ->join('questions', 'answers_questions.question_id', '=', 'questions.id')
                ->whereIn('questions.type_question_benefit', $selectedBenefits)
                ->select('questions.question', 'questions.type_question_benefit', 'answers_questions.answer')
                ->get();

            // Procesa los resultados de la consulta

            return view('bienestar::postulations', compact('query'));
        } else {
            // No se seleccionaron beneficios, puedes redirigir a otra vista o mostrar un mensaje de error
            return view('bienestar::postulations');
        }
    }
}
