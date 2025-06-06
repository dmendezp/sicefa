<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Person;
use Modules\BIENESTAR\Entities\PostulationBenefit;

class CallConsultationController extends Controller

{
    public function index()
    {
        // Obtenemos Listado Convocatoria
       $CallConsultations=PostulationBenefit::all(); 
       $people=Person::all(); 
       
       return view('bienestar::callconsultation',['CallConsultations' => $CallConsultations,'people'=>$people]);
    }

    public function search(Request $request)
    {
        $documentNumber = json_decode($_POST['data']);
        $result = DB::select("
        WITH RankedBenefits AS (
            SELECT 
                people.document_number, 
                people.first_name, 
                people.first_last_name, 
                people.second_last_name,
                courses.code, 
                programs.name, 
                postulations_benefits.state, 
                benefits.name AS benefit_name,
                benefits.porcentege,
                postulations_benefits.message, 
                convocations.id,
                ROW_NUMBER() OVER (PARTITION BY benefits.name ORDER BY postulations.created_at DESC, postulations_benefits.created_at DESC) AS rn
            FROM 
                postulations_benefits
            INNER JOIN 
                benefits ON postulations_benefits.benefit_id = benefits.id
            INNER JOIN 
                postulations ON postulations_benefits.postulation_id = postulations.id
            INNER JOIN 
                convocations ON postulations.convocation_id = convocations.id
            INNER JOIN 
                apprentices ON postulations.apprentice_id = apprentices.id
            INNER JOIN 
                people ON apprentices.person_id = people.id
            INNER JOIN 
                courses ON apprentices.course_id = courses.id
            INNER JOIN 
                programs ON courses.program_id = programs.id
            WHERE 
                people.document_number = ?
                AND benefits.name IN ('Transporte', 'Alimentacion')
        )
        SELECT *
        FROM RankedBenefits
        WHERE rn = 1
    ", [$documentNumber]);
        return view('bienestar::consult.consult-consultation-table', compact('result'));
    }
    
     //Funciones para la API
     public function ConsultBenefit(Request $request)
    {
        $documentNumber = $request->input('data');

        $result = DB::select("
        WITH RankedBenefits AS (
            SELECT 
                people.first_name, 
                people.first_last_name, 
                people.second_last_name,
                programs.name, 
                postulations_benefits.state, 
                benefits.name AS benefit_name,
                convocations.id,
                ROW_NUMBER() OVER (PARTITION BY benefits.name ORDER BY postulations.created_at DESC, postulations_benefits.created_at DESC) AS rn
            FROM 
                postulations_benefits
            INNER JOIN 
                benefits ON postulations_benefits.benefit_id = benefits.id
            INNER JOIN 
                postulations ON postulations_benefits.postulation_id = postulations.id
            INNER JOIN 
                convocations ON postulations.convocation_id = convocations.id
            INNER JOIN 
                apprentices ON postulations.apprentice_id = apprentices.id
            INNER JOIN 
                people ON apprentices.person_id = people.id
            INNER JOIN 
                courses ON apprentices.course_id = courses.id
            INNER JOIN 
                programs ON courses.program_id = programs.id
            WHERE 
                people.document_number = ?
                AND benefits.name IN ('Transporte', 'Alimentacion')
        )
        SELECT *
        FROM RankedBenefits
        WHERE rn = 1
    ", [$documentNumber]);
    return response()->json(['data' => $result], 200);
    }

}