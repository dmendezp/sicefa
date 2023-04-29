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
        $farm = Farm::get();
        $environ = Environment::get();
        $filter = Environment::query()->with('farms','productive_units');
        if ($request->has('id')) {
            $filter->where('farms_id', $request->id);
            $filter->where('productive_units_id', $request->id);
        }
        $result = $filter->get();
        $data = ['title'=>trans('cefamaps::menu.Home'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'classenviron'=>$classenviron, 'filter'=>$filter];
        return view('cefamaps::index',$data, compact('result'));
    }

}
