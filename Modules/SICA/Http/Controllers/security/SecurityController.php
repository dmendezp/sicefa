<?php

namespace Modules\SICA\Http\Controllers\security;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SecurityController extends Controller
{

    public function apps(){
        $data = ['title'=>trans('sica::menu.Apps')];
        return view('sica::admin.security.apps',$data);
    }
}
