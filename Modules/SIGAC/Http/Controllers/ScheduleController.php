<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;

class ScheduleController extends Controller
{
    public function schedule_instructor()
    {
        $view = ['titlePage'=>trans('sigac::sInstructor.TitlePage'), 'titleView'=>trans('sigac::sInstructor.TitleView')];
        return view('sigac::schedule.instructor', compact('view'));
    }

    public function schedule_titled()
    {
        $view = ['titlePage'=>trans('sigac::sApprentice.TitlePage'), 'titleView'=>trans('sigac::sApprentice.TitleView')];
        return view('sigac::schedule.titled', compact('view'));
    }

    public function schedule_apprentice()
    {
        $view = ['titlePage'=>trans('sigac::sApprentice.TitlePage'), 'titleView'=>trans('sigac::sApprentice.TitleView')];
        return view('sigac::schedule.apprentice', compact('view'));
    }
}
