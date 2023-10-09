<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Course;
use Modules\BIENESTAR\Entities\Postulation;
use Modules\BIENESTAR\Entities\PostulationsBenefit;
use Modules\BIENESTAR\Entities\Benefit;

class CallConsultationController extends Controller

{
    public function index()
    {
        // Obtenemos Listado Convocatoria
       $CallConsultations=PostulationsBenefit::all(); 
       $people=Person::all(); 
       
       return view('bienestar::callconsultation',['CallConsultations' => $CallConsultations,'people'=>$people]);
    }

    public function search(Request $request)
    {
        $documentNumber = $request->input('document_number');
        
        // Realiza una consulta para obtener los datos de la persona con el número de documento
        $personData = Person::with('apprentices.course.program','apprentices.postulations.postulationBenefits.benefit')->where('document_number', $documentNumber)->first();
        
        if ($personData) {
            // Si se encontró una persona, devuelve los datos junto con el ID
            return response()->json($personData);
        } else {
            // Si no se encontró una persona, devuelve una respuesta vacía
            return response()->json(null);
        }
    }
}
