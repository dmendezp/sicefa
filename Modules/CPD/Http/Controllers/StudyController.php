<?php

namespace Modules\CPD\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CPD\Entities\Data;
use Modules\CPD\Entities\Producer;
use Modules\CPD\Entities\Study;

class StudyController extends Controller
{

    public function index(){
        $view = ['titlePage'=>'Monitoreos', 'titleView'=>'Monitoreos de los cultivos de cacao'];
        $datas = Data::all();
        $studies = Study::all();
        return view('cpd::study.index', compact('view','datas','studies'));
    }

    public function addGet(){
        $view = ['titlePage'=>'Monitoreos - registro', 'titleView'=>'Registro de monitoreo de cultivo de cacao'];
        $datas = Data::all();
        $producers = Producer::orderBy('name','ASC')->pluck('name','id');
        return view('cpd::study.add', compact('view','datas','producers'));
    }

}
