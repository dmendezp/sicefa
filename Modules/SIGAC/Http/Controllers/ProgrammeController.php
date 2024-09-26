<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\SICA\Entities\Employee;
use Modules\SICA\Entities\Contractor;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Country;
use Modules\SICA\Entities\Department;
use Modules\SICA\Entities\LearningOutcomePerson;
use Modules\SICA\Entities\Municipality;
use Modules\SICA\Entities\Holiday;
use Modules\SIGAC\Entities\InstructorProgram;
use Modules\SIGAC\Entities\ExternalActivity;
use Modules\SIGAC\Entities\Profession;
use Modules\SIGAC\Entities\Quarterly;
use Modules\SIGAC\Entities\SpecialProgram;
use Modules\SIGAC\Entities\ProgramRequest;
use Modules\SIGAC\Entities\ProgramRequestDate;
use Modules\SIGAC\Entities\InstructorProgramNovelty;
use Modules\SIGAC\Entities\ProgramNovelty;
use Modules\SIGAC\Entities\InstructorProgramPerson;
use Modules\SIGAC\Entities\EnvironmentInstructorProgram;
use Modules\SIGAC\Entities\InstructorProgramOutcome;
use Modules\SIGAC\Entities\ProgramRequestDocument;
use DB;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Competencie;
use Modules\SICA\Entities\LearningOutcome;
use Modules\SICA\Entities\KnowledgeNetwork;
use Modules\SICA\Entities\Network;
use Modules\SICA\Entities\Line;
use Carbon\Carbon;
use Modules\SIGAC\Imports\ApprenticeLearningOutcomeImport;
use Modules\SIGAC\Imports\ProgramImport;
use Modules\SIGAC\Exports\ProgramCourseExport;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Excel, Exception;
use Illuminate\Support\Str;

class ProgrammeController extends Controller
{
    // Programación de horarios
    public function programming()
    {
        $app = App::where('name', 'SIGAC')->orWhere('name', 'CEFAMAPS')->get();

        foreach ($app as $a) {
            $app_id[] = $a->id;
        }

        $user = Auth::user();
        $roles = '';
        if($user){
            $slug  = Role::whereIn('app_id', $app_id)
            ->whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->pluck('slug')->first();        
    
            if($slug == 'sigac.academic_coordinator' || $slug == 'superadmin'){
                $roles = 'academic_coordination';
            }else{
                $roles = Str::replaceFirst('sigac.', '', $slug);
            }
        }
        

        $days = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miercoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo'
        ];

        $quarter = [
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
        ];

        $holidays = Holiday::get();

