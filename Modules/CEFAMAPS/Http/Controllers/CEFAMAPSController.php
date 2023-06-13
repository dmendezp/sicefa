<?php

namespace Modules\CEFAMAPS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CEFAMAPSController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('cefamaps::index');
    }

    public function sst()
    {
         return view('cefamaps::sst');
    }
    
    public function evacuation()
    {
         return view('cefamaps::evacuation');
    }

}
