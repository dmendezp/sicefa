<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\App;

class SIGACController extends Controller
{

    public function index(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_index_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_index_title_view')];
        $apps = App::get();
        return view('sigac::index', compact('apps', 'view'));
    }

    public function info(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_info_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_info_title_view')];
        $apps = App::get();
        return view('sigac::information.index', compact('apps','view'));
    }

    public function devs(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_devs_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_devs_title_view')];
        $apps = App::get();
        return view('sigac::developers.index', compact('apps','view'));
    }

    /* Panel de control de coordinación académica */
    public function academic_coordination_dashboard(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_academic_coordination_dashboard_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_academic_coordination_dashboard_title_view')];
        $apps = App::get();
        return view('sigac::index_academic_coordination', compact('apps','view'));
    }

    /* Panel de control del instructor */
    public function instructor_dashboards(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_instructor_dashboard_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_instructor_dashboard_title_view')];
        $apps = App::get();
        return view('sigac::index_instructor', compact('apps','view'));
    }

    /* Panel de control de bienestar */
    public function wellness_dashboard(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_wellness_dashboard_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_wellness_dashboard_title_view')];
        $apps = App::get();
        return view('sigac::index_wellness', compact('apps','view'));
    }

    /* Panel de control de aprendiz */
    public function apprentice_dashboard(){
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_apprentice_dashboard_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_apprentice_dashboard_title_view')];
        $apps = App::get();
        return view('sigac::index_apprentice', compact('apps','view'));
    }
}
