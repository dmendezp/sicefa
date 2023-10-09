<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HDC\Entities\FamilyPersonFootprint;
use Modules\HDC\Entities\PersonEnvironmentalAspect;
use Modules\SICA\Entities\EnvironmentalAspect;
use Modules\SICA\Entities\Person;

class CarbonfootprintController extends Controller
{
  public function persona()
    {
        return view('hdc::Calc_Huella.ingresoConsulta');
    }

    public function formcalculates(){
        $environmentalAspects = EnvironmentalAspect::where('personal', 1)
            ->pluck('name', 'id');

        return view('hdc::Calc_Huella.formcalculatefootprint')->with('environmentalAspects', $environmentalAspects);
    }

    public function verificarUsuario($documento)
    {
        // Buscar la persona en la base de datos
        $persona = Person::where('document_number', $documento)->first();

        if (is_null($persona)) {
            // Retorna una respuesta JSON con un mensaje de error si no se encuentra la persona
            return response()->json(['mensaje' => 'Persona No Encontrada']);
        } else {
            // Retorna una vista con los datos de la persona si se encuentra
            return view('hdc::Calc_Huella.tabla', ['persona' => $persona]);
        }
    }

    public function saveConsumption(Request $request)
    {
        // Validar y procesar los datos del formulario
        $data = $request->validate([
            'aspecto.*' => 'required|numeric',
            'aspecto.*.id_aspecto' => 'required|numeric',
        ]);

        // Obtener el número de documento de la solicitud
        $documento = $request->input('documento');


        $persona = Person::where('document_number', $documento)->first();


        if (!$persona) {

            return response()->json(['mensaje' => 'Persona No Encontrada']);
        }

        foreach ($data['aspecto'] as $values) {
            PersonEnvironmentalAspect::create([
                'environmental_aspect_id' => $values['id_aspecto'],
                'family_person_footprint_id' => $values['id_familypersonfootprint'],
                'valor_consumo' => $values['valor_consumo'],
            ]);
        }

        return redirect()->route('carbonfootprint.calculos.persona')->with('success', 'Valores guardados correctamente');
    }
}
