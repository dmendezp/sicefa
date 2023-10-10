<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;

class AttendanceController extends Controller
{
    /* Consultar Excusas de Aprendiz */
    public function consult_excuses()
    {
        $view = ['titlePage'=>trans('sigac::consult.Consultation'), 'titleView'=>trans('sigac::consult.Attendance Consultation')];
        return view('sigac::attendance.excuses', compact('view'));
    }

    /* Consultar Asistencia de Aprendiz o Titulada */
    public function consult_attendance()
    {
        $view = ['titlePage'=>trans('sigac::consult.Consultation'), 'titleView'=>trans('sigac::consult.Attendance Consultation')];
        return view('sigac::attendance.index', compact('view'));
    }

    /* Registrar asistencia de aprendiz por titulada */
    public function index()
    {
        $view = ['titlePage'=>trans('sigac::attendance.Attendance'), 'titleView'=>trans('sigac::attendance.Attendance Registration')];
        return view('sigac::attendance.register', compact('view'));
    }
    
    /* Vista principal para la sección de reportes de asistencia */
    public function reports_attendance()
    {
        $view = ['titlePage'=>trans('sigac::reports.TitlePage'), 'titleView'=>trans('sigac::reports.TitleView')];
        return view('sigac::reports.index', compact('view'));
    }
}
