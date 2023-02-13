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

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard()
    {
        $unit = ProductiveUnit::get();
        $farm = Farm::get();
        $environ = Environment::get();
        $roles = Role::count();
        $data = ['title'=>trans('cefamaps::menu.Dashboard'), 'roles'=>$roles, 'unit'=>$unit, 'farm'=>$farm, 'environ'=>$environ];
        return view('cefamaps::admin.dashboard',$data);
    }
}
