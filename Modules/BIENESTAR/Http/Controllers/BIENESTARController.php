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


    
}
