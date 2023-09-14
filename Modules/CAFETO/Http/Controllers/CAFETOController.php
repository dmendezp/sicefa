<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\App;

class CAFETOController extends Controller
{

    public function index(){
        $view = ['titlePage'=>'Inicio', 'titleView'=>'Página Principal'];
        $apps = App::get();
        return view('cafeto::index', compact('apps', 'view'));
    }

    public function devs(){
        $view = ['titlePage'=>trans('cafeto::controllers.CAFETO_devs_title_page'), 'titleView'=>trans('cafeto::controllers.CAFETO_devs_title_view')];
        $apps = App::get();
        return view('cafeto::developers.index', compact('apps','view'));
    }

    public function info(){
        $view = ['titlePage'=>trans('cafeto::controllers.CAFETO_info_title_page'), 'titleView'=>trans('cafeto::controllers.CAFETO_info_title_page')];
        $apps = App::get();
        return view('cafeto::information.index', compact('apps','view'));
    }

}
