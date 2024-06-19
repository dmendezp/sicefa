<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SIGAC\Entities\Quarterly;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\LearningOutcome;
use Modules\SICA\Entities\Competencie;

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
        $quarterlies = Quarterly::with('training_project.courses.program', 'learning_outcome.competencie', 'learning_outcome.people.professions','learning_outcome.instructor_program_outcomes.instructor_program.instructor_program_people.person')
            ->whereHas('training_project.courses', function ($query) use ($course_id) {
                $query->where('courses.id', $course_id);
            })
            ->get()
            ->groupBy(function ($quarterly) {
                $competencieName = $quarterly->learning_outcome->competencie->name;
                return str_replace('-' . $quarterly->quarter_number, '', $competencieName);
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

    public function index()
    {
        return view('sigac::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sigac::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('sigac::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sigac::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
