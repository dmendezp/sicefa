<?php

namespace Modules\CEFAMAPS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Environment;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard()
    {
        $roles = Role::count();
        $data = ['title'=>trans('cefamaps::menu.Dashboard'),'roles'=>$roles];
        return view('cefamaps::admin.dashboard',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function environment()
    {
        $data = ['title'=>trans('cefamaps::environment.Environment')];
        return view('cefamaps::admin.environment.index',$data);
    }
}
