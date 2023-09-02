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
use Modules\BIENESTAR\Entities\benefits;



class PostulationsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $benefits = Benefit::all();
        $postulations = Postulations::with(['apprentice', 'convocation', 'typesOfBenefits'])->get();
        return view('bienestar::postulations', compact('postulations'));
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
        
        $questions = Questions::whereIn('id', $postulation->convocation->questions->pluck('id'))->get();
        
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

public function markBeneficiaries(Request $request)
{
    try {
        // Obtener los IDs de las postulaciones seleccionadas desde el formulario
        $selectedPostulations = $request->input('selectedPostulations');
        
        // Validar que al menos una postulación haya sido seleccionada
        if (empty($selectedPostulations)) {
            return response()->json(['error' => 'No se han seleccionado postulaciones'], 400);
        }

        // Obtener los datos comunes para todos los registros
        $benefitId = $request->input('benefit_id');
        $state = $request->input('state');
        $message = $request->input('message');

        // Recorrer las postulaciones seleccionadas y crear registros en postulations_benefits
        foreach ($selectedPostulations as $postulationId) {
            PostulationsBenefits::create([
                'postulation_id' => $postulationId,
                'benefit_id' => $benefitId,
                'state' => $state,
                'message' => $message,
            ]);
        }

        return response()->json(['message' => 'Postulaciones marcadas como beneficiarias con éxito']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al marcar las postulaciones como beneficiarias', 'message' => $e->getMessage()], 500);
    }
}
    public function assignBenefits(Request $request)
{
    try {
        // Obtener las ID de postulaciones seleccionadas desde el formulario
        $selectedPostulations = explode(',', $request->input('selected-postulations'));

        // Obtener los valores de benefit_id, state y message desde el formulario
        $benefitId = $request->input('benefit_id');
        $state = $request->input('state');
        $message = $request->input('message');

        // Aquí puedes iterar sobre las postulaciones seleccionadas y registrar los valores en postulations_benefits
        foreach ($selectedPostulations as $postId) {
            $postulationBenefit = new PostulationBenefit([
                'postulation_id' => $postId,
                'benefit_id' => $benefitId,
                'state' => $state,
                'message' => $message,
            ]);
            $postulationBenefit->save();
        }

        return response()->json(['message' => 'Beneficios asignados con éxito']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al asignar beneficios', 'message' => $e->getMessage()], 500);
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
