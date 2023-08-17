<?php

namespace Modules\SICA\Http\Controllers\security;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\App;

class AppController extends Controller
{

    /* Lista de aplicaciones disponibles */
    public function apps_index(){
        $apps = App::orderBy('name','ASC')->get();
        $data = ['title'=>trans('sica::menu.Apps'),'apps'=>$apps];
        return view('sica::admin.security.apps.index',$data);
    }
    
}
