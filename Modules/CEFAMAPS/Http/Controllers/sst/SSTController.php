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
        $data = ['titlePage' => trans('cefamaps::controllers.CEFAMAPS_SST_Index_title_page'), 'environ'=>$environ];
        return view('cefamaps::sst.index', $data);
    }
    
    public function evacuation()
    {
        $data = ['titlePage' => trans('cefamaps::controllers.CEFAMAPS_STT_Evacuation_title_page')];
        return view('cefamaps::sst.evacuation', $data);
    }
    public function Extintores()
    {
        $data = ['titlePage' => trans('cefamaps::controllers.CEFAMAPS_STT_Extintores_title_page')];
        return view('cefamaps::sst.Extintores', $data);
    }
    public function healt()
    {
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_STT_Healt_title_page')];
        return view('cefamaps::sst.healt', $data);
    }

}
