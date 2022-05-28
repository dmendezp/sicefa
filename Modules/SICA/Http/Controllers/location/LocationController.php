<?php

namespace Modules\SICA\Http\Controllers\location;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Municipality;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\Environment;

class LocationController extends Controller
{
    public function countries(){
        $countries = Municipality::with('department.country')->get();
        $data = ['title'=>trans('sica::menu.Countries'),'countries'=>$countries];
        return view('sica::admin.location.countries.home',$data);
    }

    public function farms(){
        //$farms = Farm::get();
        $coudepmun = Municipality::where('department_id','421')->get();
        $data = ['title'=>trans('sica::menu.Farms'),'coudepmun'=>$coudepmun];
        return view('sica::admin.location.farms.home',$data);
    }

    public function environments(){
        $environments = Environment::get();
        $data = ['title'=>trans('sica::menu.Environments'),'environments'=>$environments];
        return view('sica::admin.location.environments.home',$data);
    }    
}
