<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;

class ShoppingController extends Controller
{
    public function index(){ // Vista de la tienda (Publica)
        $view = ['titlePage'=> 'Store', 'titleView'=> 'Store'];
        return view('ptventa::shopping.index', compact('view'));
    }

}
