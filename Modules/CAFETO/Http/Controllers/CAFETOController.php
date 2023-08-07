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

}
