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
        $view = ['titlePage'=>trans('sigac::sInstructor.TitlePage'), 'titleView'=>trans('sigac::sInstructor.TitleView')];
        $apps = App::get();
        return view('sigac::schedule.instructor', compact('apps', 'view'));
    }

    public function scheduleApprentice()
    {
        $view = ['titlePage'=>trans('sigac::sApprentice.TitlePage'), 'titleView'=>trans('sigac::sApprentice.TitleView')];
        $apps = App::get();
        return view('sigac::schedule.apprentice', compact('apps', 'view'));
    }

    public function scheduleProgramInstructor()
    {
        $view = ['titlePage'=>trans('sigac::sProgram.TitlePage'), 'titleView'=>trans('sigac::sProgram.TitleView')];
        $apps = App::get();
        return view('sigac::schedule.programs', compact('apps', 'view'));
    }

    public function scheduleProgramEnvironment()
    {
        $view = ['titlePage'=>trans('sigac::sEnvironment.TitlePage'), 'titleView'=>trans('sigac::sEnvironment.TitleView')];
        $apps = App::get();
        return view('sigac::schedule.environment', compact('apps', 'view'));
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
