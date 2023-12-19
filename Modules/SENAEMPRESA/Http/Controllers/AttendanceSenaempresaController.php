<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\SENAEMPRESA\Entities\AttendanceSenaempresa;
use Modules\SENAEMPRESA\Entities\StaffSenaempresa;
use Modules\SENAEMPRESA\Entities\Senaempresa;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Person;


class AttendanceSenaempresaController extends Controller
{
    public function new()
    {
        $attendances = AttendanceSenaempresa::with('staffSenaempresa.apprentice.person')->get();
        $senaempresas = Senaempresa::all();
        return view('senaempresa::Company.attendance.index', ['attendances' => $attendances, 'senaempresas' => $senaempresas,  'title' => trans('senaempresa::menu.Attendance')]);
    }

    public function loadStaffBySenaempresa(Request $request)
    {
        $senaempresaId = $request->input('senaempresa_id');
        $documentNumber = $request->input('document_number');
    
        $staff = StaffSenaempresa::where('senaempresa_id', $senaempresaId)
            ->whereHas('apprentice.person', function ($query) use ($documentNumber) {
                $query->where('document_number', $documentNumber);
            })
            ->first();
    
        if ($staff) {
            $response = [
                'staff' => [
                    'id' => $staff->id,
                    'name' => $staff->apprentice->person->full_name,
                ],
            ];
    
            return response()->json($response);
        } else {
            return response()->json(['staff' => null]);
        }
    }
    
    


    public function register(Request $request)
    {
        // Valida los datos del formulario aquí, si es necesario
        $personid = $request->input('person_id');
        $currentDate = now()->format('Y-m-d'); // Obtener la fecha actual en formato YYYY-MM-DD

        // Busca un registro de asistencia existente para la persona y fecha actual
        $existingAttendance = AttendanceSenaempresa::whereHas('staffSenaempresa.apprentice.person', function ($query) use ($personid) {
            $query->where('id', $personid);
        })
            ->whereDate('start_datetime', $currentDate)
            ->first();

        if ($existingAttendance) {
            // Ya existe un registro de asistencia para esta persona en el mismo día
            if ($existingAttendance->end_datetime) {
                // Si ya tiene una fecha y hora de salida registrada, muestra una alerta
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.index')->with('error', 'La asistencia para este día ya ha sido registrada con una hora de entrada y de salida.');
            } else {
                // Actualiza la fecha y hora de salida
                $existingAttendance->end_datetime = now();
                $existingAttendance->save();
                // Redirige a la lista de asistencias o muestra un mensaje de éxito
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.index')->with('success', 'Hora de salida registrada exitosamente.');
            }
        } else {
            // No existe un registro de asistencia existente, crea uno nuevo
            $personid = $request->input('person_id');

            $apprenticeid = Apprentice::where('person_id', $personid)->pluck('id')->first();

            $staffsenaempresaid = StaffSenaempresa::where('apprentice_id', $apprenticeid)->pluck('id')->first();

            // Verifica si $staffsenaempresaid es válido antes de crear el registro
            if ($staffsenaempresaid) {
                // Registra la asistencia en la tabla attendances
                $attendance = new AttendanceSenaempresa();
                $attendance->staff_senaempresa_id = $staffsenaempresaid;
                $attendance->start_datetime = now();
                $attendance->save();

                // Redirige a la lista de asistencias o muestra un mensaje de éxito
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.index')->with('success', 'Asistencia registrada exitosamente.');
            } else {
                // Maneja el caso en el que $staffsenaempresaid no es válido, por ejemplo, mostrando un mensaje de error
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.index')->with('error', 'No se pudo registrar la asistencia porque el aprendiz no esta en el personal');
            }
        }
    }

    public function queryAttendance(Request $request)
    {
        $documentNumber = $request->input('document_number');

        $attendances = AttendanceSenaempresa::with('staffSenaempresa.apprentice.person')
            ->whereHas('staffSenaempresa.apprentice.person', function ($query) use ($documentNumber) {
                $query->where('document_number', $documentNumber);
            })
            ->get();

        $attendanceData = [];

        foreach ($attendances as $attendance) {
            $attendanceData[] = [
                'name' => $attendance->staffSenaempresa->apprentice->person->full_name,
                'document_number' => $attendance->staffSenaempresa->apprentice->person->document_number,
                'start_datetime' => $attendance->start_datetime,
                'end_datetime' => $attendance->end_datetime,
            ];
        }

        return response()->json(['attendances' => $attendanceData]);
    }


    public function getPersonData(Request $request)
    {
        $documentNumber = $request->input('document_number');

        // Realiza una consulta para obtener los datos de la persona con el número de documento
        $personData = Person::where('document_number', $documentNumber)->first();

        // Verifica si la persona está registrada en StaffSenaempresa
        $isRegisteredInStaff = false;
        if ($personData) {
            $personId = $personData->id;
            $apprentice = Apprentice::where('person_id', $personId)->first();
            if ($apprentice) {
                $isRegisteredInStaff = StaffSenaempresa::where('apprentice_id', $apprentice->id)->exists();
            }
        }

        if ($personData && $isRegisteredInStaff) {
            // Si se encontró una persona registrada en StaffSenaempresa, devuelve los datos junto con el indicador
            return response()->json([
                'id' => $personData->id,
                'full_name' => $personData->full_name,
                'is_registered' => $isRegisteredInStaff, // Indicador de registro en StaffSenaempresa
            ]);
        }
    }
}
