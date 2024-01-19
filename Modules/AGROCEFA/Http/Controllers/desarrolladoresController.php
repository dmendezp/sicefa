<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class desarrolladoresController extends Controller
{
    public function index()
    {
        return view('agrocefa::desarrolladores.index');
    }
}
