<?php

namespace Modules\BIENESTAR\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
// Modifica tu función index en el controlador
public function index(Request $request)
{
    $postulation = Postulation::select(
        'people.first_name',
        'people.first_last_name',
        'people.second_last_name',
        'postulations.transportation_benefit',
        'postulations.feed_benefit',
        'postulations.id',
        'postulations.total_score'
    )
        ->join('convocations', 'postulations.convocation_id', '=', 'convocations.id')
        ->join('apprentices', 'postulations.apprentice_id', '=', 'apprentices.id')
        ->join('people', 'apprentices.person_id', '=', 'people.id')
        ->whereRaw('CURDATE() BETWEEN convocations.start_date AND convocations.end_date')
        ->orderBy('postulations.created_at', 'desc') 
        ->get();

    $benefits = Benefit::all();
    $curdate = now();
    $convocations = Convocation::where('start_date','<=',$curdate)
        ->where('end_date','>=',$curdate)
        ->get();

    $answers = Answer::all();

    return view('bienestar::postulation-management', compact('postulation','benefits','convocations','answers'));
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
        return response()->json(['success' =>'Beneficio eliminado Correctamente'], 200);
    } catch (\Exception $e) {
        // Capturar y manejar errores, puedes personalizar esto según tus necesidades
        return redirect()->back()->with('error', 'Error al actualizar el beneficio');
    }
}



public function updateStateBenefit(Request $request, $id)
{
    try {
        // Buscar la postulación por ID
        $postulation = Postulation::findOrFail($id);

        // Validar los beneficios seleccionados
        $request->validate([
            'transport_benefit' => 'required|exists:benefits,id',
            'food_benefit' => 'required|exists:benefits,id',
        ]);

        // Obtener los beneficios seleccionados
        $transportBenefitId = $request->input('transport_benefit');
        $foodBenefitId = $request->input('food_benefit');

        // Verificar si ya existe un beneficio de transporte y alimentación
        $existingTransportBenefit = $postulation->postulationBenefits()
            ->where('benefit_id', $transportBenefitId)
            ->whereHas('benefit', function ($query) {
                $query->where('name', 'Transporte');
            })->first();

        $existingFoodBenefit = $postulation->postulationBenefits()
            ->where('benefit_id', $foodBenefitId)
            ->whereHas('benefit', function ($query) {
                $query->where('name', 'Alimentacion');
            })->first();

        // Actualizar o crear el beneficio de transporte si no existe
        if (!$existingTransportBenefit) {
            $transportBenefit = PostulationBenefit::updateOrCreate(
                ['postulation_id' => $postulation->id, 'benefit_id' => $transportBenefitId],
                ['state' => 'Beneficiario', 'message' => 'Felicidades, has sido aceptado para recibir el beneficio de transporte']
            );
        }

        // Actualizar o crear el beneficio de alimentación si no existe
        if (!$existingFoodBenefit) {
            $foodBenefit = PostulationBenefit::updateOrCreate(
                ['postulation_id' => $postulation->id, 'benefit_id' => $foodBenefitId],
                ['state' => 'Beneficiario', 'message' => 'Felicidades, has sido aceptado para recibir el beneficio de alimentación']
            );
        }

        // Puedes ajustar el mensaje según tu lógica
        return redirect()->back()->with('success', 'Beneficios actualizados o creados con éxito');
    } catch (\Exception $e) {
        // Capturar y manejar errores, puedes personalizar esto según tus necesidades
        return redirect()->back()->with('error', 'Error al actualizar o crear los beneficios: ' . $e->getMessage());
    }
}

public function updateBenefits(Request $request)
{
    try {
        $postulationId = $request->input('postulation_id');
        $benefitId = $request->input('benefit_id');
        $isChecked = $request->input('checked');

        // Tu lógica de validación y procesamiento aquí
        // Puedes utilizar el modelo PostulationBenefit para actualizar o crear registros

        // Ejemplo: Actualizar o crear el registro en la base de datos
        $postulationBenefit = PostulationBenefit::updateOrCreate(
            ['postulation_id' => $postulationId, 'benefit_id' => $benefitId],
            ['state' => $isChecked ? 'Beneficiario' : 'No Beneficiario']
        );

        return response()->json([
            'success' => 'Beneficio actualizado con éxito.',
        ], 200);
    } catch (\Exception $e) {
        // Manejar errores si es necesario
        return response()->json(['error' => 'Error al actualizar el beneficio: ' . $e->getMessage()], 500);
    }
}





public function editBenefitDetail(Request $request, $id)
{
    try {
        // Encuentra la postulación por su ID
        $postulation = Postulation::findOrFail($id);

        // Actualiza el campo 'message' con el nuevo valor
        $postulation->update([
            'message' => $request->input('edited_message'),
        ]);

        // Resto del código si es necesario

        // Devuelve una respuesta de éxito
        return response()->json(['message' => 'La actualización fue exitosa'], 200);
    } catch (\Exception $e) {
        // Registra detalles del error
        \Log::error($e->getMessage());
        
        // Devuelve una respuesta de error
        return response()->json(['error' => 'Hubo un error interno en el servidor'], 500);
    }
}




}