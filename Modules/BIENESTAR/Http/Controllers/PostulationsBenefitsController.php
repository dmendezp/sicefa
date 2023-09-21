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






public function assignOrUpdateBenefit(Request $request)
{
    try {
        // Obtener los datos JSON del cuerpo de la solicitud
        $requestData = json_decode($request->getContent(), true);

        // Obtener los valores necesarios del arreglo JSON
        $benefitId = $requestData['benefit_id'];
        $selectedPostulations = $requestData['selectedPostulations'];
        $state = $requestData['state'];
        $message = $requestData['message'];

        // Realizar la lógica para asignar beneficios a las postulaciones seleccionadas
        foreach ($selectedPostulations as $postulationId) {
            // Verificar si ya existe un registro en postulation_benefits para esta postulación
            $existingBenefit = PostulationsBenefits::where('postulation_id', $postulationId)->first();

            if ($existingBenefit) {
                // Si existe, actualiza los datos necesarios
                $existingBenefit->benefit_id = $benefitId;
                $existingBenefit->state = $state;
                $existingBenefit->message = $message;
                $existingBenefit->save();
            } else {
                // Si no existe, crea un nuevo registro
                $newBenefit = new PostulationsBenefits();
                $newBenefit->postulation_id = $postulationId;
                $newBenefit->benefit_id = $benefitId;
                $newBenefit->state = $state;
                $newBenefit->message = $message;
                $newBenefit->save();
            }
        }

        // Respuesta exitosa
        return response()->json(['message' => 'Beneficios asignados o actualizados con éxito en postulations_benefits'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al asignar o actualizar beneficios en postulations_benefits: ' . $e->getMessage()], 500);
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




    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
{
    try {
        // Validar los datos del formulario aquí...

        // Verificar la respuesta a la pregunta "A cual beneficio se postula?"
        $selectedBenefits = $request->input('selected_benefits', []);
        $benefitId = null;

        if (in_array('Alimentacion', $selectedBenefits)) {
            $benefitId = 1; // Debes ajustar el ID correspondiente a "Alimentacion" en tu base de datos
        } elseif (in_array('Transporte', $selectedBenefits)) {
            $benefitId = 2; // Debes ajustar el ID correspondiente a "Transporte" en tu base de datos
        } elseif (in_array('Internado', $selectedBenefits)) {
            $benefitId = 3; // Debes ajustar el ID correspondiente a "Internado" en tu base de datos
        }

        // Validar si ya se ha seleccionado "Internado"
        $existingPostulation = PostulationsBenefits::where('postulation_id', auth()->user()->id)
            ->where('benefit_id', 3) // Debes ajustar el ID correspondiente a "Internado" en tu base de datos
            ->first();

        if ($existingPostulation && $benefitId !== 3) {
            return redirect()->back()->with('error', 'Ya has seleccionado "Internado". No puedes seleccionar otro beneficio.');
        }

        // Crear la nueva postulación
        $postulation = new Postulations([
            'apprentice_id' => auth()->user()->id, // O ajusta el ID del aprendiz según tu lógica
            'convocation_id' => $request->input('convocation_id'),
            'total_score' => 0, // Ajusta según tus necesidades
        ]);

        $postulation->save();

        // Registrar los beneficios seleccionados en postulations_benefits
        foreach ($selectedBenefits as $benefit) {
            PostulationsBenefits::create([
                'postulation_id' => $postulation->id,
                'benefit_id' => $benefitId,
                'state' => 'Postulado',
                'message' => 'Aprendiz postulado',
            ]);
        }

        return redirect()->route('.cefabienestar.postulation-management.index')->with('success', 'Postulación creada con éxito.');
    } catch (\Exception $e) {
        // Capturar y manejar errores, puedes personalizar esto según tus necesidades
        return redirect()->back()->with('error', 'Error al crear la postulación: ' . $e->getMessage());
    }
}







public function markAsBeneficiaries(Request $request)
{
    try {
        // Obtener los IDs de las postulaciones seleccionadas desde el formulario
        $selectedPostulations = $request->input('selected-postulations');

        // Validar que al menos una postulación haya sido seleccionada
        if (empty($selectedPostulations)) {
            return redirect()->back()->with('error', 'No se han seleccionado postulaciones');
        }

        // Determinar el beneficio y el estado según el botón presionado
        $benefitId = $this->determineBenefitId($request);
        $state = 'Beneficiado'; // Por defecto, se establece como "Beneficiado"
        $message = 'Felicidades, Has sido aceptado al Beneficio solicitado';

        // Verificar qué botón se presionó y ajustar el estado y el mensaje en consecuencia
        if ($request->has('mark-as-no-beneficiado')) {
            $state = 'No Beneficiado';
            $message = 'Lamentablemente, no has sido aceptado al Beneficio solicitado';
        }

        // Actualizar el estado y el beneficio de las postulaciones seleccionadas
        foreach ($selectedPostulations as $postulationId) {
            // Obtener la postulación por ID
            $postulation = Postulations::findOrFail($postulationId);

            // Actualizar el estado y el beneficio de la postulación
            PostulationsBenefits::create([
                'postulation_id' => $postulation->id,
                'benefit_id' => $benefitId,
                'state' => $state,
                'message' => $message,
            ]);
        }

        return redirect()->back()->with('success', 'Postulaciones marcadas como beneficiarias con éxito');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al marcar como beneficiarias: ' . $e->getMessage());
    }
}






public function markAsNoBeneficiaries(Request $request)
{
    try {
        // Obtener los IDs de las postulaciones seleccionadas desde el formulario
        $selectedPostulations = $request->input('selected-postulations');

        // Validar que al menos una postulación haya sido seleccionada
        if (empty($selectedPostulations)) {
            return response()->json(['error' => 'No se han seleccionado postulaciones'], 400);
        }

        // Determinar el beneficio y el estado
        $benefitId = $this->determineBenefitId($request);
        $state = 'No Beneficiado';
        $message = 'Lamentamos decirle que no has sido aceptado para recibir el beneficio';

        // Actualizar el estado y el beneficio de las postulaciones seleccionadas
        foreach ($selectedPostulations as $postulationId) {
            // Obtener la postulación por ID
            $postulation = Postulations::findOrFail($postulationId);

            // Actualizar el estado y el beneficio de la postulación
            PostulationsBenefits::create([
                'postulation_id' => $postulation->id,
                'benefit_id' => $benefitId,
                'state' => $state,
                'message' => $message,
            ]);
        }

        return response()->json(['message' => 'Postulaciones marcadas como no beneficiarias con éxito'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al marcar como no beneficiarias: ' . $e->getMessage()], 500);
    }
}







// Agrega tu lógica para determinar el beneficio aquí
private function determineBenefitId(Request $request)
    {
        // Aquí debes determinar el ID del beneficio según la lógica de tu aplicación.
        // Puedes hacerlo según la respuesta del formulario, como mencionaste anteriormente.
        // Por ejemplo, si la respuesta es "Alimentación", el ID del beneficio será 1.
        // Ajusta esto según tu lógica.
        $benefitId = null;

        // Ejemplo de lógica:
        $response = $request->input('response');

        if ($response === 'Alimentación') {
            $benefitId = 1; // Cambia esto según tu lógica.
        } elseif ($response === 'Transporte') {
            $benefitId = 2; // Cambia esto según tu lógica.
        } elseif ($response === 'Internado') {
            $benefitId = 3; // Cambia esto según tu lógica.
        }

        return $benefitId;
    }





public function updateBenefits(Request $request)
{
    try {
        $selectedPostulations = json_decode($request->input('selected-postulations'));

        if (empty($selectedPostulations)) {
            return redirect()->back()->with('error', 'No se han seleccionado postulaciones');
        }

        // Obtén los valores comunes para actualizar
        $benefitId = $request->input('benefit_id');
        $state = $request->input('state');
        $message = $request->input('message');

        // Actualiza los registros de acuerdo con los ID de las postulaciones seleccionadas
        PostulationsBenefits::whereIn('postulation_id', $selectedPostulations)->update([
            'benefit_id' => $benefitId,
            'state' => $state,
            'message' => $message,
        ]);

        return redirect()->back()->with('success', 'Postulaciones actualizadas con éxito');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al actualizar postulaciones: ' . $e->getMessage());
    }
}

}
