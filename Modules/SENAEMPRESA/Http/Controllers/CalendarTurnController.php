<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SENAEMPRESA\Entities\Asistencia;
use Modules\SICA\Entities\Course;

class CalendarTurnController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $cursos = Course::orderBy('code','desc')->get();
        $asistencias = Asistencia::all();
        return view('senaempresa::Calendar.calendarTurn', compact('asistencias', 'cursos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('senaempresa::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate(['course_id'=>'required',
                        'start'=>'required', 
                        'end'=>'required']
                    );
        $asistencia = $request->input('course_id');
        $curso = Course::where('id',$asistencia)->get();
        $cursoTitle = $curso->code;
        $aprendices = Apprentice::where('course_id',$asistencia)->get();
        return $asistencia;
       /*  $course_id = $asistencia-> */
       /*  course = Course::where('course_id','id'); */
        Return "Hola";
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Asistencia $asistencia)
    {
        $asistencia = Asistencia::all();
        return response()->json($asistencia);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('senaempresa::edit');
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
