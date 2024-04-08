<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\LearningOutcome;
use Modules\SICA\Entities\Competence;
use Modules\SIGAC\Entities\TrainingProject;
use Modules\SIGAC\Entities\Quarterly;

class CurriculumPlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

     // Proyecto formativo
    public function training_project_index()
    {
        $learning_outcomes = LearningOutcome::pluck('name','id'); 
        return view('sigac::curriculum_planning.training_project.index')->with(['titlePage'=>trans('Proyecto Formativo'), 'titleView'=>trans('Proyecto Formativo'), 'learning_outcomes' => $learning_outcomes]);
    }
    // Registrar proyecto formativo
    public function training_project_store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'execution_time' => 'required|numeric',
            'total_result' => 'required|numeric',
            'objective' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $training_project =  new TrainingProject;
        $training_project->name = $request->name;
        $training_project->execution_time = $request->execution_time;
        $training_project->total_result = $request->total_result;
        $training_project->objective = $request->objective;
        $training_project->save();

        return back()->with('success', "Proyecto formativo registrado exitosamente");
    }


    public function quarterlie_index()
    {
        $quarterlies = Quarterly::with('learning_outcome.competencie')->get();
        return view('sigac::curriculum_planning.quarterlie.index')->with(['titlePage'=>trans('Trimestralización'), 'titleView'=>trans('Trimestralización'),'quarterlies' => $quarterlies]);
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
