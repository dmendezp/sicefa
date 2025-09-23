<?php

namespace Modules\GDMF\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\GDMF\Entities\AnnualBudgetTrainingProject;
use Modules\GDMF\Entities\MaterialRequest;
use Modules\GDMF\Entities\MaterialRequestItem;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Person;
use Modules\SIGAC\Entities\TrainingMaterial;

class MaterialRequestController extends Controller
{
    /**
     * Devuelve datos del proyecto formativo, presupuesto y materiales de un curso
     */
    public function index()
    {
        $courses = Course::get();
        return view('gdmf::material_request.index')->with([
            'titlePage' => trans('Solicitud Materiales'),
            'titleView' => trans('Solicitud Materiales'),
            'courses' => $courses
        ]);
    }

    public function getProjectInfo($course_id)
    {
        $course = Course::with('training_projects')->findOrFail($course_id);

        $project = $course->training_projects->first();
        if (!$project) {
            return response()->json(['info' => 'No hay proyecto asociado'], 404);
        }

        $budgetData = AnnualBudgetTrainingProject::where('training_project_id', $project->id)
            ->whereHas('annual_budget', function ($q) {
                $q->where('year', now()->year);
            })->first();

        $materials = TrainingMaterial::with('element')
            ->where('training_project_id', $project->id)
            ->get()
            ->map(function ($tm) {
                return [
                    'id' => $tm->element->id,
                    'name' => $tm->element->name,
                    'price' => $tm->element->price,
                    'unit' => $tm->element->measurement_unit->name ?? 'Unidad',
                ];
            });

        return response()->json([
            'project' => $project,
            'budget' => $budgetData->budget_current ?? 0,
            'materials' => $materials
        ]);
    }

    /**
     * Almacena la solicitud de materiales
     */

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'training_project_id' => 'required|exists:training_projects,id',
            'items' => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;

            foreach ($request->items as $item) {
                $element = Element::findOrFail($item['element_id']);
                $total += $element->price * $item['quantity'];
            }

            $budgetRecord = AnnualBudgetTrainingProject::where('training_project_id', $request->training_project_id)
                ->whereHas('annual_budget', function ($q) {
                    $q->where('year', now()->year);
                })->first();

            $availableBudget = $budgetRecord?->budget_current ?? 0;
            $fundingSource = 'Proyecto';
            $fromProject = 0;
            $fromProduction = 0;

            // Validación sin afectar presupuesto
            if ($availableBudget <= 0) {
                $fundingSource = 'Produccion';
                $fromProduction = $total;
            } elseif ($availableBudget >= $total) {
                $fundingSource = 'Proyecto';
                $fromProject = $total;
                // NO se descuenta aquí
                // $budgetRecord->budget_current -= $total;
                // $budgetRecord->save();
            } else {
                $fundingSource = 'Mixto';
                $fromProject = $availableBudget;
                $fromProduction = $total - $availableBudget;
                // $budgetRecord->budget_current = 0;
                // $budgetRecord->save();
            }

            $user = Auth::user();

            // Crear la solicitud
            $requestRecord = MaterialRequest::create([
                'training_project_id' => $request->training_project_id,
                'course_id' => $request->course_id,
                'person_id' => $user->person->id,
                'total' => $total,
                'funding_source' => $fundingSource,
                'from_project' => $fromProject,
                'from_production' => $fromProduction,
            ]);

            // Crear los ítems
            foreach ($request->items as $item) {
                $element = Element::findOrFail($item['element_id']);
                MaterialRequestItem::create([
                    'material_request_id' => $requestRecord->id,
                    'element_id' => $element->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $element->price,
                    'subtotal' => $element->price * $item['quantity']
                ]);
            }

            DB::commit();

            return back()->with('success', "Solicitud registrada exitosamente. Financiación: " . ucfirst($fundingSource));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al registrar solicitud de materiales: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', "Ocurrió un error al registrar la solicitud. Intenta nuevamente más tarde.");
        }
    }



    public function report(Request $request)
    {
        $employeeTypeNames = ['Instructor'];

        $instructorsRaw = DB::table('employees')
            ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
            ->join('people', 'employees.person_id', '=', 'people.id')
            ->whereNull('employees.deleted_at')
            ->whereIn('employee_types.name', $employeeTypeNames)
            ->select(
                'people.id as person_id',
                DB::raw('CONCAT(people.first_name, " ", people.first_last_name) as full_name')
            )
            ->union(
                DB::table('contractors')
                    ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                    ->join('people', 'contractors.person_id', '=', 'people.id')
                    ->whereNull('contractors.deleted_at')
                    ->whereIn('employee_types.name', $employeeTypeNames)
                    ->select(
                        'people.id as person_id',
                        DB::raw('CONCAT(people.first_name, " ", people.first_last_name) as full_name')
                    )
            )
            ->get();

        // Convertimos a un array asociativo para usar en el select
        $instructors = $instructorsRaw->pluck('full_name', 'person_id');

        // Cursos para el filtro
        $courses = Course::with('program')->get()->mapWithKeys(function ($course) {
            return [
                $course->id => $course->code . ' - ' . $course->program->name,
            ];
        });


        $query = MaterialRequest::with(['course', 'training_project', 'items.element', 'person']);

        if ($request->filled('instructor_id')) {
            $query->where('person_id', $request->instructor_id); // Suponiendo que la solicitud tiene un `person_id`
        }

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $requests = $query->orderBy('created_at', 'desc')->paginate(20);

        $titlePage = "Reporte de Solicitudes de Materiales";
        $titleView = "Solicitudes de Materiales";

        return view('gdmf::material_request.report', compact('requests', 'instructors', 'courses', 'titlePage', 'titleView'));
    }
}
