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
use Illuminate\Support\Facades\Log;

class PostulationsBenefitsController extends Controller
{
    public function index(Request $request)
{
    $benefits = Benefits::all();
    $postulations = Postulations::with(['apprentice', 'convocation', 'typeOfBenefit'])->get();
    $questions = Questions::all(); // Obtener todas las preguntas disponibles

    // Obtener las postulaciones seleccionadas desde el formulario
    $selectedPostulations = $request->input('selected-postulations', []);

    // Obtener las postulaciones no seleccionadas
    $allPostulations = Postulations::all();
    $unselectedPostulations = $allPostulations->filter(function ($postulation) use ($selectedPostulations) {
        return !in_array($postulation->id, $selectedPostulations);
    });

    $postulationBenefits = PostulationsBenefits::all();

    return view('bienestar::postulation-management', compact('postulations', 'benefits', 'questions', 'postulationBenefits', 'selectedPostulations', 'unselectedPostulations'));
}
public function show($id) {
    $postulation = Postulations::with('convocation', 'apprentice', 'typeOfBenefit', 'answers', 'postulationBenefits', 'socioEconomicSupportFiles', 'typeOfBenefit')->findOrFail($id);
    return view('bienestar::postulation-management.show', compact('postulation'));
}



    public function showModal($id)
{
    $postulation = Postulations::with(['convocation', 'apprentice', 'typeOfBenefit', 'answers' => function ($query) use ($id) {
        $query->where('postulation_id', $id);
    }])->findOrFail($id);
    
    // Obtener todas las preguntas disponibles
    $questions = Questions::all();
    
    return view('bienestar::postulation-management.modal', compact('postulation', 'questions'));
}


    public function updateScore(Request $request, $id)
{
    try {
        // Buscar la postulación por ID
        $postulation = Postulations::findOrFail($id);
        
        // Validar el valor del nuevo puntaje (puede agregar más validaciones según sus necesidades)
        $request->validate([
            'new-score' => 'required|integer', // Validar que sea un número entero
        ]);

        // Obtener el nuevo puntaje del formulario
        $newScore = $request->input('new-score');

        // Actualizar el puntaje de la postulación
        $postulation->total_score = $newScore;
        $postulation->save();

        // Redirigir de vuelta a la página anterior con un mensaje de éxito (puede personalizar esto)
        return redirect()->back()->with('success', 'Puntuación actualizada con éxito');
    } catch (\Exception $e) {
        // Capturar y manejar errores, puedes personalizar esto según tus necesidades
        return redirect()->back()->with('error', 'Error al actualizar la puntuación: ' . $e->getMessage());
    }
}




public function updateBenefits(Request $request)
{
    
    try {
        $selectedPostulations = $request->input('selected_postulations', []);
        $question_id = Questions::where('question', 'Apoyo al que se postula')->first()->id;

        // Obtener todos los beneficios posibles (puedes ajustar esto según tus necesidades)
        $benefits = Benefits::all();

        foreach ($selectedPostulations as $postulationId) {
            $benefit_name = Postulations::find($postulationId)->answers->where('questions_id', $question_id)->first()->answer;
            $benefit_id = $benefits->where('name', $benefit_name)->first()->id;

            // Buscar el registro existente en postulations_benefits
            $postulationBenefit = PostulationsBenefits::where('postulation_id', $postulationId)->first();

            if ($postulationBenefit) {
                // Actualizar el registro si existe
                $postulationBenefit->update([
                    'benefit_id' => $benefit_id,
                    'state' => 'Beneficiado',
                    'message' => 'Felicidades',
                ]);
            } else {
                // Crear un nuevo registro si no existe
                PostulationsBenefits::create([
                    'postulation_id' => $postulationId,
                    'benefit_id' => $benefit_id,
                    'state' => 'Beneficiado',
                    'message' => 'Felicidades',
                ]);
            }
        }

        // Ahora, para los no marcados (los que están marcados en $allPostulations pero no en $selectedPostulations)
        $allPostulations = Postulations::all();
        $unselectedPostulations = $allPostulations->filter(function ($postulation) use ($selectedPostulations) {
            return !in_array($postulation->id, $selectedPostulations);
        });

        foreach ($unselectedPostulations as $postulation) {
            // Obtener el beneficio correspondiente
            $benefit_name = Postulations::find($postulation->id)->answers->where('questions_id', $question_id)->first()->answer;
            $benefit_id = $benefits->where('name', $benefit_name)->first()->id;

            // Buscar el registro existente en postulations_benefits
            $postulationBenefit = PostulationsBenefits::where('postulation_id', $postulation->id)->first();

            if ($postulationBenefit) {
                // Actualizar el registro si existe
                $postulationBenefit->update([
                    'benefit_id' => $benefit_id,
                    'state' => 'No Beneficiado',
                    'message' => 'Mala suerte',
                ]);
            } else {
                // Crear un nuevo registro si no existe
                PostulationsBenefits::create([
                    'postulation_id' => $postulation->id,
                    'benefit_id' => $benefit_id,
                    'state' => 'No Beneficiado',
                    'message' => 'Mala suerte',
                ]);
            }
        }

        // Devolver una respuesta JSON con los datos actualizados (opcional)
        return response()->json([
            'message' => 'Registros actualizados con éxito.',
            'updated_data' => [
                'postulation_ids' => $selectedPostulations,
                'benefit_id' => $benefit_id,
                'state' => 'Beneficiado',
                'message' => 'Felicidades',
            ],
        ], 200);
    } catch (\Exception $e) {
        // Manejar errores si es necesario
        return response()->json(['error' => 'Error al actualizar los registros: ' . $e->getMessage()], 500);
    }
}



    

}




