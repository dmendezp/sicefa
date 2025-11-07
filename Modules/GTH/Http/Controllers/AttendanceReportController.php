<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon;
use Modules\SIGAC\Entities\Attendance;
use Modules\SICA\Entities\Person;

class AttendanceReportController extends Controller
{
    public function viewattendancereport()
    {
        $currentDateOnly = Carbon::today()->toDateString();

        $attendances = Attendance::with('person.employees.employee_type')->where('date', $currentDateOnly)->get();

        return view('gth::attendance_report.attendancereport', ['attendances' => $attendances, 'date', $currentDateOnly]);

    }
}
