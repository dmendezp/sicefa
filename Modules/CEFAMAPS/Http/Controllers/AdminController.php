<?php

namespace Modules\CEFAMAPS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;

use Modules\SICA\Entities\Role;

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
}
