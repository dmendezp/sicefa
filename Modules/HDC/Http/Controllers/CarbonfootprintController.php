<?php

namespace Modules\HDC\Http\Controllers;


use Illuminate\Routing\Controller;
use Modules\HDC\Entities\FamilyPersonFootprint;
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


public function calculosPersona($documento) {
    // Busca la persona en la base de datos usando el número de documento proporcionado
    $persona = Person::where('document_number', $documento)->first();

    if (is_null($persona)) {
        // Aquí puedes manejar el caso en el que no se encuentra una persona con el documento proporcionado.
    } else {
        // Ahora que tienes la persona, puedes realizar la consulta de cálculos y mostrar la vista.
        $calculos =FamilyPersonFootprint::where('person_id', $persona->id)
            ->orderBy('updated_at', 'DESC')
            ->get();

        if (count($calculos)) {
            return view('hdc::Calc_Huella.tabla', ['persona' => $persona, 'calculos' => $calculos]);
        }
    }
}
}

