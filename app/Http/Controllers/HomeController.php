<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\SICA\Entities\App;

class HomeController extends Controller
{

    public function welcome()
    {
        $apps = App::all();
        $data = ['apps'=>$apps];
        return view('welcome', $data);
    }

    public function developers()
    {
        return view('designners');
    }

    public function index()
    {
        $apps = App::all();
        $data = ['apps'=>$apps];
        return view('home', $data);
    }
}