        $view = [
            'titlePage' => trans('sigac::controllers.SIGAC_programming_schedules_title_page'),
            'titleView' => trans('sigac::controllers.SIGAC_programming_schedules_title_view'),
            'days' => $days,
            'quarter' => $quarter,
            'holidays' => json_encode($holidays),
            'role' => $roles
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

        $executed_programming = InstructorProgramOutcome::whereHas('instructor_program', function($query) use ($course_id){
            $query->where('instructor_programs.course_id', $course_id);
        })
        ->select('learning_outcome_id', \DB::raw('hour as total_executed_hours'))
        ->groupBy('hour', 'learning_outcome_id')
        ->pluck('total_executed_hours', 'learning_outcome_id')
        ->toArray();

        

        $outcomes_not_programming = Quarterly::with('learning_outcome.competencie', 'learning_outcome.instructor_program_outcomes.instructor_program')
        ->whereHas('training_project.courses', function($query) use ($course_id) {
            $query->where('courses.id', $course_id);
        })
        ->where('quarter_number', '<', $quarter_number)
        ->get() // Obtener todos los resultados relevantes
        ->filter(function ($quarterly) use ($executed_programming) {
            $learning_outcome_id = $quarterly->learning_outcome_id;
            $planned_hours = $quarterly->hour; // Horas planeadas en 'Quarterly'
            $executed_hours = $executed_programming[$learning_outcome_id] ?? 0; // Horas ejecutadas o 0 si no existe

            // Incluir si el resultado no ha sido ejecutado o si las horas ejecutadas son menores a las horas planeadas
            return $executed_hours < $planned_hours;
        })
        ->groupBy(function ($quarterly) use ($quarter_number) {
            $competencieName = $quarterly->learning_outcome->competencie->name;
            return str_replace('-' . $quarter_number, '', $competencieName); // Agrupar por nombre de competencia
        });
    
        debug($outcomes_not_programming);

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

    
        return response()->json(['quarterlie' => $quarterlie, 'outcomes_not_programming' => $outcomes_not_programming]);
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
        $admin = $request->input('admin');
        

        if ($admin == 'true') {
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
                    'first_name' => $name
                ];
            });
        } else {
            $instructors = Person::join('learning_outcome_people', 'people.id', '=', 'learning_outcome_people.person_id')
            ->where('learning_outcome_people.learning_outcome_id', $learning_outcome_id)
            ->orderBy('learning_outcome_people.priority', 'asc')
            ->get(['people.id', 'people.first_name']);
        }
    
        return response()->json(['instructors' => $instructors]);
    }
    

    public function management_programming_filterenvironment(Request $request)
    {
        $admin = $request->input('admin');
        $learning_outcome = LearningOutcome::findOrfail($request->input('learning_outcome_id')) ;
        $competencie_id = $learning_outcome->competencie->id;

        if ($admin == 'true') {
            $environments = Environment::get()->pluck('name','id');
        } else {
            $environments = Environment::whereHas('class_environment.competencies', function($query) use ($competencie_id) {
                $query->where('competencies.id', $competencie_id);
            })->pluck('name','id');
            
        }


        return response()->json(['environments' => $environments->toArray()]);
    }

    public function management_programming_filterstatelearning(Request $request)
    {
        $learning_outcome_id = $request->input('learning_outcome_id');
        $course_id = $request->input('course_id');

        // Obtener la lista de programas de instructor asociados al resultado de aprendizaje
        $instructor_programs = InstructorProgram::whereHas('instructor_program_outcomes', function($query) use ($learning_outcome_id) {
            $query->where('learning_outcome_id', $learning_outcome_id);
        })
        ->where('course_id', $course_id)
        ->get();

        // Verificar si el resultado de aprendizaje está programado
        if ($instructor_programs->isEmpty()) {
            // El resultado de aprendizaje no está programado
            $message = 'No programado';
        } else {
            // El resultado de aprendizaje está programado
            $message = 'Programado';
            // Recorrer los programas de instructor para obtener la información de fecha y hora
            $scheduled_info = [];
            foreach ($instructor_programs as $program) {
                foreach ($program->instructor_program_outcomes as $outcome) {
                    // Verificamos que sea el resultado de aprendizaje seleccionado
                    if ($outcome->learning_outcome_id == $learning_outcome_id) {
                        // Sumamos las horas de este resultado de aprendizaje
                        $hours = $outcome->hour;
            
                        // Guardamos la información programada para este resultado de aprendizaje
                        $scheduled_info[] = [
                            'date' => $program->date,
                            'hours' => $hours,
                            'start_time' => $program->start_time,
                            'end_time' => $program->end_time
                        ];
            
                        // Rompemos el ciclo porque solo necesitamos registrar una vez el resultado de aprendizaje seleccionado
                        break;
                    }
                }
            }
        }

        return response()->json([
            'status' => $message,
            'scheduled_info' => $scheduled_info ?? null
        ]);
    }

    // Registrar programacion
    public function management_programming_store(Request $request)
    {
        $days = $request->days;
        $modality = $request->has('modality') ? 1 : 0;
        $fechas = [];
        $fechaActual = Carbon::parse($request->start_date);
        while ($fechaActual->lte(Carbon::parse($request->end_date))) {
            if (in_array($fechaActual->englishDayOfWeek, $days)) {
                $fechas[] = $fechaActual->toDateString();
            }
            $fechaActual->addDay();
        }

        $course_id = $request->course;
        $instructors = $request->instructor;
        $environments = $request->environment;
        $learning_outcomes = $request->learning_outcome;
        $hours = $request->hour;
        $querter_number = $request->querter_number;

        $c_modality = Course::findOrFail($course_id);

        foreach ($fechas as $f) {
            if($modality == 1 || $c_modality->deschooling == 'Virtual'){
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
                ->whereHas('instructor_program_people', function ($query) use ($instructors) {
                    $query->whereIn('person_id', $instructors);
                })
                ->where('course_id', $course_id)
                ->exists();
            }else{
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
                ->whereHas('instructor_program_people', function ($query) use ($instructors) {
                    $query->whereIn('person_id', $instructors);
                })
                ->whereHas('environment_instructor_programs', function ($query) use ($environments) {
                    $query->whereIn('environment_id', $environments);
                })
                ->where('course_id', $course_id)
                ->exists();
            }

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

            try {
                DB::beginTransaction();

                if($modality == 1 || $c_modality->deschooling == 'Virtual'){
                    $p = new InstructorProgram;
                    $p->date = $f;
                    $p->start_time = $request->start_time;
                    $p->end_time = $request->end_time;
                    $p->course_id = $request->course;
                    $p->quarter_number = $querter_number;
                    $p->state = 'Programado';
                    $p->modality = 'Medios Tecnologicos';
                    $p->save();
                    $instructor_program_id = $p->id;
                }else{
                    $p = new InstructorProgram;
                    $p->date = $f;
                    $p->start_time = $request->start_time;
                    $p->end_time = $request->end_time;
                    $p->course_id = $request->course;
                    $p->quarter_number = $querter_number;
                    $p->state = 'Programado';
                    $p->modality = 'Presencial';
                    $p->save();
                    $instructor_program_id = $p->id;
                    
                    foreach ($environments as $index => $environment_id) {
                        $environment_instructor_programs = new EnvironmentInstructorProgram;
                        $environment_instructor_programs->instructor_program_id = $instructor_program_id;
                        $environment_instructor_programs->environment_id = $environment_id;
                        $environment_instructor_programs->save();
                    }
                }

                foreach ($instructors as $index => $instructor_id) {
                    $instructor_program_people = new InstructorProgramPerson;
                    $instructor_program_people->instructor_program_id = $instructor_program_id;
                    $instructor_program_people->person_id = $instructor_id;
                    $instructor_program_people->save();
                }
                
                foreach ($learning_outcomes as $index => $learning_outcome_id) {
                    $hour = $hours[$index];
                    $instructor_program_outcomes = new InstructorProgramOutcome;
                    $instructor_program_outcomes->instructor_program_id = $instructor_program_id;
                    $instructor_program_outcomes->learning_outcome_id = $learning_outcome_id;
                    $instructor_program_outcomes->hour = $hour;
                    $instructor_program_outcomes->state = 'Pendiente';
                    $instructor_program_outcomes->save();
                }

                DB::commit();
            } catch (\Exception $e) {
                // En caso de error, realiza un rollback de la transacción y maneja el error
                DB::rollBack();
                $mensaje = 'Ocurrio un error al registrar la programación.';
                return redirect()->back()->with(['error'=> $mensaje]);
    
                \Log::error('Error en el registro: ' . $e->getMessage());
                \Log::error('Error en el registro: ' . $e->getTraceAsString());
            }
        }

        if (!empty($fechas_no_registradas)) {
            $hora_inicio = $request->start_time;
            $hora_fin = $request->end_time;
            $mensaje = 'No se pudieron registrar las siguientes fechas: ' . implode(', ', $fechas_no_registradas) . ', ya hay programación para estas fechas entre estas horas: ' . $hora_inicio . ' - ' . $hora_fin . '.';
            return redirect()->back()->with(['success'=> $mensaje]);
        } else {
            $mensaje = 'Programación creada con éxito.';
            return redirect()->back()->with(['success'=> $mensaje]);
        }
    }

    public function management_programming_search_course(Request $request){
        $term = $request->get('code_course');
        $course = Course::where('code', 'LIKE', '%' . $term . '%')
        ->get();

        foreach ($course as $c) {
            $name = $c->program->name;
        }
        return response()->json([
            'program' => $name,
        ]);
    }

    public function management_programming_destroy(Request $request){
        try {
            $instructor = $request->input('person_id');
            $code_course = $request->input('code_course');
            $quarter = $request->input('quarter');
            $daysSelected = $request->input('days');
            
            $year = Carbon::now()->year; 
            
            $daysOfWeek = [
                'Sunday' => Carbon::SUNDAY,
                'Monday' => Carbon::MONDAY,
                'Tuesday' => Carbon::TUESDAY,
                'Wednesday' => Carbon::WEDNESDAY,
                'Thursday' => Carbon::THURSDAY,
                'Friday' => Carbon::FRIDAY,
                'Saturday' => Carbon::SATURDAY,
            ];
           
            
            $dayOfWeek = $daysOfWeek[$daysSelected] ?? null;
            
            // Verificar si el día es válido
            if ($dayOfWeek !== null) {
                $datesForDay = [];

                // Generar las fechas para el año actual directamente
                $startDate = Carbon::create($year, 1, 1); // Inicio del año
                $endDate = Carbon::create($year, 12, 31); // Fin del año

                $period = CarbonPeriod::create($startDate, $endDate);
                
                foreach ($period as $date) {
                    if ($date->dayOfWeek === $dayOfWeek) {
                        $datesForDay[] = $date->format('Y-m-d'); // Agregar la fecha al array
                    }
                }

                $instructor_program_ids = InstructorProgram::where('quarter_number', $quarter)
                ->whereIn('date', $datesForDay)
                ->whereHas('course', function ($query) use ($code_course) {
                    $query->where('code', $code_course);
                })
                ->whereHas('instructor_program_people.person', function ($query) use ($instructor) {
                    $query->where('id', $instructor);
                })->pluck('id'); // Obtener solo los IDs

                if($instructor_program_ids->isEmpty()){
                    return redirect()->back()->with(['error'=> 'No existe programación del trimestre '. $quarter .' para el día '. $daysSelected .'.']);
                }else{
                    InstructorProgram::whereIn('id', $instructor_program_ids)->delete();
                    $mensaje = 'Programación eliminada con éxito.';
                    return redirect()->back()->with(['success'=> $mensaje]);
                }

                // Eliminar los registros usando los IDs obtenidos
            } else {
                return redirect()->back()->with(['error'=> 'Error al eliminar la programación']);
            }


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error'=> 'Error al eliminar la programación']);
        }  
    }

    public function management_search_quarter_number(Request $request){

        $course_id = $request->input('course_id');

        $course = Course::findOrFail($course_id);
        $quarter_number = $course->program->quarter_number;

        $modality = $course->deschooling;

        // Crear una colección con números desde 1 hasta quarter_number
        $results = collect(range(1, $quarter_number));
        

        return response()->json([
            'results' => $results,
            'modality' => $modality
        ]);
    }

    public function management_filter(Request $request){

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
                ->select('people.id', DB::raw('CONCAT(people.first_name, " ", people.first_last_name, " ", people.second_last_name) as name'))
                ->union(
                    DB::table('contractors')
                        ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                        ->join('people', 'contractors.person_id', '=', 'people.id')
                        ->whereIn('employee_types.name', $employeeTypeNames)
                        ->select('people.id', DB::raw('CONCAT(people.first_name, " ", people.first_last_name) as name'))
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

    public function management_search(Request $request)
    {

        $filter = $request->input('search');
        $option = $request->input('option');

        if ($option == 1) {

            $programmingEvents = InstructorProgram::with('instructor_program_people.person', 'course.program', 'course.municipality.department','environment_instructor_programs.environment','instructor_program_outcomes.learning_outcome','instructor_program_novelties')->whereHas('instructor_program_people.person', function ($query) use ($filter) {
                $query->where('id', $filter);
            })
            ->where('state','=','Programado')
            ->get();
        } elseif ($option == 2) {
            $programmingEvents = InstructorProgram::with('instructor_program_people.person', 'course.program', 'course.municipality.department', 'environment_instructor_programs.environment','instructor_program_outcomes.learning_outcome')->whereHas('environment_instructor_programs.environment', function ($query) use ($filter) {
                $query->where('id', $filter);
            })
            ->where('state','=','Programado')
            ->get();
        } else {
            $programmingEvents = InstructorProgram::with('instructor_program_people.person', 'course.program', 'course.municipality.department','environment_instructor_programs.environment','instructor_program_outcomes.learning_outcome')->whereHas('course', function ($query) use ($filter) {
                $query->where('id', $filter);
            })
            ->where('state','=','Programado')
            ->get();
        }


        foreach ($programmingEvents as $programmingEvent) {
            foreach ($programmingEvent->instructor_program_people as $asociacion) {
                $name = $asociacion->person->fullname;
            }
            
            $parts = explode(' ', $name); // Dividir el nombre completo en palabras individuales
            $initials = '';

            foreach ($parts as $part) {
                $initials .= strtoupper(substr($part, 0, 1)); // Tomar la primera letra de cada palabra y convertirla a mayúsculas
            }

            foreach ($programmingEvent->instructor_program_people as $asociacion) {
                $asociacion->person->initials = $initials; // Agregar las iniciales al objeto de persona en el evento de programación
            }

            
        }

        // Construir una cadena de texto que contenga todas las iniciales
        $allInitials = '';
        foreach ($programmingEvents as $programmingEvent) {
            foreach ($programmingEvent->instructor_program_people as $asociacion) {
                $allInitials .= $asociacion->person->initials;
            }
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
        $external_activities = ExternalActivity::get();
        $special_programs = SpecialProgram::get();

        $titlePage = 'Parametros';
        $titleView = 'Parametros';
        return view('sigac::programming.parameters.index')->with(['titlePage' => $titlePage,
        'titleView' => $titleView, 
        'external_activities' => $external_activities, 
        'professions' => Profession::all(), 
        'special_programs' => $special_programs]);
    }
  
    /* Consultar programas de manera asincrónica*/
    public function program_search(){
        $data = Program::with('knowledge_network')->latest()->get();
        $programsselect = $data->map(function ($p) {
            $id = $p->id;
            $name = $p->name;
            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un programa'])->pluck('name', 'id');
        Session::put('programs', $programsselect);
        return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = '
                        <a class="btn btn-primary" href="'.route('sigac.academic_coordination.programming.competence.index', ['program_id' => $id]).'" data-toggle="tooltip" data-placement="top" title="Ver competencias">
                        <i class="fa-solid fa-outdent"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function parameter_competencies($program_id)
    {
        $programs = Session::get('programs');
        $program = Program::findOrFail($program_id);
        $name = $program->name;
        $competencies = Competencie::where('program_id',$program_id)->get();
        $titlePage = 'Parametros - Competencia';
        $titleView = 'Parametros - Competencia';
        return view('sigac::programming.parameters.competences.table')->with(['titlePage' => $titlePage,
        'titleView' => $titleView, 
        'program_id' => $program_id,
        'programs' => $programs,
        'nameprogram' => $name,
        'competencies' => $competencies]);
    }

    public function parameter_learning_outcomes($competencie_id, $program_id)
    {
        $Comps = Competencie::all();
        $competencies = $Comps->map(function ($c) {
            $id = $c->id;
            $name = $c->name;
            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una competencia'])->pluck('name', 'id');
        $competencie = Competencie::findOrFail($competencie_id);
        $name_competencia = $competencie->name;
        $learning_outcomes = LearningOutcome::where('competencie_id',$competencie_id)->get();
        $titlePage = 'Parametros - Resultado de aprendizaje';
        $titleView = 'Parametros - Resultado de aprendizaje';
        return view('sigac::programming.parameters.learning_outcomes.table')->with(['titlePage' => $titlePage,
        'titleView' => $titleView, 
        'competencie_id' => $competencie_id,
        'learning_outcomes' => $learning_outcomes, 
        'program_id' => $program_id,
        'namecompetencie' => $name_competencia,
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

    // Registrar programa especial
    public function special_program_store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message' => 'Ocurrió un error con el formulario.', 'typealert' => 'danger']);
        }
        // Realizar registro
        if (SpecialProgram::create($request->all())) {
            return redirect()->back()->with(['success' => 'Programa especial registrado exitosamente']);
        } else {
            return redirect()->back()->with(['error' => 'Error al registrar el Programa especial']);
        }
        return redirect()->back()->with(['error' => 'Ocurrio algun error']);
    }

    // Actualizar programa especial
    public function special_program_update(Request $request)
    {
        $special = SpecialProgram::find($request->input('id'));
        $special->name = e($request->input('name'));
        if ($special->save()) {
            return redirect()->back()->with(['success' => 'Programa especial actualizado exitosamente']);
        } else {
            return redirect()->back()->with(['error' => 'Error al actualizar el Programa especial']);
        }
        return redirect()->back()->with(['error' => 'Ocurrio algun error']);
    }

    // Eliminar programa especial
    public function special_program_destroy($id)
    {
        // Obtener el programa especial por su ID
        $special = SpecialProgram::findOrFail($id);

        // Realizar la eliminación
        $special->delete();

        return redirect()->back()->with('success', 'Programa especial eliminado exitosamente');
    }

    // Registrar competencia
    public function competence_store(Request $request)
    {
        $rules = [
            'program_id' => 'required',
            'name' => 'required|string',
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
            'name' => 'required|string',
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
        return redirect()->back()->with(['icon' => $icon, 'message_profession' => $message_profession]);
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

    public function learning_outcome_load_create($program_id){
        $nameprogram = Program::where('id','=',$program_id)->pluck('name')->first();
		return view('sigac::programming.parameters.learning_outcomes.load')->with(['titlePage' => 'Cargar Resultados de Aprendizaje',
            'titleView' => 'Cargar Resultados de Aprendizaje',
            'program_id' => $program_id,
            'nameprogram' => $nameprogram
        ]);
	}

    /* Registrar aprendices a partir de un archivo */
    public function learning_outcome_load_store(Request $request){
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
            $program_name = $array[0][4][2]; // Obtener la ficha del curso y el nombre del programa en un arreglo
            $course_code = $array[0][1][2];
            $datas = array_splice($array[0], 12, count($array[0])); // Obtener solo los registros de los datos de los aprendices
            try {
                $count = 0;

                DB::beginTransaction();
                // Recorrer datos y relizar registros
                $program_id = $request->program_id;
                $program = Program::findOrFail($program_id);
                $nameprogramselected = $program->name;

                if ($nameprogramselected != $program_name) {
                    DB::rollBack(); // Devolver cambios realizados durante la transacción
                    return back()->with('error', 'El programa ingresado ('. $program_name.') para el registro de los resultados no coincide con el seleccionado ('.$nameprogramselected.').')->with('typealert', 'danger');
                }
               
                foreach($datas as $data){
                    $competencie = explode(" - ", $data[5]);
                    if ($competencie) {
                        if (count($competencie) > 1) {
                            $code_competencie = $competencie[0];
                            // Si hay más de una parte después de dividir por el guión
                            $name_competencia = trim(preg_replace('/^[0-9\s\-\x{2022}\x{0095}\t]+/u', '', $competencie[1])); // Eliminar números y espacios al principio de la cadena
                            
                        } else {
                            // Si no hay un guión, entonces tomar el nombre completo sin modificar
                            $name_competencia = trim($competencie[0]);
                        }

                    }
                    $learning_outcome = explode(" - ", $data[6]); // Dividir la cadena por el guión ('-')
                    if ($learning_outcome) {
                        if (count($learning_outcome) > 1) {
                            // Si hay más de una parte después de dividir por el guión
                            $name_learning = trim(preg_replace('/^[0-9\s\-\x{2022}\x{0095}\t]+/u', '', $learning_outcome[1]));
                        } else {
                            // Si no hay un guión, entonces tomar el nombre completo sin modificar
                            $name_learning = trim($learning_outcome[0]);
                        }
                        $competenciefind = Competencie::where('name', '=', $name_competencia)->where('program_id',$program_id)->first();

                        if ($competenciefind) {
                            $competencie_id = $competenciefind->id;
                        } else {
                            $competencies = new Competencie;
                            $competencies->program_id = $program_id;
                            $competencies->code = $code_competencie;
                             // Convierte la frase a minúsculas
                            $name_competencia = mb_strtolower($name_competencia, 'UTF-8');
                            // Capitaliza la primera letra
                            $name_competencia = mb_strtoupper(mb_substr($name_competencia, 0, 1), 'UTF-8') . mb_substr($name_competencia, 1);
                            $competencies->name = $name_competencia;
                            $competencies->hour = 0;
                            $competencies->type = 'Técnico';
                            $competencies->save();
                            $competencie_id = $competencies->id;
                        }

                        $learning_outcome = LearningOutcome::where('name', '=', $name_learning)->whereHas('competencie', function($query) use ($program_id) {
                            $query->where('program_id', $program_id);
                        })->first();
                        
                        if ($learning_outcome) {
                            $learning_outcome_id = $learning_outcome->id;
                        } else {
                            $learning_outcomes = new LearningOutcome;
                            $learning_outcomes->competencie_id = $competencie_id;

                            // Convierte la frase a minúsculas
                            $name_learning = mb_strtolower($name_learning, 'UTF-8');

                            // Capitaliza la primera letra
                            $name_learning = mb_strtoupper(mb_substr($name_learning, 0, 1), 'UTF-8') . mb_substr($name_learning, 1);

                            // Asigna el nombre convertido al campo correspondiente
                            $learning_outcomes->name = $name_learning;

                            $learning_outcomes->hour = 0;
                            $learning_outcomes->save();
                            $count++;

                        }
                    }
                }

                DB::commit();
                
                return back()->with('success', 'Archivo excel escaneado coerrectamente. '.$count.' Resultados registrados exitosamente.')->with('typealert', 'success');
            } catch (Exception $e) {
                DB::rollBack(); // Devolver cambios realizados durante la transacción
                return back()->with('error', 'Ocurrio un error en la importación y/o registro de datos del archivo excel cargado. <hr> <strong>Error: </strong> ('.$e->getMessage().').')->with('typealert', 'danger');
             }

        }
    }

    public function program_load_create(){
	
		return view('sigac::programming.parameters.competences.load')->with(['titlePage' => 'Cargar Programas',
        'titleView' => 'Cargar Programas'
        ]);
	}


    public function program_export(){
	
		return Excel::download(new ProgramCourseExport, 'programs.xlsx');

	}

    /* Registrar aprendices a partir de un archivo */
    public function program_load_store(Request $request){
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
            $datas = array_splice($array[0], 1, count($array[0]));
            try {
                $count = 0;
                // Recorrer datos y relizar registros
               
                DB::beginTransaction();

                foreach($datas as $data){
                    $sofia_code = $data[0];
                    $version = $data[1];
                    $training_type = $data[3];
                    $name = str_replace('.', '', $data[4]);
                    $maximum_duration = $data[6];
                    $program_type = $data[5];
                    $name_line = $data[19];
                    $name_network = $data[20];
                    $name_knowledge_network = $data[21];
                    $modality = $data[22];
                    $priority_bets = $data[23];
                    $fic = $data[24];
                    $file_meses_lectiva = explode(".", $data[25]);
                    $meses_lectiva = $file_meses_lectiva[0];
                    $file_meses_productiva = explode(".", $data[26]);
                    $meses_productiva = $file_meses_productiva[0];
                    $file_quarter_number = explode(".", $data[27]);
                    $quarter_number = $file_quarter_number[0];
                    $knowledge_network = KnowledgeNetwork::where('name', '=', $name_knowledge_network)->first();

                    

                    if ($knowledge_network) {
                        $knowledge_network_id = $knowledge_network->id;
                    } else {

                        $network = Network::where('name', '=', $name_network)->first();

                        if ($network) {
                            $network_id = $network->id;
                        } else {
                            $line = Line::where('name', '=', $name_line)->first();

                            if ($line) {
                                $line_id = $line->id;
                            } else {
                                $l = new Line;
                                $l->name = $name_line;
                                $l->save();
                                $line_id = $l->id;
                            }
                            $networ = new Network;
                            $networ->name = $name_network;
                            $networ->line_id = $line_id;
                            $networ->save();
                            $network_id = $networ->id;
                        }

                        $knowledge = new KnowledgeNetwork;
                        $knowledge->name = $name_knowledge_network;
                        $knowledge->network_id = $network_id;
                        $knowledge->save();
                        $knowledge_network_id = $knowledge->id;
                    }

                    $program = Program::where('name', '=', $name)->where('program_type', '=', $program_type)->first();

                    if ($program) {
                        $program->sofia_code = $sofia_code;
                        $program->version = $version;
                        $program->training_type = $training_type;
                        $program->maximum_duration = $maximum_duration;
                        $program->modality = $modality;
                        $program->priority_bets = $priority_bets;
                        $program->fic = $fic;
                        $program->knowledge_network_id = $knowledge_network_id;
                        $program->months_lectiva = $meses_lectiva;
                        $program->months_productiva = $meses_productiva;
                        $program->quarter_number = $quarter_number;
                        $program->save();
                    } else {
                        $program = new Program;
                        $program->sofia_code = $sofia_code;
                        $program->version = $version;
                        $program->training_type = $training_type;
                        $program->name = $name;
                        $program->quarter_number = $quarter_number;
                        $program->knowledge_network_id = $knowledge_network_id;
                        $program->program_type = $program_type;
                        $program->maximum_duration = $maximum_duration;
                        $program->modality = $modality;
                        $program->priority_bets = $priority_bets;
                        $program->fic = $fic;
                        $program->months_lectiva = $meses_lectiva;
                        $program->months_productiva = $meses_productiva;
                        $program->save();
                        $count++;
                    }
                }

                DB::commit();
                
                return back()->with('success', 'Archivo excel escaneado coerrectamente. '.$count.' Programas registrados exitosamente.')->with('typealert', 'success');
            } catch (Exception $e) {
                DB::rollBack(); // Devolver cambios realizados durante la transacción
                \Log::error('Error en el registro: ' . $e->getMessage());
                return back()->with('error', 'Ocurrio un error en la importación y/o registro de datos del archivo excel cargado. <hr> <strong>Error: </strong> ('.$e->getMessage().').')->with('typealert', 'danger');
             }

        }
    }

    public function program_request_table(){
        $user = Auth::user();
        $person_id = $user->person->id;
        foreach($user->roles as $u){
            $rol = $u->slug;
        }
        if ($rol == 'sigac.instructor') {
            $program_request = ProgramRequest::with('person', 'program', 'special_program', 'program_request_documents')
            ->where('person_id', $person_id)
            ->where('state', 'Pendiente')
            ->orWhere('state', 'Cancelado')
            ->get();
        }elseif ($rol == 'sigac.academic_coordinator' || checkRol('superadmin')) {
            $program_request = ProgramRequest::with('person', 'program', 'special_program', 'program_request_documents')
            ->where('state', 'Pendiente')
            ->orWhere('state', 'Cancelado')
            ->get();
        }
        return view('sigac::programming.program_request.table', [
            'titlePage' => trans('Solicitudes de programa'),
            'titleView' => trans('Solicitudes de programa'),
            'program_requests' => $program_request
        ]);
    }

    // Solicitar programa
    public function program_request_index()
    {
        $program = Program::orderBy('sofia_code','Asc')->get()->mapWithKeys(function ($program) {
            return [$program->id => $program->name . ' - ' . $program->sofia_code];
        });
        $program_especial = SpecialProgram::orderBy('name','Asc')->get()->mapWithKeys(function ($program_especial) {
            return [$program_especial->id => $program_especial->name];
        });

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

        $country_id = Country::where('name','=','Colombia')->pluck('id');
        $department_id = Department::where('country_id',$country_id)->pluck('id');
        $municipalities = Municipality::whereIn('department_id',$department_id)->orderBy('name','Asc')->get()->mapWithKeys(function ($munipality) {
            return [$munipality->id => $munipality->name];
        });

        $today = Carbon::today();

        // Obtener los festivos de la tabla 'holidays' que son posteriores a hoy
        $holidays = Holiday::where('date', '>=', $today)->pluck('date')->toArray();

        // Calcular la fecha mínima (5 días hábiles)
        $workingDays = 0;
        $minDate = $today->copy();

        while ($workingDays < 5) {
            $minDate->addDay();

            if ($minDate->isWeekday() && !in_array($minDate->toDateString(), $holidays)) {
                $workingDays++;
            }
        }

        // Calcular la fecha máxima (30 días hábiles)
        $workingDays = 0;
        $maxDate = $minDate->copy();

        while ($workingDays < 30) {
            $maxDate->addDay();

            if ($maxDate->isWeekday() && !in_array($maxDate->toDateString(), $holidays)) {
                $workingDays++;
            }
        }

        $user = Auth::user();
        if($user){
            $idPersona = $user->person->id;
            $name = $user->person->first_name . ' ' . $user->person->first_last_name . ' ' . $user->person->second_last_name;
            
        }

        return view('sigac::programming.program_request.index', [
            'titlePage' => trans('Solicitar Programa'),
            'titleView' => trans('Solicitar Programa'),
            'program'=>$program,
            'instructors' => $instructors,
            'program_especial'=>$program_especial,
            'municipalities'=>$municipalities,
            'minDate' => $minDate->toDateString(),
            'maxDate' => $maxDate->toDateString(),
            'person' => $name
        ]);
    }
    
    // Buscar instructor
    public function program_request_searchperson(Request $request)
    {
        $term = $request->input('name');

        $persons = Person::whereRaw("CONCAT(first_name, ' ', first_last_name, ' ', second_last_name) LIKE ?", ['%' . $term . '%'])->get();

        $results = [];
        foreach ($persons as $person) {
            $results[] = [
                'id' => $person->id,
                'text' => $person->first_name . ' ' . $person->first_last_name,
            ];
        }

        return response()->json($results);
    }

    public function program_request_searchprofession(Request $request)
    {
        try {
            $person_id = $request->input('person_id');

            $professions = Profession::whereHas('people', function ($query) use ($person_id) {
                $query->where('people.id', $person_id);
            })->first();

            $response = [
                'professions' => $professions ?? null,
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function program_request_searchempresa(Request $request)
    {
        $term = $request->get('q');
        $empresas = ProgramRequest::where('empresa', 'LIKE', '%' . $term . '%')
            ->select('empresa as text', 'address') // selecciona solo los campos necesarios
            ->get();

        return response()->json($empresas);
    }

    public function program_request_searchapplicant(Request $request)
    {
        $term = $request->get('q');
        $applicants = ProgramRequest::where('applicant', 'LIKE', '%' . $term . '%')
            ->select('applicant as text', 'email','telephone') // selecciona solo los campos necesarios
            ->get();

        return response()->json($applicants);
    }


    // Registrar solicitud del programa
    public function program_request_store(Request $request)
    {
        try {
            $instructor = $request->input('instructor');
            $program_id = $request->input('program_id');
            $special_program_id = $request->input('program_especial_id');
            $hours = $request->input('total_hours');
            $quota = $request->input('quota');
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $municipality_id = $request->input('municipality_id');
            $dates = $request->input('dates');
            
            $start_times = $request->input('start_time');
            $end_times = $request->input('end_time');
            $observation = $request->input('observation');
            $empresa = $request->input('empresa');
            $address = $request->input('address');
            $applicant = $request->input('applicant');
            $email = $request->input('email');
            $telephone = $request->input('telephone');

            DB::beginTransaction();

            $program_request = new ProgramRequest;
            if(checkRol('sigac.academic_coordinator')){
                $program_request->person_id = $instructor;
            }else{
                $user = Auth::user();
                if($user){
                    $idPersona = $user->person->id;
                    $program_request->person_id = $idPersona;
                }
            }
            $program_request->program_id = $program_id;
            $program_request->special_program_id = $special_program_id;
            $program_request->municipality_id = $municipality_id;
            $program_request->hours = $hours;
            $program_request->start_date = $start_date;
            $program_request->end_date = $end_date ?? null;
            $program_request->quotas = $quota;
            $program_request->address = $address;
            $program_request->observation = $observation ?? null;
            $program_request->empresa = $empresa;
            $program_request->applicant = $applicant;
            $program_request->email = $email;
            $program_request->telephone = $telephone;
            $program_request->state = 'Pendiente';
            $program_request->save();
    
            $conflicting_dates = [];
    
            foreach ($dates as $index => $date) {
                $start_time = $start_times[$index];
                $end_time = $end_times[$index];
    
                $existing_program = InstructorProgram::where('date', $date)
                    ->where(function ($query) use ($start_time, $end_time) {
                        $query->where(function ($query) use ($start_time) {
                            $query->where('start_time', '<=', $start_time)
                                  ->where('end_time', '>=', $start_time);
                        })->orWhere(function ($query) use ($start_time, $end_time) {
                            $query->where('start_time', '<=', $end_time)
                                  ->where('end_time', '>=', $end_time);
                        })->orWhere(function ($query) use ($start_time, $end_time) {
                            $query->where('start_time', '>=', $start_time)
                                  ->where('end_time', '<=', $end_time);
                        });
                    })
                    ->whereHas('instructor_program_people', function ($query) use ($instructor) {
                        $query->where('person_id', $instructor);
                    })
                    ->exists();
    
                if ($existing_program) {
                    DB::rollBack();
                    $conflicting_dates[] = [
                        'date' => $date,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                    ];

                    $conflicting_message = ' No se pudieron registrar las siguientes fechas debido a que ya se encuentran programadas: ';
                    foreach ($conflicting_dates as $conflict) {
                        $conflicting_message .= "\nFecha: " . $conflict['date'] . ", Hora de inicio: " . $conflict['start_time'] . ", Hora de fin: " . $conflict['end_time'];
                    }

                    return redirect()->route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.programming.program_request.index')->with('success', $conflicting_message);
                    
                } else {
                    $program_request_date = new ProgramRequestDate;
                    $program_request_date->program_request_id = $program_request->id;
                    $program_request_date->date = $date;
                    $program_request_date->start_time = $start_time;
                    $program_request_date->end_time = $end_time;
                    $program_request_date->save();

                    if ($request->hasFile('documents')) {
                        $files  = $request->file('documents');
                        foreach ($files  as $file) {
                            if ($file->isValid()) {
                                // Guardar el archivo en el sistema de archivos
                                $path = $file->store('documents');
                                $program_request_document = new ProgramRequestDocument;
                                $program_request_document->program_request_id = $program_request->id;
                                $program_request_document->name = $file->getClientOriginalName();
                                $program_request_document->path = $path;
                                $program_request_document->save();
                            }else {
                                return redirect()->back()->with('error', 'Uno de los archivos no es válido.');
                            }
                        }
                    }
                    
                }
            }
    
            DB::commit();
    
            $success_message = 'Solicitud enviada';
    
            return redirect()->route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.programming.program_request.table')->with('success', $success_message);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            \Log::error('Error en el registro: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor',$e], 500);
        }
    }

    public function program_request_document_store(Request $request, $id)
    {
        try{
            if ($request->hasFile('documents')) {
                $files  = $request->file('documents');
                foreach ($files  as $file) {
                    if ($file->isValid()) {
                        // Guardar el archivo en el sistema de archivos
                        $program_request = ProgramRequest::find($id);
                        $program_request->state = 'Pendiente';
                        $program_request->save();

                        $path = $file->store('documents');
                        $program_request_document = new ProgramRequestDocument;
                        $program_request_document->program_request_id = $program_request->id;
                        $program_request_document->name = $file->getClientOriginalName();
                        $program_request_document->path = $path;
                        $program_request_document->save();
                    }else {
                        return redirect()->back()->with('error', 'Uno de los archivos no es válido.');
                    }
                }
            }    

            DB::commit();

            $success_message = 'Se agregaron los archivos faltantes';
    
            return redirect()->route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.programming.program_request.table')->with('success', $success_message);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error en el registro: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor',$e], 500);
        }
    }

    public function program_request_download($id)
    {
        $documents = ProgramRequestDocument::where('program_request_id', $id)->get();

        if ($documents->isEmpty()) {
            return redirect()->back()->with('error', 'No existen archivos para este programa.');
        }
    
        $zip = new ZipArchive;
        $zipFileName = 'documents.zip';
        $zipFilePath = storage_path('app/' . $zipFileName);
    
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($documents as $document) {
                $filePath = storage_path('app/' . $document->path);
    
                if (file_exists($filePath)) {
                    $filename = $document->name;
    
                    // Evitar nombres duplicados en el ZIP
                    $i = 1;
                    while ($zip->locateName($filename) !== false) {
                        $filename = pathinfo($document->name, PATHINFO_FILENAME) . "_$i." . pathinfo($document->name, PATHINFO_EXTENSION);
                        $i++;
                    }
    
                    // Añadir el archivo al ZIP
                    $zip->addFile($filePath, $filename);
                }
            }
    
            $zip->close();
    
            // Descargar el archivo ZIP y eliminarlo después de la descarga
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return redirect()->back()->with('error', 'No se pudo crear el archivo ZIP.');
        }
    }

    // Solicitudes de caracterización
    public function program_request_characterization()
    {
        $program_requests = ProgramRequest::with(['program_request_dates' => function ($query) {
            $query->orderBy('date', 'asc');
        }])->orderBy('created_at', 'Asc')->get();

        // Agrupar las fechas por hora de inicio y fin
        foreach ($program_requests as $program_request) {
            $groupedDates = $program_request->program_request_dates->groupBy(function ($date) {
                return $date->start_time . '-' . $date->end_time;
            });
            $program_request->groupedDates = $groupedDates;
        }

        return view('sigac::programming.program_request.characterization', [
            'titlePage' => trans('Caracterización'),
            'titleView' => trans('Caracterización'),
            'program_request'=>$program_requests
        ]);


    }

    // Caracterizar programa
    public function program_request_characterization_store(Request $request, $id)
    {
        try {
            $code_course = $request->input('code_course');
            $code_empresa = $request->input('code_empresa');
            $date_inscription = $request->input('date_inscription');
            $date_characterization = Carbon::now()->toDateString();
            DB::beginTransaction();
    
            $program_request = ProgramRequest::with('program_request_dates')->findOrFail($id);
            $program_request->date_inscription = $date_inscription;
            $program_request->code_empresa = $code_empresa;
            $program_request->code_course = $code_course;
            $program_request->date_characterization = $date_characterization;
            $program_request->state = 'Confirmado';
            $program_request->save();

            $course = new Course;
            $course->code = $program_request->code_course;
            $course->star_date = $program_request->start_date;
            $course->end_date = $program_request->end_date;
            $course->status = 'Activo';
            $course->program_id = $program_request->program_id;
            $course->municipality_id = $program_request->municipality_id;
            $course->save();

            foreach ($program_request->program_request_dates as $dates) {
                $instructor_program = new InstructorProgram;
                $instructor_program->date = $dates->date;
                $instructor_program->start_time = $dates->start_time;
                $instructor_program->end_time = $dates->end_time;
                $instructor_program->course_id = $course->id;
                $instructor_program->state = 'Programado';
                $instructor_program->modality = 'Complementaria';
                $instructor_program->save();

                $instructor_program_people = new InstructorProgramPerson;
                $instructor_program_people->instructor_program_id = $instructor_program->id;
                $instructor_program_people->person_id = $program_request->person_id;
                $instructor_program_people->save();
            }

            DB::commit();
    
            return redirect()->route('sigac.support.programming.program_request.characterization.index')->with('success', 'Caracterizacion confirmada');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            \Log::error('Error en el registro: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor',$e], 500);
        }
    }

    // Devolver solicitud
    public function program_request_characterization_devolution(Request $request, $id)
    {
        try {
            $observation = $request->input('observation');
            DB::beginTransaction();
    
            $program_request = ProgramRequest::findOrFail($id);
            $program_request->observation = $observation;
            $program_request->state = 'Cancelado';
            $program_request->save();

            DB::commit();
    
            return redirect()->route('sigac.support.programming.program_request.characterization.index')->with('success', 'Solicitud cancelada');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error en el registro: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor',$e], 500);
        }
    }

    // Novedad de programación
    public function management_programming_novelty(Request $request)
    {
        try {
            $instructor_program_id = $request->input('instructor_program_id');
            $activity = $request->input('activity');
            $observation = $request->input('observation');
            $option = $request->input('option');

            $date = InstructorProgram::where('id', $instructor_program_id)->pluck('date')->first();

            DB::beginTransaction();
                $instructor_program_novelty = new InstructorProgramNovelty;
                $instructor_program_novelty->instructor_program_id = $instructor_program_id;
                $instructor_program_novelty->date = $date;
                $instructor_program_novelty->activity = $activity;
                $instructor_program_novelty->observation = $observation;
                $instructor_program_novelty->save();

                if ($option == 'yes') {
                    $instructor_program = InstructorProgram::findOrFail($instructor_program_id);
                    $instructor_program->state = 'Cancelado';
                    $instructor_program->save();
                }
            DB::commit();
    
            return redirect()->route('sigac.programming.index')->with('success', 'Novedad Enviada');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error en el registro: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor',$e], 500);
        }
    }

    public function external_activities_index(){
        $external_activities = InstructorProgram::with('instructor_program_people.person', 'course')
        ->whereNotNull('activity_name')
        ->where('state', 'Pendiente')
        ->get()
        ->groupBy('activity_name');

        return view('sigac::programming.external_activities.index', [
            'titlePage' => 'Actividades externas',
            'titleView' => 'Actividades externas',
            'external_activities' => $external_activities
        ]);
    }

    public function external_activities_create(){
        $courses = Course::where('status', 'Activo')->where('deschooling', 'Presencial')->get();

        $course = $courses->map(function($c){
            $id = $c->id;
            $name = $c->code . ' - ' . $c->program->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        });

        return view('sigac::programming.external_activities.create', [
            'titlePage' => 'Crear actividades externas',
            'titleView' => 'Crear actividades externas',
            'course' => $course
        ]);
    }

    public function external_activities_search_course(Request $request){
        $name = $request->input('name');

        $courses = Course::where('status', 'Activo')
        ->where('deschooling', 'Presencial')
        ->whereHas('program', function($query) use ($name){
            $query->where('name', 'LIKE', '%'. $name . '%');
        })->get();

        $output = '';
        foreach ($courses as $course) {
            $output .= '<div class="form-check">';
            $output .= '<input type="checkbox" class="form-check-input courses" name="courses[]" value="' . $course->id . '">';
            $output .= '<label class="form-check-label">'. $course->code . ' - ' . $course->program->name . '</label>';
            $output .= '</div>';
        }

        return response()->json($output);
    }

    public function external_activities_search_person(Request $request){
        $term = $request->get('term');
        $persons = Person::whereRaw("CONCAT(first_name, ' ', first_last_name, ' ', second_last_name) LIKE ?", ['%' . $term . '%'])->get();

        $results = [];
        foreach ($persons as $person) {
            $results[] = [
                'id' => $person->id,
                'text' => $person->full_name,
            ];
        }

        return response()->json($results);
    }

    public function external_activities_store(Request $request){   
        $courses = $request->courses;
        $date = $request->date;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $activity_description = $request->description;
        $responsible = $request->responsible;
        $app_id = App::where('name', 'SIGAC')->pluck('id')->first();

        $user = Auth::user();
  
        $slug  = Role::where('app_id', $app_id)
        ->whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->pluck('slug')->first();  
        
        $roles = Str::replaceFirst('sigac.', '', $slug);

        $route = getRoleRouteName(Route::currentRouteName());
        try {

            DB::beginTransaction();

            if($route == 'academic_coordination' || $roles == 'academic_coordinator'){
                foreach($courses as $c){
                    $instructor_program = new InstructorProgram;
                    $instructor_program->course_id = $c;
                    $instructor_program->activity_name = 'Coordinación Académica';
                    $instructor_program->activity_description = $activity_description;
                    $instructor_program->date = $date;
                    $instructor_program->start_time = $start_time;
                    $instructor_program->end_time = $end_time;
                    $instructor_program->state = 'Pendiente';
                    $instructor_program->save();

                    $instructor_program_people = new InstructorProgramPerson;
                    $instructor_program_people->instructor_program_id = $instructor_program->id;
                    $instructor_program_people->person_id = $responsible;
                    $instructor_program_people->save();
                }
            }else if ($route == 'wellness' || $roles == 'wellness'){
                foreach($courses as $c){
                    $instructor_program = new InstructorProgram;
                    $instructor_program->course_id = $c;
                    $instructor_program->activity_name = 'Bienestar';
                    $instructor_program->activity_description = $activity_description;
                    $instructor_program->date = $date;
                    $instructor_program->start_time = $start_time;
                    $instructor_program->end_time = $end_time;
                    $instructor_program->state = 'Pendiente';
                    $instructor_program->save();

                    $instructor_program_people = new InstructorProgramPerson;
                    $instructor_program_people->instructor_program_id = $instructor_program->id;
                    $instructor_program_people->person_id = $responsible;
                    $instructor_program_people->save();
                }
            }
            DB::commit();
                
            
            return redirect()->route('sigac.'. $route .'.programming.external_activities.index')->with('success', 'Actividad externa registrada exitosamente')->with('typealert', 'success');
        } catch (\Exception $e){
            DB::rollBack();
            return back()->with(['error' => 'Error interno del servidor.'], 500);
        }
    }

    public function approved_external_activities(Request $request){
        $ids = $request->input('id'); // Puede ser un único ID o un array de IDs

        // Si es un solo ID, convertirlo en un array
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        // Encontrar todas las actividades con esos IDs
        $instructorPrograms = InstructorProgram::whereIn('id', $ids)->get();

        foreach ($instructorPrograms as $i) {
            $i->state = 'Programado';
            $i->save(); // Guardar cada actividad actualizada
        }

        return redirect()->route('sigac.academic_coordination.programming.external_activities.index')->with('success', 'Actividad externa aprobada exitosamente')->with('typealert', 'success');
    }

    public function cancel_external_activities(Request $request){
        $ids = $request->input('id'); // Puede ser un único ID o un array de IDs

        // Si es un solo ID, convertirlo en un array
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        // Encontrar todas las actividades con esos IDs
        $instructorPrograms = InstructorProgram::whereIn('id', $ids)->get();

        foreach ($instructorPrograms as $i) {
            $i->state = 'Cancelado';
            $i->save(); // Guardar cada actividad actualizada
        }

        return redirect()->route('sigac.academic_coordination.programming.external_activities.index')->with('success', 'Actividad externa no aprobada exitosamente')->with('typealert', 'success');
    }
}