<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }

    public function developers()
    {
        return view('designners');
    }

    public function index()
    {
        return view('home');
    }
}
