<?php

namespace Modules\SICA\Http\Controllers\unit;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UnitController extends Controller
{

	public function areas(){
        $areas = array();
        $data = ['title'=>trans('sica::menu.Areas'),'areas'=>$areas];
        return view('sica::admin.units.areas.home',$data);
    }

	public function consumption(){
        $consumption = array();
        $data = ['title'=>trans('sica::menu.Consumption'),'consumption'=>$consumption];
        return view('sica::admin.units.consumption.home',$data);
    }

	public function production(){
        $production = array();
        $data = ['title'=>trans('sica::menu.Production'),'production'=>$production];
        return view('sica::admin.units.production.home',$data);
    }

}
