<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\EnvironmentalAspectLabor;
use Modules\SICA\Entities\EnvironmentalAspect;
use Modules\SICA\Entities\Labor;


class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    /*  public function index()
    {
        return view('hdc::index');
    } */
    public function formulario()
    {
        $productive_unit = ProductiveUnit::orderBy('name', 'ASC')->get();
        return view('hdc::registration_form.formulario', compact('productive_unit'));
    }

    public function getActivities()
    {
        $datap = json_decode(($_POST['data']));
        // Obtener las actividades relacionadas con la unidad productiva
        $activities = ProductiveUnit::findOrFail($datap->productive_unit_id)->activities;
        return view('hdc::registration_form.activity', compact('activities'));
    }


    public function getAspects()
    {

        $data = json_decode($_POST['data']);
        $aspects = Activity::with('environmental_aspects.measurement_unit')->where('id', $data->activity_id)->get();
        $activity_id = $data->activity_id;
        return view('hdc::registration_form.tablaaspectosambientales', compact('aspects', 'activity_id'));
    }

    public function guardarValores(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'aspecto.*.amount' => 'required|numeric',
            'activity_id' => 'required|exists:activities,id',
        ]);



        $labor = Labor::create([
            'activity_id' => $request->input('activity_id'),
            'planning_date' => now(),
            'execution_date' => now(),
            'description' => 'Descripción de la labor',
            'status' => 'Realizado',
            'observations' => 'Observaciones de la labor',
            'destination' => 'Formacion',
        ]);




        foreach ($request->input('aspecto') as $aspectoData) {

            EnvironmentalAspectLabor::create([
                'environmental_aspect_id' => $aspectoData['id'],
                'labor_id' => $labor->id,
                'amount' => $aspectoData['amount'],
                'price' => 0,
            ]);
        }

        // Redirige al usuario o proporciona una respuesta de éxito
        return redirect()->route('admin.hdc.table')->with('success', 'Valores guardados correctamente');
    }

    public function table()
{
    $datos = EnvironmentalAspectLabor::with('environmental_aspect', 'labor')->get();
    $productive_units = ProductiveUnit::orderBy('name', 'ASC')->get();
    $activities = Activity::with('productive_unit')->get();

    $formattedData = [];

    foreach ($datos as $dato) {
        $unit = $dato->labor->activity->productive_unit;
        $activi = $dato->labor->activity;

        if (!isset($formattedData[$unit->id])) {
            $formattedData[$unit->id] = [
                'unit_name' => [
                    'name' => $unit->name,
                    'rowspan' => 0,
                ],
                'activities' => [],
            ];
        }

        $formattedData[$unit->id]['activities'][] = [
            'id' => $dato->id,
            'activity_name' => [
                'name' => $activi->name,
                'rowspan' => 0,
            ],
            'aspect_name' => $dato->environmental_aspect->name,
            'amount' => $dato->amount,
            'labor_planning' => $dato->labor->planning_date, // Agregamos el nombre de la labor
        ];
    }

    // Calcular el rowspan para la unidad productiva y las actividades
    foreach ($formattedData as &$unitData) {
        $unitData['unit_name']['rowspan'] = count($unitData['activities']);

        foreach ($unitData['activities'] as &$activityData) {
            $activityData['activity_name']['rowspan'] = $unitData['unit_name']['rowspan'];
        }
    }

    return view('hdc::registration_form.resultform', compact('formattedData'));
}


    public function delete($id)
    {
        try {
            // Realiza la eliminación real
            $ambient = EnvironmentalAspectLabor::findOrFail($id);
            $ambient->delete();

            return redirect()->back()->with('success', 'Eliminado satisfactoriamente');
        } catch (\Exception $e) {
            $message = $e->getMessage(); // Puedes personalizar este mensaje según tus necesidades

            return redirect()->back()->with('error', $message);
        }
    }

    public function edit($id)
    {

        return view('hdc::registration_form.editform', compact('aspects', 'ennnviroment_aspect','productive_unit','activities'));
    }
   // funcion de editar

   public function editForm($id)
{
    // Obtener los datos que se van a editar
    $data = EnvironmentalAspectLabor::findOrFail($id);
    $productive_units = ProductiveUnit::orderBy('name', 'ASC')->get();
    $activities = Activity::with('productive_unit')->get();

    return view('hdc::registration_form.editform', compact('data', 'productive_units', 'activities'));
}

public function update(Request $request, $id)
{
    // Validar los datos del formulario de edición
    $request->validate([
        // Agrega las reglas de validación necesarias para tus campos de actualización
    ]);

    // Obtener el registro que se va a actualizar
    $record = EnvironmentalAspectLabor::findOrFail($id);

    // Actualizar los campos según los datos enviados en el formulario
    $record->update([
        // Actualiza los campos correspondientes según tus necesidades
    ]);

    // Redirige al usuario o proporciona una respuesta de éxito
    return redirect()->route('cefa.hdc.table')->with('success', 'Registro actualizado correctamente');
}


}
