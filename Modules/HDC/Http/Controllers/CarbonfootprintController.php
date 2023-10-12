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

    public function formcalculates(Person $person)
    {
        $environmentalAspects = EnvironmentalAspect::where('personal', 1)
            ->pluck('name', 'id');


        return view('hdc::Calc_Huella.formcalculatefootprint')->with('environmentalAspects', $environmentalAspects)->with('person', $person);
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
            'aspecto.*.id_aspecto' => 'required|numeric',
            'aspecto.*.valor_consumo' => 'required|numeric',
        ]);

        $personId = $request->input('person_id');
        $person = Person::findOrFail($personId);



        // Crear el modelo FamilyPersonFootprint
        $personFootprint = new FamilyPersonFootprint([
            'carbon_print' => 0,
            // Otros campos necesarios
        ]);

        // Asignar el person_id
        $personFootprint->person_id = $person->id;

        // Guardar el modelo FamilyPersonFootprint
        $personFootprint->save();

        foreach ($data['aspecto'] as $values) {
            // Asociar con el modelo FamilyPersonFootprint
            PersonEnvironmentalAspect::create([
                'environmental_aspect_id' => $values['id_aspecto'],
                'family_person_footprint_id' => $personFootprint->id,
                'consumption_value' => $values['valor_consumo'],
            ]);
        }

        return redirect()->route('carbonfootprint.calculos.persona', $person->document_number)->with('success', 'Valores guardados correctamente');


    }
   /*  public function showCarbonFootprints($personaId)
    {
        $person = Person::findOrFail($personaId);
        $carbonFootprints = FamilyPersonFootprint::with('aspecto')->where('person_id', $person->id)->get();

        return view('hdc::Calc_Huella.tabla', compact('person', 'carbonFootprints'));
    } */
}
