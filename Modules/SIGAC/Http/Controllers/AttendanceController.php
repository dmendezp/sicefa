<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;

class AttendanceController extends Controller
{
    /* Consultar Excusas de Aprendiz */
    public function consult_excuses()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_consult_excuses_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_consult_excuses_title_view')];
        return view('sigac::attendance.excuses', $view);
    }

    /* Consultar Asistencia de Aprendiz o Titulada */
    public function consult_attendance()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_consult_attendance_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_consult_attendance_title_view')];
        return view('sigac::attendance.index', $view);
    }

    /* Registrar asistencia de aprendiz por titulada */
    public function index()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_register_attendance_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_register_attendance_title_view')];
        return view('sigac::attendance.register', $view);
    }
    
    /* Vista principal para la sección de reportes de asistencia */
    public function reports_attendance()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_reports_attendance_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_reports_attendance_title_view')];
        return view('sigac::reports.index', $view);
    }
}
