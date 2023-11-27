<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\EnvironmentalAspect;
use Modules\SICA\Entities\ProductiveUnit;

class AssignAspectsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function consul()
    {
        $productive_unit = ProductiveUnit::orderBy('name', 'ASC')->get();
        return view('hdc::AssignEnvironmentalAspect.ConsultEnvironmentalAspect', compact('productive_unit'));

    }

    public function addaspects()
    {
        $productive_unit = ProductiveUnit::orderBy('name', 'ASC')->get();

        return view('hdc::AssignEnvironmentalAspect.AddAspects', compact('productive_unit'));

    }

    public function AspectActivities()
    {
        $datap = json_decode(($_POST['data']));
        // Obtener las actividades relacionadas con la unidad productiva
        $activities = ProductiveUnit::findOrFail($datap->productive_unit_id)->activities;
        return view('hdc::AssignEnvironmentalAspect.Activity', compact('activities'));
    }

    public function Aspect()
    {

        $data = json_decode($_POST['data']);
        $environmentalAspect = EnvironmentalAspect::get();

        return view('hdc::AssignEnvironmentalAspect.EnvironmentalAspects', compact('environmentalAspect'));
    }
    public function getEnvironmentalAspects($activityId)
    {
        $activity = Activity::find($activityId);

        // Obtén los aspectos ambientales asociados a la actividad
        $associatedEnvironmentalAspects = $activity->environmental_aspects()->pluck('environmental_aspects.id')->toArray();

        return response()->json($associatedEnvironmentalAspects);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hdc::create');
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
        return view('hdc::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('hdc::edit');
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
