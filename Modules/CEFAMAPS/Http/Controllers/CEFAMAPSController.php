<?php

namespace Modules\CEFAMAPS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Sector;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ClassEnvironment;
use Modules\CEFAMAPS\Entities\Page;

class CEFAMAPSController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $unit = ProductiveUnit::get();
        $classenviron = ClassEnvironment::get();
        $sector = Sector::get();
        $environ = Environment::get();
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_index_title_page'), 'environ'=>$environ, 'unit'=>$unit, 'sector'=>$sector, 'classenviron'=>$classenviron];
        return view('cefamaps::index',$data);
    }
}
