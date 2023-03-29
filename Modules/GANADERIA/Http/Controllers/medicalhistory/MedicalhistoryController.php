<?php

namespace Modules\GANADERIA\Http\Controllers\medicalhistory;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MedicalhistoryController extends Controller
{

    public function Generaldata(){
        
        $data = ['title'=>trans('ganaderia::menu.medicalhistory')];
        return view('ganaderia::admin.generaldata.home',$data);
    }

   
}
