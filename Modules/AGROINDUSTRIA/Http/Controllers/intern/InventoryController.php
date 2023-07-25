<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Intern;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InventoryController extends Controller
{
    public function index(){
        $title = 'Inicio';
        return view('agroindustria::intern.index', compact('title'));
    }
    
    public function invb()
    {
        $title = 'Inventario';
        return view('agroindustria::intern.invb', compact('title'));
    }
}
