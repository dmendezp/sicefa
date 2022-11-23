<?php

namespace Modules\CPD\Http\Controllers;

use Illuminate\Routing\Controller;

class CPDController extends Controller
{

    public function home()
    {
        $view = ['titlePage'=>'Home', 'titleView'=>'Datos de producción de cacao'];
        return view('cpd::home', compact('view'));
    }

}
