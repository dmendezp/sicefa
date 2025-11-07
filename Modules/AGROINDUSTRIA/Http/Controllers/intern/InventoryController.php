<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\intern;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InventoryController extends Controller
{
 
    public function invb()
    {
        $title = 'Inventario';
        return view('agroindustria::intern.invb', compact('title'));
    }

    public function bodegaepp()
    {
        $title = 'Ibdoegaepp';
        return view('agroindustria::intern.bepp', compact('title'));
    }

    public function bodegaaseo()
    {
        $title = 'Ibdoegaaseo';
        return view('agroindustria::intern.baseo', compact('title'));
    }

    public function bodegainsumos()
    {
        $title = 'Ibdoegainsumos';
        return view('agroindustria::intern.binsu', compact('title'));
    }
    
}
