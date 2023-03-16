<?php

namespace Modules\CEFAMAPS\Http\Controllers\sst;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;

class SSTController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $environ = Environment::with('coordinates')->with('farms')->with('productive_units')->get();
        $data = ['title'=>trans('cefamaps::SST.Home'), 'environ'=>$environ];
        return view('cefamaps::sst.index',$data);
    }
    
    public function evacuation()
    {
        $data = ['title'=>trans('cefamaps::menu.Home')];
        return view('cefamaps::sst.evacuation', $data);
    }
}
