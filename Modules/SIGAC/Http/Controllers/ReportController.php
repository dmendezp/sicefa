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
     
     public function report_quarterlie_search(Request $request)
    {
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
            'competences_select' => $competences_select
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

        foreach ($instructor_program as $p) {
            $id[] = $p->id;
        
            $programmedEnvironmentIds = EnvironmentInstructorProgram::whereIn('instructor_program_id', $id)->pluck('environment_id')->toArray();

            // Obtener los ambientes que NO están programados
            $unprogrammedEnvironments = Environment::whereNotIn('id', $programmedEnvironmentIds)->pluck('name', 'id');
        }

        return view('sigac::reports.environments.table')->with([
            'instructor_program' => $instructor_program,
            'unprogrammedEnvironments' => $unprogrammedEnvironments    
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

}
