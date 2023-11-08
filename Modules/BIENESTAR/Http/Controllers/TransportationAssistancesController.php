<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;
use Illuminate\Support\Facades\DB;
use Modules\BIENESTAR\Entities\AssignTransportRoute;
use Modules\BIENESTAR\Entities\TransportationAssistance;

class TransportationAssistancesController extends Controller
{
    public function index()
    {
        return view('bienestar::transportation_assistance_list');
    }

    public function search(Request $request)
    {
        $documentNumber = $request->input('document_number');
    
        $person = Person::with('apprentices.course.program', 'apprentices.postulations.postulationBenefits','apprentices.assigntransoportroutes.convocations') // Cargar la relación de convocatoria
            ->where('document_number', $documentNumber)
            ->first();
        
        return view('bienestar::transportation_assistance_list', ['person' => $person]);
    }

    //Funciones de la vista route-assistance
    public function indexasistances()
    {
        return view('bienestar::route-attendance.transportation-assistance');
    }

    public function searchapprentice(Request $request)
    {

        $documentNumber = json_decode($_POST['data']);
       
        // Realizar la consulta y obtener los datos
        $data = DB::table('assing_transport_routes')
            ->join('postulations_benefits', 'assing_transport_routes.postulation_benefit_id', '=', 'postulations_benefits.id')
            ->join('postulations', 'postulations_benefits.postulation_id', '=', 'postulations.id')
            ->join('benefits', 'postulations_benefits.benefit_id', '=', 'benefits.id')
            ->join('apprentices', 'postulations.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('routes_transportations', 'assing_transport_routes.route_transportation_id', '=', 'routes_transportations.id')
            ->join('buses', 'routes_transportations.bus_id', '=', 'buses.id')
            ->join('bus_drivers', 'buses.bus_driver_id', '=', 'bus_drivers.id')
            ->select(
                'assing_transport_routes.id as assing_transport_route_id',
                'apprentices.id as apprentice_id',
                'postulations_benefits.id as postulation_benefit_id',
                'buses.id as bus_id',
                'bus_drivers.id as bus_driver_id',
                'benefits.porcentege',
                DB::raw('NOW() as date_time')
            )
            ->where('people.document_number', $documentNumber)
            ->where('postulations_benefits.state', 'beneficiario')
            ->where('benefits.name', 'Transporte')
            ->get();

        // Guardar los datos en la tabla transportation_assistances
        foreach ($data as $row) {
            DB::table('transportation_assistances')->insert([
                'assing_transport_route_id' => $row->assing_transport_route_id,
                'apprentice_id' => $row->apprentice_id,
                'postulation_benefit_id' => $row->postulation_benefit_id,
                'bus_id' => $row->bus_id,
                'bus_driver_id' => $row->bus_driver_id,
                'porcentenge' => $row->porcentege,
                'date_time' => $row->date_time,
                'created_at' => $row->date_time,
                'updated_at' => $row->date_time,
            ]);
        }
        $resultados = DB::table('transportation_assistances')
            ->join('apprentices', 'transportation_assistances.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('assing_transport_routes', 'transportation_assistances.assing_transport_route_id', '=', 'assing_transport_routes.id')
            ->join('routes_transportations', 'assing_transport_routes.route_transportation_id', '=', 'routes_transportations.id')
            ->join('bus_drivers', 'transportation_assistances.bus_driver_id', '=', 'bus_drivers.id')
            ->join('buses', 'transportation_assistances.bus_id', '=', 'buses.id')
            ->select(
                'transportation_assistances.apprentice_id',
                'people.document_number',
                'people.first_name',
                'people.first_last_name',
                'people.second_last_name',
                'transportation_assistances.assing_transport_route_id',
                'routes_transportations.route_number',
                'routes_transportations.name_route',
                'transportation_assistances.bus_driver_id',
                'bus_drivers.name',
                'transportation_assistances.bus_id',
                'buses.plate',
                'transportation_assistances.date_time'
            )
            ->get();

        return view('bienestar::route-attendance.table', compact('resultados'));
    }
}
