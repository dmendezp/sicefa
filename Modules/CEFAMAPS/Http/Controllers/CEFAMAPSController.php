<?php

namespace Modules\CEFAMAPS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ClassEnvironment;
use Modules\CEFAMAPS\Entities\Page;
use Modules\CEFAMAPS\Entities\Coordinate;

class CEFAMAPSController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $unit = ProductiveUnit::get();
        $classenviron = ClassEnvironment::get();
        $farm = Farm::get();
        $environ = Environment::get();
        $data = ['title'=>trans('cefamaps::menu.Home'), 'unit'=>$unit, 'farm'=>$farm, 'environ'=>$environ, 'classenviron'=>$classenviron];
        return view('cefamaps::index',$data);
    }

}
