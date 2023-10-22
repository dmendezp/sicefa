<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\EnvironmentalAspect;

class assign_environmental_aspectsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function assign_environmental_aspects() {
        $productive_unit = ProductiveUnit::all();
        $activities = Activity::all();
        $environmentalAspect = EnvironmentalAspect::get();
        return view('hdc::Asignar.assign_environmental_aspects', compact('productive_unit' , 'activities', 'environmentalAspect'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hdc::create');
    }

    public function store(Request $request)
    {
        
        // Obtén la actividad seleccionada
        $activity = Activity::find($request->activity_id);

        // Obtén los IDs de los aspectos ambientales seleccionados
        $selectedEnvironmentalAspects = $request->input('Environmental_Aspect', []);

        // Recorre los aspectos ambientales seleccionados y crea una entrada en la tabla pivote
        foreach ($selectedEnvironmentalAspects as $environmentalAspectId) {
            $activity->environmental_aspects()->attach($environmentalAspectId);
        }

        return redirect(route('cefa.hdc.assign_environmental_aspects'));
    }
    

    public function getEnvironmentalAspects($activityId)
{
    $activity = Activity::find($activityId);

    // Obtén los aspectos ambientales asociados a la actividad
    $associatedEnvironmentalAspects = $activity->environmental_aspects()->pluck('environmental_aspects.id')->toArray();

    return response()->json($associatedEnvironmentalAspects);
}

public function updateEnvironmentalAspects(Request $request)
{
    $activity = Activity::find($request->activity_id);

    // Obtén los IDs de los aspectos ambientales seleccionados
    $selectedEnvironmentalAspects = $request->input('Environmental_Aspect', []);

    // Sincroniza los aspectos ambientales en la tabla pivote
    $activity->environmental_aspects()->sync($selectedEnvironmentalAspects);

        return redirect(route('cefa.hdc.assign_environmental_aspects'));
    }


    
}
