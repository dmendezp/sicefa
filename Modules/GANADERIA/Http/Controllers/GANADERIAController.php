<?php

namespace Modules\GANADERIA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GANADERIAController extends Controller
{

    public function index()
    {
        $data = ['title'=>trans('ganaderia::menu.Home')];
        return view('ganaderia::index',$data);
    }

    public function property()
    {
        $data = ['title'=>trans('ganaderia::menu.property')];
        return view('ganaderia::property',$data);
    }    

    public function developers()
    {
        $data = ['title'=>trans('ganaderia::menu.Developers')];
        return view('ganaderia::developers',$data);
    }
   
}
