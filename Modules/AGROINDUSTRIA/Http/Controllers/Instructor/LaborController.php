<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\instructor;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Responsibility;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\AGROINDUSTRIA\Entities\Formulation;
use Modules\AGROINDUSTRIA\Entities\Executor;
use Modules\AGROINDUSTRIA\Entities\EmployementType;
use Modules\AGROINDUSTRIA\Entities\Tool;

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
        })->prepend(['id' => null, 'name' => trans('agroindustria::labors.selectActivity')])->pluck('name', 'id');

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
        })->prepend(['id' => null, 'name' => trans('agroindustria::labors.selectRecipe')])->pluck('name', 'id');

        $employee = EmployementType::get();
        $nameEmployee = $employee->map(function ($e){
            $id = $e->id;
            $name = $e->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('agroindustria::labors.selectEmployeeType')])->pluck('name', 'id');

        $productive_unit_warehouse = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('id');
        $elements = Element::where('category_id', 2)->pluck('id');

        $tools = Inventory::where('productive_unit_warehouse_id', $productive_unit_warehouse)->whereIn('element_id', $elements)->get();
        $tool = $tools->map(function ($t) {
            $id = $t->id;
            $name = $t->element->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una herramienta'])->pluck('name', 'id');

        $data = [
            'title' => $title,
            'activity' => $activity,
            'recipe' => $recipe,
            'destination' => $destination,
            'employee' => $nameEmployee,
            'tool' => $tool
        ];
        return view('agroindustria::instructor.labors.form', $data);
    }

    public function responsibilites ($activityId){

        $responsabilities = Responsibility::where('activity_id', $activityId)->pluck('role_id');
        
        $roles = Role::with('users')->where('id', $responsabilities)->get();
        
        $id = $roles->flatMap(function ($r){
            return $r->users->map(function ($u){
                return [
                    'personId' => $u->person_id,
                ];
            });
        });
        
        $people = Person::where('id', $id)->get();
        $person = $people->map(function ($p){
            $personId = $p->id;
            $personName = $p->first_name . ' ' . $p->first_last_name . ' ' . $p->second_last_name;

            return [
                'id' => $personId,
                'name' => $personName
            ];
        });

        return response()->json(['id' => $person]);
    }

    public function price_employement($id){
        $price = EmployementType::where('id', $id)->value('price');

        return response()->json(['price' => $price]);
    }

    public function price_tools($id){
        $price = Inventory::where('id', $id)->value('price');

        return response()->json(['price' => $price]);
    }

    public function executors($document_number){
        $people = Person::where('document_number', $document_number)->get();
        $person = $people->map(function ($p){
            $personId = $p->id;
            $personName = $p->first_name . ' ' . $p->first_last_name . ' ' . $p->second_last_name;
            
            return [
                'id' => $personId,
                'name' => $personName
            ];
        });
        return response()->json(['id' => $person]);
    }

    public function register_labor(Request $request){
        $rules = [
            'activities' => 'required',
            'person' => 'required',
            'date_execution' => 'required',
            'description' => 'required',
            'destination' => 'required',
            'observations' => 'required',
            'employement_type' => 'required',
            'hours' => 'required',
        ];
        $messages = [
            'activities.required' => trans('agroindustria::labors.youMustSelectActivity'),
            'person.required' => trans('agroindustria::labors.youMustSelectResponsible'),
            'date_execution.required' => trans('agroindustria::labors.youMustEnterDate'),
            'description.required' => trans('agroindustria::labors.youMustEnterDescription'),
            'destination.required' => trans('agroindustria::labors.youMustSelectDestination'),
            'observations.required' => trans('agroindustria::labors.youMustEnterRemark'),
            'employement_type.required' => trans('agroindustria::labors.youMustSelectEmployeeType'),
            'hours.required' => trans('agroindustria::labors.youMustEnterNumberHoursWorked'),
        ];
        $validatedData = $request->validate($rules, $messages);
    
        
        $l = new Labor;
        $l->activity_id = $validatedData['activities'];
        $l->person_id = $validatedData['person'];
        $l->planning_date = $request->input('date_plannig');
        $l->execution_date = $validatedData['date_execution'];
        $l->description = $validatedData['description'];
        $l->status = 'Programado';
        $l->observations = $validatedData['observations'];
        $l->destination =  $validatedData['destination'];
        $l->save();

        $executors = $request->input('executors_id');
        $employement_type = $validatedData['employement_type'];
        $hours = $validatedData['hours'];
        $price = $request->input('price');


        foreach ($executors as $key => $executor){   
            $e = new Executor;
            $e->labor_id = $l->id;
            $e->person_id = $executor;
            $e->employement_type_id = $employement_type[$key];
            $e->amount = $hours[$key];
            $e->price = $price[$key];
            $e->save();
        }

        $tools = $request->input('tools');
        $amount_tools = $request->input('amount_tools');
        $price_tools = $request->input('price_tools');

        foreach ($tools as $key => $tool){   
            $t = new Tool;
            $t->labor_id = $l->id;
            $t->inventory_id = $tool;
            $t->amount = $amount_tools[$key];
            $t->price = $price_tools[$key];
            $t->save();
        }

        if($t->save()){
            $icon = 'success';
                $message_line = trans('agroindustria::labors.laborSavedCorrectly');
         }else{
            $icon = 'error';
            $message_line = trans('agroindustria::labors.errorWhenSavingWork');
         }
         return redirect()->route('cefa.agroindustria.units.instructor.labor')->with([
             'icon' => $icon,
             'message_line' => $message_line,
         ]); 
    }
    
    public function cancelLabor($id){
        $labor = Labor::findOrFail($id);
        $labor->status = 'Cancelado';
        $labor->save();

        // Puedes agregar cualquier lógica adicional que necesites aquí

        return redirect()->back()->with([
            'icon' => 'success',
            'message_line' => trans('agroindustria::labors.laborCorrectlyCancelled'),
        ]);
    }
    public function approbedLabor($id){
        $labor = Labor::findOrFail($id);
        $labor->status = 'Realizado';
        $labor->save();
    
        // Puedes agregar cualquier lógica adicional que necesites aquí
    
        return redirect()->back()->with([
            'icon' => 'success',
            'message_line' => trans('agroindustria::labors.workPerformedCorrectly'),
        ]);
    }
}
