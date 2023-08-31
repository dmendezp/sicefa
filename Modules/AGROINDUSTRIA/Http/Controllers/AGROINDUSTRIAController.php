<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;

class AGROINDUSTRIAController extends Controller
{
    public function index()
    {
        $title = 'Inicio';
        return view('agroindustria::index', compact('title'));
    }

    public function unidd()
    {
        $title = 'Unidades';
        return view('agroindustria::instructor.unidd', compact('title'));
    }

    public function solicitud()
    {
        $title = 'Solicitud';
        return view('agroindustria::instructor.solicitud', compact('title'));
    }

    public function enviarsolicitud()
    {
        $title = 'Enviar Solicitud';
        return view('agroindustria::instructor.enviarsolicitud', compact('title'));
    }

    public function invb()
    {
        $title = 'Inventario';
        return view('agroindustria::intern.invb', compact('title'));
    }

    public function dashboard()
    {
        $title = 'Dasboard';
        return view('agroindustria::admin.dashboard', compact('title'));
    }

}
