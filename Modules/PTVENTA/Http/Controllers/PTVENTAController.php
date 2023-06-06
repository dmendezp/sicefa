<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Routing\Controller;

class PTVENTAController extends Controller
{

    public function index(){
        $view = ['titlePage'=>'Inicio', 'titleView'=>trans('ptventa::mainPage.Main page')];
        return view('ptventa::index', compact('view'));
    }

    public function devs(){
        $view = ['titlePage'=>'PTVENTA - Desarrolladores', 'titleView'=>trans('ptventa::devs.Developers and credits')];
        return view('ptventa::developers.index', compact('view'));
    }

    public function info(){
        $view = ['titlePage'=>'PTVENTA - Información', 'titleView'=>'Acerca de PTVENTA'];
        return view('ptventa::information.index', compact('view'));
    }
}
