<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Routing\Controller;

class InventoryController extends Controller
{

    public function index() { // Listado del inventario actual
        $view = ['titlePage'=>'Inventario - Listado', 'titleView'=>'Administración de inventario'];
        return view('ptventa::inventory.index', compact('view'));
    }

    public function create() { // Formulario de registro (entrada) de inventario
        $view = ['titlePage'=>'Inventario - Registro', 'titleView'=>'Registro de inventario'];
        return view('ptventa::inventory.create', compact('view'));
    }

}
