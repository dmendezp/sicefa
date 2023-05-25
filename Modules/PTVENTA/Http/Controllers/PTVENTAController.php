<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Routing\Controller;

class PTVENTAController extends Controller
{

    public function index(){
        $view = ['titlePage'=>'PTVENTA - Inicio', 'titleView'=>'Bienvenido a PTVENTA'];
        return view('ptventa::index', compact('view'));
    }

    public function devs(){
        $view = ['titlePage'=>'PTVENTA - Desarrolladores', 'titleView'=>'Desarrolladores y créditos de PTVENTA'];
        return view('ptventa::developers.index', compact('view'));
    }
}
