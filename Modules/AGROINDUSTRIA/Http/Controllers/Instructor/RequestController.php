<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\instructor;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RequestController extends Controller
{
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
    
}
