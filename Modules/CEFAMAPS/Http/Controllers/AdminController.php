<?php

namespace Modules\CEFAMAPS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\ClassEnvironment;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard(Request $request)
    {
        $unit = ProductiveUnit::get();
        $farm = Farm::get();
        $environ = Environment::get();
        $classenviron = ClassEnvironment::get();
        $roles = Role::count();
        $filter = Environment::query()->with('farms','productive_units');
        if ($request->has('id')) {
            $filter->where('farms_id', $request->id);
            $filter->where('productive_units_id', $request->id);
        }
        $result = $filter->get();
        $data = ['title'=>trans('cefamaps::menu.Dashboard'), 'roles'=>$roles, 'unit'=>$unit, 'farm'=>$farm, 'environ'=>$environ, 'classenviron'=>$classenviron, 'filter'=>$filter];
        return view('cefamaps::admin.dashboard',$data, compact('result'));
    }
}