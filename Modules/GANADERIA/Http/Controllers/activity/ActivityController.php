<?php

namespace Modules\GANADERIA\Http\Controllers\activity;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ActivityController extends Controller
{
    public function productive_unit(){
        
        $data = ['title'=>trans('ganaderia::menu.activity')];
        return view('ganaderia::admin.productive_unit.home',$data);
    }

    public function movement(){
        
        $data = ['title'=>trans('ganaderia::menu.activity')];
        return view('ganaderia::admin.movement.home',$data);
    }
}
