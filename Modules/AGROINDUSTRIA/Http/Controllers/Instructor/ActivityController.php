<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Instructor;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\ProductiveUnit;

class ActivityController extends Controller
{
    public function activity($unit)
    {
        session(['viewing_unit' => $unit]);
        $selectedUnit = ProductiveUnit::findOrFail($unit);
        session(['viewing_unit_name' => $selectedUnit->name]);

        $activities = Activity::where('productive_unit_id', $unit)->get();
        $data = ['title' =>trans('agroindustria::menu.Activities'), 'activities' =>$activities];
        return view('agroindustria::instructor.activity',$data);
    } 
}
