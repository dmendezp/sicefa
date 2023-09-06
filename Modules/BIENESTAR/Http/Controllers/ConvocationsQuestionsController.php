<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\Questions;
use Modules\BIENESTAR\Entities\AnswersQuestions;

class ConvocationsQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function add_question()
    {
        $questions = Questions::all();
        return view('bienestar::add_question', ['questions' => $questions]);
    }


    public function editform()
    {

        $questions = Questions::all();
        $answers = AnswersQuestions::all();

        return view('bienestar::editform', ['questions' => $questions, 'answers' => $answers]);
    }

    public function deleteQuestion($id)
    {
        // Primero, obtenemos la pregunta por su ID
        $question = Questions::find($id);

        // Si la pregunta no existe, redirigimos o mostramos un mensaje de error
        if (!$question) {
            return redirect()->route('bienestar.editform')->with('error', 'La pregunta no existe.');
        }

        // Eliminamos las respuestas asociadas a esta pregunta
        AnswersQuestions::where('question_id', $id)->delete();

        // Eliminamos la pregunta
        $question->delete();

        // Redirigimos o mostramos un mensaje de éxito después de la eliminación
        return redirect()->route('bienestar.editform')->with('success', 'La pregunta y sus respuestas han sido eliminadas con éxito.');
    }

    public function addQuestion(Request $request)
    {
        // Crear una nueva pregunta
        $pregunta = new Questions();
        $pregunta->question = $request->input('text_question');
        $pregunta->save();

        // Guardar las respuestas relacionadas con la pregunta
        foreach ($request->input('respuestas') as $respuestaText) {
            if (!empty($respuestaText)) {
                $respuesta = new AnswersQuestions();
                $respuesta->answer = $respuestaText;
                $respuesta->question_id = $pregunta->id; // Asignar la pregunta_id
                $respuesta->save();
            }
        }

        // Redireccionar a la vista de edición o a donde desees después de guardar
        return redirect()->route('bienestar.editform')->with('success', 'Pregunta y respuestas guardadas exitosamente.');
    }

    public function updateQuestion(Request $request, $id)
    {
        // Encuentra la pregunta por su ID
        $pregunta = Questions::findOrFail($id);

        // Actualiza la pregunta con los nuevos valores
        $pregunta->update([
            'question' => $request->input('name'), // Cambiar a 'name' para la pregunta
        ]);

        $respuestas = $request->input('respuestas', []);

        if (!empty($respuestas)) {
            foreach ($respuestas as $respuestaId => $respuestaText) {
                $respuesta = AnswersQuestions::findOrFail($respuestaId); // Encuentra la respuesta por su ID
                $respuesta->update([
                    'answer' => $respuestaText,
                ]);
            }
        }


        // Redirige de nuevo con un mensaje de éxito
        return redirect()->back()->with('success', 'Pregunta y respuestas actualizadas con éxito.');
    }
}
