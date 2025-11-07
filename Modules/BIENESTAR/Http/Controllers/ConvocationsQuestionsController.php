<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\ConvocationQuestion;
use Modules\BIENESTAR\Entities\Question;
use Modules\BIENESTAR\Entities\AnswersQuestion;
use Modules\BIENESTAR\Entities\Convocation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ConvocationsQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function add_question()
    {
        $questions = Question::all();
        return view('bienestar::add_question', ['questions' => $questions]);
    }


    public function editform()
    {
        $convocations = Convocation::all();
         // Filtrar las convocatorias basándonos en la fecha actual
    $currentDate = Carbon::now();

    $filteredConvocations = $convocations->filter(function ($convocation) use ($currentDate) {
        return $currentDate->between($convocation->start_date, $convocation->end_date);
    });
        $questions = Question::all();
        $answers = AnswersQuestion::all();

        return view('bienestar::editform', ['questions' => $questions, 'answers' => $answers, 'convocations' => $filteredConvocations]);
    }

    public function deleteQuestion($id)
    {
        // Primero, obtenemos la pregunta por su ID
        $question = Question::find($id);

        // Si la pregunta no existe, enviamos una respuesta JSON con un mensaje de error
        if (!$question) {
            return response()->json(['mensaje' => 'La pregunta no existe.'], 400);
        }

        // Eliminamos las respuestas asociadas a esta pregunta
        AnswersQuestion::where('question_id', $id)->delete();

        // Eliminamos la pregunta
        $question->delete();

        // Enviamos una respuesta JSON con un mensaje de éxito
        return response()->json(['mensaje' => 'La pregunta y sus respuestas han sido eliminadas con éxito.'], 200);
    }

    public function deleteAnswer($id)
    {
        $answer =  AnswersQuestion::findOrFail($id);
        // Eliminamos la respuesta
        $answer->delete();

        // Enviamos una respuesta JSON con un mensaje de éxito
        return response()->json(['mensaje' => 'La respuestas han sido eliminadas con éxito.'], 200);
    }


    public function add_answer(Request $request)
{
    // Crear una nueva pregunta
    $pregunta = new Question();
    $pregunta->question = $request->input('text_question');
    $pregunta->type_question_benefit = $request->input('question_category');
    $pregunta->save();

    // Guardar las respuestas relacionadas con la pregunta
    foreach ($request->input('respuestas') as $respuestaText) {
        if (!empty($respuestaText)) {
            $respuesta = new AnswersQuestion();
            $respuesta->answer = $respuestaText;
            $respuesta->question_id = $pregunta->id; // Asignar la pregunta_id
            $respuesta->save();
        }
    }

    // Redireccionar a la vista de edición o a donde desees después de guardar
    return response()->json(['success' => 'Pregunta y respuestas guardadas exitosamente!']);
}


    public function updateQuestion(Request $request, $id)
    {

        // Encuentra la pregunta por su ID
        $pregunta = Question::find($id);

        if (!$pregunta) {
            // Si la pregunta no se encuentra, muestra un mensaje y redirige
            return redirect()->back()->with('error', 'Pregunta no encontrada o ID inválido.');
        }

        // Actualiza la pregunta con los nuevos valores
        $pregunta->update([
            'question' => $request->input('question'), // Accede directamente al campo 'question'
        ]);

        $respuestas = $request->input('answer', []);
        if (!empty($respuestas)) {
            foreach ($respuestas as $respuestaId => $respuestaText) {
                $respuesta = AnswersQuestion::findOrFail($respuestaId); // Encuentra la respuesta por su ID
                $respuesta->update([
                    'answer' => $respuestaText,
                ]);
            }
        }

        // Redirige de nuevo con un mensaje de éxito
        return response()->json(['success' => 'Pregunta y respuestas actualizadas con éxito!']);
    }

    public function updateAnswer(Request $request)
    {
        $answer = $request->input('answer');
        $id_question = $request->input('id_question');
    
        // Verifica si existe un registro igual, incluyendo los eliminados suavemente
        $existingAnswer = AnswersQuestion::withTrashed()
            ->where('answer', $answer)
            ->where('question_id', $id_question)
            ->first();
    
        // Si existe un registro igual (incluso si ha sido eliminado suavemente), restaura el registro y permite la creación del nuevo
        if ($existingAnswer) {
            // Restaurar el registro eliminado suavemente (opcional)
            $existingAnswer->restore();
    
            // Puedes personalizar la respuesta según tus necesidades, en este caso, redirigir a una vista de edición
            return response()->json(['success' => 'Se ha agregado la respuesta con éxito!']);
        }
    
        // Si no existe un registro igual (incluso si ha sido eliminado suavemente), crea uno nuevo
        $respuesta = new AnswersQuestion();
        $respuesta->answer = $answer;
        $respuesta->question_id = $id_question;
        $respuesta->save();
    
        return response()->json(['success' => 'Se ha agregado la respuesta con éxito!']);
    }
    


    public function showForm(Request $request)
    {
       
        $selectedConvocationId = $request->input('selectedConvocationId');
        
        // Obtener las preguntas relacionadas con la convocatoria seleccionada
        $relatedQuestions = [];
        if ($selectedConvocationId) {
            $relatedQuestions = (array) ConvocationQuestion::where('convocation_id', $selectedConvocationId)
                ->pluck('questions_id')
                ->toArray();
        } 

        // Devolver la información en formato JSON
        return response()->json(['relatedQuestions' => $relatedQuestions]);
    }



    /**
     * @method('POST')
     */
    public function saveForm(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'convocatoria_id' => 'required|exists:convocations,id',
            'selected_questions' => 'required|string',
        ]);
        $convocatoriaId = $request->input('convocatoria_id');
        $selectedQuestionIds = explode(',', $request->input('selected_questions'));

        // Recorre los IDs de las preguntas seleccionadas y guárdalos en la base de datos
        foreach ($selectedQuestionIds as $questionId) {
            // Verifica si ya existe la relación, si no existe, la crea
            ConvocationQuestion::firstOrCreate([
                'convocation_id' => $convocatoriaId,
                'questions_id' => $questionId,
            ]);
        }


        // Devolver una respuesta JSON exitosa
        return redirect()->route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.convocations.crud.editform');
    }

    public function deleteQuestionCall(Request $request){
        
        $questionId = $request->input('questionId');
        $convocationId = $request->input('convocationId');
        
        // Verifica si ya existe la relación
        $existingRelation = ConvocationQuestion::where('questions_id', $questionId)
            ->where('convocation_id', $convocationId)
            ->first();
        
        if ($existingRelation) {
            // Si la relación existe, la elimina
            $existingRelation->delete();

            return response()->json(['success' => 'Se ha eliminada la pregunta con éxito de la convocatoria!']);
        } else {
            // Si la relación no existe, puedes manejarlo según tus necesidades
            return response()->json(['error' => 'La relación no existe']);
        }
        

    }
}