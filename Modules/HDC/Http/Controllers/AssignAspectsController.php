<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\EnvironmentalAspect;
use Modules\SICA\Entities\ProductiveUnit;

class AssignAspectsController extends Controller
{
    //Consulta la unidad productiva
    public function consul()
    {
        $productive_unit = ProductiveUnit::orderBy('name', 'ASC')->get();
        return view('hdc::AssignEnvironmentalAspect.ConsultEnvironmentalAspect', compact('productive_unit'));
    }
    //Ingresa al formulario
    public function addaspects()
    {
        $productive_unit = ProductiveUnit::orderBy('name', 'ASC')->get();

        return view('hdc::AssignEnvironmentalAspect.AddAspects', compact('productive_unit'));
    }
    //Trae las actividades que se ejecutan en esa unidad productiva
    public function AspectActivities()
    {
        $datap = json_decode(($_POST['data']));
        // Obtener las actividades relacionadas con la unidad productiva
        $activities = ProductiveUnit::findOrFail($datap->productive_unit_id)->activities;
        return view('hdc::AssignEnvironmentalAspect.Activity', compact('activities'));
    }

    //Trae los aspectos ambientales a la vista del formulario
    public function Aspect()
    {

        $data = json_decode($_POST['data']);
        $environmentalAspect = EnvironmentalAspect::get();

        return view('hdc::AssignEnvironmentalAspect.EnvironmentalAspects', compact('environmentalAspect','data'));
    }
    // Esta función trae la tabla con los aspectos ambientales de esa actividad
/*
    public function resulttable(Request $request)
{
    $productive_unit_id = $request->input('productive_unit_id');

    // Realiza una consulta para obtener las actividades asociadas a la unidad productiva seleccionada
    $activities = Activity::where('productive_unit_id', $productive_unit_id)->get();

    // Devuelve la vista con las actividades asociadas
    return view('hdc::AssignEnvironmentalAspect.TablaResultAspects', compact('activities'));
}
 */



    //Boton guardar
    public function guardarAspectos(Request $request, $actividad)
    {
        // Validación de datos
        $request->validate([
            'Environmental_Aspect' => 'required|array',
            'Environmental_Aspect.*' => 'exists:environmental_aspects,id',
        ]);

        // Obtener la actividad
        $actividad = Activity::find($actividad);

        // Adjuntar los aspectos ambientales seleccionados a la actividad
        $actividad->environmental_aspects()->syncWithoutDetaching($request->input('Environmental_Aspect'));


        // Resto de la lógica de guardado o redirección
        // ...

        return redirect()->route('cefa.hdc.guardar.aspectos')->with('success', 'Aspectos ambientales guardados correctamente');
    }
}
