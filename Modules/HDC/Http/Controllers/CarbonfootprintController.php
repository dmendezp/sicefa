<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Modules\HDC\Entities\FamilyPersonFootprint;
use Modules\HDC\Entities\PersonEnvironmentalAspect;
use Modules\SICA\Entities\EnvironmentalAspect;
use Modules\SICA\Entities\Person;
use Illuminate\Support\Facades\Validator;

class CarbonfootprintController extends Controller
{
    public function persona()
    {
        // Verifica si el usuario está autenticado y tiene una relación 'person'
        if (auth()->check() && auth()->user()->person) {
            // Obtén el ID de la persona del usuario autenticado
            $personaid = auth()->user()->person->id;

            // Continúa con la obtención de datos y la carga de la vista
            $environmeaspect = FamilyPersonFootprint::with('personenvironmentalaspects.environmental_aspect')
                ->select('id', 'carbon_print', 'created_at', 'mes', 'anio')
                ->where('person_id', $personaid)
                ->orderBy('mes', 'desc')
                ->orderBy('anio', 'desc')
                ->get();

            $environmeaspectgraph = FamilyPersonFootprint::with('personenvironmentalaspects.environmental_aspect')
                ->select('id', 'carbon_print', 'created_at', 'mes', 'anio')
                ->where('person_id', $personaid)
                ->orderBy('mes', 'asc')
                ->orderBy('anio', 'desc')
                ->take(12)
                ->get();

            // Retorna una vista con los datos de la persona si se encuentra
            return view('hdc::Calc_Huella.table', ['environmeaspect' => $environmeaspect, 'environmeaspectgraph'=>$environmeaspectgraph]);
        }


        // Si no se cumple la condición, redirige a la vista deseada
        return redirect()->route('cefa.hdc.index');

    }


    public function formcalculates(Person $person)
    {
        $environmentalAspects = EnvironmentalAspect::where('personal', 1)
            ->pluck('name', 'id');



        return view('hdc::Calc_Huella.formcalculatefootprint')->with('environmentalAspects', $environmentalAspects)->with('person', $person);
    }

    public function saveConsumption(Request $request)
{
    $data = $request->validate([
        'aspecto.*.id_aspecto' => 'required|numeric',
        'aspecto.*.valor_consumo' => 'required|numeric',
        'mes' => 'required',
        'anio' => 'required|numeric',
    ]);

    $personId = $request->input('person_id');
    $person = Person::findOrFail($personId);

    // Convertir el nombre del mes a número
    $mes = $data['mes'];

    // Verificar si ya existe una entrada con el mismo mes y año
    $existingEntry = FamilyPersonFootprint::where('mes', $mes)
        ->where('anio', $data['anio'])
        ->where('person_id', $person->id)
        ->first();

    if ($existingEntry) {
        // Aquí puedes manejar el caso en el que ya existe una entrada
        // Puedes redirigir con un mensaje de error o hacer lo que necesites
        return redirect()->back()->with('error', 'Ya existe una entrada para este mes y año.');
    }

    // Si no hay una entrada existente, procede a guardar el modelo FamilyPersonFootprint
    $personFootprint = new FamilyPersonFootprint([
        'carbon_print' => 0,
        'mes' => $mes,
        'anio' => $data['anio'],
    ]);

    // Asignar el person_id
    $personFootprint->person_id = $person->id;

    // Guardar el modelo FamilyPersonFootprint
    $personFootprint->save();

    // Resto del código...
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

    return redirect()->route('cefa.hdc.carbonfootprint.persona');
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


        // Buscar el registro de FamilyPersonFootprint por ID
        $fpf = FamilyPersonFootprint::findOrFail($id);

        // Actualizar los valores de mes y año
        $fpf->mes = $request->mes;
        $fpf->anio = $request->anio;
        $fpf->save();

        // Actualizar los valores de consumo en la tabla intermedia
        foreach ($request->aspecto as $peaId => $data) {
            foreach ($data['valor_consumo'] as $key => $value) {
                $fpf->personenvironmentalaspects()
                    ->where('id', $peaId)
                    ->update(['consumption_value' => $value]);
            }
        }

        // Redirigir a la vista de edición con un mensaje de éxito
        return redirect()->route('cefa.hdc.carbonfootprint.persona', ['id' => $fpf->id])
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
        return redirect()->route('cefa.hdc.carbonfootprint.persona')->with('success', 'Registros eliminados correctamente');
    }



}
