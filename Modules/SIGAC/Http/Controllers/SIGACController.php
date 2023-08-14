<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\App;

class SIGACController extends Controller
{

    public function index(){
        $view = ['titlePage'=>trans('sigac::general.TitlePage'), 'titleView'=>trans('sigac::general.TitleView')];
        $apps = App::get();
        return view('sigac::index', compact('apps', 'view'));
    }
}
