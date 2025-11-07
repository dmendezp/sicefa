<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BIENESTARController extends Controller
{

    public function home()
    {
        return view('bienestar::home');
    }

    public function manual()
    {
        $pdfPath1 = asset('modules\bienestar\manual\Manual de Usuarios BIENESTAR - Rol de Administrador.pdf');

        return view('bienestar::user-manual.user-manual', compact('pdfPath1'));
    }
    
}
