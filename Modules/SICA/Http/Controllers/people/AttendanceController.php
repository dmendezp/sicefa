<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Event;

class AttendanceController extends Controller
{

    /* Formulario de registro de asistencia a eventos */
    public function index(){
        $events = Event::where('state','Disponible')->pluck('name','id');
        $data = ['title'=>trans('sica::menu.Events attendance'),'events'=>$events];
        return view('sica::admin.people.attendance.index', $data);
    }

}
