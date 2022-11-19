<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ConfigController extends Controller
{

    public function config(){
        $data = ['title'=>trans('sica::menu.Config')];
        return view('sica::admin.people.config.home',$data);        
    } 

}
