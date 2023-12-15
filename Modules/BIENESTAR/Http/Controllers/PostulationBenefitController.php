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
// Modifica tu función index en el controlador
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
        $selectedPostulations = $request->input('selected_postulations', []);

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



public function removeBenefit(Request $request, $id, $benefitId)
{
    try {
        // Buscar la postulación por ID
        $postulation = Postulation::findOrFail($id);

        // Validar si la postulación está en el estado correcto para desasignar el beneficio
        if ($postulation->state !== 'Beneficiario') {
            return redirect()->back()->with('error', 'La postulación no está en el estado correcto para desasignar el beneficio.');
        }

        // Buscar el beneficio a desasignar
        $postulationBenefit = $postulation->postulationBenefits
            ->where('state', 'Beneficiario')
            ->where('id', $benefitId)
            ->first();

        // Imprimir información en la consola
        error_log("Postulation ID: $id, Benefit ID: $benefitId");
        error_log("Postulation state: " . $postulation->state);

        if ($postulationBenefit) {
            // Imprimir información en la consola
            error_log("Found PostulationBenefit ID: " . $postulationBenefit->id);
            
            // Desasignar el beneficio
            $postulationBenefit->update([
                'state' => 'No Beneficiario',
                'message' => 'Se le ha cancelado el beneficio',
            ]);

            // Puedes hacer aquí otras actualizaciones según sea necesario

            return response()->json(['message' => 'Beneficio Actualizado con exito'], 200);
        } else {
            // Imprimir información en la consola
            error_log("PostulationBenefit not found for ID: $benefitId");
            return redirect()->back()->with('error', 'No se encontró un beneficio para desasignar');
        }
    } catch (\Exception $e) {
        // Imprimir información en la consola
        error_log("Error: " . $e->getMessage());
        return redirect()->back()->with('error', 'Error al desasignar el beneficio: ' . $e->getMessage());
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