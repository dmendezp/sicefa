<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\Postulation;
use Modules\BIENESTAR\Entities\Convocation;
use Modules\SICA\Entities\Apprentice;
use Modules\BIENESTAR\Entities\TypeOfBenefit;
use Modules\BIENESTAR\Entities\Question;
use Modules\BIENESTAR\Entities\Benefit;
use Modules\BIENESTAR\Entities\PostulationBenefit;
use Modules\BIENESTAR\Entities\Answer;
use Illuminate\Http\JsonResponse;

class PostulationBenefitController extends Controller
{
    public function index(Request $request)
{
    $benefits = Benefit::all();
    $postulations = Postulation::with(['apprentice', 'convocation', 'typeOfBenefit'])->get();
    $questions = Question::all();

    // Obtén las postulaciones seleccionadas desde el formulario
    $selectedPostulations = $request->input('selected-postulations', []);

    // Obtén las postulaciones no seleccionadas
    $allPostulations = Postulation::all();
    $unselectedPostulations = $allPostulations->filter(function ($postulation) use ($selectedPostulations) {
        return !in_array($postulation->id, $selectedPostulations);
    });

    // Obtén la convocatoria activa basada en la fecha actual
    $currentDate = Carbon::now(); // Obtiene la fecha y hora actual
    $convocation = Convocation::where('start_date', '<=', $currentDate)
        ->where('end_date', '>=', $currentDate)
        ->first();

    $postulationBenefits = PostulationBenefit::all();

    return view('bienestar::postulation-management', compact('postulations', 'benefits', 'questions', 'postulationBenefits', 'selectedPostulations', 'unselectedPostulations', 'convocation'));
}

public function show($id) {
    $postulation = Postulation::with('convocation', 'apprentice', 'typeOfBenefit', 'answers', 'postulationBenefits', 'socioEconomicSupportFiles', 'typeOfBenefit')->findOrFail($id);
    return view('bienestar::postulation-management.show', compact('postulation'));
}



    public function showModal($id)
{
    $postulation = Postulation::with(['convocation', 'apprentice', 'typeOfBenefit', 'answers' => function ($query) use ($id) {
        $query->where('postulation_id', $id);
    }])->findOrFail($id);
    
    // Obtener todas las preguntas disponibles
    $questions = Question::all();
    
    return view('bienestar::postulation-management.modal', compact('postulation', 'questions'));
}


    public function updateScore(Request $request, $id)
{
    try {
        // Buscar la postulación por ID
        $postulation = Postulation::findOrFail($id);
        
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
        return response()->json(['success' => 'Registros actualizados con éxito.',], 200);    
    } catch (\Exception $e) {
        // Capturar y manejar errores, puedes personalizar esto según tus necesidades
        return response()->json(['error' => 'Error al actualizar los registros: ' . $e->getMessage()], 500);    }
    }



public function updateState(Request $request)
{
    try {
        $postulationId = $request->input('postulation_id');

        // Buscar la postulación por ID 
        $postulation = Postulation::findOrFail($postulationId);

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
    try {
        $selectedPostulations = $request->input('selected_postulations', []);
        $question_id = Question::where('question', 'Apoyo al que se postula')->first()->id;
        $convocation = Convocation::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first(); // Obtén la convocatoria activa basada en la fecha actual

        // Obtener todos los beneficios posibles (puedes ajustar esto según tus necesidades)
        $benefits = Benefit::all();

        // Obtener las cuotas disponibles para Alimentación
        $foodQuotas = $convocation->food_quotas;
        $transportQuotas = $convocation->transport_quotas;

        // Validar si se están registrando postulaciones para Transporte
        $isRegisteringForTransport = in_array('Transporte', $benefits->pluck('name')->toArray());

        // Manejo de advertencias enviadas desde JavaScript
        if ($request->has('message')) {
            $message = $request->input('message');
            $responseType = $request->input('type', 'warning'); // Tipo predeterminado si no se especifica

            // Responde con un mensaje JSON de advertencia
            return response()->json([
                'warning' => $message,
            ], 200);
        }

        foreach ($selectedPostulations as $postulationId) {
            $postulation = Postulation::findOrFail($postulationId);
            $postulationBenefit = PostulationBenefit::where('postulation_id', $postulationId)->first();
            $benefit = null;

            if ($postulationBenefit) {
                $benefit = $postulationBenefit->benefit->name;
            }

            if ($postulationBenefit && $postulationBenefit->state !== 'Beneficiado') {
                // Verifica si el estado de la postulación no es "Beneficiado"
                $benefit_name = $postulation->answers->where('questions_id', $question_id)->first()->answer;
                $benefit_id = $benefits->where('name', $benefit_name)->first()->id;

                if ($benefit === 'Transporte') {
                    if ($isRegisteringForTransport) {
                        // Validar si todavía hay cuotas disponibles para Transporte
                        if ($transportQuotas > 0) {
                            $postulationBenefit->update([
                                'benefit_id' => $benefit_id,
                                'state' => 'Beneficiado',
                                'message' => 'Felicidades, has sido aceptado para recibir el beneficio solicitado',
                            ]);

                            $transportQuotas--;
                        }
                    }
                } else {
                    // Validar si todavía hay cuotas disponibles para Alimentación
                    if ($foodQuotas > 0) {
                        $postulationBenefit->update([
                            'benefit_id' => $benefit_id,
                            'state' => 'Beneficiado',
                            'message' => 'Felicidades, has sido aceptado para recibir el beneficio solicitado',
                        ]);
                        $foodQuotas--;
                    }
                }
            }
        }

        // Ahora, para los no marcados (los que están marcados en $allPostulations pero no en $selectedPostulations)
        $allPostulations = Postulation::all();
        $unselectedPostulations = $allPostulations->filter(function ($postulation) use ($selectedPostulations) {
            return !in_array($postulation->id, $selectedPostulations);
        });

        foreach ($unselectedPostulations as $postulation) {
            $benefit_name = $postulation->answers->where('questions_id', $question_id)->first()->answer;
            $benefit_id = $benefits->where('name', $benefit_name)->first()->id;
            $postulationBenefit = PostulationBenefit::where('postulation_id', $postulation->id)->first();

            if (!$postulationBenefit) {
                // Crear un nuevo registro si no existe
                PostulationBenefit::create([
                    'postulation_id' => $postulation->id,
                    'benefit_id' => $benefit_id,
                    'state' => 'No Beneficiado',
                    'message' => 'Lo sentimos, no cumples con los requisitos necesarios y no has sido aceptado',
                ]);
            }
        }

        // Actualiza las cuotas en la convocatoria en la base de datos
        $convocation->food_quotas = $foodQuotas;
        if ($isRegisteringForTransport) {
            $convocation->transport_quotas = $transportQuotas;
        }
        $convocation->save();

        // Devuelve una respuesta JSON con los datos actualizados en caso de éxito
        return response()->json([
            'success' => 'Registros actualizados con éxito.',
        ], 200);
    } catch (\Exception $e) {
        // Maneja errores si es necesario
        return response()->json(['error' => 'Error al actualizar los registros: ' . $e->getMessage()], 500);
    }
}


}




