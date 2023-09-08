<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\Person;

class CarbonfootprintController extends Controller
{
     public function persona()
    {
        return view('hdc::Calc_Huella.ingresoConsulta');
    }

    public function verficarPersona($documento){
        $usuario = Person::where('document_number',$documento)->first();
        if(is_null($usuario)){
            return view('hdc::Calc_Huella.sinregistro');
        }else{
            return view('hdc::Calc_Huella.verficado', ['usuario'=>$usuario]);
        }
    }
}
