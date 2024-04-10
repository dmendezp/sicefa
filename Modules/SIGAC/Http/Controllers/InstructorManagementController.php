<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SIGAC\Entities\Profession;
use Modules\SICA\Entities\Program;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InstructorManagementController extends Controller{
    public function profession_instructor_index(){
        $person_profession = DB::table('person_professions')->get();

        $prof = Profession::all();
        $proffesions = $prof->map(function ($p) {
            $id = $p->id;
            $name = $p->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::profession.Select_Profession')])->pluck('name', 'id');

        // Obtener tanto empleados como contratistas que sean de los tipos especificados
        $getInstructor = DB::table('employees')
                        ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
                        ->join('people', 'employees.person_id', '=', 'people.id')
                        ->where('state', 'Activo')
                        ->where('employee_types.name', 'Instructor')
                        ->select('people.id','people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                        ->union(
                            DB::table('contractors')
                            ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                            ->join('people', 'contractors.person_id', '=', 'people.id')
                            ->where('state', 'Activo')
                            ->where('employee_types.name', 'Instructor')
                            ->select('people.id','people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                        )->get();
        $instructors = $getInstructor->map(function ($i) {
            $id = $i->id;
            $name = $i->first_name . ' ' . $i->first_last_name . ' ' . $i->second_last_name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::profession.SelectAnInstructor')])->pluck('name', 'id');

        $view = [
            'titlePage'=> 'Instructor x Profesión', 
            'titleView'=> 'Instructor x Profesión', 
            'professions' => $proffesions, 
            'instructors' => $instructors,
            'person_profession' => $person_profession
        ];

        return view('sigac::human_talent.management_instructor.index', $view);
    }

    public function profession_instructor_store(Request $request){
        $rules = [
            'profession' => 'required',
            'instructor' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Realizar registro
        if (DB::table('person_professions')->insert(['profession_id' => $request->profession,'person_id' => $request->instructor])){
            return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor_index'))->with(['success'=> trans('sigac::profession.Successful_Aggregation')]);
        } else {
            return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor_index'))->with(['error'=> trans('sigac::profession.Error_Adding')]);
        }
    }

    public function profession_instructor_edit($id){
        $person_profession = DB::table('person_professions')->get();

        $searchPersonProfession = DB::table('person_professions')->where('id', $id)->get();
        

        $prof = Profession::all();
        $proffesions = $prof->map(function ($p) {
            $id = $p->id;
            $name = $p->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::profession.Select_Profession')])->pluck('name', 'id');

        // Obtener tanto empleados como contratistas que sean de los tipos especificados
        $getInstructor = DB::table('employees')
                        ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
                        ->join('people', 'employees.person_id', '=', 'people.id')
                        ->where('state', 'Activo')
                        ->where('employee_types.name', 'Instructor')
                        ->select('people.id','people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                        ->union(
                            DB::table('contractors')
                            ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                            ->join('people', 'contractors.person_id', '=', 'people.id')
                            ->where('state', 'Activo')
                            ->where('employee_types.name', 'Instructor')
                            ->select('people.id','people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                        )->get();
        $instructors = $getInstructor->map(function ($i) {
            $id = $i->id;
            $name = $i->first_name . ' ' . $i->first_last_name . ' ' . $i->second_last_name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un instructor'])->pluck('name', 'id');

        $view = [
            'titlePage'=> 'Instructor x Profesión', 
            'titleView'=> 'Instructor x Profesión', 
            'person_profession'=>$person_profession, 
            'persProf'=>$searchPersonProfession,
            'professions' => $proffesions, 
            'instructors' => $instructors,
        ];

        return view('sigac::human_talent.management_instructor.index', $view);
    }
    
    public function profession_instructor_update(Request $request, $id){
        $rules = [
            'profession' => 'required',
            'instructor' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        
        $affected = DB::table('person_professions')->where('id', $id)->update(['profession_id' => $request->profession, 'person_id' => $request->instructor]);

        // Realizar registro
        if ($affected){
            return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor_index'))->with(['success'=> trans('sigac::profession.Successful_Edition')]);
        } else {
            return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor_index'))->with(['error'=> trans('sigac::profession.Error_Editing')]);
        }
        return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor_index'))->with(['icon'=>$icon, 'message_line'=>$message]);
    }

    public function profession_instructor_destroy($id){
        $professionProgram = DB::table('person_professions')->where('id', $id)->delete();

        if($professionProgram){
            return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor_index'))->with(['success'=> trans('sigac::profession.Successful_Removal')]);
        }else{
            return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor_index'))->with(['error'=> trans('sigac::profession.Delete_Error')]);
        }
        return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor_index'))->with(['icon'=>$icon, 'message_line'=>$message]);
    }
}
