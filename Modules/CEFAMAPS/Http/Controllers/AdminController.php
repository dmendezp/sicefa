<?php

namespace Modules\CEFAMAPS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Sector;
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
        $sector = Sector::get();
        $environ = Environment::get();
        $classenviron = ClassEnvironment::get();
        $roles = Role::count();
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_dashboard_title_page'), 'roles'=>$roles, 'unit'=>$unit, 'sector'=>$sector, 'environ'=>$environ, 'classenviron'=>$classenviron];
        return view('cefamaps::admin.dashboard',$data);
    }

    public function environmentmanager_dashboard(Request $request)
    {
        $environ = Environment::get();
        $classenviron = ClassEnvironment::get();
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_dashboard_title_page'),'environ'=>$environ, 'classenviron'=>$classenviron];
        return view('cefamaps::environmentmanager_dashboard',$data);
    }
}
