<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttendanceController extends Controller
{

    public function events_attendance()
    {
        $data = ['title'=>trans('sica::menu.Events attendance')];
        return view('sica::admin.people.attendance.home',$data);
    }

}
