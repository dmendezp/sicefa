<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;

class EnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $environ = Environment::get();
        $data = ['title'=>trans('cefamaps::environment.Environment'), 'environ'=>$environ];
        return view('cefamaps::admin.environment.index',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function add()
    {
        $data = ['title'=>trans('cefamaps::environment.Add')];
        return view('cefamaps::admin.environment.add',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function addpost()
    {
        $unit = ProductiveUnit::get();
        $data = ['title'=>trans('cefamaps::environment.Add'), 'unit'=>$unit];
        return view('cefamaps::admin.environment.add',$data);
    }
}
