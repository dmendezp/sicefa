<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\LearningOutcome;
use Modules\SICA\Entities\Competencie;
use Modules\SICA\Entities\Course;
use Modules\SIGAC\Entities\TrainingProject;
use Modules\SIGAC\Entities\Quarterly;
use Modules\SICA\Entities\Program;
use Modules\SIGAC\Entities\Profession;
use Illuminate\Support\Facades\DB;

class CurriculumPlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

     // Proyecto formativo
    public function training_project_index()
    {
        $learning_outcomes = LearningOutcome::pluck('name','id');
        $coursesWithTrainingProjects =  Course::has('training_projects')->get();
        $coursesWithTrainingProjects =  Course::has('training_projects')->get();
        return view('sigac::curriculum_planning.training_project.index')->with(['titlePage'=>trans('Proyecto Formativo'), 
        'titleView'=>trans('Proyecto Formativo'), 
        'learning_outcomes' => $learning_outcomes, 
        'coursesWithTrainingProjects' => $coursesWithTrainingProjects]);
    }

    public function training_project_quarterlie_index($training_project_id ,$course_id )
    {
        $quarterlies = Quarterly::with('training_project.courses.program', 'learning_outcome.competencie','learning_outcome.people.professions')
        ->where('training_project_id', $training_project_id)
        ->whereHas('training_project.courses', function ($query) use ($course_id) {
            $query->where('courses.id', $course_id);
        })
        ->get()
        ->groupBy(function ($quarterly) {
            return $quarterly->learning_outcome->competencie->name . '-' . $quarterly->quarter_number; // Agrupar por competencia y trimestre
        });


        
        
        $trainingProject = TrainingProject::findOrFail($training_project_id);
        $trainingProjectName = $trainingProject->name;
        $trainingProjectId = $trainingProject->id;

        $course = Course::findOrFail($course_id);
        $courseNumber = $course->program->quarter_number; 
        $programId = $course->program->id;

        $learning_outcomes_select = LearningOutcome::whereHas('competencie.program', function ($query) use ($programId) {
            $query->where('id', $programId);
        })->pluck('name','id');

        return view('sigac::curriculum_planning.quarterlie.index')->with([
            'titlePage' => trans('Trimestralización'),
            'titleView' => trans('Trimestralización'),
            'quarterlies' => $quarterlies,
            'trainingProjectName' => $trainingProjectName,
            'courseNumber' => $courseNumber,
            'trainingProjectId' => $trainingProjectId,
            'programId' => $programId,
            'learning_outcomes_select' => $learning_outcomes_select
        ]);
    }
    // Registrar proyecto formativo
    public function training_project_store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'execution_time' => 'required|numeric',
            'objective' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $training_project =  new TrainingProject;
        $training_project->name = $request->name;
        $training_project->execution_time = $request->execution_time;
        $training_project->objective = $request->objective;
        $training_project->save();

        return back()->with('success', "Proyecto formativo registrado exitosamente");
    }

    // Actualizar proyecto formativo
    public function training_project_update(Request $request)
    {
        $training_project = TrainingProject::find($request->input('id'));
        $training_project->name = e($request->input('name'));
        $training_project->execution_time = e($request->input('execution_time'));
        $training_project->total_result = e($request->input('total_result'));
        $training_project->objective = e($request->input('objective'));
        if($training_project->save()){
            return redirect()->back()->with(['success'=>'Proyecto formativo actualizado exitosamente']);
        }else{
            return redirect()->back()->with(['error'=>'Error al actualizar el proyecto formativo']);
        }
        return redirect()->back()->with(['error'=>'Ocurrio algun error']);
    }

    // Eliminar proyecto formativo
    public function training_project_destroy($id)
    {
        // Obtener la actividad por su ID
        $training_project = TrainingProject::findOrFail($id);

        // Realizar la eliminación
        $training_project->delete();

        return redirect()->back()->with('success', 'Proyecto formativo eliminado exitosamente');
    }


    public function quarterlie_index()
    {
        $learning_outcomes_select = LearningOutcome::pluck('name','id');
        $quarterlies = Quarterly::with('training_project.courses.program', 'learning_outcome.competencie')
                        ->get()
                        ->groupBy(function ($quarterly) {
                            return $quarterly->training_project->pluck('name')->implode('_');
                        })
                        ->map(function ($courseQuarterlies) {
                            return $courseQuarterlies->groupBy(function ($quarterly) {
                                return $quarterly->learning_outcome->competencie->name;
                            });
                        });

        return view('sigac::curriculum_planning.quarterlie.index')->with([
            'titlePage' => trans('Trimestralización'),
            'titleView' => trans('Trimestralización'),
            'quarterlies' => $quarterlies,
            'learning_outcomes_select' => $learning_outcomes_select
        ]);
    }

    public function quarterlie_filterlearnin_outcome(Request $request)
    {
        $learning_outcome_id = $request->input('learning_outcome_id');

        $quartely = Quarterly::where('learning_outcome_id', $learning_outcome_id)->first();

        if ($quartely) {
            return false;
        }

        return true;
    }

    public function quarterlie_store(Request $request)
    {
        $rules = [
            'quarter_number' => 'required|numeric',
            'training_project_id' => 'required',
            'learning_outcome_id' => 'required|array', 
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $learning_outcome_Ids = $request->input('learning_outcome_id');
        foreach ($learning_outcome_Ids as $index => $learning_outcome_id) {
            
            $quarterly = new Quarterly([
                'quarter_number' => $request->quarter_number,
                'training_project_id' => $request->training_project_id,
                'learning_outcome_id' => $learning_outcome_id, 
            ]);
            
            $quarterly->save();
        }

        return redirect()->back()->with('success', "Trimestralización registrada exitosamente");
    }

    public function quarterlie_edit($id)
    {
        $quarterly = Quarterly::findOrFail($id);
        $competencie_id = $quarterly->learning_outcome->competencie->id;
        $training_projects = TrainingProject::pluck('name', 'id');
        $learning_outcomes_select = LearningOutcome::whereHas('competencie', function ($query) use ($competencie_id) {
            $query->where('id', $competencie_id);
        })->pluck('name', 'id');

        // Obtener todos los trimestres del proyecto formativo actual
        $allQuarterlies = Quarterly::where('training_project_id', $quarterly->training_project_id)->whereHas('learning_outcome.competencie', function ($query) use ($competencie_id) {
            $query->where('id', $competencie_id);
        })->get();

        return view('sigac::curriculum_planning.quarterlie.edit')->with([
            'titlePage' => trans('Editar Trimestralización'),
            'titleView' => trans('Editar Trimestralización'),
            'quarterlie' => $quarterly,
            'learning_outcomes_select' => $learning_outcomes_select,
            'training_projects' => $training_projects,
            'allQuarterlies' => $allQuarterlies
        ]);
    }


    public function quarterlie_update(Request $request, $id)
    {
        $rules = [
            'quarter_number' => 'required|numeric',
            'training_project_id' => 'required',
            'learning_outcome_id' => 'required|array',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $learning_outcome_Ids = $request->input('learning_outcome_id');
        
        $quarterly = Quarterly::findOrFail($id);
        $competencie_id = $quarterly->learning_outcome->competencie->id;
        
        // Actualizar el trimestre actual con los datos proporcionados
        $quarterly->quarter_number = $request->quarter_number;
        $quarterly->training_project_id = $request->training_project_id;
        $quarterly->save();

        // Obtener los IDs de los resultados de aprendizaje eliminados
        $deleted_learning_outcomes = $request->input('deleted_learning_outcomes');

        // Eliminar los trimestres asociados a los IDs de resultados de aprendizaje eliminados
        if (!empty($deleted_learning_outcomes)) {
            Quarterly::whereIn('learning_outcome_id', $deleted_learning_outcomes)->delete();
        }

        // Obtener todos los trimestres del proyecto formativo actual
        $allQuarterlies = Quarterly::where('training_project_id', $quarterly->training_project_id)->whereHas('learning_outcome.competencie', function ($query) use ($competencie_id) {
            $query->where('id', $competencie_id);
        })->get();

        foreach ($allQuarterlies as $index => $allQuarterly) {
            // Actualizar los demás trimestres con sus respectivos resultados de aprendizaje
            $allQuarterly->learning_outcome_id = $learning_outcome_Ids[$index] ?? null;
            $allQuarterly->save();
        }

        return redirect(route('sigac.academic_coordination.curriculum_planning.quarterlie.index'))->with('success', "Trimestralización actualizada exitosamente");
    }

    // Eliminar trimestralización
    public function quarterlie_destroy($id)
    {
        
        $e = Quarterly::findOrFail($id);

        // Realizar la eliminación
        $e->delete();

        return redirect()->back()->with('success', 'Trimestralización eliminada exitosamente');
    }

    public function competencie_profession_index(){
        $competencieProfession = DB::table('competencie_professions')->get();

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
            'competencieProfession' => $competencieProfession
        ];

        return view('sigac::curriculum_planning.competencie_profession.index', $view);
    }

    public function competencie_profession_search($id){
        $comp = Competencie::where('program_id', $id)->get();
        $competencies = $comp->map(function ($c) {
            $id = $c->id;
            $name = $c->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        });

        return response()->json(['competencie' => $competencies]);      
    }

    public function competencie_profession_store(Request $request){
        $rules = [
            'profession' => 'required',
            'competencie' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Realizar registro
        $competencie = Competencie::where('id', $request->competencie)->first();
        $existingRecord = DB::table('competencie_professions')
        ->where('competencie_id', $competencie->id)
        ->where('profession_id', $request->profession)
        ->exists();
        
        if(!$existingRecord){
            if ($competencie->professions()->syncWithoutDetaching($request->profession)){
                return redirect(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_index'))->with(['success'=> trans('sigac::profession.Successful_Aggregation')]);
            } else {
                return redirect(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_index'))->with(['error'=> trans('sigac::profession.Error_Adding')]);
            }
        }else{
            return redirect(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_index'))->with(['error'=> trans('sigac::learning_out_come.RecordAlreadyExistsWithDataSent')]);
        }
    } 

    public function competencie_profession_destroy($id){
        $competencie = DB::table('competencie_professions')->where('id', $id)->delete();

        if($competencie){
            return redirect(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_index'))->with(['success'=> trans('sigac::profession.Successful_Removal')]);
        }else{
            return redirect(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_index'))->with(['error'=> trans('sigac::profession.Delete_Error')]);
        }
    }

    public function learning_out_people_index(){
        $learningOutcomePeople = DB::table('learning_outcome_people')->get();

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
            'titlePage'=> trans('sigac::learning_out_come.AssignLearning'), 
            'titleView'=> trans('sigac::learning_out_come.AssignLearningOutcomesInstructors'), 
            'programs' => $programs, 
            'learningOutcomePeople' => $learningOutcomePeople
        ];

        return view('sigac::curriculum_planning.assign_learning_outcomes.index', $view);
    }

    public function learning_out_people_search_competencie($id) {
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

    public function learning_out_people_search_learning_outcome($id) {
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

    public function learning_out_people_search_instructor($id){
        $learningOutCome = LearningOutCome::with('competencie.professions')->where('id', $id)->get();
        $professions = [];

        foreach ($learningOutCome as $l) {
            foreach ($l->competencie->professions as $p){
                $profession = $p->id;
                $professions[] = $profession;
            } 
        }
       
        $people = Profession::with('people')->whereIn('id', $professions)->get();
        $person = [];

        foreach ($people as $p) {
            foreach ($p->people as $pp){
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
                        ->select('people.id','people.first_name', 'people.first_last_name', 'people.second_last_name')
                        ->union(
                            DB::table('contractors')
                            ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                            ->join('people', 'contractors.person_id', '=', 'people.id')
                            ->where('state', 'Activo')
                            ->where('employee_types.name', 'Instructor')
                            ->whereIn('person_id', $person)
                            ->select('people.id','people.first_name', 'people.first_last_name', 'people.second_last_name')
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
   
    public function learning_out_people_store(Request $request){
        $rules = [
            'instructor' => 'required',
            'learningOutCome' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        $learning_outcome = LearningOutCome::where('id', $request->learningOutCome)->first();
        $existingRecord = DB::table('learning_outcome_people')
        ->where('person_id', $request->instructor)
        ->where('learning_outcome_id', $learning_outcome->id)
        ->exists();
        
        // Realizar registro
        if(!$existingRecord){
            if ($learning_outcome->people()->syncWithoutDetaching($request->instructor)){
                return redirect(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.learning_out_people_index'))->with(['success'=> trans('sigac::profession.Successful_Aggregation')]);
            } else {
                return redirect(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.learning_out_people_index'))->with(['error'=> trans('sigac::profession.Error_Adding')]);
            }
        }else{
            return redirect(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.learning_out_people_index'))->with(['error'=> trans('sigac::learning_out_come.RecordAlreadyExistsWithDataSent')]);
        }
    }

    public function learning_out_people_destroy($id){
        $professionProgram = DB::table('learning_outcome_people')->where('id', $id)->delete();

        if($professionProgram){
            return redirect(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.learning_out_people_index'))->with(['success'=> trans('sigac::profession.Successful_Removal')]);

        }else{
            return redirect(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.learning_out_people_index'))->with(['error'=> trans('sigac::profession.Delete_Error')]);
        }
    }
}
