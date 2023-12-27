<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function food_assitances()
    {

        $AssistancesFoods = DB::table('assistances_foods')
            ->select(
                'people.document_number',
                'people.first_name',
                'people.first_last_name',
                'people.second_last_name',
                'courses.code',
                'programs.name as program_name',
                'benefits.name as benefit_name',
                'benefits.porcentege',
                'assistances_foods.date_time'
            )
            ->join('apprentices', 'assistances_foods.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('courses', 'apprentices.course_id', '=', 'courses.id')
            ->join('programs', 'courses.program_id', '=', 'programs.id')
            ->join('postulations_benefits', 'assistances_foods.postulation_benefit_id', '=', 'postulations_benefits.id')
            ->join('benefits', 'postulations_benefits.benefit_id', '=', 'benefits.id')
            ->whereDate('assistances_foods.date_time', '=', now()->toDateString()) // Filtrar por la fecha actual
            ->get();


        return view('bienestar::food-assistance', compact('AssistancesFoods'));
    }

    public function assistances(Request $request)
    {
        $documentNumber = $request->input('documentNumber');

        // Obtén el apprentice_id y postulation_benefit_id según los criterios
        $queryResult = DB::table('postulations_benefits')
            ->select(
                'apprentices.id as apprentice_id',
                'postulations_benefits.id as postulation_benefit_id',
                'benefits.porcentege',
                DB::raw('NOW() as date_time')
            )
            ->join('postulations', 'postulations_benefits.postulation_id', '=', 'postulations.id')
            ->join('benefits', 'postulations_benefits.benefit_id', '=', 'benefits.id')
            ->join('apprentices', 'postulations.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->where('people.document_number', $documentNumber)
            ->where('postulations_benefits.state', 'Beneficiario')
            ->where('benefits.name', 'Alimentacion')
            ->first();

        if ($queryResult) {
            // Verificar si ya existe un registro para el aprendiz en la fecha actual
            $existingRecord = DB::table('assistances_foods')
                ->where('apprentice_id', $queryResult->apprentice_id)
                ->whereDate('date_time', now()->toDateString())
                ->exists();

            if ($existingRecord) {
                return response()->json(['error' => 'El aprendiz ya tomó la asistencia hoy!']);
            }

            // Realiza la inserción en la tabla assistances_foods
            DB::table('assistances_foods')->insert([
                'apprentice_id' => $queryResult->apprentice_id,
                'postulation_benefit_id' => $queryResult->postulation_benefit_id,
                'porcentage' => $queryResult->porcentege,
                'date_time' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['success' => 'Asistencia Guardada Correctamente!']);
        } else {
            return response()->json(['error' => 'Error al procesar la solicitud.']);
        }
    }



    //FUNCIONES API
    public function FoodAssistances()
    {
        $AssistancesFoods = DB::table('assistances_foods')
            ->join('apprentices', 'assistances_foods.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('courses', 'apprentices.course_id', '=', 'courses.id')
            ->join('programs', 'courses.program_id', '=', 'programs.id')
            ->join('postulations_benefits', 'assistances_foods.postulation_benefit_id', '=', 'postulations_benefits.id')
            ->join('benefits', 'postulations_benefits.benefit_id', '=', 'benefits.id')
            ->select(
                'people.document_number',
                'people.first_name',
                'people.first_last_name',
                'people.second_last_name',
                'courses.code',
                'programs.name as program_name',
                'benefits.name as benefit_name',
                'assistances_foods.porcentage',
                'assistances_foods.date_time'
            )
            ->whereDate('assistances_foods.date_time', '=', now()->toDateString())
            ->orderBy('assistances_foods.date_time', 'desc')
            ->get();

        return response()->json(['data' => $AssistancesFoods], 200);
    }

    public function RegisterAssistances(Request $request)
    {
        $documentNumber = $request->input('data');

        $SavetAttendance = DB::table('postulations_benefits')
            ->join('postulations', 'postulations_benefits.postulation_id', '=', 'postulations.id')
            ->join('benefits', 'postulations_benefits.benefit_id', '=', 'benefits.id')
            ->join('apprentices', 'postulations.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->select(
                'apprentices.id as apprentice_id',
                'postulations_benefits.id as postulation_benefit_id',
                'benefits.porcentege',
                DB::raw('NOW() as date_time')
            )
            ->where('people.document_number', $documentNumber)
            ->where('postulations_benefits.state', 'Beneficiario')
            ->where('benefits.name', 'Alimentacion')
            ->get();

        foreach ($SavetAttendance as $row) {
            DB::table('assistances_foods')->insert([
                'apprentice_id' => $row->apprentice_id,
                'postulation_benefit_id' => $row->postulation_benefit_id,
                'porcentage' => $row->porcentege,
                'date_time' => $row->date_time,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $response = [
            'success' => true,
            'message' => 'Número de documento enviado con éxito',
        ];

        return response()->json($response, 200);
    }


    // Nueva función para obtener todas las asistencias alimenticias en formato JSON
    // Nueva función para obtener todas las asistencias alimenticias en formato JSON
    public function getAllAssistances()
    {
        $assistances = DB::table('assistances_foods')
            ->join('apprentices', 'assistances_foods.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('courses', 'apprentices.course_id', '=', 'courses.id')
            ->join('programs', 'courses.program_id', '=', 'programs.id')
            ->join('postulations_benefits', 'assistances_foods.postulation_benefit_id', '=', 'postulations_benefits.id')
            ->join('benefits', 'postulations_benefits.benefit_id', '=', 'benefits.id')
            ->select(
                'people.document_number',
                'people.first_name',
                'people.first_last_name',
                'people.second_last_name',
                'courses.code',
                'programs.name as program_name',
                'benefits.name as benefit_name',
                'assistances_foods.porcentage',
                'assistances_foods.date_time'
            )
            ->whereDate('assistances_foods.date_time', '=', now()->toDateString())
            ->orderBy('assistances_foods.date_time', 'desc')
            ->get();

        return response()->json(['data' => $assistances], 200);
    }

    // Nueva función para filtrar asistencias por porcentaje en formato JSON
    public function filterAssistancesByPercentage($porcentaje)
    {
        $assistances = DB::table('assistances_foods')
            ->join('apprentices', 'assistances_foods.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('courses', 'apprentices.course_id', '=', 'courses.id')
            ->join('programs', 'courses.program_id', '=', 'programs.id')
            ->join('postulations_benefits', 'assistances_foods.postulation_benefit_id', '=', 'postulations_benefits.id')
            ->join('benefits', 'postulations_benefits.benefit_id', '=', 'benefits.id')
            ->select(
                'people.document_number',
                'people.first_name',
                'people.first_last_name',
                'people.second_last_name',
                'courses.code',
                'programs.name as program_name',
                'benefits.name as benefit_name',
                'assistances_foods.porcentage',
                'assistances_foods.date_time'
            )
            ->whereDate('assistances_foods.date_time', '=', now()->toDateString())
            ->whereNotNull('people.document_number')
            ->whereNotNull('people.first_name')
            ->whereNotNull('courses.code')


            ->where('assistances_foods.porcentage', $porcentaje)
            ->orderBy('assistances_foods.date_time', 'desc')
            ->get();

        return response()->json(['data' => $assistances], 200);
    }
}
