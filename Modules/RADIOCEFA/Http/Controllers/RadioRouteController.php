<?php

namespace Modules\RADIOCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RadioRouteController extends Controller
{
    // ruta para peticiones
    public function PetMusica()
    {
        return view('radiocefa::PetMusica');
    }

    // // ruta para cronograma
    //  public function index()
    // {
    //     return view('radiocefa::index');
    // }

    // // ruta para peticionMusica
    //  public function index()
    // {
    //     return view('radiocefa::index');
    // }

}
