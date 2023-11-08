<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\AssistanceFood;

class AssistancesFoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $AssistancesFoods = AssistanceFood::with(['postulationBenefit.benefit', 'apprentice.course.program'])->get();
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
