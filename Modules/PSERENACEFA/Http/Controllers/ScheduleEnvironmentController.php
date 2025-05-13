<?php

namespace Modules\PSERENACEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PSERENACEFA\Entities\Course;
use Modules\PSERENACEFA\Entities\Environment1;
use Modules\PSERENACEFA\Entities\ScheduleEnvironment;

class ScheduleEnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        //return view('pserenacefa::admin.horariosambie');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
         $environments = Environment1::all();
        $courses = Course::all();
        return view('pserenacefa::admin.createhorarios', compact('environments', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function  store(Request $request)
    {
        $request->validate([
        'environment1_id' => 'required|exists:environments1,id',
        'courses_id' => 'required|exists:courses,id',
        'day_of_week' => 'required|in:lunes,martes,miercoles,jueves,viernes,sabado',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
    ]);

        ScheduleEnvironment::create($request->all());

        return redirect()->back()->with('success', 'Horario creado correctamente.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('pserenacefa::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('pserenacefa::edit');
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
