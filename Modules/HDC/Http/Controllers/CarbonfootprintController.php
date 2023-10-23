<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HDC\Entities\FamilyPersonFootprint;
use Modules\HDC\Entities\PersonEnvironmentalAspect;
use Modules\SICA\Entities\EnvironmentalAspect;
use Modules\SICA\Entities\Person;
use Illuminate\Support\Facades\Validator;

class CarbonfootprintController extends Controller
{
    public function persona()
    {
        $personaid = Auth::user()->person->id;


            $environmeaspect = FamilyPersonFootprint::with('personenvironmentalaspects.environmental_aspect')->where('person_id', $personaid)->get();

            // Retorna una vista con los datos de la persona si se encuentra
            return view('hdc::Calc_Huella.tabla', ['environmeaspect' => $environmeaspect]);
        //return view('hdc::Calc_Huella.ingresoConsulta');
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
        $personaid = Person::where('document_number', $documento)->pluck('id')->first();
        $persona = Person::where('document_number', $documento)->first();
        if (is_null($persona)) {
            // Retorna una respuesta JSON con un mensaje de error si no se encuentra la persona
            return response()->json(['mensaje' => 'Persona No Encontrada']);
        } else {

            $environmeaspect = FamilyPersonFootprint::with('personenvironmentalaspects.environmental_aspect')->where('person_id', $personaid)->get();

            // Retorna una vista con los datos de la persona si se encuentra
            return view('hdc::Calc_Huella.tabla', ['persona' => $persona, 'environmeaspect' => $environmeaspect]);
        }
    }

    public function saveConsumption(Request $request)
    {

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

        $total = 0;
        foreach ($data['aspecto'] as $values) {
            // Asociar con el modelo FamilyPersonFootprint
            $pea = PersonEnvironmentalAspect::create([
                'environmental_aspect_id' => $values['id_aspecto'],
                'family_person_footprint_id' => $personFootprint->id,
                'consumption_value' => $values['valor_consumo'],
            ]);

            // Obtén el modelo EnvironmentalAspect asociado a $pea
            $environmentalAspect = $pea->environmental_aspect;
            $resultado = $pea->consumption_value * $environmentalAspect->conversion_factor;


            $total += $resultado;
        }
        $personFootprint->update(['carbon_print' => $total]);

        return redirect()->route('carbonfootprint.persona')->with('success', 'Valores guardados correctamente');
    }

    public function editConsumption($id)
    {
        // Buscar el registro de PersonEnvironmentalAspect por ID
        $fpf = FamilyPersonFootprint::findOrFail($id);

        // Retornar la vista de edición con los datos necesarios
        return view('hdc::Calc_Huella.edit_consumption', compact('fpf'));
    }


    public function updateConsumption(Request $request, $id)
    {
        // Validar los datos del formulario si es necesario
        $request->validate([
            'aspecto.*.valor_consumo.*' => 'required|numeric',
        ]);

        // Buscar el registro de FamilyPersonFootprint por ID
        $fpf = FamilyPersonFootprint::findOrFail($id);

        // Actualizar los valores de consumo en la tabla intermedia
        foreach ($request->aspecto as $peaId => $data) {
            foreach ($data['valor_consumo'] as $key => $value) {
                $fpf->personenvironmentalaspects()
                    ->where('id', $peaId)
                    ->update(['consumption_value' => $value]);
            }
        }

        // Redirigir a la vista de edición con un mensaje de éxito
        return redirect()->route('carbonfootprint.persona', ['id' => $fpf->id])
            ->with('success', 'Consumo actualizado exitosamente');
    }




    /* Funcion de boton eliminar  */
    public function eliminarConsumo($id)
    {
        // Buscar el registro de PersonEnvironmentalAspect por ID
        $personAspect = PersonEnvironmentalAspect::findOrFail($id);

        // Obtener el ID del FamilyPersonFootprint asociado
        $familyPersonFootprintId = $personAspect->family_person_footprint_id;

        // Eliminar todos los registros relacionados en PersonEnvironmentalAspect
        PersonEnvironmentalAspect::where('family_person_footprint_id', $familyPersonFootprintId)->delete();

        // Eliminar el registro específico en FamilyPersonFootprint
        FamilyPersonFootprint::where('id', $familyPersonFootprintId)->delete();

        // Puedes redirigir a la vista que necesites después de eliminar
        return redirect()->route('carbonfootprint.persona')->with('success', 'Registros eliminados correctamente');
    }
}
