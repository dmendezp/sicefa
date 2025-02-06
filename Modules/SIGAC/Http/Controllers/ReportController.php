<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SIGAC\Entities\Quarterly;
use Modules\SIGAC\Entities\InstructorProgram;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\LearningOutcome;
use Modules\SICA\Entities\Competencie;
use Modules\SICA\Entities\Person;
use Modules\SIGAC\Entities\EnvironmentInstructorProgram;
use Modules\SICA\Entities\Environment;
use Modules\SIGAC\Entities\InstitucionalRequest;
use Modules\SIGAC\Entities\InstructorProgramOutcome;
use Modules\SICA\Entities\ClassEnvironment;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function report_quarterlie_index () 
    {
        $courses = Course::orderBy('code','Asc')->get()->mapWithKeys(function ($course) {
            return [$course->id => $course->program->name . ' - ' . $course->code];
        });
        return view('sigac::reports.quarterlies.index')->with(['titlePage' => 'Consultar trimestralización',
        'titleView' => 'Consultar trimestralización',
        'courses'=>$courses]);
    }
     
    public function report_quarterlie_search(Request $request){
        $course_id = $request->input('course_id');
        $quarterlies = Quarterly::with('training_project.courses.program', 'learning_outcome.competencie', 'learning_outcome.people.professions', 'learning_outcome.instructor_program_outcomes.instructor_program.instructor_program_people.person')
            ->whereHas('training_project.courses', function ($query) use ($course_id) {
                $query->where('courses.id', $course_id);
            })
            ->get()
            ->groupBy(function ($quarterly) {
                
                $competencieName = $quarterly->learning_outcome->competencie->name;
                return str_replace('-' . $quarterly->quarter_number, '', $competencieName);
            })
            ->map(function ($grouped) {
                // Ahora agrupa por el nombre del learning_outcome en lugar de por learning_outcome_id
                return $grouped->groupBy(function ($item) {
                    return $item->learning_outcome->name;
                });
            });

            
        $instructor_programs = InstructorProgram::where('course_id', $course_id)->get();
    
        $executedHours = [];
        $executedHoursCompetency = [];

        $uniqueHours = [];
        $uniqueHoursCompetencie = [];

        foreach ($instructor_programs as $ins) {
            foreach ($ins->instructor_program_outcomes as $outcome) {
                $quarterNumber = intval($ins->quarter_number); // El trimestre al que pertenece el instructor_program
                $learningOutcome = $outcome->learning_outcome_id;
                $learningOutcomeName = $outcome->learning_outcome->name;
                $competencie = $outcome->learning_outcome->competencie->name;
                $outcomeHours = $outcome->hour;
        
                // Inicializa la entrada para el trimestre si no existe
                if (!isset($executedHours[$quarterNumber])) {
                    $executedHours[$quarterNumber] = [];
                }

                 // Inicializa la entrada para el trimestre si no existe
                 if (!isset($executedHoursCompetency[$quarterNumber])) {
                    $executedHoursCompetency[$quarterNumber] = [];
                }
        
                // Inicializa la entrada para el resultado de aprendizaje si no existe
                if (!isset($executedHours[$quarterNumber][$learningOutcomeName])) {
                    $executedHours[$quarterNumber][$learningOutcomeName] = 0;
                }
        
                // Inicializa la entrada para la competencia si no existe
                if (!isset($executedHoursCompetency[$quarterNumber][$learningOutcome][$competencie])) {
                    $executedHoursCompetency[$quarterNumber][$learningOutcome][$competencie] = 0;
                }
        
                // Crea un identificador único para la combinación de resultado de aprendizaje y horas
                $uniqueKey = $quarterNumber . '-' . $learningOutcomeName . '-' . $outcomeHours;
                $uniqueCompetencie = $quarterNumber . '-' . $competencie . '-' . $learningOutcome . '-' . $outcomeHours;
        
                // Solo suma si esta combinación de horas no ha sido procesada previamente
                if (!isset($uniqueHours[$uniqueKey])) {
                    // Suma la hora y marca esta combinación como procesada
                    $executedHours[$quarterNumber][$learningOutcomeName] += $outcomeHours;
                    
                    // Marca esta combinación como ya sumada
                    $uniqueHours[$uniqueKey] = true;
                }

                if (!isset($uniqueHoursCompetencie[$uniqueCompetencie])) {
                    // Suma la hora y marca esta combinación como procesada
                    $executedHoursCompetency[$quarterNumber][$learningOutcome][$competencie] += $outcomeHours;
                    $uniqueHoursCompetencie[$uniqueCompetencie] = true;
                }                
            }
        }
    
        $course = Course::findOrFail($course_id);
        $courseNumber = $course->program->quarter_number;
        $programId = $course->program->id;

        $learning_outcomes_select = LearningOutcome::whereHas('competencie.program', function ($query) use ($programId) {
            $query->where('id', $programId);
        })->pluck('name', 'id');

        $competences_select = Competencie::whereHas('program', function ($query) use ($programId) {
            $query->where('id', $programId);
        })->pluck('name', 'id');


        return view('sigac::reports.quarterlies.table')->with([
            'titlePage' => trans('Trimestralización'),
            'titleView' => trans('Trimestralización'),
            'quarterlies' => $quarterlies,
            'courseNumber' => $courseNumber,
            'programId' => $programId,
            'learning_outcomes_select' => $learning_outcomes_select,
            'competences_select' => $competences_select,
            'course_id' => $course_id,
            'instructor_programs' => $instructor_programs,
            'executedHours' => $executedHours,
            'executedHoursCompetency' => $executedHoursCompetency
        ]);
    }

    public function instructors_index(){
        return view('sigac::reports.instructors.index')->with([
            'titlePage' => 'Consultar datos de instructores',
            'titleView' => 'Consultar datos de instructores',          
        ]);
    }

    public function instructors_search(Request $request){
        $day = $request->day;

        $instructor_program = InstructorProgram::with('instructor_program_people.person', 'environment_instructor_programs.environment')
        ->where('date', $day)
        ->get()
        ->groupBy(function ($instructor_name) {
                foreach ($instructor_name->instructor_program_people as $ip) {
                        return $ip->person->first_name . ' ' . $ip->person->first_last_name. ' '. $ip->person->second_last_name;
                }
        });

        $instructor_emails = $instructor_program->map(function ($programs) {
            foreach ($programs as $program) {
                foreach ($program->instructor_program_people as $ip) {
                    $emails[] = $ip->person->sena_email;
                }
            }
            return array_unique($emails);
        });

        $instructor_telephones = $instructor_program->map(function ($programs) {
            foreach ($programs as $program) {
                foreach ($program->instructor_program_people as $ip) {
                    $telephones[] = $ip->person->telephone1 . "\n" . $ip->person->telephone2;
                }
            }
            return array_unique($telephones);
        });


        return view('sigac::reports.instructors.table')->with([
            'titlePage' => 'Consultar datos de instructores',
            'titleView' => 'Consultar datos de instructores',        
            'instructor_program' => $instructor_program,
            'instructor_emails' => $instructor_emails,
            'instructor_telephones' => $instructor_telephones
        ]);
    }

    public function environments_index(){
        return view('sigac::reports.environments.index')->with([
            'titlePage' => 'Consultar disponibilidad de ambientes',
            'titleView' => 'Consultar disponibilidad de ambientes',          
        ]);
    }

    public function environments_search(Request $request){
        $day = $request->day;

        $instructor_program = InstructorProgram::with('environment_instructor_programs.environment', 'instructor_program_people.person')
        ->where('date', $day)
        ->orderBy('created_at', 'Asc')
        ->get();

        $id = [];

        foreach ($instructor_program as $p) {
            $id[] = $p->id;
        }

        $programmedEnvironmentIds = EnvironmentInstructorProgram::whereIn('instructor_program_id', $id)->pluck('environment_id')->toArray();

        $extern = ClassEnvironment::where('name', 'Externo')->pluck('id')->toArray();

        // Obtener los ambientes que NO están programados
        $unprogrammedEnvironments = Environment::whereNotIn('id', $programmedEnvironmentIds)->whereNotIn('class_environment_id', $extern)->get();

        $d = $unprogrammedEnvironments->map(function ($u){
            $id = $u->id;
            $name = $u->name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un ambiente'])->pluck('name', 'id');

        return view('sigac::reports.environments.table')->with([
            'instructor_program' => $instructor_program,
            'unprogrammedEnvironments' => $d,
            'environments' => $unprogrammedEnvironments
        ]);
    }

    public function search_person (Request $request){
        $term = $request->input('applicant');
        $persons = Person::whereRaw("CONCAT(first_name, ' ', first_last_name, ' ', second_last_name) LIKE ?", ['%' . $term . '%'])->get();

        
        $results = [];
        foreach ($persons as $person) {
            $results[] = [
                'id' => $person->id,
                'text' => $person->first_name . ' ' . $person->first_last_name . ' ' . $person->second_last_name,
            ];
        }

        return response()->json($results);
    }

    public function institucional_request_store(Request $request){
        try {
            $institucional_request = $request->has('institucional_request') ? 1 : 0;
            $applicant = $request->input('applicant');
            $reason = $request->input('reason');
            $date = $request->input('date');
            $start_time = $request->input('start_time');
            $end_time = $request->input('end_time');
            $instructor_program_id = $request->input('program_id');
            $environment = $request->input('environment');
            $start_time_environment = $request->input('start_time_environment');
            $end_time_environment = $request->input('end_time_environment');

            if($institucional_request == 1){
                $i = new InstitucionalRequest;
                $i->person_id = $applicant;
                $i->reason = $reason;
                $i->date = $date;
                $i->start_time = $start_time;
                $i->end_time = $end_time;
                $i->save();

                $environment_instructor_program = EnvironmentInstructorProgram::where('instructor_program_id', $instructor_program_id)->first();
                $environment_instructor_program->environment_id = $environment;
                $environment_instructor_program->save();

                $mensaje = 'Se reasigno el ambiente correctamente';
                return response()->json(['success' => $mensaje]);
            }else{
                $environment_instructor_program = EnvironmentInstructorProgram::where('instructor_program_id', $instructor_program_id)->first();
                $environment_instructor_program->environment_id = $environment;
                $environment_instructor_program->save();

                $mensaje = 'Se reasigno el ambiente correctamente';
                return response()->json(['success' => $mensaje]);            
            }
            
            
        } catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=> 'Error al eliminar la programación']);

        }
    }

    public function active_courses_index(){
        return view('sigac::reports.active_courses.index')->with([
            'titlePage' => 'Fichas activas',
            'titleView' => 'Fichas Activas'        
        ]);
    }

    public function active_courses_search(Request $request){

        $quarterlie = $request->input('quarterlie');

        if (isset($quarterlie)) {
            $active_courses = Course::where('status', 'Activo')->whereHas('instructor_programs', function ($query) use ($quarterlie) {
                $query->where('quarter_number', $quarterlie);
            })->with('program', 'instructor_programs', 'person')->get();
    
            return view('sigac::reports.active_courses.table')->with([
                'courses' => $active_courses
            ]);
        }else{
            $active_courses = Course::where('status', 'Activo')->with('program', 'instructor_programs', 'person')->get();
            return view('sigac::reports.active_courses.table')->with([
                'courses' => $active_courses    
            ]);
        }


       
    }
}
