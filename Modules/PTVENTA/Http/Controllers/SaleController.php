<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Movement;

class SaleController extends Controller
{

    public function index(){
        $movements = Movement::all();
        $view = ['titlePage'=>'PVENTA - Ventas', 'titleView'=>'Ventas realizadas'];
        return view('ptventa::sale.index', compact('view','movements'));
    }

    public function register(){
        $view = ['titlePage'=>'PTVENTA - Ventas', 'titleView'=>'Registro de venta'];
        return view('ptventa::sale.register', compact('view'));
    }

}
