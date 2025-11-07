<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\EnvironmentalAspectLabor;
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
        $validator = $request->validate([
            'aspecto.*.id' => 'required|exists:environmental_aspects,id',
            'aspecto.*.amount' => 'required|numeric',
            'activity_id' => 'required|exists:activities,id',
        ], [
            'aspecto.*.amount.required' => 'Por favor, complete todos los campos.',
            'aspecto.*.amount.numeric' => 'El campo debe ser un valor numérico.',
        ]);


        // Crear la labor y los aspectos ambientales asociados
        $labor = Labor::create([
            'person_id' => auth()->user()->person->id,
            'activity_id' => $request->input('activity_id'),
            'planning_date' => now(),
            'execution_date' => now(),
            'description' => 'Descripción de la labor',
            'status' => 'Realizado',
            'price' => 0,
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
        return redirect()->route('hdc.'.getRoleRouteName(Route::currentRouteName()).'.table')->with('success', 'Valores guardados correctamente');
    }



    public function table()
    {

        $datos = Labor::has('environmental_aspect_labors')->with('environmental_aspect_labors.environmental_aspect.measurement_unit')->with('activity.productive_unit')->get();


        return view('hdc::registration_form.resultform', compact('datos'));
    }




    public function delete($id)
    {

        // Intenta encontrar el registro
        try {
            // Encuentra el registro por su ID
            $labor = Labor::findOrFail($id);

            // Elimina el registro
            $labor->delete();
            return redirect()->back()->with('success', 'Eliminado satisfactoriamente');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return redirect()->back()->with('error', $message);
        }
    }


    public function edit(Labor $labor)
    {
        // Retornar la vista de edición con los datos
        return view('hdc::registration_form.editform', compact('labor'));
    }

    public function update(Request $request, Labor $labor)
    {
        $request->validate([
            'amounts.*' => 'numeric',
        ]);

        // Actualizar los valores de amounts en los aspectos ambientales
        foreach ($labor->environmental_aspect_labors as $key => $envasp) {
            $envasp->update(['amount' => $request->input('amounts.' . $key)]);
        }


        return redirect()->route('hdc.'.getRoleRouteName(Route::currentRouteName()).'.table', ['labor' => $labor])
            ->with('success', 'Datos actualizados correctamente');
    }


}
