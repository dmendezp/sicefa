<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;

class ScheduleController extends Controller
{
    public function schedule_instructor()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_schedule_instructor_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_schedule_instructor_title_view')];
        return view('sigac::schedule.instructor', $view);
    }

    public function schedule_titled()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_schedule_titled_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_schedule_titled_title_view')];
        return view('sigac::schedule.titled', $view);
    }

    public function schedule_apprentice()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_schedule_apprentice_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_schedule_apprentice_title_view')];
        return view('sigac::schedule.apprentice', $view);
    }
}
