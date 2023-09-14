<?php

namespace Modules\HDC\Http\Controllers;


use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;

class CarbonfootprintController extends Controller
{
     public function persona()
    {
        return view('hdc::Calc_Huella.ingresoConsulta');
    }


    public function calculosPersona($documento) {
        // Busca la persona en la base de datos usando el número de documento proporcionado
        $persona = Person::where('document_number', $documento)->first();

        if (is_null($persona)) {
            // Maneja el caso en el que no se encuentra una persona con el documento proporcionado.
            return redirect()->route('carbonfootprint.persona')->with('error','Persona No Encontrada');
        } else {
            return view('hdc::Calc_Huella.tabla', ['persona' => $persona,]);
        }
    }
}




