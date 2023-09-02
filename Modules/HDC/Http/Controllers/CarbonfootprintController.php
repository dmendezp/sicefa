<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;

class CarbonfootprintController extends Controller
{
    public function persona()
    {
        return view('hdc::Calc_Huella.ingresoConsulta');
    }

    public function verficarPersona($documento){
        $usuario = Person::where('document_number',$documento)->first();
        /* if(is_null($usuario)){
            $epss = EPS::pluck('name','id');
            $gruposPoblacionales = PopulationGroup::pluck('name','id');
            return view('carbonfootprint::persona.registro', ['documento'=>$documento, 'epss' => $epss, 'gruposPoblacionales' => $gruposPoblacionales]);
        }else{
            return view('carbonfootprint::persona.verficado', ['usuario'=>$usuario]);
        } */
    }
}
