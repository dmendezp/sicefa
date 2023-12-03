<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\AssistanceFood;
use Illuminate\Support\Facades\DB;

class AssistancesFoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $AssistancesFoods = DB::table('postulations_benefits')
        ->select('people.first_name', 'people.first_last_name', 'people.document_number', 'courses.code', 'programs.name', 'benefits.name', 'benefits.porcentege')
        ->join('postulations', 'postulations_benefits.postulation_id', '=', 'postulations.id')
        ->join('apprentices', 'postulations.apprentice_id', '=', 'apprentices.id')
        ->join('people', 'apprentices.person_id', '=', 'people.id')
        ->join('benefits', 'postulations_benefits.benefit_id', '=', 'benefits.id')
        ->join('courses', 'apprentices.course_id', '=', 'courses.id')
        ->join('programs', 'courses.program_id', '=', 'programs.id')
        ->where('postulations_benefits.state', '=', 'beneficiario')
        ->where('benefits.name', '=', 'Alimentacion')
        ->get();
        $data = ['AssistancesFoods' => $AssistancesFoods];
        return view('bienestar::foodrecord', $data);
    }


    /////////////////////////////////////////////////Funcones para la vista AssistancesFood.blade.php


    public function assistancefoodrecord(Request $request)
    
    {
        $selectedPorcentaje = $request->input('porcentaje');

    $AssistancesFoods = AssistanceFood::with(['postulationBenefit.benefit', 'apprentice.course.program'])
        ->where('porcentage', $selectedPorcentaje)
        ->get();

        $AssistancesFoods = AssistanceFood::with(['postulationBenefit.benefit', 'apprentice.course.program'])->get();
        $data = ['AssistancesFoods' => $AssistancesFoods, 'selectedPorcentaje' => $selectedPorcentaje];
        return view('bienestar::assistancefood', $data);

    }
    public function filtrarPorcentaje(Request $request)
    {
        $selectedPorcentaje = $request->input('porcentaje');
    
        $AssistancesFoods = AssistanceFood::with(['postulationBenefit.benefit', 'apprentice.course.program'])
            ->where('porcentage', $selectedPorcentaje)
            ->get();
    
        $data = ['AssistancesFoods' => $AssistancesFoods, 'selectedPorcentaje' => $selectedPorcentaje];
    
        return view('bienestar::partial.assistancefood_table', $data);
    }
    
}
