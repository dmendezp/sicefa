<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AGROCEFAController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('agrocefa::index');
    }

    public function insumos()
    {
        return view('agrocefa::insumos');
    }

    public function bodega()
    {
        return view('agrocefa::formulariocultivo');
    }

    public function inventory()
    {
        return view('agrocefa::inventory');
    }

    public function parameters()
    {
        return view('agrocefa::parameters');
    }

    public function vistaaprendiz()
    {
        return view('agrocefa::index');
    }

    public function vistauser()
    {
        return view('agrocefa::index');
    }
 
 



}
