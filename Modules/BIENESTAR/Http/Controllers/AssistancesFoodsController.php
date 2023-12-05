<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\AssistanceFood;
use Modules\BIENESTAR\Entities\PostulationBenefit;
use Modules\SICA\Entities\Person;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Benefit;
use Illuminate\Support\Facades\Log;
use Modules\SICA\Entities\Apprentice;




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
            ->when($selectedPorcentaje, function ($query) use ($selectedPorcentaje) {
                return $query->where('porcentage', $selectedPorcentaje);
            })
            ->get();
    
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
    
    public function indexassistances()
    {
        return view('bienestar::food-attendance.food-assistance');
    }
   
   
    public function searchFoodAssistance(Request $request)
    {
        $documentNumber = json_decode($_POST['data']);
    
        // Obtener los datos de la consulta
        $data = DB::table('postulations_benefits')
            ->join('postulations', 'postulations_benefits.postulation_id', '=', 'postulations.id')
            ->join('benefits', 'postulations_benefits.benefit_id', '=', 'benefits.id')
            ->join('apprentices', 'postulations.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->select(
                'apprentices.id as apprentice_id',
                'postulations_benefits.id as postulation_benefit_id',
                'benefits.porcentage', // Ajustar el nombre de la columna según tu esquema
                DB::raw('NOW() as date_time')
            )
            ->where('people.document_number', $documentNumber)
            ->where('postulations_benefits.state', 'beneficiario')
            ->where('benefits.name', 'Alimentacion')
            ->get();
    
        // Guardar los datos en la tabla correspondiente (en este caso, assistances_foods)
        foreach ($data as $row) {
            DB::table('assistances_foods')->insert([
                'apprentice_id' => $row->apprentice_id,
                'postulation_benefit_id' => $row->postulation_benefit_id,
                'porcentage' => $row->porcentage, // Ajustar el nombre de la columna según tu esquema
                'date_time' => $row->date_time,
                'created_at' => now(), // Use Laravel helper function for current timestamp
                'updated_at' => now(), // Use Laravel helper function for current timestamp
            ]);
        }
    
        // Obtener los resultados después de la inserción
        $resultados = DB::table('assistances_foods')
            ->join('apprentices', 'assistances_foods.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('postulations_benefits', 'assistances_foods.postulation_benefit_id', '=', 'postulations_benefits.id')
            ->join('benefits', 'postulations_benefits.benefit_id', '=', 'benefits.id')
            ->select(
                'assistances_foods.apprentice_id',
                'people.document_number',
                'people.first_name',
                'people.first_last_name',
                'people.second_last_name',
                'assistances_foods.postulation_benefit_id',
                'benefits.porcentage as porcentaje_insertado', // Ajustar el nombre según tu esquema
                'assistances_foods.date_time'
            )
            ->get();
    
        // Retornar la vista o los resultados según tus necesidades
        return view('bienestar::food-attendance.table', compact('resultadoss'));
    }
           
}
