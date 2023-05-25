<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Routing\Controller;

class PTVENTAController extends Controller
{

    public function index(){
        $view = ['titlePage'=>'PTVENTA - Inicio', 'titleView'=>'Bienvenido a PTVENTA'];
        return view('ptventa::index', compact('view'));
    }

}
