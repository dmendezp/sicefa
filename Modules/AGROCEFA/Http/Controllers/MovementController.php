<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MovementController extends Controller
{
    public function viewmovements()
    {   
        return view('agrocefa::movements.index');
    }

    public function formentrance ()
    {
        return view('agrocefa::movements.formentrance');
    }

    public function formexit()
    {
        return view('agrocefa::movements.formexit');
    }
}
