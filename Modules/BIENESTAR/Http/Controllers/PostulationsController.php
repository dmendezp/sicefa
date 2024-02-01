<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\Convocation;
use Modules\BIENESTAR\Entities\Postulation;
use Modules\BIENESTAR\Entities\Question;
use Modules\BIENESTAR\Entities\Answer;
use Modules\BIENESTAR\Entities\SocioEconomicSupportFile;


class PostulationsController extends Controller
{
    public function index()
    {
        $currentDate = now(); // Obtén la fecha actual
        $convocations = Convocation::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->get();

        return view('bienestar::postulations', compact('convocations'));
    }

    public function search(Request $request)
    {
        $documentNumber = json_decode($_POST['data']);
        $convocation = Convocation::find($request->input('convocation_id')); // Obtener la convocatoria seleccionada

        // Consulta SQL para verificar la existencia del registro en la tabla postulations
        $existingPostulation = DB::table('postulations')
            ->select(
                'postulations.id',
                'postulations.apprentice_id',
                'people.document_number',
                'convocations.name',
                'convocations.start_date',
                'convocations.end_date'
            )
            ->join('apprentices', 'postulations.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('convocations', 'postulations.convocation_id', '=', 'convocations.id')
            ->where('people.document_number', $documentNumber)
            ->whereDate('convocations.start_date', '<=', now())
            ->whereDate('convocations.end_date', '>=', now())
            ->whereNull('postulations.deleted_at')
            ->first();

        if ($existingPostulation) {
            return view('bienestar::question_postulation.messages');
        }

        // Si no existe una postulación existente, continuar con la búsqueda de aprendices
        $resultados = DB::table('apprentices')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('courses', 'apprentices.course_id', '=', 'courses.id')
            ->join('programs', 'courses.program_id', '=', 'programs.id')
            ->select(
                'apprentices.id',
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
            return response()->json(['error' => 'No se encontraron resultados para el número de documento proporcionado.']);
        }

        return view('bienestar::question_postulation.data_apprentice', compact('resultados'));
    }


    public function getquestions(Request $request)
    {
        $data = json_decode($_POST['data']);

        // Obtén las preguntas excluyendo las eliminadas suavemente
        $questions = DB::table('questions')
            ->select('questions.id as question_id', 'questions.question')
            ->join('convocations_questions', 'questions.id', '=', 'convocations_questions.questions_id')
            ->join('convocations', 'convocations_questions.convocation_id', '=', 'convocations.id')
            ->where('questions.type_question_benefit', $data)
            ->whereDate('convocations.start_date', '<=', now())
            ->whereDate('convocations.end_date', '>=', now())
            ->whereNull('questions.deleted_at') // Excluye preguntas eliminadas suavemente
            ->get();

        // Obtén las respuestas excluyendo las eliminadas suavemente
        $answers = DB::table('answers_questions')
            ->whereNull('deleted_at')  // Filtra las respuestas no eliminadas
            ->select('question_id', 'answer')
            ->get();

        $groupedQuestions = ['questions' => $questions, 'answers' => $answers];

        return view('bienestar::question_postulation.question', $groupedQuestions);
    }

    public function getallquestions(Request $request)
    {
        // Obtén las preguntas excluyendo las eliminadas suavemente
        $questions = DB::table('questions')
            ->select('questions.id as question_id', 'questions.question')
            ->join('convocations_questions', 'questions.id', '=', 'convocations_questions.questions_id')
            ->join('convocations', 'convocations_questions.convocation_id', '=', 'convocations.id')
            ->whereDate('convocations.start_date', '<=', now())
            ->whereDate('convocations.end_date', '>=', now())
            ->whereNull('questions.deleted_at') // Excluye preguntas eliminadas suavemente
            ->get();
    
        // Obtén las respuestas excluyendo las eliminadas suavemente
        $answers = DB::table('answers_questions')
            ->whereNull('deleted_at')  // Filtra las respuestas no eliminadas
            ->select('question_id', 'answer')
            ->get();
    
        return view('bienestar::question_postulation.allquestion', compact('questions', 'answers'));
    }

    public function savepostulation(Request $request)
    {
        // Validar si ya existe una postulación con el mismo documento
        $existingPostulation = Postulation::where('apprentice_id', $request->input('apprentice_id'))
        ->where('convocation_id', $request->input('convocation_id'))
        ->first();

        if ($existingPostulation) {
            // Ya existe una postulación con el mismo documento, puedes manejar esto según tus necesidades
            return response()->json(['error' => 'Ya existe una postulación con este documento.']);
        }

        // Crear una nueva postulación
        $postulation = new Postulation();
        $postulation->apprentice_id = $request->input('apprentice_id');
        $postulation->convocation_id = $request->input('convocation_id');
        $postulation->feed_benefit = $request->input('food') ?? 0;
        $postulation->transportation_benefit = $request->input('transport') ?? 0;
        $postulation->save();


        // Obtener las respuestas del formulario
        $answers = $request->input('answer', []);
        $questionIds = $request->input('question', []);

        // Recorrer las respuestas y guardarlas relacionadas con la postulación
        foreach ($answers as $index => $answerValue) {
            if (!empty($answerValue) && isset($questionIds[$index])) {
                $respuesta = new Answer();
                $respuesta->answer = $answerValue; // Guardar el valor de la respuesta
                $respuesta->postulation_id = $postulation->id;
                $respuesta->question_id = $questionIds[$index]; // Guardar el ID de la pregunta
                $respuesta->save();
            }
        }

        $file = $request->file('socioeconomicFile');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = 'modules/bienestar/socioeconomico/' . $fileName; // Ruta dentro de la carpeta public

        // Mover el archivo a la carpeta public
        $file->move(public_path('modules/bienestar/socioeconomico'), $fileName);

        // Guardar el archivo en la tabla SocioEconomicSupportFile
        $supportFile = new SocioEconomicSupportFile();
        $supportFile->file_path = $filePath;
        $supportFile->postulation_id = $postulation->id;
        $supportFile->save();

        // Redireccionar a la vista de edición o a donde desees después de guardar
        return response()->json(['success' => 'Postulación exitosa!']);
        
    }
}