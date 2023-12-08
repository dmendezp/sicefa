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
        return view('bienestar::consult.consult-consultation-table', ['documentNumber' => $documentNumber]);
    }
    
     //

}