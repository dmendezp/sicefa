<?php

namespace Modules\BIENESTAR\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\Postulation;
use Modules\BIENESTAR\Entities\Convocation;
use Modules\SICA\Entities\Apprentice;
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
    $postulations = Postulation::with(['apprentice', 'convocation'])->get();
    $questions = Question::all();

     // Obtén la convocatoria activa basada en la fecha actual
     $currentDate = Carbon::now();
     $convocation = Convocation::where('start_date', '<=', $currentDate)
         ->where('end_date', '>=', $currentDate)
         ->first();
 
     // Verifica si la convocatoria existe
     if ($convocation) {
         // Obtén las postulaciones de la convocatoria activa
         $postulations = Postulation::with(['apprentice', 'convocation'])
             ->where('convocation_id', $convocation->id)
             ->get();
 
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
} else {
    // Si no hay convocatoria activa, puedes manejarlo de la manera que prefieras
    // Por ejemplo, puedes redirigir a una página de error o mostrar un mensaje
    return view('error_page'); // Ajusta el nombre de la vista de error según sea necesario
}
}
public function show($id) {
    $postulation = Postulation::with('convocation', 'apprentice', 'typeOfBenefit', 'answers', 'postulationBenefits', 'socioEconomicSupportFiles')->findOrFail($id);
    return view('bienestar::postulation-management.show', compact('postulation'));
}



public function showModal($id)
{
    $postulation = Postulation::with([
        'convocation',
        'apprentice',
        'answers' => function ($query) use ($id) {
            $query->where('postulation_id', $id);
        },
        'socioeconomicsupportfiles' // Cargar archivos socioeconómicos
    ])->findOrFail($id);

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
        return redirect()->back()->with('success', 'Puntuación actualizada con éxito');
    } catch (\Exception $e) {
        // Capturar y manejar errores, puedes personalizar esto según tus necesidades
        return redirect()->back()->with('error', 'Error al actualizar la puntuación: ' . $e->getMessage());
    }
}



public function updateStateBenefit(Request $request, $id)
{
    try {
        // Buscar la postulación por ID
        $postulation = Postulation::findOrFail($id);

        // Validar el beneficio seleccionado
        $request->validate([
            'benefit' => 'required|exists:benefits,id',
        ]);

        // Obtener el beneficio seleccionado
        $benefitId = $request->input('benefit');

        // Verificar si la postulación ya tiene ese beneficio asignado
        $existingBenefit = $postulation->postulationBenefits
            ->where('state', 'Beneficiario')
            ->where('benefit_id', $benefitId)
            ->first();

        if ($existingBenefit) {
            // Si ya tiene el beneficio asignado, evita la actualización y muestra un mensaje de error
            return redirect()->back()->with('error', 'Esta postulación ya tiene asignado ese beneficio.');
        }

        // Actualizar el beneficio de la postulación
        $postulationBenefit = $postulation->postulationBenefits->where('state', 'Beneficiario')->first();

        if ($postulationBenefit) {
            $postulationBenefit->benefit_id = $benefitId;
            $postulationBenefit->save();

            // Redirigir de vuelta a la página anterior con un mensaje de éxito 
            return redirect()->back()->with('success', 'Beneficio actualizado con éxito');
        } else {
            // Manejar el caso en que no hay beneficio para actualizar
            return redirect()->back()->with('error', 'No se encontró un beneficio para actualizar');
        }
    } catch (\Exception $e) {
        // Capturar y manejar errores, puedes personalizar esto según tus necesidades
        return redirect()->back()->with('error', 'Error al actualizar el beneficio: ' . $e->getMessage());
    }
}

