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

    public function contact()
    {
        $data = ['title'=>trans('ganaderia::menu.Contact')];
        return view('ganaderia::form_contact',$data);
    }    

    public function developers()
    {
        $data = ['title'=>trans('ganaderia::menu.Developers')];
        return view('ganaderia::developers',$data);
    }
   
}
