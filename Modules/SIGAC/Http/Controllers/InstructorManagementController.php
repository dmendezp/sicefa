<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Modules\SIGAC\Entities\Profession;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Competencie;
use Modules\SICA\Entities\LearningOutcome;
use Modules\SICA\Entities\LearningOutcomePerson;
use Illuminate\Support\Facades\DB;

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
            'titlePage'=> 'Instructor por Profesión', 
            'titleView'=> 'Instructor por Profesión', 
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

        $professions = Profession::where('id', $request->profession)->first();
        $existingRecord = DB::table('person_professions')
        ->where('person_id', $request->instructor)
        ->where('profession_id', $professions->id)
        ->exists();

        // Realizar registro
        if(!$existingRecord){
            if ($professions->people()->syncWithoutDetaching($request->instructor)){
                return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index'))->with(['success'=> trans('sigac::profession.Successful_Aggregation')]);
            } else {
                return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index'))->with(['error'=> trans('sigac::profession.Error_Adding')]);
            }
        }else{
            return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index'))->with(['error'=> trans('sigac::learning_out_come.RecordAlreadyExistsWithDataSent')]);
        }
    }

    public function profession_instructor_destroy($id){
        $professionProgram = DB::table('person_professions')->where('id', $id)->delete();

        if($professionProgram){
            return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index'))->with(['success'=> trans('sigac::profession.Successful_Removal')]);
        }else{
            return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index'))->with(['error'=> trans('sigac::profession.Delete_Error')]);
        }
    }

    public function learning_out_people_index()
    {
        $progr = Program::all();
        $programs = $progr->map(function ($p) {
            $id = $p->id;
            $name = $p->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::learning_out_come.SelectProgram')])->pluck('name', 'id');


        $view = [
            'titlePage' => trans('sigac::learning_out_come.AssignLearning'),
            'titleView' => trans('sigac::learning_out_come.AssignLearningOutcomesInstructors'),
            'programs' => $programs,
        ];

        return view('sigac::human_talent.assign_learning_outcomes.index', $view);
    }

    public function learning_out_people_table(Request $request)
{
    $competencie_id = $request->input('selectedCompetencie');
    
    $learning_outcome_people = LearningOutcomePerson::with('learning_outcome.competencie','person')
        ->whereHas('learning_outcome.competencie', function ($query) use ($competencie_id) {
            $query->where('id', $competencie_id);
        })->get();

    $view = [
        'learning_outcome_people' => $learning_outcome_people,
    ];

    return view('sigac::human_talent.assign_learning_outcomes.table', $view);
}


    public function learning_out_people_search_competencie($id)
    {
        $comp = Competencie::where('program_id', $id)->get();
        $competencies = $comp->map(function ($c) {
            $id = $c->id;
            $name = $c->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        });

        return response()->json(['competencies' => $competencies]);
    }

    public function learning_out_people_search_learning_outcome($id)
    {
        $lear = LearningOutCome::where('competencie_id', $id)->get();
        $learning_outcomes = $lear->map(function ($l) {
            $id = $l->id;
            $name = $l->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        });

        return response()->json(['learning_outcomes' => $learning_outcomes]);
    }

    public function learning_out_people_search_instructor($id)
    {
        $learningOutCome = LearningOutCome::with('competencie.professions')->where('id', $id)->get();
        $professions = [];

        foreach ($learningOutCome as $l) {
            foreach ($l->competencie->professions as $p) {
                $profession = $p->id;
                $professions[] = $profession;
            }
        }

        $people = Profession::with('people')->whereIn('id', $professions)->get();
        $person = [];

        foreach ($people as $p) {
            foreach ($p->people as $pp) {
                $person_id = $pp->id;
                $person[] = $person_id;
            }
        }

        // Obtener tanto empleados como contratistas que sean de los tipos especificados
        $getInstructor = DB::table('employees')
            ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
            ->join('people', 'employees.person_id', '=', 'people.id')
            ->where('state', 'Activo')
            ->where('employee_types.name', 'Instructor')
            ->whereIn('person_id', $person)
            ->select('people.id', 'people.first_name', 'people.first_last_name', 'people.second_last_name')
            ->union(
                DB::table('contractors')
                    ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                    ->join('people', 'contractors.person_id', '=', 'people.id')
                    ->where('state', 'Activo')
                    ->where('employee_types.name', 'Instructor')
                    ->whereIn('person_id', $person)
                    ->select('people.id', 'people.first_name', 'people.first_last_name', 'people.second_last_name')
            )->get();

        $instructors = $getInstructor->map(function ($i) {
            $id = $i->id;
            $name = $i->first_name . ' ' . $i->first_last_name . ' ' . $i->second_last_name;

            return [
                'id' => $id,
                'name' => $name
            ];
        });

        return response()->json(['instructors' => $instructors]);
    }

    public function learning_out_people_store(Request $request)
{
    $rules = [
        'instructor' => 'required',
        'learningOutCome' => 'required',
        'priority' => 'required'
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $learning_outcome = LearningOutCome::where('id', $request->learningOutCome)->first();

    $existingRecord = DB::table('learning_outcome_people')
        ->where('person_id', $request->instructor)
        ->where('learning_outcome_id', $learning_outcome->id)
        ->where('priority', $request->priority)
        ->exists();

    if (!$existingRecord) {
        $learning_outcome_people = new LearningOutcomePerson;
        $learning_outcome_people->learning_outcome_id = $learning_outcome->id; 
        $learning_outcome_people->person_id = $request->instructor; 
        $learning_outcome_people->priority = $request->priority; 
        if ($learning_outcome_people->save()) {
            return response()->json(['success' => trans('sigac::profession.Successful_Aggregation')], 200);
        } else {
            return response()->json(['error' => trans('sigac::profession.Error_Adding')], 500);
        }
    } else {
        return response()->json(['error' => trans('sigac::learning_out_come.RecordAlreadyExistsWithDataSent')], 409);
    }
}

    public function learning_out_people_destroy($learning_outcome_person_id)
{
    $learning_outcome_people = DB::table('learning_outcome_people')->where('id', $learning_outcome_person_id)->delete();
    
    return redirect()->route('sigac.academic_coordination.human_talent.assign_learning_outcomes.index')
    ->with(['success' => trans('sigac::profession.Successful_Removal')]);
}

}
