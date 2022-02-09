<?php

namespace Modules\SICA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SICAController extends Controller
{

    public function index()
    {
        $data = ['title'=>trans('sica::menu.Home')];
        return view('sica::index',$data);
    }

    public function contact()
    {
        $data = ['title'=>trans('sica::menu.Contact')];
        return view('sica::form_contact',$data);
    }    

    public function developers()
    {
        $data = ['title'=>trans('sica::menu.Developers')];
        return view('sica::developers',$data);
    }
   
}
