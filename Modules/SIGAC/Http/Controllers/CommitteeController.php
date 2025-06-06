<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Competencie;
use Modules\SICA\Entities\LearningOutcome;
use Modules\SIGAC\Entities\MissingCommittee;
use Modules\SIGAC\Entities\ApprenticeNovelty;
use Modules\SIGAC\Entities\LearningOutcomeCommittee;
use Modules\SIGAC\Entities\CommitteeStaff;
use Modules\SIGAC\Entities\EvaluationCommittee;
use Modules\SICA\Entities\Apprentice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function missing_index()
    {
        $missings = MissingCommittee::get();
        return view('sigac::committee.missing.index')->with([
            'titlePage' => trans('Faltas Cometidas'),
            'titleView' => trans('Faltas Cometidas'),
            'missings' => $missings,
        ]);
    }

    // Registrar Falta Cometida
    public function missing_store(Request $request)
    {
       
        $missing = new MissingCommittee;
        $missing->name = e($request->input('name'));
        $missing->type = e($request->input('type'));
        if ($missing->save()) {
            return redirect()->back()->with(['success' => 'Falta registrada exitosamente']);
        } else {
            return redirect()->back()->with(['error' => 'Error al registrar el Falta']);
        }
        return redirect()->back()->with(['error' => 'Ocurrio algun error']);
    }

    // Actualizar Falta Cometida
    public function missing_update(Request $request)
    {
        $missing = MissingCommittee::find($request->input('id'));
        $missing->name = e($request->input('name'));
        $missing->type = e($request->input('type'));
        if ($missing->save()) {
            return redirect()->back()->with(['success' => 'Falta actualizado exitosamente']);
        } else {
            return redirect()->back()->with(['error' => 'Error al actualizar el Falta']);
        }
        return redirect()->back()->with(['error' => 'Ocurrio algun error']);
    }

    // Eliminar Falta Cometida
    public function missing_destroy($id)
    {
        // Obtener el programa especial por su ID
        $missing = MissingCommittee::findOrFail($id);

        // Realizar la eliminación
        $missing->delete();

        return redirect()->back()->with('success', 'Falta eliminado exitosamente');
    }

    public function novelty_index ()
    {
        $apprentice_novelties = ApprenticeNovelty::get();

        return view('sigac::committee.apprentice_novelty.index')->with([
            'titlePage' => trans('Gestion de Novedades'),
            'titleView' => trans('Gestion de Novedades'),
            'apprentice_novelties' => $apprentice_novelties,
        ]);

        
    }

    public function novelty_create ()
    {
        $competences_select = Competencie::pluck('name','id');
        $missings = MissingCommittee::pluck('name','id');
        return view('sigac::committee.apprentice_novelty.create')->with([
            'titlePage' => trans('Reportar Novedad del Aprendiz'),
            'titleView' => trans('Reportar Novedad del Aprendiz'),
            'missings' => $missings,
            'competences_select' => $competences_select,
        ]);
    }

    public function searchapprentice(Request $request)
    {
        $term = $request->input('q');

        // Buscar al aprendiz
        $persons = Person::whereRaw("CONCAT(first_name, ' ', first_last_name, ' ', second_last_name) LIKE ?", ['%' . $term . '%'])
        ->whereHas('apprentices')
        ->get();

        $results = [];
        foreach ($persons as $person) {
            $results[] = [
                'id' => $person->id,
                'text' => $person->first_name . ' ' . $person->first_last_name . ' ' . $person->second_last_name,
            ];
        }

        return response()->json($results);
    }

    public function searchmissing(Request $request)
    {
        $missing_id = $request->input('missing');

        // Buscar la falta
        $missing = MissingCommittee::where('id',$missing_id)->pluck('type');

        return response()->json($missing);
    }

    public function searchlearning(Request $request)
    {

        $learning_outcome = LearningOutcome::get();

        return response()->json(['learning_outcome' => $learning_outcome->toArray()]);
    }

    public function novelty_store (Request $request) {
        $apprentice = $request->apprentice_id;
        $apprentice_id = Apprentice::where('person_id',$apprentice)->pluck('id')->first();
        $user = Auth::user();
        $instructor_id = $user->person->id;
        $missing_committee_id = $request->missing_id;
        $type = $request->type;
        $observation = $request->observation;
        $learning_outcomes = $request->learning_outcome_id;

        $apprentice_noveltie = new ApprenticeNovelty;
        $apprentice_noveltie->apprentice_id = $apprentice_id;
        $apprentice_noveltie->person_id = $instructor_id;
        $apprentice_noveltie->missing_committee_id = $missing_committee_id;
        $apprentice_noveltie->type = $type;
        $apprentice_noveltie->observation = $observation;
        $apprentice_noveltie->state = 'Pendiente';
        $apprentice_noveltie->save();
        $apprentice_novelty_id = $apprentice_noveltie->id;

        if ($learning_outcomes) {
            foreach ($learning_outcomes as $index => $learning_outcome_id) {
                $learning_outcome_committee = new LearningOutcomeCommittee;
                $learning_outcome_committee->apprentice_novelty_id = $apprentice_novelty_id;
                $learning_outcome_committee->learning_outcome_id = $learning_outcome_id;
                $learning_outcome_committee->save();
            }
        }

        return redirect()->back()->with('success','Novedad Registrada');
        
    }

    public function committee_create ($id)
    {
        $apprentice_novelty = ApprenticeNovelty::findOrFail($id);
        $missings = MissingCommittee::pluck('name','id');
        return view('sigac::committee.create')->with([
            'titlePage' => trans('Realizar Seguimiento'),
            'titleView' => trans('Realizar Seguimiento'),
            'missings' => $missings,
            'apprentice_novelty' => $apprentice_novelty,
        ]);
    }

    public function committee_store(Request $request)
    {
        try {
            $apprentice_novelty_id = $request->novelty_id;
            $apprentice_novelty = ApprenticeNovelty::findOrFail($apprentice_novelty_id);

            $date = $request->date;
            $start_time = $request->start_time;
            $end_time = $request->end_time;
            $person_ids = $request->person_id;
            $learning_outcomes = $request->learning_outcome_id;

            // Verificar si ya existe un comité
            $isScheduled = EvaluationCommittee::where('date', $date)
                ->where(function ($query) use ($start_time, $end_time) {
                    $query->where(function ($q) use ($start_time, $end_time) {
                        $q->where('start_time', '<=', $end_time)
                            ->where('end_time', '>=', $start_time);
                    });
                })
                ->exists();

            if ($isScheduled) {
                return redirect()->back()->with('error', 'El comité ya está programado para esta fecha y hora.');
            }

            DB::beginTransaction();

            $evaluation_committee = new EvaluationCommittee;
            $evaluation_committee->apprentice_novelty_id = $apprentice_novelty_id;
            $evaluation_committee->date = $date;
            $evaluation_committee->start_time = $start_time;
            $evaluation_committee->end_time = $end_time;
            $evaluation_committee->state = 'Programado';
            $evaluation_committee->save();

            foreach ($person_ids as $person_id) {
                $committee_staff = new CommitteeStaff;
                $committee_staff->evaluation_committee_id = $evaluation_committee->id;
                $committee_staff->person_id = $person_id;
                $committee_staff->role = 'Comite';
                $committee_staff->save();
            }

            DB::commit();

            return redirect()->back()->with('success', 'Comité programado exitosamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al programar el comité.');
        }
    }

    public function searchperson(Request $request)
    {
        $term = $request->input('q');

        // Buscar al aprendiz
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

    public function answer_create ($id)
    {
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
        })->prepend(['id' => null, 'name' => trans('Seleccione el instructor')])->pluck('name', 'id');

        $evaluation_committee = EvaluationCommittee::where('apprentice_novelty_id',$id)->first();
        $evaluation_committee_id = $evaluation_committee->id;

        return view('sigac::committee.answer')->with([
            'titlePage' => trans('Respuesta del Comite de Evaluación'),
            'titleView' => trans('Respuesta del Comite de Evaluación'),
            'instructors' => $instructors,
            'evaluation_committee' => $evaluation_committee,
            'evaluation_committee_id' => $evaluation_committee_id
        ]);
    }

    public function answer_store (Request $request) {

        $type = $request->type;
        $evaluation_committee_id = $request->evaluation_committee_id;
        $evaluation_committee = EvaluationCommittee::findOrFail($evaluation_committee_id);
        $apprentice_novelty_id = $evaluation_committee->apprentice_novelty_id;
        $apprentice_novelty = ApprenticeNovelty::findOrFail($apprentice_novelty_id);

        if ($type == 'Plan de Mejoramiento') {
            $instructor = $request->instructor;

            $committee_staff = new CommitteeStaff;
            $committee_staff->evaluation_committee_id = $evaluation_committee_id;
            $committee_staff->person_id = $instructor;
            $committee_staff->role = 'Plan Mejoramiento';
            $committee_staff->save();

            $evaluation_committee->state = 'Concluido';
            $evaluation_committee->save();

            $apprentice_novelty->state = 'Plan Mejoramiento';
            $apprentice_novelty->save();
        } else {
            $answer = $request->answer;

            $evaluation_committee->state = 'Concluido';
            $evaluation_committee->answer = $answer;
            $evaluation_committee->save();

            $apprentice_novelty->state = 'Resuelta';
            $apprentice_novelty->save();

        }

        return redirect()->route('sigac.academic_coordination.committee.novelty.index')->with('success','Comite Concluido');
        
    }

    public function committee_consult ()
    {
        return view('sigac::committee.reports.apprentice')->with([
            'titlePage' => trans('Reporte Novedad del Aprendiz'),
            'titleView' => trans('Reporte Novedad del Aprendiz'),
        ]);
    }

    public function committee_result (Request $request)
    {
       $person_id = $request->apprentice_id;
       $apprentice_id = Apprentice::where('person_id',$person_id)->pluck('id');
       $apprentice_novelties = ApprenticeNovelty::where('apprentice_id',$apprentice_id)->get();
       return view('sigac::committee.reports.result')->with([
        'apprentice_novelties' => $apprentice_novelties
       ]);
    }
}
