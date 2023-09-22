<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\instructor;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Labor;
use Modules\AGROINDUSTRIA\Entities\Formulation;

class LaborController extends Controller
{

    public function index()
    {
        $title = 'Labor';
        $selectedUnit = session('viewing_unit');
        $unitName = ProductiveUnit::findOrFail($selectedUnit);
        $activities = Activity::where('productive_unit_id', $selectedUnit)->pluck('id');

        $labors = Labor::whereIn('activity_id', $activities)->get();

        $data = [
            'title' => $title,
            'labors' => $labors
        ];
        
        return view('agroindustria::instructor.labors.table', $data);
    }

    public function form(){
        $title = 'Registrar Labor';
        $selectedUnit = session('viewing_unit');
        $unitName = ProductiveUnit::findOrFail($selectedUnit);

        $activities = Activity::where('productive_unit_id', $selectedUnit)->get();

        $activity = $activities->map(function ($a){
            $id = $a->id;
            $name = $a->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una actividad'])->pluck('name', 'id');

        $destination = [
            'Formación' => 'Formación',
            'Producción' => 'Producción'
        ];

        $formulations = Formulation::where('productive_unit_id', $selectedUnit)->get();
        $recipe = $formulations->map(function ($f){
            $id = $f->id;
            $name = $f->element->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una receta'])->pluck('name', 'id');
        $data = [
            'title' => $title,
            'activity' => $activity,
            'recipe' => $recipe,
            'destination' => $destination
        ];
        return view('agroindustria::instructor.labors.form', $data);
    }

    public function register_labor(Request $request){
        $rules = [
            'activities' => 'required',
            'date_execution' => 'required',
            'description' => 'required',
            'destination' => 'required',
            'observations' => 'required'
        ];
        $messages = [
            'activities.required' => 'Debe seleccionar una actividad',
            'date_execution.required' => 'Debe ingresar una fecha',
            'description.required' => 'Debe ingresar una descripción',
            'destination.required' => 'Debe seleccionar un destino',
            'observations.required' => 'Debe ingresar una obsevación'
        ];
        $validatedData = $request->validate($rules, $messages);
    
        
        $l = new Labor;
        $l->activity_id = $validatedData['activities'];
        $l->planning_date = $request->input('date_plannig');
        $l->execution_date = $validatedData['date_execution'];
        $l->description = $validatedData['description'];
        $l->status = 'Programado';
        $l->observations = $validatedData['observations'];
        $l->destination =  $validatedData['destination'];
        $l->save();

        if($l->save()){
            $icon = 'success';
                $message_line = 'Labor guardada correctamente';
         }else{
            $icon = 'error';
            $message_line = 'Error al guardar la labor';
         }
         return redirect()->route('cefa.agroindustria.units.instructor.labor')->with([
             'icon' => $icon,
             'message_line' => $message_line,
         ]); 
    }
}
