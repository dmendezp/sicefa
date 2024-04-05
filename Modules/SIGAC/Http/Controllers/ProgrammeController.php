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
use Modules\SIGAC\Entities\Profession;
use DB;

class ProgrammeController extends Controller
{
    /* Vista principal para la programación de horarios */
    public function programming()
    {
        $view = [
            'titlePage' => trans('sigac::controllers.SIGAC_programming_schedules_title_page'),
            'titleView' => trans('sigac::controllers.SIGAC_programming_schedules_title_view'),
            'programmingEvents' => InstructorProgram::get(),
        ];

        return view('sigac::programming.index', $view);
    }

    /* Vista registro de programación de horarios (Coordinación Académica) */
    public function programming_create()
    {
        // Nombres de los tipos de empleados
        $employeeTypeNames = ['Instructor'];

        // Obtener tanto empleados como contratistas que sean de los tipos especificados
        $instructors = DB::table('employees')
                        ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
                        ->join('people', 'employees.person_id', '=', 'people.id')
                        ->whereIn('employee_types.name', $employeeTypeNames)
                        ->select('people.id','people.first_name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                        ->union(
                            DB::table('contractors')
                                ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                                ->join('people', 'contractors.person_id', '=', 'people.id')
                                ->whereIn('employee_types.name', $employeeTypeNames)
                                ->select('people.id','people.first_name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                        )
                        ->get();

        $environments = Environment::get();

        $courses = Course::with('program')->get();
                    
        return view('sigac::programming.create',[
            'instructors' => $instructors,
            'environments' => $environments,
            'courses' => $courses,
            'titlePage'=>trans('Programación - Crear Programación'),
            'titleView'=>trans('Crear Programación')
            
        ]);
    }

    public function programming_store (Request $request) 
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
                return redirect()->back()->withErrors($validator)->withInput()->with(['error','Error en el formulario']);
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

    public function programming_filter (Request $request) 
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
                            ->select('people.id','people.first_name as name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                            ->union(
                                DB::table('contractors')
                                    ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                                    ->join('people', 'contractors.person_id', '=', 'people.id')
                                    ->whereIn('employee_types.name', $employeeTypeNames)
                                    ->select('people.id','people.first_name as name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
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

    public function programming_get (Request $request) 
    {

        $programmingEvents = InstructorProgram::with('person','course.program','environment')->get();

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

    public function programming_search (Request $request) 
    {

        $filter = $request->input('search');
        $option = $request->input('option');

        if ($option == 1) {
        
        $programmingEvents = InstructorProgram::with('person','course.program','environment')->whereHas('person', function ($query) use ($filter) {
            $query->where('id', $filter);
        })
        ->get();

        } elseif ($option == 2) {
            $programmingEvents = InstructorProgram::with('person','course.program','environment')->whereHas('environment', function ($query) use ($filter) {
                $query->where('id', $filter);
            })
            ->get();

        } else {
            $programmingEvents = InstructorProgram::with('person','course.program','environment')->whereHas('course', function ($query) use ($filter) {
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
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_event_programming_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_event_programming_title_view')];
        return view('sigac::programming.event_programming', $view);
    }

    public function parameter()
    {
        $view = ['titlePage'=>trans('Parametros'), 'titleView'=>trans('Parametros'), 'professions' => Profession::all(),];
        return view('sigac::programming.parameters.index',$view);
    }

    public function profession_store(Request $request){
        $rules = [
            'name' => 'required',
            'level' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Realizar registro
        if (Profession::create($request->all())){
            $icon = 'success';
            $message_profession = 'Se agrego la profesion correctamente.';
        } else {
            $icon = 'error';
            $message_profession = 'Error al añadir la profesión.';
        }
        return redirect(route('sigac.academic_coordination.programming.parameters.index'))->with(['icon'=>$icon, 'message_profession'=>$message_profession]);
    }

    public function profession_update(Request $request){
        $p = Profession::find($request->input('id'));
        $p->name = e($request->input('name'));
        $p->level = e($request->input('level'));
        if($p->save()){
            $icon = 'success';
            $message_profession = 'Profesión editada con exito';
        }else{
            $icon = 'error';
            $message_profession = 'Error al editar la profesión';
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_profession'=>$message_profession]);
    }

    public function profession_destroy(Request $request){
        $p = Profession::find($request->input('id'));
        if($p->delete()){
            $icon = 'success';
            $message_profession = 'Profesión eliminada con exito';
        }else{
            $icon = 'error';
            $message_profession = 'Error al eliminar la profesión';
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_profession'=>$message_profession]);
    }

}
