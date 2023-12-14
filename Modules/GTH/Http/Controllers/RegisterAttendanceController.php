<?php

namespace Modules\GTH\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Apprentice;
use Modules\SIGAC\Entities\Attendance;

class RegisterAttendanceController extends Controller
{
    public function viewregisterattendance(Request $request)
    {
        $documentNumber = $request->input('document_number');
        $date = Carbon::now()->toDateString();

        $person = Apprentice::whereHas('person', function ($query) use ($documentNumber){
            $query->where('document_number', $documentNumber);
        })->first();

        $apprenticeid = $person->id;

        $attendance = Attendance::where('apprentice_id', $apprenticeid)->where('date',$date)->get();

        if ($attendance->isEmpty()) {
            $attendancenew = new Attendance;

            $attendancenew->date = $date;
            $attendancenew->apprentice_id = $apprenticeid;
            $attendancenew->state = 'Si';
            $attendancenew->save();

            return redirect()->back()->with('success', 'Asistencia Tomada');

        }else {
            return redirect()->back()->with('error', 'Ya tiene asistencia');

        }


    }
}
