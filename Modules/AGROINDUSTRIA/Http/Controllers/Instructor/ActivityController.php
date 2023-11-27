<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\instructor;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;

class ActivityController extends Controller
{
    public function activity()
    {
        $selectedUnit = session('viewing_unit');
        $activities = Activity::where('productive_unit_id', $selectedUnit)->get();
        $data = ['title' =>trans('agroindustria::menu.Activities'), 'activities' =>$activities];
        return view('agroindustria::instructor.activity',$data);
    } 
}
