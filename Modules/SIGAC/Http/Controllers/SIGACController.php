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
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_info_title_page'), 'titleView'=>trans('sigac::controllers.SICAC_info_title_view')];
        $apps = App::get();
        return view('sigac::information.index', compact('apps','view'));
    }

    /* Panel de control del instructor */
    public function instructor_dashboard(){
        $view = ['titlePage'=>trans('sigac::about.About us'), 'titleView'=>trans('sigac::about.About us')];
        $apps = App::get();
        return view('sigac::index_instructor', compact('apps','view'));
    }
}
