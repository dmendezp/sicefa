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



public function updateState(Request $request)
{
    try {
        $postulationId = $request->input('postulation_id');

        // Buscar la postulación por ID 
        $postulation = Postulations::findOrFail($postulationId);

        // Validar y actualizar el estado
        $request->validate([
            'state' => 'required|in:Beneficiado,No Beneficiado,Postulado',
        ]);

        // Actualizar el estado de la postulación
        $postulation->postulationBenefits->first()->state = $request->input('state');
        $postulation->postulationBenefits->first()->save();

        // Redirigir de vuelta a la página anterior con un mensaje de éxito
        return redirect()->back()->with('success', 'Estado actualizado con éxito');
    } catch (\Exception $e) {
        // Capturar y manejar errores, puedes personalizar esto según tus necesidades
        return redirect()->back()->with('error', 'Error al actualizar el estado: ' . $e->getMessage());
    }
}


public function updateBenefits(Request $request)
    {
        return Postulations::find($request->input('postulation_ids')[0])->answers;
        try {
            $postulationsData = $request->input('postulations', []);

            foreach ($postulationsData as $postulationData) {
                $postulationId = $postulationData['postulation_id'];
                $state = $postulationData['state'];
                $message = $postulationData['message'];

                // Buscar el registro existente en postulations_benefits
                $postulationBenefit = PostulationsBenefits::where('postulation_id', $postulationId)->first();

                if ($postulationBenefit) {
                    // Actualizar el registro si existe
                    $postulationBenefit->update([
                        'state' => $state,
                        'message' => $message,
                    ]);
                } else {
                    // Crear un nuevo registro si no existe
                    PostulationsBenefits::create([
                        'postulation_id' => $postulationId,
                        'state' => $state,
                        'message' => $message,
                    ]);
                }
            }

            return response()->json(['message' => 'Registros actualizados con éxito.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar los registros: ' . $e->getMessage()], 500);
        }
    }
    
    public function assignBenefitsToPostulations()
{
    try {
        // Obtener todas las postulaciones
        $postulations = Postulations::all();

        foreach ($postulations as $postulation) {
            // Obtener las respuestas de la postulación
            $answers = $postulation->answers;

            // Variables para almacenar los beneficios encontrados en las respuestas
            $benefitsFound = [];

            foreach ($answers as $answer) {
                // Verificar si la respuesta corresponde a algún beneficio
                $answerContent = strtolower($answer->answer);

                // Consultar la tabla de beneficios por nombre
                $benefit = Benefits::where('name', $answerContent)->first();

                if ($benefit) {
                    // Agregar el beneficio encontrado al arreglo de beneficios
                    $benefitsFound[] = $benefit;
                }
            }

            // Asignar el beneficio correspondiente a la postulación
            if (!empty($benefitsFound)) {
                // Tomar el primer beneficio encontrado (puedes ajustar la lógica aquí)
                $selectedBenefit = $benefitsFound[0];

                // Establecer el "benefit_id" en la postulación
                $postulation->benefit_id = $selectedBenefit->id;
                $postulation->save();
            }
        }

        return response()->json(['message' => 'Beneficios asignados correctamente'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al asignar beneficios: ' . $e->getMessage()], 500);
    }
}

}




