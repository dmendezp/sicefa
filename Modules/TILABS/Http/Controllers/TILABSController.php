<?php

namespace Modules\TILABS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TILABSController extends Controller
{

    public function index()
    {
        $data = ['title'=>trans('tilabs::menu.Home')];
        return view('tilabs::index',$data);
    }

    public function labs()
    {
        $data = ['title'=>trans('tilabs::menu.Labs')];
        return view('tilabs::index',$data);
    }    

    public function dashboard()
    {
        $data = ['title'=>trans('tilabs::menu.Dashboard')];
        return view('tilabs::admin.dashboard',$data);
    }

    public function loan()
    {
        $data = ['title'=>trans('tilabs::menu.Home')];
        return view('tilabs::admin.loan.home',$data);
    }

    public function return()
    {
        $data = ['title'=>trans('tilabs::menu.Home')];
        return view('tilabs::index',$data);
    }

    public function transactions()
    {
        $data = ['title'=>trans('tilabs::menu.Home')];
        return view('tilabs::index',$data);
    }

    public function inventory()
    {
        $data = ['title'=>trans('tilabs::menu.Home')];
        return view('tilabs::index',$data);
    }

    public function developers()
    {
        $data = ['title'=>trans('tilabs::menu.Home')];
        return view('tilabs::developers',$data);
    }

}
