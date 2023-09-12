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
<<<<<<< HEAD
        $data = ['title'=>trans('cefamaps::SST.Home'), 'environ'=>$environ];
=======
        $data = ['titlePage' => trans('cefamaps::controllers.CEFAMAPS_SST_Index_title_page'), 'environ'=>$environ];
>>>>>>> FABRICA4
        return view('cefamaps::sst.index', $data);
    }
    
    public function evacuation()
    {
<<<<<<< HEAD
        $data = ['title'=>trans('cefamaps::menu.Home')];
=======
        $data = ['titlePage' => trans('cefamaps::controllers.CEFAMAPS_STT_Evacuation_title_page')];
>>>>>>> FABRICA4
        return view('cefamaps::sst.evacuation', $data);
    }
    public function Extintores()
    {
<<<<<<< HEAD
        $data = ['title'=>trans('cefamaps::menu.Home')];
=======
        $data = ['titlePage' => trans('cefamaps::controllers.CEFAMAPS_STT_Extintores_title_page')];
>>>>>>> FABRICA4
        return view('cefamaps::sst.Extintores', $data);
    }
    public function healt()
    {
<<<<<<< HEAD
        $data = ['title'=>trans('cefamaps::menu.Home')];
=======
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_STT_Healt_title_page')];
>>>>>>> FABRICA4
        return view('cefamaps::sst.healt', $data);
    }

}
