<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\SENAEMPRESA\Entities\AttendanceSenaempresa;
use Modules\SENAEMPRESA\Entities\StaffSenaempresa;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Quarter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\SENAEMPRESA\Entities\Senaempresa;


class AttendanceSenaempresaController extends Controller
{
    public function new()
    {
        if (auth()->user()->person->apprentices()->first()) {
            // Assuming you have authentication in place, retrieve the currently authenticated user
            $apprentice = auth()->user()->person->apprentices()->first();

            // Retrieve attendance records for the authenticated apprentice
            $attendances_apprentice = AttendanceSenaempresa::with('staffSenaempresa.apprentice.person')
                ->whereHas('staffSenaempresa', function ($query) use ($apprentice) {
                    $query->where('apprentice_id', $apprentice->id);
                })
                ->get();

        }
        $user = Auth::user();
        $rol = $user->roles->first();
       
        if ($rol->slug != 'senaempresa.apprentice' && Route::is('senaempresa.apprentice.attendances.index')) {
            return redirect()->back()->withInput()->with('info', 'No eres una Aprendiz');
        }
        

        $datenow = Carbon::now();
        $quarter = Quarter::where('start_date', '<=', $datenow)->where('end_date', '>=', $datenow)->first();
        if (!$quarter) {
            return redirect()->back()->withInput()->with('info', 'No hay un trimestre para la fecha actual');
        }
        $senaempresa = Senaempresa::where('quarter_id',$quarter->id)->first();
        if (!$senaempresa) {
            return redirect()->back()->withInput()->with('info', 'No hay una senaempresa para el trimestre actual');
        }
        $attendances_apprentice = AttendanceSenaempresa::with('staffSenaempresa.apprentice.person')
                ->whereHas('staffSenaempresa', function ($query) use ($senaempresa) {
                    $query->where('senaempresa_id', $senaempresa->id);
                })
                ->get();
        $attendances = AttendanceSenaempresa::with('staffSenaempresa.apprentice.person')->get();
        $senaempresas = Senaempresa::all();

        return view('senaempresa::Company.attendance.index', ['attendances' => $attendances, 'attendances_apprentice' => $attendances_apprentice, 'senaempresas' => $senaempresas, 'title' => trans('senaempresa::menu.Attendance')]);

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
                    'id' => $staff->apprentice->person->id,
                    'name' => $staff->apprentice->person->full_name,
                ],
            ];

            return response()->json($response);
        } else {
            return response()->json(['staff' => null]);
        }
    }

    public function loadAttendancesBySenaempresa(Request $request)
    {
        $senaempresaId = $request->input('senaempresa_id');

        $attendances = AttendanceSenaempresa::with('staffSenaempresa.apprentice.person')
            ->whereHas('staffSenaempresa', function ($query) use ($senaempresaId) {
                $query->where('senaempresa_id', $senaempresaId);
            })
            ->get();

        $attendanceData = [];

        foreach ($attendances as $attendance) {
            $attendanceData[] = [
                'name' => $attendance->staffSenaempresa->apprentice->person->full_name,
                'document_number' => $attendance->staffSenaempresa->apprentice->person->document_number,
                'start_datetime' => $attendance->start_datetime,
                'end_datetime' => $attendance->end_datetime,
                'duration' => $attendance->duration,
            ];
        }

        return response()->json(['attendances' => $attendanceData]);
    }

    public function loadReportBySenaempresa(Request $request)
    {
        $senaempresaId = $request->input('senaempresa_id');

        $reportData = StaffSenaempresa::with('apprentice.person')
            ->where('senaempresa_id', $senaempresaId)
            ->get()
            ->map(function ($staff) {
                return [
                    'name' => $staff->apprentice->person->full_name,
                    'document_number' => $staff->apprentice->person->document_number,
                    'duration_total' => $staff->duration_total,
                ];
            });

        return response()->json(['reportData' => $reportData]);
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
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.index')->with('info', trans('senaempresa::menu.Attendance for this day has already been recorded with a check-in and check-out time.'));
            } else {
                // Actualiza la fecha y hora de salida
                // Actualiza la fecha y hora de salida
                $existingAttendance->end_datetime = now();

                // Calcula la duración y almacénala en el formato HH:MM:SS
                $startDatetime = Carbon::parse($existingAttendance->start_datetime);
                $endDatetime = Carbon::parse($existingAttendance->end_datetime);
                $duration = $startDatetime->diff($endDatetime);
                $durationFormatted = $duration->format('%H:%I:%S');

                $existingAttendance->duration = $durationFormatted;
                $existingAttendance->save();

                // Actualiza la duración total en la tabla staff_senaempresas
                $staffSenaempresa = $existingAttendance->staffSenaempresa;
                $staffSenaempresa->duration_total = $this->sumDurations($staffSenaempresa->duration_total, $durationFormatted);
                $staffSenaempresa->save();

                // Redirige a la lista de asistencias o muestra un mensaje de éxito
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.index')->with('success', trans('senaempresa::menu.Time of departure successfully recorded.'));
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
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.index')->with('success', trans('senaempresa::menu.Attendance successfully registered.'));
            } else {
                // Maneja el caso en el que $staffsenaempresaid no es válido, por ejemplo, mostrando un mensaje de error
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.attendances.index')->with('info', trans('senaempresa::menu.Attendance could not be recorded because the trainee is not on staff'));
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

    private function sumDurations($duration1, $duration2)
    {
        $start = Carbon::createFromFormat('H:i:s', '00:00:00');
        $sum = $start->addHours(intval(substr($duration1, 0, 2)))->addMinutes(intval(substr($duration1, 3, 2)))->addSeconds(intval(substr($duration1, 6, 2)));
        $sum = $sum->addHours(intval(substr($duration2, 0, 2)))->addMinutes(intval(substr($duration2, 3, 2)))->addSeconds(intval(substr($duration2, 6, 2)));

        return $sum->format('H:i:s');
    }
}
