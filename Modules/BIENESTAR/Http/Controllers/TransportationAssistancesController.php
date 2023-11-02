<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;

class TransportationAssistancesController extends Controller
{
    public function index()
    {
        return view('bienestar::transportation_assistance_list');
    }

    public function search(Request $request)
    {
        $documentNumber = $request->input('document_number');
    
        $person = Person::with('apprentices.course.program', 'apprentices.assigntransoportroutes.routes_trasportantion','apprentices.assigntransoportroutes.convocations') // Cargar la relación de convocatoria
            ->where('document_number', $documentNumber)
            ->first();
        
        return view('bienestar::transportation_assistance_list', ['person' => $person]);
    }

   //Funciones de la vista route-assistance
    public function indexasistances()
    {
        return view('bienestar::route-attendance.transportation-assistance');
    }

    public function searchapprentice(Request $request){
        
        $data = json_decode($_POST['data']);

        $documentNumber = $data;

        

        return view('bienestar::route-attendance.table');

    }  
}
