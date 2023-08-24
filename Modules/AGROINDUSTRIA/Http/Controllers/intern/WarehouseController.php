<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Intern;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WarehouseController extends Controller
{
    

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

    public function bodegaenvases()
    {
        $title = 'Ibdoegaenvases';
        return view('agroindustria::intern.benvas', compact('title'));
    }

    
}
