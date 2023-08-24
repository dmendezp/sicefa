<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class ParameterController extends Controller 
{

     // Borrado suave
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

     // Mostrar la vista de Parametros
    public function index()
    {
        return view('agrocefa::parameters');
    }
}
