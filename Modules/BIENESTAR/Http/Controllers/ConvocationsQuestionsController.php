<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\ConvocationQuestion;
use Modules\BIENESTAR\Entities\Question;
use Modules\BIENESTAR\Entities\AnswersQuestion;
use Modules\BIENESTAR\Entities\Convocation;

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
        $questions = Question::all();
        $answers = AnswersQuestion::all();

        return view('bienestar::editform', ['questions' => $questions, 'answers' => $answers, 'convocations' => $convocations]);
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
        return redirect()->route('bienestar.admin.crud.editform')->with('success', 'Pregunta y respuestas guardadas exitosamente.');
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
        return redirect()->route('bienestar.admin.crud.editform')->with('success', 'Pregunta y respuestas actualizadas con éxito.');
    }




    /**
     * @method('POST')
     */
    public function saveForm(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'convocatoria_id' => 'required|exists:convocations,id',
            'selected_question_ids' => 'required|string',
        ]);

        try {
            // Obtener el ID de la convocatoria y los IDs de las preguntas seleccionadas
            $convocatoriaId = $request->input('convocatoria_id');
            $selectedQuestionIds = explode(',', $request->input('selected_question_ids'));

            // Recorre los IDs de las preguntas seleccionadas y guárdalos en la base de datos
            foreach ($selectedQuestionIds as $questionId) {
                // Aquí puedes guardar $convocatoriaId y $questionId en tu base de datos
                $pregunta = new ConvocationQuestion();
                $pregunta->convocation_id = $convocatoriaId;
                $pregunta->questions_id = $questionId;
                $pregunta->save();
            }

            // Devolver una respuesta JSON exitosa
            return redirect()->route('bienestar.admin.crud.editform')->with('success', 'Se ha guardado con exito');
        } catch (\Exception $e) {
            // En caso de error, manejar el error y devolver una respuesta JSON con un mensaje de error
            return redirect()->route('bienestar.admin.crud.editform')->with('error', 'Error al guardar');
        }
    }
}
