<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\instructor;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use App\Models\User;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Course;
use Illuminate\Support\Facades\Auth;
use Modules\AGROINDUSTRIA\Entities\RequestExternal;
use Modules\AGROINDUSTRIA\Entities\Supply;

use Validator, Str;

class RequestController extends Controller
{

    public function table(){
        $title = 'Solicitudes';

        $user = Auth::user();
        $id = $user->person->id;

        $requests = RequestExternal::with(['person', 'receive', 'course.program'])->where('receiver', $id)->get();
        $data = [
            'title' => $title,
            'requests' => $requests
        ];

        return view('agroindustria::instructor.request.table', $data);
    }

    public function solicitud(){
        $title = 'Solicitud a Centro';
        //Verifica el usuario logueado
        $user = Auth::user();
        if ($user->person) {
            $nombrePersona = $user->person->first_name . ' ' . $user->person->first_last_name . ' ' . $user->person->second_last_name;
            $cedula = $user->person->document_number;
        } else {
            $nombrePersona = null;
            $cedula = null;
        }
        //Consulta para traer la persona que tenga el rol de Coordinador Academico
        $coordinator = Role::with('users.person')->where('id', 2)->get();
        $coordinatorOptions = $coordinator->map(function ($role) {
            $personId = $role->users->first()->person->id;
            $personName = $role->users->first()->person->first_name . ' ' . $role->users->first()->person->first_last_name . ' ' . $role->users->first()->person->second_last_name;
            return [
                'id' => $personId,
                'name' => $personName,
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un coordinador'])->pluck('name', 'id');
        //Se trae los cursos con nombre del programa y ficha del curso y el id
        $programCourses = Course::select('courses.id', 'courses.code', 'programs.name as program_name')
            ->join('programs', 'courses.program_id', '=', 'programs.id')
            ->where('programs.network_id', 7)
            ->where('courses.status', 'Activo')
            ->get();
        $programCourses->transform(function ($course) {
            return [
                'text' => $course->code . ' - ' . $course->program_name,
                'value' => $course->id,
            ];
        });
       
        $pwarehouse = ProductiveUnitWarehouse::where('warehouse_id', 2)->pluck('id');
        $elementsInventory = Inventory::with('element.measurement_unit')->whereIn('productive_unit_warehouse_id', $pwarehouse)->get();
        $element = $elementsInventory->map(function ($inventory){
            $elementId = $inventory->element->id;
            $elementName = $inventory->element->name;
            $unitName = $inventory->element->measurement_unit->name;
            $elementWithUnit = $elementName . ' (' . $unitName . ')';
            return [
                'id' => $elementId,
                'name' => $elementWithUnit
            ];
        })->prepend(['id' => null, 'name' => trans('agroindustria::menu.Select a product')])->pluck('name', 'id');

        $data = [
            'title' => $title,
            'name' => $nombrePersona,
            'cedula' => $cedula,
            'courses' => $programCourses,
            'coordinatorOptions' => $coordinatorOptions,
            'element' => $element,
        ];

        return view('agroindustria::instructor.request.form', $data);
    }
     
    public function document_coordinator($coordinatorId){
         $cedula = User::select('people.document_number')
         ->join('people', 'users.person_id', '=', 'people.id')
         ->where('users.person_id', $coordinatorId)->first();
 
         return response()->json(['cedula' => $cedula]);
    }

    public function amount($id){
        $inventory = Inventory::where('element_id', $id)->get();
        return response()->json(['inventory' => $inventory]);
    }
 
    public function create(Request $request){  
        $idPersona = null;
        $user = Auth::user();
        if ($user->person) {
            $idPersona = $user->person->id;
        }
         $rules = [
            'coordinator' => 'required',
            'course_id' => 'required',
            'code_sena' => 'required',
            'product_name' => 'required',
            'amount' => 'required',
        ];
         $messages = [
            'coordinator.required' => trans('agroindustria::menu.You must select a coordinator'),
            'course_id.required' => trans('agroindustria::menu.You must select a course'),
            'code_sena.required' => trans('agroindustria::menu.You must enter a SENA code'),
            'product_name.required' => trans('agroindustria::menu.You must select a product'),
            'amount.required' => trans('agroindustria::menu.You must enter an amount'),
        ];

        $validatedData = $request->validate($rules, $messages);
        $r = new RequestExternal;
        $r->date = $request->input('date');
        $r->coordinator = $validatedData['coordinator'];
        $r->receiver = $idPersona;
        $r->course_id = e($validatedData['course_id']);
        $r->status = 'Pendiente';
        $r->save();
         // Obtener los datos de productos del formulario
        $productNames = $request->input('product_name');
        $codeSena = $request->input('code_sena');
        $amounts = $request->input('amount');
        $observations = $request->input('observations');
         // Recorrer los datos de productos y guardarlos en Supply
        foreach ($productNames as $key => $productName) {
            $supply = new Supply;
            $supply->element_id = $productName;
            $supply->request_external_id = $r->id; // Asociar con el RequestExternal
            $supply->sena_code = $codeSena[$key];
            $supply->amount = $amounts[$key];
            $supply->observation = $observations[$key];
            $supply->save();
        }
        if($supply->save()){
           $icon = 'success';
            $message_line = trans('agroindustria::menu.Request Registered Successfully');
        }else{
           $icon = 'error';
           $message_line = trans('agroindustria::menu.Error registering the request');
        }
        return redirect()->route('cefa.agroindustria.units.instructor.solicitud')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]); 
    }

    public function cancel($id){
        $r = RequestExternal::find($id);
        if ($r) {
            $r->status = 'Cancelado';
            $r->save();
        }
        if($r->save()){
            $icon = 'success';
            $message_line = trans('agroindustria::request.applicationCancelled');
        }else{
            $icon = 'error';
            $message_line = trans('agroindustria::request.iCannotCancelRequest');
        }

        return redirect()->route('cefa.agroindustria.units.instructor.requests')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]);
    }
}