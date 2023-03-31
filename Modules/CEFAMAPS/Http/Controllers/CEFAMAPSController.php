<?php

namespace Modules\CEFAMAPS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\Environment;
use Modules\CEFAMAPS\Entities\Page;
use Modules\CEFAMAPS\Entities\Coordinate;

class CEFAMAPSController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $unit = ProductiveUnit::get();
        $farm = Farm::get();
        $environ = Environment::with('pages')->get();
        $data = ['title'=>trans('cefamaps::menu.Home'), 'unit'=>$unit, 'farm'=>$farm, 'environ'=>$environ];
        return view('cefamaps::index',$data);
    }

    public function pruebas(Request $request)
    {
        $unit = ProductiveUnit::get();
        $farm = Farm::get();
        $environ = Environment::with('pages')->get();
        //mio aparte pruebas
        $userId = $request->input('environments_id');
        $class = Environment::all();
        $selectedUser = $userId ? Environment::findOrFail($userId) : null;
        $data = ['title'=>trans('cefamaps::menu.Home'), 'unit'=>$unit, 'farm'=>$farm, 'environ'=>$environ];
        return view('cefamaps::pruebas',$data, compact('class', 'selectedUser'));
    }

}
