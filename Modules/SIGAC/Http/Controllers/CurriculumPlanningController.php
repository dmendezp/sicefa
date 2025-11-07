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
use Modules\SICA\Entities\Apprentice;
use Modules\SIGAC\Entities\Profession;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\ClassEnvironment;
use Modules\SIGAC\Entities\InstructorProgram;
use Modules\SIGAC\Entities\EvaluativeJudgment;
use Modules\SIGAC\Entities\InstructorProgramOutcome;
use Modules\SICA\Entities\Person;
use Modules\SICA\Imports\PeopleImport;
use Modules\SIGAC\Imports\ApprenticeLearningOutcomeImport;
use Modules\SIGAC\Imports\ProgramImport;

use Excel, Exception;

class CurriculumPlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    // Proyecto formativo
    public function training_project_index()
    {
        $learning_outcomes = LearningOutcome::pluck('name', 'id');
        $coursesWithTrainingProjects = Course::has('training_projects')->with('training_projects.quarterlies.learning_outcome.instructor_program_outcomes.instructor_program')->get();

        // Contar los resultados de aprendizaje programados para cada proyecto formativo
        $counts = [];
        foreach ($coursesWithTrainingProjects as $course) {
            foreach ($course->training_projects as $trainingProject) {
                $count = $trainingProject->quarterlies->unique('learning_outcome_id')->count();
                $counts[$trainingProject->id] = $count;
            }
        }


        return view('sigac::curriculum_planning.training_project.index')->with([
            'titlePage' => trans('Proyecto Formativo'),
            'titleView' => trans('Proyecto Formativo'),
            'learning_outcomes' => $learning_outcomes,
            'coursesWithTrainingProjects' => $coursesWithTrainingProjects,
            'counts' => $counts, // Pasar el conteo a la vista
        ]);
    }

    public function training_project_quarterlie_index($training_project_id, $course_id)
    {
        $quarterlies = Quarterly::with('training_project.courses.program', 'learning_outcome.competencie', 'learning_outcome.people.professions')
            ->where('training_project_id', $training_project_id)
            ->whereHas('training_project.courses', function ($query) use ($course_id) {
                $query->where('courses.id', $course_id);
            })
            ->get()
            ->groupBy(function ($quarterly) {
                $competencieName = $quarterly->learning_outcome->competencie->name;
                return str_replace('-' . $quarterly->quarter_number, '', $competencieName);
            });

        $trainingProject = TrainingProject::findOrFail($training_project_id);
        $trainingProjectName = $trainingProject->name;
        $trainingProjectId = $trainingProject->id;

        $course = Course::findOrFail($course_id);
        $courseNumber = $course->program->quarter_number;
        $programId = $course->program->id;

        $learning_outcomes_select = LearningOutcome::whereHas('competencie.program', function ($query) use ($programId) {
            $query->where('id', $programId);
        })->pluck('name', 'id');

        $competences_select = Competencie::whereHas('program', function ($query) use ($programId) {
            $query->where('id', $programId);
        })->pluck('name', 'id');



        return view('sigac::curriculum_planning.quarterlie.index')->with([
            'titlePage' => trans('Trimestralización'),
            'titleView' => trans('Trimestralización'),
            'quarterlies' => $quarterlies,
            'trainingProjectName' => $trainingProjectName,
            'courseNumber' => $courseNumber,
            'trainingProjectId' => $trainingProjectId,
            'programId' => $programId,
            'learning_outcomes_select' => $learning_outcomes_select,
            'competences_select' => $competences_select
        ]);
    }
    // Registrar proyecto formativo
    public function training_project_store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'code' => 'required|numeric',
            'execution_time' => 'required|numeric',
            'objective' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $training_project =  new TrainingProject;
        $training_project->name = $request->name;
        $training_project->code = $request->code;
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
        $training_project->code = e($request->input('code'));
        $training_project->execution_time = e($request->input('execution_time'));
        $training_project->objective = e($request->input('objective'));
        if ($training_project->save()) {
            return redirect()->back()->with(['success' => 'Proyecto formativo actualizado exitosamente']);
        } else {
            return redirect()->back()->with(['error' => 'Error al actualizar el proyecto formativo']);
        }
        return redirect()->back()->with(['error' => 'Ocurrio algun error']);
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
        $learning_outcomes_select = LearningOutcome::pluck('name', 'id');
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

    public function quarterlie_filterlearning(Request $request)
    {
        $competencie_id = $request->input('competencie_id');

        $learning_outcome = LearningOutcome::where('competencie_id', $competencie_id)->pluck('name', 'id');

        return response()->json(['learning_outcome' => $learning_outcome->toArray()]);
    }


    public function quarterlie_load_create($course_id, $training_project_id){

        $nametraining_projectselected = TrainingProject::where('id','=',$training_project_id)->pluck('name')->first();
		return view('sigac::curriculum_planning.training_project.load')->with(['titlePage' => 'Cargar Trimestralización',
        'titleView' => 'Cargar Trimestralización',
        'course_id' => $course_id,
        'training_project_id' => $training_project_id,
        'nametraining_projectselected' => $nametraining_projectselected
        ]);
	}

    /* Registrar aprendices a partir de un archivo */
    public function quarterlie_load_store(Request $request){
        ini_set('max_execution_time', 3000); // Ampliar el tiempo máximo de la ejecución del proceso en el servidor
        $validator = Validator::make($request->all(),
            ['archivo'  => 'required'],
            ['archivo.required'  => 'El archivo es requerido.']
        );
        if($validator->fails()){
            return back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }else{
            $path = $request->file('archivo'); // Obtener ubicación temporal del archivo en el servidor
            // Usar el importador personalizado para obtener los datos
            $import = new ProgramImport();
            $array = Excel::toArray($import, $path);
            $datas = array_splice($array[0], 3, count($array[0]));
            $fila = $array[0];
            $code = $fila[0][1];
            $name_training_project = $fila[1][1];
            $course_id = $request->course_id;
            $course= Course::findOrFail($course_id);
            $program_id = $course->program_id;
            
            $competencias = Competencie::where('program_id',$program_id)->pluck('id');
            $learning_outcome_Ids = LearningOutcome::whereIn('competencie_id',$competencias)->get();
            $countlearning = $learning_outcome_Ids->count();
            if ($countlearning == 0) {
                return redirect()->back()->with('error', 'No se encontraron resultados de aprendizaje para este programa.')->with('typealert', 'error');
            }

            $training_project_id = $request->training_project_id;
            $nametraining_projectselected = TrainingProject::where('id','=',$training_project_id)->pluck('name')->first();
            
            if($nametraining_projectselected != $name_training_project ){
                $codeselected = TrainingProject::where('code','=',$code)->pluck('name')->first();
                if ($codeselected != $code) {
                    return redirect()->back()->with('error', 'El proyecto formativo ingresado ('.$name_training_project.') para el registro de la trimestralización no coincide con el seleccionado ('.$nametraining_projectselected.').')->with('typealert', 'error');
                }
            }            
            try {
                $count = 0;
                // Recorrer datos y relizar registros
                
                DB::beginTransaction();

                foreach($datas as $data){
                    $name_learning_file = $data[0];
                    if ($data[0] != null) {
                        if ($name_learning_file) {
                            // Si hay más de una parte después de dividir por el guión
                            $name_learning = trim(preg_replace('/^[0-9\s\-\x{2022}\x{0095}\t]+/u', '', $name_learning_file)); // Eliminar números y espacios al principio de la cadena
                        } else {
                            // Si no hay un guión, entonces tomar el nombre completo sin modificar
                            $name_learning = trim($name_learning_file[0]);
                        }
                        
                        $hour = $data[1];
                        $quarter_number = $data[2];
    
                        $learning_outcome = LearningOutcome::where('name', '=', $name_learning)->first();
    
                        $training_project = TrainingProject::where('name', '=', $name_training_project)->first();
                        if (!$training_project) {
                            $training_projectc = TrainingProject::where('code', '=', $code)->first();
    
                            if (!$training_projectc) {
                                DB::rollBack(); // Devolver cambios realizados durante la transacción
                                return redirect()->back()->with('error', 'El proyecto formativo no existe')->with('typealert', 'error');
                            }
                            $training_project_id = $training_projectc->id;
                            if ($learning_outcome) {
                               
                                $learning_outcome_id = $learning_outcome->id;
    
                                $quarterlie = new Quarterly;
                                $quarterlie->training_project_id = $training_project_id;
                                $quarterlie->learning_outcome_id = $learning_outcome_id;
                                $quarterlie->hour = $hour;
                                $quarterlie->quarter_number = $quarter_number;
                                $quarterlie->save();
                                $count++;
                                
                            } else {
                                DB::rollBack(); // Devolver cambios realizados durante la transacción
                                return redirect()->back()->with('error', "El resultado de aprendizaje '{$name_learning}' no fue encontrado")->with('typealert', 'error');
                            }
                        } else {
                            $training_project_id = $training_project->id;
                            
                            if ($learning_outcome) {
                                
                                $learning_outcome_id = $learning_outcome->id;
    
                                $quarterlie = new Quarterly;
                                $quarterlie->training_project_id = $training_project_id;
                                $quarterlie->learning_outcome_id = $learning_outcome_id;
                                $quarterlie->hour = $hour;
                                $quarterlie->quarter_number = $quarter_number;
                                $quarterlie->save();
                                $count++;
    
                            }  else {
                                DB::rollBack(); // Devolver cambios realizados durante la transacción
                                return redirect()->back()->with('error', "El resultado de aprendizaje '{$name_learning}' no fue encontrado")->with('typealert', 'error');
                            }
    
                        }
                    }
                    
                }

                $quarterlie = Quarterly::where('training_project_id',$training_project_id)->get()->groupBy('learning_outcome_id');
                $countquarterly = $quarterlie->count();

                if ($countlearning == $countquarterly) {
                    DB::commit();
                    return redirect()->back()->with('success', 'Archivo excel escaneado coerrectamente. '.$count.' Trimestralizaciones registradas exitosamente.')->with('typealert', 'success');
                } else {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Debe enviar la trimestralización completa, se requieren '.$countlearning .' resultados con trimestralización y se enviaron '.$countquarterly.'.')->with('typealert', 'error');
                }

            } catch (Exception $e) {
                DB::rollBack(); // Devolver cambios realizados durante la transacción
                \Log::error('Error en el registro: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Ocurrio un error en la importación y/o registro de datos del archivo excel cargado. <hr> <strong>Error: </strong> ('.$e->getMessage().').')->with('typealert', 'danger');
             }

        }
    }

    public function quarterlie_store(Request $request)
    {
        $rules = [
            'hour' => 'required',
            'quarter_number' => 'required|numeric',
            'training_project_id' => 'required',
            'learning_outcome_id' => 'required|array',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $learning_outcome_Ids = $request->input('learning_outcome_id');
        $hours = $request->input('hour');
        foreach ($learning_outcome_Ids as $index => $learning_outcome_id) {
            $hour = $hours[$index];
            $quarterly = new Quarterly([
                'hour' => $hour,
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
            'hour' => 'required|numeric',
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
        $quarterly->hour = $request->hour;
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

    public function competencie_profession_index()
    {
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
            'titlePage' => trans('Competencia por Profesión'),
            'titleView' => trans('Competencia por Profesión'),
            'professions' => $proffesions,
            'programs' => $programs,
            'competencieProfession' => $competencieProfession
        ];

        return view('sigac::curriculum_planning.competencie_profession.index', $view);
    }
    public function competencie_profession_table(Request $request)
    {
        $selectedProgram = $request->input('selectedProgram');


        $competencies = Competencie::where('program_id',$selectedProgram)->has('professions')->get();
        $view = [
            'competencies' => $competencies,
        ];

        return view('sigac::curriculum_planning.competencie_profession.table', $view);
    }

    public function competencie_profession_search($id)
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

        return response()->json(['competencie' => $competencies]);
    }

    public function competencie_profession_store(Request $request)
{
    $rules = [
        'profession' => 'required',
        'competencie' => 'required'
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $competencie = Competencie::where('id', $request->competencie)->first();
    $existingRecord = DB::table('competencie_professions')
        ->where('competencie_id', $competencie->id)
        ->where('profession_id', $request->profession)
        ->exists();

    if (!$existingRecord) {
        if ($competencie->professions()->syncWithoutDetaching($request->profession)) {
            return response()->json(['success' => trans('sigac::profession.Successful_Aggregation')], 200);
        } else {
            return response()->json(['error' => trans('sigac::profession.Error_Adding')], 500);
        }
    } else {
        return response()->json(['error' => trans('sigac::learning_out_come.RecordAlreadyExistsWithDataSent')], 409);
    }
}


    public function competencie_profession_destroy($competencieId, $profession_id)
    {
        // Obtener la competencia
        $competencie = Competencie::findOrFail($profession_id);

        // Eliminar la relación a través de Eloquent
        $competencie->professions()->detach($profession_id);
        
        return redirect(route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_index'))->with(['success' => trans('sigac::profession.Successful_Removal')]);
    }

    public function course_training_project_index()
    {

        $course = Course::with('program')->get();
        $courses = $course->map(function ($c) {
            $id = $c->id;
            $name = $c->code_name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::learning_out_come.SelectCourse')])->pluck('name', 'id');

        $training_project = TrainingProject::all();
        $training_project_select = $training_project->map(function ($t) {
            $id = $t->id;
            $name = $t->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::learning_out_come.SelectTrainingProject')])->pluck('name', 'id');

        $view = [
            'titlePage' => 'Curso por Proyecto Formativo',
            'titleView' => 'Curso por Proyecto Formativo',
            'courses' => $courses,
            'training_project_select' => $training_project_select,
        ];

        return view('sigac::curriculum_planning.course_training_project.index', $view);
    }

    public function course_training_project_table(Request $request)
    {
        $training_project = $request->input('training_project');

        $training_projects = TrainingProject::where('id',$training_project)->has('courses')->get();
 
        $view = [
            'training_projects' => $training_projects,
        ];

        return view('sigac::curriculum_planning.course_training_project.table', $view);
    }

    public function course_training_project_store(Request $request)
    {
        $rules = [
            'course' => 'required',
            'training_project' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message' => 'Ocurrió un error con el formulario.', 'typealert' => 'danger']);
        }

        $course = Course::where('id', $request->course)->first();
        $existingRecord = DB::table('course_training_projects')
            ->where('course_id', $course->id)
            ->where('training_project_id', $request->training_project)
            ->exists();

        // Realizar registro
        if (!$existingRecord) {
            if ($course->training_projects()->syncWithoutDetaching($request->training_project)) {
                return redirect(route('sigac.academic_coordination.curriculum_planning.course_trainig_project.index'))->with(['success' => trans('sigac::profession.Successful_Aggregation')]);
            } else {
                return redirect(route('sigac.academic_coordination.curriculum_planning.course_trainig_project.index'))->with(['error' => trans('sigac::profession.Error_Adding')]);
            }
        } else {
            return redirect(route('sigac.academic_coordination.curriculum_planning.course_trainig_project.index'))->with(['error' => trans('sigac::learning_out_come.RecordAlreadyExistsWithDataSent')]);
        }
    }

    public function course_training_project_destroy($training_project_id, $course_id)
    {
        // Obtener la competencia
        $training_project = TrainingProject::findOrFail($training_project_id);

        // Eliminar la relación a través de Eloquent
        $training_project->courses()->detach($course_id);

        return redirect(route('sigac.academic_coordination.curriculum_planning.course_trainig_project.index'))->with(['success' => trans('sigac::profession.Successful_Removal')]);
    }

    // Proyecto formativo
    public function competencie_class_index()
    {
        $competencies = Competencie::has('class_environments')->get();

        $competencie = Competencie::all();
        $competencieselect = $competencie->map(function ($p) {
            $id = $p->id;
            $name = $p->name;
            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una competencia'])->pluck('name', 'id');

        $prof = ClassEnvironment::all();
        $ClassEnvi = $prof->map(function ($p) {
            $id = $p->id;
            $name = $p->name;
            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una clase de ambiente'])->pluck('name', 'id');


        return view('sigac::curriculum_planning.competencie_class.index')->with(['titlePage' => 'Competencia por ambiente',
        'titleView' => 'Competencia por ambiente', 
        'competencieselect' => $competencieselect, 
        'ClassEnvi' => $ClassEnvi, 
        'competencies' => $competencies]);
    }

    public function competencie_class_store(Request $request)
    {
        $rules = [
            'class_environment_id' => 'required',
            'competencie_id' => 'required'
        ];
    
        // Validación de los datos recibidos del formulario
        $validator = Validator::make($request->all(), $rules);
    
        // Si la validación falla, redireccionar de vuelta con los errores y los datos anteriores del formulario
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message' => 'Ocurrió un error con el formulario.', 'typealert' => 'danger']);
        }
    
        // Obtener el resultado de aprendizaje y verificar si ya existe un registro para ese par de IDs
        $competencie = Competencie::find($request->competencie_id);

        
        $existingRecord = DB::table('class_environment_competencies')
            ->where('class_environment_id', $request->class_environment_id)
            ->where('competencie_id', $request->competencie_id)
            ->exists();
    
        // Realizar el registro si no existe un registro previo para el par de IDs
        if (!$existingRecord) {
            // SyncWithoutDetaching para asociar los datos en la tabla pivote sin eliminar los registros existentes
            if ($competencie->class_environments()->syncWithoutDetaching([$request->class_environment_id])) {
                return redirect(route('sigac.academic_coordination.curriculum_planning.competencie_class.index'))->with(['success' => 'Registro exitoso.']);
            } else {
                return redirect(route('sigac.academic_coordination.curriculum_planning.competencie_class.index'))->with(['error' => 'Error al agregar el registro.']);
            }
        } else {
            return redirect(route('sigac.academic_coordination.curriculum_planning.competencie_class.index'))->with(['error' => 'Ya existe un registro.']);
        }
    }

    public function competencie_class_destroy($class_environment_id, $competencie_id)
    {
        // Obtener la competencia
        $class_environment = ClassEnvironment::findOrFail($class_environment_id);
       
        // Eliminar la relación a través de Eloquent
        $class_environment->competencies()->detach($competencie_id);
        
        return redirect(route('sigac.academic_coordination.curriculum_planning.competencie_class.index'))->with(['success' => trans('sigac::profession.Successful_Removal')]);
    }

    /* Consultar aprendices por titulación */

    public function evaluative_judgment_create(){
	
		return view('sigac::curriculum_planning.evaluative_judgment.load')->with(['titlePage' => 'Cargar juicio evaluativo',
        'titleView' => 'Cargar juicio evaluativo']);
	}

	public function evaluative_judgment_filter(Request $request){
        $person_id = $request->person_id;
        $course_id = $request->course_id;
		if($person_id):
            $resultsperson = Person::where('id',$person_id)->get();
            $rperson = $resultsperson->map(function ($p){
                $personId = $p->id;
                $personName = $p->first_name . ' ' . $p->first_last_name . ' ' . $p->second_last_name;
    
                return [
                    'id' => $personId,
                    'name' => $personName
                ];
            })->pluck('name', 'id');
            if ($request->state) {
                $state = $request->state;
                $evaluative_judgments = EvaluativeJudgment::where('course_id',$course_id)->where('person_id',$person_id)->where('state',$state)->get();
            } else {
                $evaluative_judgments = EvaluativeJudgment::where('course_id',$course_id)->where('person_id',$person_id)->get();
            }
            $apprentices = Person::whereHas('evaluative_judgments', function ($query) use ($course_id) {
                $query->where('course_id', $course_id);
            })->get();
            $rapprentices = $apprentices->map(function ($p){
                $personId = $p->id;
                $personName = $p->first_name . ' ' . $p->first_last_name . ' ' . $p->second_last_name;
    
                return [
                    'id' => $personId,
                    'name' => $personName
                ];
            })->pluck('name', 'id');
			$course = Course::with('program')->findOrFail($course_id);
			$data = ['evaluative_judgments'=>$evaluative_judgments,
            'course'=>$course,
            'apprentices'=>$rapprentices,
            'resultsperson'=>$rperson,
            'state'=>$state,
        ];
            return view('sigac::curriculum_planning.evaluative_judgment.table',$data);
        endif;
	}

	public function evaluative_judgment_search(Request $request){
        $course_id = $request->course_id;
		if($course_id):
            $evaluative_judgments = EvaluativeJudgment::where('course_id',$course_id)->get();
            $apprentices = Person::whereHas('evaluative_judgments', function ($query) use ($course_id) {
                $query->where('course_id', $course_id);
            })->get();
            
            $rapprentices = $apprentices->map(function ($p){
                $personId = $p->id;
                $personName = $p->first_name . ' ' . $p->first_last_name . ' ' . $p->second_last_name;
    
                return [
                    'id' => $personId,
                    'name' => $personName
                ];
            })->pluck('name', 'id');
			$course = Course::with('program')->findOrFail($course_id);
			$data = ['evaluative_judgments'=>$evaluative_judgments,'course'=>$course,'apprentices'=>$rapprentices];
            return view('sigac::curriculum_planning.evaluative_judgment.table',$data);
        else:
            return '<div class="row d-flex justify-content-center"><span class="h5 text-danger">No se encontró registros</span><div>';
        endif;
	}

    public function evaluative_judgment_index () 
    {
        $courses = Course::orderBy('code','Asc')->get()->mapWithKeys(function ($course) {
            return [$course->id => $course->program->name . ' - ' . $course->code];
        });
        return view('sigac::curriculum_planning.evaluative_judgment.index')->with(['titlePage' => 'Consultar juicio evaluativo',
        'titleView' => 'Consultar juicio evaluativo',
        'courses'=>$courses]);
    }

    /* Registrar aprendices a partir de un archivo */
    public function evaluative_judgment_store(Request $request){
        ini_set('max_execution_time', 3000); // Ampliar el tiempo máximo de la ejecución del proceso en el servidor
        $validator = Validator::make($request->all(),
            ['archivo'  => 'required'],
            ['archivo.required'  => 'El archivo es requerido.']
        );
        if($validator->fails()){
            return back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }else{
            $path = $request->file('archivo'); // Obtener ubicación temporal del archivo en el servidor
            $array = Excel::toArray(new ApprenticeLearningOutcomeImport, $path); // Convertir el contenido del archivo excel en una arreglo de arreglos
            $course_code = $array[0][1][2];
            $course_start_l = $array[0][6][2];
            $start_l = date('Y-m-d', strtotime('1899-12-30 + '. $course_start_l . 'days'));
            $course_end_p = $array[0][7][2];
            $end_p = date('Y-m-d', strtotime('1899-12-30 + '. $course_end_p . 'days'));

            $course_start_p = date('Y-m-d', strtotime('-6 months', strtotime($end_p)));
            $course_end_l = date('Y-m-d', strtotime('-1 days', strtotime($course_start_p)));

            $apprentices_data = array_splice($array[0], 12, count($array[0])); // Obtener solo los registros de los datos de los aprendices
            try {
                
                // Recorrer datos y relizar registros
                $countstate = 0;
                foreach($apprentices_data as $data){
                    $document_number = $data[1];
                    $learning_outcome = explode(" - ", $data[6]); // Dividir la cadena por el guión ('-')
                    if ($learning_outcome) {
                        if (count($learning_outcome) > 1) {
                            // Si hay más de una parte después de dividir por el guión
                            $name_learning = trim(preg_replace('/^[0-9\s\-\x{2022}\x{0095}\t]+/u', '', $learning_outcome[1])); // Eliminar números y espacios al principio de la cadena
                        } else {
                            // Si no hay un guión, entonces tomar el nombre completo sin modificar
                            $name_learning = trim($learning_outcome[0]);
                        }
                        $state = $data[7];
                        $learning_outcome = LearningOutcome::where('name', '=', $name_learning)->first();
                        
                        if ($learning_outcome) {
                            $learning_outcome_id = $learning_outcome->id;

                            $course = Course::where('code',$course_code)->first();
                            $course->start_production_date = $course_start_p;
                            $course->school_end_date = $course_end_l;
                            $course->save();
                            // Modificar fechas del curso
                            // guardar curso
                            if ($course) {
                                $course_id = $course->id;
                                $person = Person::where('document_number',$document_number)->first();
                                $person_id = $person->id;
                                $evaluative_judgments = EvaluativeJudgment::where('person_id',$person_id)->where('learning_outcome_id',$learning_outcome_id)->where('course_id',$course_id)->first();
                                switch ($state) {
                                    case 'APROBADO':
                                        $status = 'Aprobado';
                                        break;
                                    case 'POR EVALUAR':
                                        $status = 'Pendiente';
                                        break;
                                    case 'NO APROBADO':
                                        $status = 'No Aprobado';
                                        break;
                                    
                                    default:
                                        $status = 'Pendiente';
                                        break;
                                }
                                if ($evaluative_judgments) {
                                    
                                    $evaluative_judgments->state = $status;
                                    $evaluative_judgments->save();
                                } else {
                                    $evaluative_judgments = new EvaluativeJudgment;
                                    $evaluative_judgments->person_id = $person_id;
                                    $evaluative_judgments->course_id = $course_id;
                                    $evaluative_judgments->learning_outcome_id = $learning_outcome_id;
                                    $evaluative_judgments->state = $status;
                                    $evaluative_judgments->save();
                                }
                            }
                            if ($state = "APROBADO") {
                                $instructor_program_outcomes = InstructorProgramOutcome::where('learning_outcome_id',$learning_outcome_id)->get();
                                
                                foreach ($instructor_program_outcomes as $instructor_program_outcome) {
                                    $instructor_program_outcome->state = 'Evaluado';
                                    $instructor_program_outcome->save();                                
                                }
                            }
                        }
                    }
                    $countstate++;
                }
                
                return back()->with('success', 'Se cargaron '.$countstate.' juicios evaluativos exitosamente.')->with('typealert', 'success');
            } catch (Exception $e) {
                return back()->with('error', 'Ocurrio un error en la importación y/o registro de datos del archivo excel cargado. <hr> <strong>Error: </strong> ('.$e->getMessage().').')->with('typealert', 'danger');
             }

        }
    }
    
}
