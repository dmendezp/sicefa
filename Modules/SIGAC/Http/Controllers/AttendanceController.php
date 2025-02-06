<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Modules\SIGAC\Entities\InstructorProgram;
use Modules\SIGAC\Entities\AttendanceApprentice;

use Modules\SICA\Entities\Person;
use Carbon\Carbon;

class AttendanceController extends Controller
{

    public function attendance_index() {
        $user = Auth::user();
        $instructor = $user->person->id;
        $dateactual = Carbon::now(); // Obtenemos la fecha y hora actual
        $date = $dateactual->toDateString();
        // Obtener solo la hora actual
        $currentTime = $dateactual->toTimeString();
        
        $list = InstructorProgram::with('course.apprentices.person.attendance_apprentices')
            ->whereHas('instructor_program_people', function ($query) use ($instructor) {
                $query->where('person_id', $instructor);
            })
            ->where('date', $date)
            ->get();

        return view('sigac::attendances.attendance.index')->with(['instructor_programs'=> $list,
        'titlePage'=>trans('Registro de Asistencia'), 
        'titleView'=>trans('Registro de Asistencia'),
        'currentDate'=> $date
        ]);
    }

    public function attendance_search(Request $request) {
        $user = Auth::user();
        $instructor = $user->person->id;
        $date = $request->input('date');
        
        $list = InstructorProgram::with('course.apprentices.person.attendance_apprentices')
            ->whereHas('instructor_program_people', function ($query) use ($instructor) {
                $query->where('person_id', $instructor);
            })
            ->where('date', $date)
            ->get();

        return view('sigac::attendances.attendance.table')->with(['instructor_programs'=> $list,
        'currentDate'=> $date
        ]);
    }

    public function attendance_store(Request $request)
    {
        $person_id = $request->input('person_id');
        $state = $request->input('state');
        $date = $request->input('date');
        $instructor_program_id = $request->input('instructor_program_id');

        // Verificar si el usuario existe
        $user = Person::find($person_id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $attendance = AttendanceApprentice::where('person_id', $person_id)
        ->where('instructor_program_id', $instructor_program_id)
        ->where('date', $date)
        ->first();

        if ($attendance) {
            $attendance->state = $state; // Estado tomado de la solicitud
            $attendance->save();
        } else {
            // Tomar la asistencia
            $attendance = new AttendanceApprentice();
            $attendance->person_id = $person_id;
            $attendance->state = $state; // Estado tomado de la solicitud
            $attendance->date = $date;
            $attendance->instructor_program_id = $instructor_program_id;
            $attendance->save();
        }

       

        return response()->json(['message' => 'Asistencia tomada con éxito'], 200);
    }
    

    /* Consultar Excusas de Aprendiz */
    public function consult_excuses()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_consult_excuses_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_consult_excuses_title_view')];
        return view('sigac::attendance.excuses', $view);
    }

    /* Consultar Asistencia de Aprendiz o Titulada */
    public function consult_attendance()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_consult_attendance_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_consult_attendance_title_view')];
        return view('sigac::attendance.index', $view);
    }

    /* Registrar asistencia de aprendiz por titulada */
    public function index()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_register_attendance_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_register_attendance_title_view')];
        return view('sigac::attendance.register', $view);
    }
    
    /* Vista principal para la sección de reportes de asistencia */
    public function reports_attendance()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_reports_attendance_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_reports_attendance_title_view')];
        return view('sigac::reports.index', $view);
    }
}