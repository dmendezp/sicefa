<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\SICA\Entities\Employee;
use Modules\SICA\Entities\Contractor;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\Course;
use Modules\SIGAC\Entities\InstructorProgram;
use Modules\SIGAC\Entities\ExternalActivity;
use Modules\SIGAC\Entities\Profession;
use Modules\SIGAC\Entities\Quarterly;
use DB;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Competencie;
use Modules\SICA\Entities\LearningOutcome;
use Modules\SICA\Entities\Holiday;
use Carbon\Carbon;
class ProgrammeController extends Controller
{
    // Programación de horarios
    public function programming()
    {
        $view = [
            'titlePage' => trans('sigac::controllers.SIGAC_programming_schedules_title_page'),
            'titleView' => trans('sigac::controllers.SIGAC_programming_schedules_title_view'),
            'programmingEvents' => InstructorProgram::get(),
        ];

        return view('sigac::programming.index', $view);
    }

    // Gestion de la programacion
        public function management_programming()
        {
            $courses = Course::with('program')->get();

            return view('sigac::programming.create', [
                'courses' => $courses,
                'titlePage' => trans('Programación - Crear Programación'),
                'titleView' => trans('Crear Programación')

            ]);
        }

        public function management_programming_filterquarterlie(Request $request)
        {
            $course_id = $request->input('course_id');
            $quarter_number =$request->input('quarter_number');
            $quarterlie = Quarterly::with('learning_outcome.competencie')
            ->where('quarter_number', $quarter_number)
            ->whereHas('training_project.courses', function($query) use ($course_id) {
                $query->where('courses.id', $course_id);
            })
            ->get()
            ->groupBy(function ($quarterly) use ($quarter_number) {
                $competencieName = $quarterly->learning_outcome->competencie->name;
                return str_replace('-' . $quarter_number, '', $competencieName);
            });
        
            return response()->json(['quarterlie' => $quarterlie]);
        }

        public function management_programming_filterlearning(Request $request)
        {
            $course_id = $request->input('course_id');

            $learning_outcome = LearningOutcome::whereHas('competencie.program.courses', function($query) use ($course_id) {
                $query->where('courses.id', $course_id);
            })->pluck('name','id');

            return response()->json(['learning_outcome' => $learning_outcome->toArray()]);
        }

        public function management_programming_filterinstructor(Request $request)
        {
            $learning_outcome_id = $request->input('learning_outcome_id');

            $instructors = Person::whereHas('professions.competencies.learning_outcomes', function($query) use ($learning_outcome_id) {
                $query->where('learning_outcomes.id', $learning_outcome_id);
            })->pluck('first_name','id');

            return response()->json(['instructors' => $instructors->toArray()]);
        }

        public function management_programming_filterenvironment(Request $request)
        {
            $learning_outcome_id = $request->input('learning_outcome_id');

            $environments = Environment::whereHas('class_environment.learning_outcomes', function($query) use ($learning_outcome_id) {
                $query->where('learning_outcomes.id', $learning_outcome_id);
            })->pluck('name','id');

            return response()->json(['environments' => $environments->toArray()]);
        }

    // Registrar programacion
    public function management_programming_store(Request $request)
    {
        try {
            // Reglas de validación
            $rules = [
                'person_id' => 'required|exists:people,id',
                'environment_id' => 'required|exists:environments,id',
                'course_id' => 'required|exists:courses,id',
                'date' => 'required|date',
                'start_time' => 'required',
                'end_time' => 'required',
            ];

            // Mensajes de validación
            $messages = [
                'person_id.required' => 'El campo Instructor es obligatorio.',
                'person_id.exists' => 'El instructor seleccionado no es válido.',
                'environment_id.required' => 'El campo Ambiente es obligatorio.',
                'environment_id.exists' => 'El ambiente seleccionado no es válido.',
                'course_id.required' => 'El campo Curso es obligatorio.',
                'course_id.exists' => 'El curso seleccionado no es válido.',
                'date.required' => 'El campo Fecha es obligatorio.',
                'date.date' => 'El campo Fecha debe ser una fecha válida.',
                'start_time.required' => 'El campo Hora de entrada es obligatorio.',
                'end_time.required' => 'El campo Hora de salida es obligatorio.',
            ];

            // Validar los datos con las reglas y mensajes definidos
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['error', 'Error en el formulario']);
            }

