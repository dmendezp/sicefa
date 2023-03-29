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

<<<<<<< HEAD
    public function property()
    {
        $data = ['title'=>trans('ganaderia::menu.property')];
        return view('ganaderia::property',$data);
=======
    public function contact()
    {
        $data = ['title'=>trans('ganaderia::menu.Contact')];
        return view('ganaderia::form_contact',$data);
>>>>>>> ecf44174427f6326b1453a36d931e98cfb747e27
    }    

    public function developers()
    {
        $data = ['title'=>trans('ganaderia::menu.Developers')];
        return view('ganaderia::developers',$data);
    }
   
}
