<?php

namespace Modules\CEFAMAPS\Http\Controllers\sst;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Carrusel;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;

class SSTController extends Controller
{
    
    public function index()
    {
        $environ = Environment::get();
        $data = ['title'=>trans('cefamaps::SST.Home'), 'environ'=>$environ];
        return view('cefamaps::sst.index', $data);
    }
    
    public function evacuation()
    {
        $data = ['title'=>trans('cefamaps::menu.Home')];
        return view('cefamaps::sst.evacuation', $data);
    }
    public function Extintores()
    {
        $data = ['title'=>trans('cefamaps::menu.Home')];
        return view('cefamaps::sst.Extintores', $data);
    }
    public function healt()
    {
        $data = ['title'=>trans('cefamaps::menu.Home')];
        return view('cefamaps::sst.healt', $data);
    }

}
