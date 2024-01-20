<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;

class ProgrammeController extends Controller
{
    /* Vista principal para la programación de horarios */
    public function programming_schedules()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_programming_schedules_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_programming_schedules_title_view')];
        return view('sigac::programme.programming_schedules', compact('view'));
    }

    /* Vista principal para la programación de eventos de instructor */
    public function event_programming()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_event_programming_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_event_programming_title_view')];
        return view('sigac::programme.event_programming', compact('view'));
    }
}
