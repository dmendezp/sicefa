<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;

class SIGACController extends Controller
{

    public function index(){
        return view('sigac::index'); // Parar enviar información a travez de una vista se recomienda utilizar la función compact para el envío de estos
    }

}
