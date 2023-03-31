<?php

namespace Modules\CPD\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CPD\Entities\Data;

class CPDController extends Controller
{

    public function home()
    {
        $view = ['titlePage'=>'Inicio', 'titleView'=>'Datos de producción de cacao'];
        return view('cpd::home', compact('view'));
    }

    public function metadata()
    {
        $view = ['titlePage'=>'Metadatos', 'titleView'=>'Metadatos de monitoreos de cultivos de cacao'];
        $datas = Data::all();
        return view('cpd::metadata.index', compact('view','datas'));
    }

}
