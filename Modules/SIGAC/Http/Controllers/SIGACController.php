<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Employee;
use Modules\SICA\Entities\Contractor;

class SIGACController extends Controller
{

    public function index(){
        $employees = Employee::where('employee_type_id', 2)->where('state', 'Activo')->get();
        $contractors = Contractor::where('contract_end_date', '>=', now())->where('employee_type_id', 2)->get();
        $apprentices = Apprentice::where('apprentice_status', 'EN FORMACIÓN')->get();

        $view = [
            'titlePage'=>trans('sigac::controllers.SIGAC_index_title_page'), 
            'titleView'=>trans('sigac::controllers.SIGAC_index_title_view'),
            'apprentices' => $apprentices,
            'employees' => $employees,
            'contractors' => $contractors
        ];
        return view('sigac::index', $view);
    }

    public function proof(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_index_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_index_title_view')];
        return view('sigac::proof', $view);
    }

    public function info(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_info_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_info_title_view')];
        return view('sigac::information.index', $view);
    }

    public function devs(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_devs_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_devs_title_view')];
        return view('sigac::developers.index', $view);
    }

    /* Panel de control de coordinación académica */
    public function academic_coordination_dashboard(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_academic_coordination_dashboard_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_academic_coordination_dashboard_title_view')];
        return view('sigac::index_academic_coordination', $view);
    }

    /* Panel de control del instructor */
    public function instructor_dashboards(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_instructor_dashboard_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_instructor_dashboard_title_view')];
        return view('sigac::index_instructor', $view);
    }

    /* Panel de control de bienestar */
    public function wellness_dashboard(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_wellness_dashboard_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_wellness_dashboard_title_view')];
        return view('sigac::index_wellness', $view);
    }

    /* Panel de control de aprendiz */
    public function apprentice_dashboard(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_apprentice_dashboard_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_apprentice_dashboard_title_view')];
        return view('sigac::index_apprentice', $view);
    }

    /* Panel de control de apoyo */
    public function support_dashboard(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_support_dashboard_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_support_dashboard_title_view')];
        return view('sigac::index_wellness', $view);
    }

    /* Panel de control de apoyo */
    public function securitystaff_dashboard(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_support_dashboard_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_support_dashboard_title_view')];
        return view('sigac::index_wellness', $view);
    }
}   