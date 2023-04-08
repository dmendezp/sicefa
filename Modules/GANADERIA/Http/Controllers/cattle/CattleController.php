<?php

namespace Modules\GANADERIA\Http\Controllers\cattle;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CattleController extends Controller
{
    public function register_cattle(){
        
        $data = ['title'=>trans('ganaderia::menu.cattle')];
        return view('ganaderia::admin.register_cattle.home',$data);
    }

  
    public function reproduction(){
        
        $data = ['title'=>trans('ganaderia::menu.cattle')];
        return view('ganaderia::admin.reproduction.home',$data);
    }

	}


