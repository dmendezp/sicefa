<?php

namespace Modules\GDMF\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\LearningOutcome;
use Modules\SICA\Entities\Competencie;
use Modules\SIGAC\Entities\TrainingProject;
use Modules\SIGAC\Entities\Quarterly;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


use Excel, Exception;
use Modules\GDMF\Entities\AnnualBudget;
use Modules\GDMF\Entities\AnnualBudgetTrainingProject;

class CurriculumPlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    // Proyecto formativo
    public function training_project_index()
    {
        $annual_budget = AnnualBudget::where('year', date('Y'))->first();
        $learning_outcomes = LearningOutcome::pluck('name', 'id');
        $coursesWithTrainingProjects = Course::has('training_projects')->with('training_projects.quarterlies.learning_outcome.instructor_program_outcomes.instructor_program')->get();

        // Contar los resultados de aprendizaje programados para cada proyecto formativo
        $counts = [];
        foreach ($coursesWithTrainingProjects as $course) {
            foreach ($course->training_projects as $trainingProject) {
                $count = $trainingProject->quarterlies->unique('learning_outcome_id')->count();
                $counts[$trainingProject->id] = $count;

                // Buscar presupuesto asignado a este proyecto para el año actual
                $budgetRecord = null;
                if ($annual_budget) {
                    $budgetRecord = AnnualBudgetTrainingProject::where('training_project_id', $trainingProject->id)
                        ->where('annual_budget_id', $annual_budget->id)
                        ->first();
                }
                $projectBudgets[$trainingProject->id] = $budgetRecord;
            }
        }


        return view('gdmf::curriculum_planning.training_project.index')->with([
            'titlePage' => trans('Proyecto Formativo'),
            'titleView' => trans('Proyecto Formativo'),
            'learning_outcomes' => $learning_outcomes,
            'coursesWithTrainingProjects' => $coursesWithTrainingProjects,
            'counts' => $counts, // Pasar el conteo a la vista
            'annual' => $annual_budget->budget_current ? $annual_budget->budget_current : 0,
            'projectBudgets' => $projectBudgets
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



        return view('gdmf::curriculum_planning.quarterlie.index')->with([
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

        return view('gdmf::curriculum_planning.course_training_project.index', $view);
    }

    public function course_training_project_table(Request $request)
    {
        $training_project = $request->input('training_project');

        $training_projects = TrainingProject::where('id', $training_project)->has('courses')->get();

        $view = [
            'training_projects' => $training_projects,
        ];

        return view('gdmf::curriculum_planning.course_training_project.table', $view);
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
                return redirect(route('gdmf.academic_coordination.curriculum_planning.course_trainig_project.index'))->with(['success' => trans('sigac::profession.Successful_Aggregation')]);
            } else {
                return redirect(route('gdmf.academic_coordination.curriculum_planning.course_trainig_project.index'))->with(['error' => trans('sigac::profession.Error_Adding')]);
            }
        } else {
            return redirect(route('gdmf.academic_coordination.curriculum_planning.course_trainig_project.index'))->with(['error' => trans('sigac::learning_out_come.RecordAlreadyExistsWithDataSent')]);
        }
    }

    public function course_training_project_destroy($training_project_id, $course_id)
    {
        // Obtener la competencia
        $training_project = TrainingProject::findOrFail($training_project_id);

        // Eliminar la relación a través de Eloquent
        $training_project->courses()->detach($course_id);

        return redirect(route('gdmf.academic_coordination.curriculum_planning.course_trainig_project.index'))->with(['success' => trans('sigac::profession.Successful_Removal')]);
    }

    public function training_project_budget_store(Request $request)
    {
        // Laravel maneja errores de validación por sí mismo
        $request->validate([
            'training_project_id' => 'required',
            'year' => 'required',
            'budget_total' => 'required',
        ]);

        try {
            // Buscar presupuesto anual del año
            $annualBudget = AnnualBudget::where('year', $request->year)->first();

            if (!$annualBudget) {
                return redirect()->back()->with('error', 'No se encontró el presupuesto anual para el año indicado.');
            }

            $existing = AnnualBudgetTrainingProject::where('annual_budget_id', $annualBudget->id)
                ->where('training_project_id', $request->training_project_id)
                ->first();

            $totalAsignado = AnnualBudgetTrainingProject::where('annual_budget_id', $annualBudget->id)
                ->when($existing, function ($query) use ($existing) {
                    $query->where('id', '!=', $existing->id);
                })
                ->sum('budget_total');

            $presupuestoDisponible = $annualBudget->budget_current - $totalAsignado;

            if ($request->budget_total > $presupuestoDisponible) {
                return redirect()->back()->with('error', 'El presupuesto asignado excede el disponible. Quedan $' . number_format($presupuestoDisponible, 0, ',', '.'));
            }

            if ($existing) {
                $existing->update([
                    'budget_total' => $request->budget_total,
                    'budget_current' => $request->budget_total
                ]);
                $mensaje = 'Presupuesto actualizado correctamente.';
            } else {
                AnnualBudgetTrainingProject::create([
                    'annual_budget_id' => $annualBudget->id,
                    'training_project_id' => $request->training_project_id,
                    'budget_total' => $request->budget_total,
                    'budget_current' => $request->budget_total,
                ]);
                $mensaje = 'Presupuesto asignado correctamente al proyecto.';
            }

            return redirect()->back()->with('success', $mensaje);
        } catch (\Exception $e) {
            dd($e);
            \Log::error('Error en training_project_budget_store: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'Ocurrió un error inesperado al guardar el presupuesto.');
        }
    }
}