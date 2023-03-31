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
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9e522343459ee925d0b5f3facbe07726bbe7eda3
>>>>>>> 38c7f0aef500bd787694266d92d1596b42416e45
    public function property()
    {
        $data = ['title'=>trans('ganaderia::menu.property')];
        return view('ganaderia::property',$data);
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
    public function contact()
    {
        $data = ['title'=>trans('ganaderia::menu.Contact')];
        return view('ganaderia::form_contact',$data);
>>>>>>> ecf44174427f6326b1453a36d931e98cfb747e27
>>>>>>> 9e522343459ee925d0b5f3facbe07726bbe7eda3
>>>>>>> 38c7f0aef500bd787694266d92d1596b42416e45
    }    

    public function developers()
    {
        $data = ['title'=>trans('ganaderia::menu.Developers')];
        return view('ganaderia::developers',$data);
    }
   
}
