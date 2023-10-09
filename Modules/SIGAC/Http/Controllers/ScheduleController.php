<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\App;

class ScheduleController extends Controller
{
    public function schedule_instructor()
    {
        $view = ['titlePage'=>trans('sigac::sInstructor.TitlePage'), 'titleView'=>trans('sigac::sInstructor.TitleView')];
        $apps = App::get();
        return view('sigac::schedule.instructor', compact('apps', 'view'));
    }

    public function schedule_titled()
    {
        $view = ['titlePage'=>trans('sigac::sApprentice.TitlePage'), 'titleView'=>trans('sigac::sApprentice.TitleView')];
        $apps = App::get();
        return view('sigac::schedule.titled', compact('apps', 'view'));
    }

    public function schedule_apprentice()
    {
        $view = ['titlePage'=>trans('sigac::sApprentice.TitlePage'), 'titleView'=>trans('sigac::sApprentice.TitleView')];
        $apps = App::get();
        return view('sigac::schedule.apprentice', compact('apps', 'view'));
    }
}
