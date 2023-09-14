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
            // Retorna una respuesta JSON con un mensaje de error si no se encuentra la persona
            return response()->json(['mensaje' => 'Persona No Encontrada']);
        } else {
            // Retorna una vista con los datos de la persona si se encuentra
            return view('hdc::Calc_Huella.tabla', ['persona' => $persona]);
        }
    }

}




