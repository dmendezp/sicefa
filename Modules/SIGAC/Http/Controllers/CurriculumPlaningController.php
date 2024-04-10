<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Program;
use Modules\SIGAC\Entities\Profession;
use Modules\SICA\Entities\LearningOutCome;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CurriculumPlaningController extends Controller{
    public function profession_program_index(){
        $professionPrograms = DB::table('profession_program')->get();

        $prof = Profession::all();
        $proffesions = $prof->map(function ($p) {
            $id = $p->id;
            $name = $p->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::profession.Select_Profession')])->pluck('name', 'id');

        $prog = Program::all();
        $programs = $prog->map(function ($p) {
            $id = $p->id;
            $name = $p->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::profession.Select_Program')])->pluck('name', 'id');

        $view = [
            'titlePage'=> trans('sigac::profession.Instructor_Management'), 
            'titleView'=> trans('sigac::profession.Instructor_Management'), 
            'professions' => $proffesions, 
            'programs' => $programs,
            'professionPrograms' => $professionPrograms
        ];

        return view('sigac::curriculum_planing.proffession_program.index', $view);
    }

    public function profession_program_store(Request $request){
        $rules = [
            'profession' => 'required',
            'program' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Realizar registro
        if (DB::table('profession_program')->insert(['profession_id' => $request->profession,'program_id' => $request->program])){
            return redirect(route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.profession_program_index'))->with(['success'=> trans('sigac::profession.Successful_Aggregation')]);
        } else {
            return redirect(route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.profession_program_index'))->with(['error'=> trans('sigac::profession.Error_Adding')]);
        }
    }

    public function profession_program_edit($profProg){
        $professionPrograms = DB::table('profession_program')->get();

        $searchProfessionProgram = DB::table('profession_program')->where('id', $profProg)->get();
        
        $prof = Profession::all();
        $proffesions = $prof->map(function ($p) {
            $id = $p->id;
            $name = $p->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::profession.Select_Profession')])->pluck('name', 'id');

        $prog = Program::all();
        $programs = $prog->map(function ($p) {
            $id = $p->id;
            $name = $p->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::profession.Select_Program')])->pluck('name', 'id');
        $view = [
            'titlePage'=> trans('sigac::profession.Instructor_Management'), 
            'titleView'=> trans('sigac::profession.Instructor_Management'),  
            'professionPrograms'=>$professionPrograms, 
            'profProg'=>$searchProfessionProgram,
            'professions' => $proffesions, 
            'programs' => $programs,
        ];

        return view('sigac::curriculum_planing.proffession_program.index', $view);
    }
    
    public function profession_program_update(Request $request, $profProg){
        $rules = [
            'profession' => 'required',
            'program' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        
        $affected = DB::table('profession_program')->where('id', $profProg)->update(['profession_id' => $request->profession, 'program_id' => $request->program]);

        // Realizar registro
        if ($affected){
            return redirect(route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.profession_program_index'))->with(['success'=> trans('sigac::profession.Successful_Edition')]);
        } else {
            return redirect(route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.profession_program_index'))->with(['error'=> trans('sigac::profession.Error_Editing')]);
        }
    }

    public function profession_program_destroy($id){
        $professionProgram = DB::table('profession_program')->where('id', $id)->delete();

        if($professionProgram){
            return redirect(route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.profession_program_index'))->with(['success'=> trans('sigac::profession.Successful_Removal')]);
        }else{
            return redirect(route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.profession_program_index'))->with(['error'=> trans('sigac::profession.Delete_Error')]);
        }
    }

    public function learning_out_people_index(){
        $learningOutcomePeople = DB::table('learning_outcome_people')->get();

        $learningOutCome = LearningOutCome::all();
        $learningOutComes = $learningOutCome->map(function ($l) {
            $id = $l->id;
            $name = $l->name . ' - ' . $l->competencie->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::learning_out_come.SelectLearningOutcome')])->pluck('name', 'id');

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
        })->prepend(['id' => null, 'name' => trans('sigac::learning_out_come.SelectInstructor')])->pluck('name', 'id');

        $view = [
            'titlePage'=> trans('sigac::learning_out_come.AssignLearning'), 
            'titleView'=> trans('sigac::learning_out_come.AssignLearningOutcomesInstructors'), 
            'learningOutComes' => $learningOutComes, 
            'instructors' => $instructors,
            'learningOutcomePeople' => $learningOutcomePeople
        ];

        return view('sigac::curriculum_planing.assign_learning_outcomes.index', $view);
    }
   
    public function learning_out_people_store(Request $request){
        $rules = [
            'instructor' => 'required',
            'learningOutCome' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Realizar registro
        if (DB::table('learning_outcome_people')->insert(['person_id' => $request->instructor, 'learning_outcome_id' => $request->learningOutCome])){
            return redirect(route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.learning_out_people_index'))->with(['success'=> trans('sigac::profession.Successful_Aggregation')]);
        } else {
            return redirect(route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.learning_out_people_index'))->with(['error'=> trans('sigac::profession.Error_Adding')]);
        }
    }


    public function learning_out_people_edit($id){
        $learningOutcomePeople = DB::table('learning_outcome_people')->get();

        $searchAssign = DB::table('learning_outcome_people')->where('id', $id)->get();
        
        $learningOutCome = LearningOutCome::all();
        $learningOutComes = $learningOutCome->map(function ($l) {
            $id = $l->id;
            $name = $l->name . ' - ' . $l->competencie->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::learning_out_come.SelectLearningOutcome')])->pluck('name', 'id');

        // Nombres de los tipos de empleados

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
        })->prepend(['id' => null, 'name' => trans('sigac::learning_out_come.SelectInstructor')])->pluck('name', 'id');

        $view = [
            'titlePage'=> trans('sigac::learning_out_come.AssignLearning'), 
            'titleView'=> trans('sigac::learning_out_come.AssignLearningOutcomesInstructors'), 
            'learningOutComes' => $learningOutComes, 
            'instructors' => $instructors,
            'learningOutcomePeople' => $learningOutcomePeople,     
            'assign'=> $searchAssign
        ];

        return view('sigac::curriculum_planing.assign_learning_outcomes.index', $view);
    }

    public function learning_out_people_update(Request $request, $id){
        $rules = [
            'instructor' => 'required',
            'learningOutCome' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        
        $affected = DB::table('learning_outcome_people')->where('id', $id)->update(['person_id' => $request->instructor, 'learning_outcome_id' => $request->learningOutCome]);
        // Realizar registro
        if ($affected){
            return redirect(route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.learning_out_people_index'))->with(['success'=> trans('sigac::profession.Successful_Edition')]);
        } else {
            return redirect(route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.learning_out_people_index'))->with(['error'=> trans('sigac::profession.Error_Editing')]);
        }
    }

    public function learning_out_people_destroy($id){
        $professionProgram = DB::table('learning_outcome_people')->where('id', $id)->delete();

        if($professionProgram){
            return redirect(route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.learning_out_people_index'))->with(['success'=> trans('sigac::profession.Successful_Removal')]);

        }else{
            return redirect(route('sigac.academic_coordination.curriculum_planing.assign_learning_outcomes.learning_out_people_index'))->with(['error'=> trans('sigac::profession.Delete_Error')]);
        }
    }
}
