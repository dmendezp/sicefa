<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SaleController extends Controller
{

    public function index(){
        $view = ['titlePage'=>'Ventas - Registro', 'titleView'=>'Registro de venta'];
        return view('ptventa::sale.index', compact('view'));
    }

}
