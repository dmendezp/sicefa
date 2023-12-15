<?php

namespace Modules\GTH\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Person;
use Modules\SIGAC\Entities\Attendance;

class RegisterAttendanceController extends Controller
{
    public function viewregisterattendance(Request $request)
    {
        $documentNumber = $request->input('document_number');
        $date = Carbon::now()->toDateString();

        $person = Person::where('document_number', $documentNumber)->first();

        if (!$person) {
            return redirect()->back()->with('error', 'Persona no encontrada');
        }

        $attendance = Attendance::where('person_id', $person->id)->where('date', $date)->first();

        if (!$attendance) {
            $attendanceNew = new Attendance;

            $attendanceNew->date = $date;
            $attendanceNew->person_id = $person->id;
            $attendanceNew->entry_time = Carbon::now(); // Agrega el tiempo de entrada
            $attendanceNew->exit_time = null; // Inicializa el tiempo de salida como nulo
            $attendanceNew->save();

            return redirect()->back()->with('success', 'Asistencia Tomada');
        } else {
            return redirect()->back()->with('error', 'Ya tiene asistencia');
        }
    }
}
