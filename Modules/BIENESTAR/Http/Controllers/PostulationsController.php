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


class PostulationsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
{
    $benefits = Benefits::all();
    $postulations = Postulations::with(['apprentice', 'convocation', 'typesOfBenefits'])->get();
    $questions = Questions::all(); // Obtener todas las preguntas disponibles
    return view('bienestar::postulations', compact('postulations', 'benefits', 'questions'));
}



    public function show($id) {
        $postulation = Postulations::with('convocation', 'apprentice', 'typesOfBenefits', 'answers', 'postulationBenefits', 'socioEconomicSupportFiles')->findOrFail($id);
        return view('bienestar::postulations.show', compact('postulation'));
    }

    public function showModal($id)
{
    $postulation = Postulations::with(['convocation', 'apprentice', 'typesOfBenefits', 'answers' => function ($query) use ($id) {
        $query->where('postulation_id', $id);
    }])->findOrFail($id);
    
    // Obtener todas las preguntas disponibles
    $questions = Questions::all();
    
    return view('bienestar::postulations.modal', compact('postulation', 'questions'));
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

public function assignBenefits(Request $request)
{
    try {
        // Obtener los IDs de las postulaciones seleccionadas desde el formulario
        $selectedPostulations = $request->input('selected-postulations');

        // Validar que al menos una postulación haya sido seleccionada
        if (empty($selectedPostulations)) {
            return response()->json(['error' => 'No se han seleccionado postulaciones'], 400);
        }

        // Obtener los datos del formulario
        $benefitId = $request->input('benefit_id');
        $state = $request->input('state');
        
        // Obtener el valor de message del formulario o establecer una cadena vacía si no se proporciona
        $message = $request->input('message');
        // Recorrer las postulaciones seleccionadas y crear registros en postulations_benefits
        foreach ($selectedPostulations as $postulationId) {
            PostulationsBenefits::create([
                'postulation_id' => $postulationId,
                'benefit_id' => $benefitId,
                'state' => $state,
                'message' => $message, // Asegúrate de que $message tenga el valor correcto
            ]);
        }

        return response()->json(['message' => 'Beneficios asignados con éxito']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al asignar beneficios: ' . $e->getMessage()], 500);
    }
}

public function calculateScore($id)
{
    try {
        // Buscar la postulación por ID
        $postulation = Postulations::findOrFail($id);

        // Realizar la lógica para calcular el nuevo puntaje (suma del puntaje de respuestas)
        $totalScore = $postulation->answers->sum('score');

        // Actualizar el campo total_score de la postulación
        $postulation->total_score = $totalScore;
        $postulation->save();

        // Devolver el nuevo puntaje actualizado como respuesta
        return response()->json(['total_score' => $totalScore]);
    } catch (\Exception $e) {
        // Capturar y manejar errores, puedes personalizar esto según tus necesidades
        return response()->json(['error' => 'Error al calcular el puntaje: ' . $e->getMessage()], 500);
    }
}


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('bienestar::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('bienestar::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
