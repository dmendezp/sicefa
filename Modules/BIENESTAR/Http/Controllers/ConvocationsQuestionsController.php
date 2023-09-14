<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\ConvocationsQuestions;
use Modules\BIENESTAR\Entities\Questions;
use Modules\BIENESTAR\Entities\AnswersQuestions;
use Modules\BIENESTAR\Entities\Convocations;

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
        $convocations = Convocations::all();
        $questions = Questions::all();
        $answers = AnswersQuestions::all();

        return view('bienestar::editform', ['questions' => $questions, 'answers' => $answers, 'convocations' => $convocations]);
    }

    public function deleteQuestion($id)
    {
        // Primero, obtenemos la pregunta por su ID
        $question = Questions::find($id);

        // Si la pregunta no existe, redirigimos o mostramos un mensaje de error
        if (!$question) {
            return redirect()->route('cefa.bienestar.editform')->with('error', 'La pregunta no existe.');
        }

        // Eliminamos las respuestas asociadas a esta pregunta
        AnswersQuestions::where('question_id', $id)->delete();

        // Eliminamos la pregunta
        $question->delete();

        // Redirigimos o mostramos un mensaje de éxito después de la eliminación
        return redirect()->route('cefa.bienestar.editform')->with('success', 'La pregunta y sus respuestas han sido eliminadas con éxito.');
    }

    public function addQuestion(Request $request)
    {
        // Crear una nueva pregunta
        $pregunta = new Questions();
        $pregunta->question = $request->input('text_question');
        $pregunta->question_category = $request->input('question_category');
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
        return redirect()->route('cefa.bienestar.editform')->with('success', 'Pregunta y respuestas guardadas exitosamente.');
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

    /**
     * @method('POST')
     */
    public function saveForm(Request $request)
    {
        // Validar los datos del formulario
        $request->validate( [
            'convocatoria_id' => 'required|exists:convocations,id', // Asegúrate de que estés validando contra la tabla de convocatorias
            'selected_question_ids' => 'required|string', // Ajusta esto según tu necesidad
        ]);

        try {
            // Obtener el ID de la convocatoria y los IDs de las preguntas seleccionadas
            $convocatoriaId = $request->input('convocatoria_id');
            $selectedQuestionIds = explode(',', $request->input('selected_question_ids'));

            // Recorre los IDs de las preguntas seleccionadas y guárdalos en la base de datos
            foreach ($selectedQuestionIds as $questionId) {
                // Aquí puedes guardar $convocatoriaId y $questionId en tu base de datos
                $pregunta = new ConvocationsQuestions();
                $pregunta->convocation_id = $convocatoriaId;
                $pregunta->questions_id = $questionId;
                $pregunta->save();
            }

            // Devolver una respuesta JSON exitosa
            return response()->json(['mensaje' => 'Guardado correctamente'], 200);
        } catch (\Exception $e) {
            // En caso de error, manejar el error y devolver una respuesta JSON con un mensaje de error
            return response()->json(['mensaje' => 'Ha ocurrido un error al intentar guardar'], 500);
        }
    }
    
}