            // Intenta crear un nuevo registro con los datos proporcionados
            if (InstructorProgram::create($request->all())) {
                // Si se crea exitosamente, redirige a la página de índice con un mensaje de éxito
                return redirect(route('sigac.academic_coordination.programming.index'))->with('success', 'Programación Registrada');
            }
        } catch (\Exception $e) {
            // Registra un mensaje de error interno del servidor
            \Log::error('Error interno del servidor: ' . $e->getMessage());

            // Si ocurre un error, redirige a la página de índice con un mensaje de error
            return redirect(route('sigac.academic_coordination.programming.index'))->with('error', 'No se registró la Programación');
        }
    }


    public function programming_filter(Request $request)
    {

        $filter = $request->input('filter');

        if ($filter == 1) {
            $option = 1;
            // Nombres de los tipos de empleados
            $employeeTypeNames = ['Instructor'];

            // Obtener tanto empleados como contratistas que sean de los tipos especificados
            $results = DB::table('employees')
                ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
                ->join('people', 'employees.person_id', '=', 'people.id')
                ->whereIn('employee_types.name', $employeeTypeNames)
                ->select('people.id', 'people.first_name as name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                ->union(
                    DB::table('contractors')
                        ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                        ->join('people', 'contractors.person_id', '=', 'people.id')
                        ->whereIn('employee_types.name', $employeeTypeNames)
                        ->select('people.id', 'people.first_name as name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                )
                ->get();
        } elseif ($filter == 2) {
            $option = 2;
            $results = Environment::get();
        } else {
            $option = 3;
            $results = Course::with('program')->get()->map(function ($course) {
                return [
                    'id' => $course->id,
                    'name' => $course->program->name . ' - ' . $course->code,
                ];
            });
        }

        return response()->json([
            'results' => $results,
            'option' => $option,
        ]);
    }

    public function programming_get(Request $request)
    {

        $programmingEvents = InstructorProgram::with('person', 'course.program', 'environment')->get();

        foreach ($programmingEvents as $programmingEvent) {
            $name = $programmingEvent->person->fullname;
            $parts = explode(' ', $name); // Dividir el nombre completo en palabras individuales
            $initials = '';

            foreach ($parts as $part) {
                $initials .= strtoupper(substr($part, 0, 1)); // Tomar la primera letra de cada palabra y convertirla a mayúsculas
            }

            $programmingEvent->person->initials = $initials; // Agregar las iniciales al objeto de persona en el evento de programación
        }

        // Construir una cadena de texto que contenga todas las iniciales
        $allInitials = '';
        foreach ($programmingEvents as $programmingEvent) {
            $allInitials .= $programmingEvent->person->initials;
        }
        return response()->json([
            'programmingEvents' => $programmingEvents,
            'initials' => $allInitials,

        ]);
    }

    public function programming_search(Request $request)
    {

        $filter = $request->input('search');
        $option = $request->input('option');

        if ($option == 1) {

            $programmingEvents = InstructorProgram::with('person', 'course.program', 'environment')->whereHas('person', function ($query) use ($filter) {
                $query->where('id', $filter);
            })
                ->get();
        } elseif ($option == 2) {
            $programmingEvents = InstructorProgram::with('person', 'course.program', 'environment')->whereHas('environment', function ($query) use ($filter) {
                $query->where('id', $filter);
            })
                ->get();
        } else {
            $programmingEvents = InstructorProgram::with('person', 'course.program', 'environment')->whereHas('course', function ($query) use ($filter) {
                $query->where('id', $filter);
            })
                ->get();
        }

        foreach ($programmingEvents as $programmingEvent) {
            $name = $programmingEvent->person->fullname;
            $parts = explode(' ', $name); // Dividir el nombre completo en palabras individuales
            $initials = '';

            foreach ($parts as $part) {
                $initials .= strtoupper(substr($part, 0, 1)); // Tomar la primera letra de cada palabra y convertirla a mayúsculas
            }

            $programmingEvent->person->initials = $initials; // Agregar las iniciales al objeto de persona en el evento de programación
        }

        // Construir una cadena de texto que contenga todas las iniciales
        $allInitials = '';
        foreach ($programmingEvents as $programmingEvent) {
            $allInitials .= $programmingEvent->person->initials;
        }

        // Devolver las iniciales junto con la respuesta JSON
        return response()->json([
            'programmingEvents' => $programmingEvents,
            'option' => $option,
            'initials' => $allInitials,
        ]);
    }

    /* Vista principal para la programación de eventos de instructor */
    public function event_programming()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_event_programming_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_event_programming_title_view')];
        return view('sigac::programming.event_programming', $view);
    }


    // ||----------------- Parametros --------------------||

    // Parametros de programacion
    public function parameter()
    {
        $prof = Program::all();
        $programs = $prof->map(function ($p) {
            $id = $p->id;
            $name = $p->name;
            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un programa'])->pluck('name', 'id');

        $Comps = Competencie::all();
        $competencies = $Comps->map(function ($c) {
            $id = $c->id;
            $name = $c->name;
            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una competencia'])->pluck('name', 'id');

        $Comps = Competencie::with('program')->get()->groupBy('program.name');

        $learning_outcomes = LearningOutcome::with('competencie')->get()->groupBy('competencie.name');

        $external_activities = ExternalActivity::get();
        $titlePage = 'Parametros';
        $titleView = 'Parametros';
        return view('sigac::programming.parameters.index')->with(['titlePage' => $titlePage,
        'titleView' => $titleView, 
        'external_activities' => $external_activities, 
        'professions' => Profession::all(), 
        'competences' => $Comps, 
        'learning_outcomes' => $learning_outcomes, 
        'programs' => $programs, 
        'competencies' => $competencies]);
    }

    // Registrar profesion
    public function profession_store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'level' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=> trans('sigac::profession.An_Error_Occurred_With_Form'), 'typealert'=>'danger']);
        }
        // Realizar registro
        if (Profession::create($request->all())){
            return redirect(route('sigac.academic_coordination.programming.parameters.index'))->with(['success'=> trans('sigac::profession.The_Profession_Was_Added_Correctly')]);
        } else {
            return redirect(route('sigac.academic_coordination.programming.parameters.index'))->with(['error'=> trans('sigac::profession.Error_When_Adding_Profession')]);
        }
    }

    // Actualizar profesion
    public function profession_update(Request $request)
    {
        $p = Profession::find($request->input('id'));
        $p->name = e($request->input('name'));
        $p->level = e($request->input('level'));
        if($p->save()){
            return redirect(route('sigac.academic_coordination.programming.parameters.index'))->with(['success'=> trans('sigac::profession.Profession_Edited_Successfully')]);
        }else{
            return redirect(route('sigac.academic_coordination.programming.parameters.index'))->with(['error'=> trans('sigac::profession.Error_Editing_Profession')]);
        }
    }

    public function profession_destroy($id){
        $p = Profession::find($id);
        if($p->delete()){
            return redirect(route('sigac.academic_coordination.programming.parameters.index'))->with(['success'=> trans('sigac::profession.Profession_Successfully_Eliminated')]);
        }else{
            return redirect(route('sigac.academic_coordination.programming.parameters.index'))->with(['error'=> trans('sigac::profession.Error_Deleting_Profession')]);
        }
    }

    // Registrar actividad externa
    public function external_activity_store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message' => 'Ocurrió un error con el formulario.', 'typealert' => 'danger']);
        }
        // Realizar registro
        if (ExternalActivity::create($request->all())) {
            return redirect()->back()->with(['success' => 'Actividad externa registrada exitosamente']);
        } else {
            return redirect()->back()->with(['error' => 'Error al registrar la actividad externa']);
        }
        return redirect()->back()->with(['error' => 'Ocurrio algun error']);
    }

    // Actualizar actividad externa
    public function external_activity_update(Request $request)
    {
        $e = ExternalActivity::find($request->input('id'));
        $e->name = e($request->input('name'));
        $e->description = e($request->input('description'));
        if ($e->save()) {
            return redirect()->back()->with(['success' => 'Actividad externa actualizada exitosamente']);
        } else {
            return redirect()->back()->with(['error' => 'Error al actualizar la actividad externa']);
        }
        return redirect()->back()->with(['error' => 'Ocurrio algun error']);
    }

    // Eliminar actividad externa
    public function external_activity_destroy($id)
    {
        // Obtener la actividad por su ID
        $e = ExternalActivity::findOrFail($id);

        // Realizar la eliminación
        $e->delete();

        return redirect()->back()->with('success', 'Actividad externa eliminada exitosamente');
    }

    // Registrar competencia
    public function competence_store(Request $request)
    {
        $rules = [
            'program_id' => 'required',
            'name' => 'required|string|max:255',
            'hour' => 'required|numeric',
            'type' => 'required|string',
            'code' => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message' => 'Ocurrió un error con el formulario.', 'typealert' => 'danger']);
        }

        if (Competencie::create($request->all())) {
            $icon = 'success';
            $message_profession = 'Se agrego la competencia correctamente.';
        } else {
            $icon = 'error';
            $message_profession = 'Error al añadir la competencia.';
        }
        return redirect(route('sigac.academic_coordination.programming.parameters.index'))->with(['icon' => $icon, 'message_profession' => $message_profession]);
    }

    // Actualizar competencia
    public function competence_update(Request $request)
    {
        $c = Competencie::find($request->input('id'));
        $c->program_id = e($request->input('program_id'));
        $c->name = e($request->input('name'));
        $c->hour = e($request->input('hour'));
        $c->type = e($request->input('type'));
        $c->code = e($request->input('code'));

        if ($c->save()) {
            return redirect()->back()->with('success', 'Registro actualizado correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrio un error al actualizar el registro');
        }
    }

    // Eliminar competencia
    public function competence_destroy($id)
    {
        $c = Competencie::find($id);
        if ($c->delete()) {
            return redirect()->back()->with('success', 'Registro eliminado correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al elimminar el registro');
        }
    }

    // Registrar resultado de aprendizaje
    public function learning_outcome_store(Request $request)
    {
        $rules = [
            'competencie_id' => 'required',
            'name' => 'required|string|max:255',
            'hour' => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message' => 'Ocurrió un error con el formulario.', 'typealert' => 'danger']);
        }

        if (LearningOutcome::create($request->all())) {
            $icon = 'success';
            $message_profession = 'Se agrego el resultado de aprendizaje correctamente.';
        } else {
            $icon = 'error';
            $message_profession = 'Error al añadir el resultado de aprendizaje.';
        }
        return redirect(route('sigac.academic_coordination.programming.parameters.index'))->with(['icon' => $icon, 'message_profession' => $message_profession]);
    }

    // Actualizar resultado de aprendizaje
    public function learning_outcome_update(Request $request)
    {
        $l = LearningOutcome::find($request->input('id'));
        $l->competencie_id = e($request->input('competencie_id'));
        $l->name = e($request->input('name'));
        $l->hour = e($request->input('hour'));

        if ($l->save()) {
            return redirect()->back()->with('success', 'Registro actualizado correctamente');
        } else {
            return redirect()->back()->with('error', 'Ocurrio un error al actualizar el registro');
        }
    }

    // Eliminar Resultado de aprendizaje
    public function learning_outcome_destroy($id)
    {
        $l = LearningOutcome::find($id);
        if ($l->delete()) {
            return redirect()->back()->with('success', 'Registro eliminado correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al elimminar el registro');
        }
    }

    public function dates_index(){
        $titleView = 'Fechas';
        $titlePage = 'Fechas';

        return view('sigac::programming.dates')->with([
            'titlePage' => $titlePage,
            'titleView' => $titleView, 
        ]);
    }

    public function store_dates(Request $request){
        $days = $request->days;
        $fechas = [];
        $fechaActual = Carbon::parse($request->start_date);
        while ($fechaActual->lte(Carbon::parse($request->end_date))) {
            if (in_array($fechaActual->englishDayOfWeek, $days)) {
                $fechas[] = $fechaActual->toDateString();
            }
            $fechaActual->addDay();
        }

        $course_id = $request->course;
       

        foreach ($fechas as $f) {
            $programming = InstructorProgram::where('date', $f)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('start_time', '>=', $request->start_time)
                        ->where('start_time', '<=', $request->end_time);
                })
                ->orWhere(function ($q) use ($request) {
                    $q->where('end_time', '>=', $request->start_time)
                        ->where('end_time', '<=', $request->end_time);
                })
                ->orWhere(function ($q) use ($request) {
                    $q->where('start_time', '<=', $request->start_time)
                        ->where('end_time', '>=', $request->end_time);
                });
            })
            ->where('person_id', $request->instructor)
            ->where('environment_id', $request->environment)
            ->where('course_id', $course_id)
            ->exists();

            $holidays = Holiday::where('date', $f)->exists();

            if($programming || $holidays){
                $fechas_no_registradas[] = $f;
                continue;
            }

            $quarterlies = Quarterly::with('learning_outcome.competencie','learning_outcome.people.professions')
            ->where('learning_outcome_id', $request->learning_outcome)
            ->whereHas('training_project.courses', function ($query) use ($course_id) {
                $query->where('courses.id', $course_id);
            })->pluck('id')->first();

            $p = new InstructorProgram;
            $p->date = $f;
            $p->start_time = $request->start_time;
            $p->end_time = $request->end_time;
            $p->person_id = $request->instructor;
            $p->course_id = $request->course;
            $p->environment_id = $request->environment;
            $p->quarterlie_id = $quarterlies;
            $p->save(); 
        }

        if (!empty($fechas_no_registradas)) {
            $hora_inicio = $request->start_time;
            $hora_fin = $request->end_time;
            $mensaje = 'No se pudieron registrar las siguientes fechas: ' . implode(', ', $fechas_no_registradas) . ', ya hay programación para estas fechas entre estas horas: ' . $hora_inicio . ' - ' . $hora_fin . '.';
            return redirect(route('sigac.academic_coordination.programming.dates_index'))->with(['error'=> $mensaje]);
        } else {
            $mensaje = 'Programación creada con éxito.';
            return redirect(route('sigac.academic_coordination.programming.dates_index'))->with(['success'=> $mensaje]);
        }

    }
}
