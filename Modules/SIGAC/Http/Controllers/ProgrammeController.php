<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\App;

class ProgrammeController extends Controller
{
    public function programming_schedules()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_programming_schedules_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_programming_schedules_title_view')];
        $apps = App::get();
        return view('sigac::programme.programming_schedules', compact('apps', 'view'));
    }

    public function event_programming()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_event_programming_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_event_programming_title_view')];
        $apps = App::get();
        return view('sigac::programme.event_programming', compact('apps', 'view'));
    }
}
