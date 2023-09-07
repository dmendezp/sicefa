<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\ProductiveUnit;

class GraficasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
   /*  public function index()
    {
        return view('hdc::index');
    } */
    public function Graficas(){
        return view('hdc::Graficas');

    }

    }