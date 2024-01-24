<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Modules\BIENESTAR\Entities\AssignTransportRoute;
use Modules\BIENESTAR\Entities\TransportationAssistance;
use Modules\BIENESTAR\Entities\RouteTransportation;
use Illuminate\Support\Facades\Mail;

class TransportationAssistancesController extends Controller
{
    public function index()
    {
        $rutas = RouteTransportation::get();
        $results = TransportationAssistance::select(
            'people.first_name',
            'people.first_last_name',
            'people.second_last_name',
            'people.document_number',
            'programs.name as program_name',
            'courses.code',
            'routes_transportations.route_number',
            'routes_transportations.name_route',
            'transportation_assistances.date_time'
        )
            ->join('assing_transport_routes', 'transportation_assistances.assing_transport_route_id', '=', 'assing_transport_routes.id')
            ->join('routes_transportations', 'assing_transport_routes.route_transportation_id', '=', 'routes_transportations.id')
            ->join('apprentices', 'transportation_assistances.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('courses', 'apprentices.course_id', '=', 'courses.id')
            ->join('programs', 'courses.program_id', '=', 'programs.id')
            ->get();

        return view('bienestar::transportation_assistance_list', compact('rutas', 'results'));
    }

    //Funciones de la vista route-assistance
    public function indexasistances()
    {
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
            ->whereDate('transportation_assistances.date_time', now()->toDateString())
            ->get();


        return view('bienestar::route-attendance.transportation-assistance', compact('resultados'));
    }

    public function searchapprentice(Request $request)
{
    $documentNumber = $request->input('documentNumber');
    try {
        // Añadir condición para verificar si el aprendiz ya tomó la asistencia hoy
        $existingRecord = DB::table('transportation_assistances')
            ->join('assing_transport_routes', 'transportation_assistances.assing_transport_route_id', '=', 'assing_transport_routes.id')
            ->join('postulations_benefits', 'transportation_assistances.postulation_benefit_id', '=', 'postulations_benefits.id')
            ->join('postulations', 'postulations_benefits.postulation_id', '=', 'postulations.id')
            ->join('apprentices', 'postulations.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->where('people.document_number', $documentNumber)
            ->whereDate('transportation_assistances.date_time', now()->toDateString())
            ->exists();

        if ($existingRecord) {
            return response()->json(['error' => 'El aprendiz ya tomó la asistencia hoy!']);
        }

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
            ->join('convocations', 'postulations.convocation_id', '=', 'convocations.id')
            ->join('quarters', 'convocations.quarter_id', '=', 'quarters.id')
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
            ->whereDate('quarters.start_date', '<=', now())
            ->whereDate('quarters.end_date', '>=', now())
            ->whereDate('convocations.start_date', '<=', now())
            ->whereDate('convocations.end_date', '>=', now())
            ->get();

        // Verificar duplicados antes de guardar los datos en la tabla transportation_assistances
        foreach ($data as $row) {
            $existingRecords = DB::table('assistances_foods')
                ->where('apprentice_id', $row->apprentice_id)
                ->whereDate('date_time', now()->toDateString()) // Filtrar por la fecha actual
                ->exists();

            if (!$existingRecords) {
                // Guardar los datos en la tabla transportation_assistances con 'Presente' en assistance_status
                DB::table('transportation_assistances')->insert([
                    'assing_transport_route_id' => $row->assing_transport_route_id,
                    'apprentice_id' => $row->apprentice_id,
                    'postulation_benefit_id' => $row->postulation_benefit_id,
                    'bus_id' => $row->bus_id,
                    'bus_driver_id' => $row->bus_driver_id,
                    'porcentenge' => $row->porcentege,
                    'date_time' => $row->date_time,
                    'assistance_status' => 'Presente',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return response()->json(['success' => 'Asistencia Guardada Correctamente!']);
    } catch (QueryException $e) {
        return response()->json(['error' => 'Error al procesar la solicitud.']);
    }
}

    public function Attendance_failures()
    {
        DB::insert("
        INSERT INTO transportation_assistances (assing_transport_route_id, apprentice_id, postulation_benefit_id, bus_id, bus_driver_id, porcentenge, date_time, assistance_status, created_at, updated_at)
        SELECT
            1 as assing_transport_route_id,
            apprentices.id as apprentice_id,
            postulations_benefits.id as postulation_benefit_id,
            1 as bus_id,
            1 as bus_driver_id,
            100 as porcentenge,
            NOW() as date_time,
            'Falla' as assistance_status,
            NOW() as created_at,
            NOW() as updated_at
        FROM apprentices
        INNER JOIN postulations ON postulations.apprentice_id = apprentices.id
        INNER JOIN postulations_benefits ON postulations.id = postulations_benefits.postulation_id
        INNER JOIN benefits ON postulations_benefits.benefit_id = benefits.id
        WHERE postulations_benefits.state = 'Beneficiario'
          AND benefits.name = 'Transporte'
          AND NOT EXISTS (
              SELECT 1
              FROM transportation_assistances
              WHERE transportation_assistances.apprentice_id = apprentices.id
                AND DATE(transportation_assistances.date_time) = CURDATE()
          )
    ");

        // Puedes agregar más lógica aquí si es necesario

        // Redirigir o responder según tus necesidades
        return response()->json(['message' => 'Inserción exitosa']);
    }

    public function Failure_reporting()
    {
        $resultados = DB::table('transportation_assistances')
            ->select(
                'people.document_number',
                'people.first_name',
                'people.first_last_name',
                'people.second_last_name',
                'courses.code',
                'programs.name',
                'routes_transportations.route_number',
                'routes_transportations.name_route',
                'bus_drivers.name',
                'buses.plate',
                DB::raw('DATE(transportation_assistances.date_time) as date_time'),
                'transportation_assistances.assistance_status'
            )
            ->join('apprentices', 'transportation_assistances.apprentice_id', '=', 'apprentices.id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('courses', 'apprentices.course_id', '=', 'courses.id')
            ->join('programs', 'courses.program_id', '=', 'programs.id')
            ->join('assing_transport_routes', 'transportation_assistances.assing_transport_route_id', '=', 'assing_transport_routes.id')
            ->join('routes_transportations', 'assing_transport_routes.route_transportation_id', '=', 'routes_transportations.id')
            ->join('buses', 'transportation_assistances.bus_id', '=', 'buses.id')
            ->join('bus_drivers', 'transportation_assistances.bus_driver_id', '=', 'bus_drivers.id')
            ->where('transportation_assistances.assistance_status', '=', 'Falla')
            ->whereRaw('WEEK(transportation_assistances.date_time) = WEEK(NOW())')
            ->orderBy('transportation_assistances.apprentice_id')
            ->orderByDesc('transportation_assistances.date_time')
            ->get();

        return view('bienestar::route-attendance.failure_reporting', ['resultados' => $resultados]);
    }

    //API FUNCIONES
    public function AssistancesTransport()
    {
        $results = DB::table('transportation_assistances')
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
            ->whereDate('transportation_assistances.date_time', now()->toDateString())
            ->orderBy('transportation_assistances.date_time', 'desc') // Ordena por fecha de forma descendente
            ->get();


        return response()->json(['data' => $results], 200);
    }

    public function SaveAttendance(Request $request)
    {
        $documentNumber = $request->input('data');

        try {
            // Verificar duplicados antes de realizar la consulta
            $existingRecord = DB::table('transportation_assistances')
                ->join('apprentices', 'transportation_assistances.apprentice_id', '=', 'apprentices.id')
                ->join('people', 'apprentices.person_id', '=', 'people.id')
                ->where('people.document_number', $documentNumber)
                ->whereDate('date_time', now()->toDateString()) // Filtrar por la fecha actual
                ->exists();

            if ($existingRecord) {
                // Si ya existe un registro para este documento hoy, retorna un JSON con un mensaje de error
                $response = [
                    'success' => false,
                    'message' => 'Ya existe un registro con ese número de documento para hoy.',
                ];
                return response()->json($response, 400);
            }

            // Verificar si el usuario tiene el beneficio de transporte
            $benefitExists = DB::table('postulations_benefits')
                ->join('postulations', 'postulations_benefits.postulation_id', '=', 'postulations.id')
                ->join('apprentices', 'postulations.apprentice_id', '=', 'apprentices.id')
                ->join('people', 'apprentices.person_id', '=', 'people.id')
                ->where('people.document_number', $documentNumber)
                ->where('postulations_benefits.state', 'beneficiario')
                ->where('benefits.name', 'Transporte')
                ->exists();

            if (!$benefitExists) {
                // Si el usuario no tiene el beneficio, retorna un JSON con un mensaje de error
                $response = [
                    'success' => false,
                    'message' => 'El usuario no tiene el beneficio de transporte.',
                ];
                return response()->json($response, 400);
            }

            // Realizar la consulta y obtener los datos
            $Savettendance = DB::table('assing_transport_routes')
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
            foreach ($Savettendance as $row) {
                // Verificar duplicados antes de guardar los datos en la tabla transportation_assistances
                $existingRecord = DB::table('transportation_assistances')
                    ->where('apprentice_id', $row->apprentice_id)
                    ->whereDate('date_time', now()->toDateString()) // Filtrar por la fecha actual
                    ->exists();

                if (!$existingRecord) {
                    // Guardar los datos en la tabla transportation_assistances con 'Presente' en assistance_status
                    DB::table('transportation_assistances')->insert([
                        'assing_transport_route_id' => $row->assing_transport_route_id,
                        'apprentice_id' => $row->apprentice_id,
                        'postulation_benefit_id' => $row->postulation_benefit_id,
                        'bus_id' => $row->bus_id,
                        'bus_driver_id' => $row->bus_driver_id,
                        'porcentenge' => $row->porcentege,
                        'date_time' => $row->date_time,
                        'assistance_status' => 'Presente',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            $response = [
                'success' => true,
                'message' => 'Número de documento enviado con éxito',
            ];

            // Retornar la respuesta como JSON
            return response()->json($response, 200);
        } catch (QueryException $e) {
            // Error de base de datos
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) { // Código de error específico para violación de clave única
                $response = [
                    'success' => false,
                    'message' => 'Ya existe un registro con ese número de documento.',
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Error en la base de datos.',
                ];
            }

            return response()->json($response, 400);
        }
    }
}