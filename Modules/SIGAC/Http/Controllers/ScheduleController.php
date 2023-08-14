<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\App;

class ScheduleController extends Controller
{
    public function scheduleInstructor()
    {
        $view = ['titlePage'=>trans('sigac::schedule.Schedule'), 'titleView'=>trans('sigac::schedule.Schedule Instructor')];
        $apps = App::get();
        return view('sigac::schedule.instructor', compact('apps', 'view'));
    }

    public function scheduleProgramInstructor()
    {
        $view = ['titlePage'=>trans('sigac::schedule.Schedule Program.'), 'titleView'=>trans('sigac::schedule.Schedule Program.')];
        $apps = App::get();
        return view('sigac::schedule.programs', compact('apps', 'view'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sigac::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('sigac::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sigac::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
