<?php

namespace Modules\CEFAMAPS\Http\Controllers\environment;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;

class EnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function config()
    {
        $environ = Environment::get();
        $data = ['title'=>trans('cefamaps::environment.Environment'), 'environ'=>$environ];
        return view('cefamaps::admin.environment.config',$data);
    }
}