public function updateBenefits(Request $request)
{
    try {
        $selectedPostulations = $request->input('selected_postulations', []);
        $convocation = Convocation::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first(); // Obtén la convocatoria activa basada en la fecha actual

        // Obtener las cuotas disponibles para Alimentación y Transporte
        $foodQuotas = $convocation->food_quotas;
        $transportQuotas = $convocation->transport_quotas;

        // Obtener todas las postulaciones para la convocatoria activa
        $allPostulations = Postulation::where('convocation_id', $convocation->id)->pluck('id');

        // Identificar las postulaciones que no están seleccionadas
        $notSelectedPostulations = array_diff($allPostulations->toArray(), $selectedPostulations);

        foreach ($selectedPostulations as $postulationId) {
            $postulation = Postulation::findOrFail($postulationId);
        
            // Verificar si existe un registro Beneficiario
            $benefitState = $postulation->postulationBenefits->where('state', 'Beneficiario')->first();
            if ($benefitState) {
                // No permitir actualizaciones si hay un registro Beneficiario
                continue;
            }
        
            // Obtener los valores de transportation_benefit y feed_benefit
            $transportationBenefit = $postulation->transportation_benefit;
            $feedBenefit = $postulation->feed_benefit;
        
            // Determinar a qué beneficios se está postulando la persona
            $benefitIds = [];
            if ($transportationBenefit == 1) {
                $benefitIds[] = [
                    'id' => Benefit::where('name', 'Transporte')->first()->id,
                    'percentage' => 100,
                ];
            }
            if ($feedBenefit == 1) {
                $alimentacionBenefit = Benefit::where('name', 'Alimentacion')->first();
                $benefitIds[] = [
                    'id' => $alimentacionBenefit->id,
                    'percentage' => $alimentacionBenefit->percentage,
                ];
            }
        
            foreach ($benefitIds as $benefitId) {
                // Verificar si existen registros de beneficios para esta postulación
                $postulationBenefit = PostulationBenefit::where('postulation_id', $postulationId)
                    ->where('benefit_id', $benefitId['id'])
                    ->first();
        
                if (!$postulationBenefit) {
                    // Crear el registro solo si no existe un registro Beneficiario
                    PostulationBenefit::updateOrCreate(
                        ['postulation_id' => $postulationId, 'benefit_id' => $benefitId['id']],
                        ['state' => 'No Beneficiario', 'message' => 'No hay cuotas disponibles y no adquiere Beneficio']
                    );
        
                    // Verificar cuotas disponibles y actualizar según sea necesario
                    $availableQuotas = ($benefitId['id'] === Benefit::where('name', 'Transporte')->first()->id) ? $transportQuotas : $foodQuotas;
        
                    if ($availableQuotas > 0) {
                        $state = 'Beneficiario';
                        $message = 'Felicidades, has sido aceptado para recibir el beneficio solicitado';
        
                        $postulationBenefit->update([
                            'state' => $state,
                            'message' => $message,
                        ]);
        
                        // Reducir la cantidad de cuotas disponibles solo si el estado es "Beneficiario"
                        if ($state === 'Beneficiario') {
                            if ($benefitId['id'] === Benefit::where('name', 'Transporte')->first()->id) {
                                $transportQuotas--;  // Reducción de cuotas de transporte
                            } else {
                                $foodQuotas--;  // Reducción de cuotas de alimentación
                            }
                        }
                    }
                } else {
                    // Si ya existe un registro, actualizar el estado y el mensaje si es necesario
                    if ($postulationBenefit->state !== 'Beneficiario') {
                        $availableQuotas = ($benefitId['id'] === Benefit::where('name', 'Transporte')->first()->id) ? $transportQuotas : $foodQuotas;
        
                        if ($availableQuotas > 0) {
                            $state = 'Beneficiario';
                            $message = 'Felicidades, has sido aceptado para recibir el beneficio solicitado';
        
                            $postulationBenefit->update([
                                'state' => $state,
                                'message' => $message,
                            ]);
        
                            // Reducir la cantidad de cuotas disponibles solo si el estado es "Beneficiario"
                            if ($state === 'Beneficiario') {
                                if ($benefitId['id'] === Benefit::where('name', 'Transporte')->first()->id) {
                                    $transportQuotas--;
                                } else {
                                    $foodQuotas--;
                                }
                            }
                        } else {
                            // No hay cuotas disponibles, se registra como "No Beneficiario"
                            $postulationBenefit->update([
                                'state' => 'No Beneficiario',
                                'message' => 'No hay cuotas disponibles y no adquiere Beneficio',
                            ]);
                        }
                    }
                }
            }
        }

      
        foreach ($notSelectedPostulations as $postulationId) {
            $benefitIds = Benefit::where(function ($query) {
                $query->where('name', 'Alimentacion')
                    ->where('porcentege', '50');
            })->orWhere('name', 'Transporte')->pluck('id');
                        foreach ($benefitIds as $benefitId) {                // Verificar si existe un registro Beneficiario
                $benefitState = PostulationBenefit::where('postulation_id', $postulationId)
                    ->where('benefit_id', $benefitId)
                    ->where('state', 'Beneficiario')
                    ->first();
        
                if (!$benefitState) {
                    // Verificar si existen registros en estado diferente a "Beneficiario"
                    $nonBeneficiaryState = PostulationBenefit::where('postulation_id', $postulationId)
                        ->where('benefit_id', $benefitId)
                        ->where('state', '<>', 'Beneficiario')
                        ->exists();
        
                    if ($nonBeneficiaryState) {
                        // Actualizar el registro existente si no es "Beneficiario"
                        PostulationBenefit::updateOrCreate(
                            ['postulation_id' => $postulationId, 'benefit_id' => $benefitId],
                            ['state' => 'No Beneficiario', 'message' => 'No has sido aceptado para ser Beneficiario']
                        );
                    } else {
                        // Crear el registro si no existe un registro Beneficiario o No Beneficiario
                        PostulationBenefit::updateOrCreate(
                            ['postulation_id' => $postulationId, 'benefit_id' => $benefitId],
                            ['state' => 'Postulado', 'message' => 'Actualmente Postulado al Beneficio']
                        );
                    }
                }
            }
        }
        

        // Actualizar las cuotas en la convocatoria en la base de datos
        $convocation->food_quotas = $foodQuotas;
        $convocation->transport_quotas = $transportQuotas;
        $convocation->save();

        // Manejar y responder a un mensaje de advertencia enviado desde JavaScript
        if ($request->has('message')) {
            $message = $request->input('message');
            $responseType = $request->input('type', 'warning'); // Tipo predeterminado si no se especifica

            // Responder con un mensaje JSON
            return response()->json([
                'warning' => 'Se ha superado el límite de cuotas seleccionadas',
            ], 200);
        }

        // Devolver una respuesta JSON con los datos actualizados en caso de éxito
        return response()->json([
            'success' => 'Registros actualizados con éxito.',
        ], 200);
    } catch (\Exception $e) {
        // Manejar errores si es necesario
        return response()->json(['error' => 'Error al actualizar los registros: ' . $e->getMessage()], 500);
    }
}





}