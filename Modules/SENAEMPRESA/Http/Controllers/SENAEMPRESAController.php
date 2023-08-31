<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SENAEMPRESA\Entities\senaempresa;
use Modules\SICA\Entities\Course;

class SENAEMPRESAController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('senaempresa::index');
    }
    public function senaempresa()
    {
        $data = ['title' => 'SenaEmpresa - Estrategias'];
        return view('senaempresa::Company.SENAEMPRESA.senaempresa', $data);
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
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('senaempresa::show');
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

    //Asociar cursos a vacantes
    public function cursos_senamepresa()
    {
        $senaempresas = senaempresa::get();
        $courses = Course::with('program')->get();
        $data = ['title' => 'Asignar Cursos a SenaEmpresa', 'courses' => $courses, 'senaempresas' => $senaempresas];
        return view('senaempresa::Company.SENAEMPRESA.courses_senaempresa', $data);
    }

    public function curso_asociado_senaempresa(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'senaempresa_id' => 'required|exists:senaempresas,id',
        ]);

        // Obtén los IDs de los cursos y las vacantes
        $courseId = $request->input('course_id');
        $senaempresaId = $request->input('senaempresa_id');

        // Encuentra los modelos correspondientes
        $course = Course::findOrFail($courseId);
        $senaempresa = senaempresa::findOrFail($senaempresaId);

        // Asigna el curso a la senaempresa
        $course->senaempresa()->attach($senaempresa);

        return redirect()->back()->with('success', 'Curso asignado a la vacante exitosamente.');
    }
    public function mostrar_registros()
    {
        $senaempresas = senaempresa::get();
        $courses = Course::with('program')->get();
        $data = ['title' => 'Asignar Cursos a SenaEmpresa', 'courses' => $courses, 'senaempresas' => $senaempresas];
        return view('senaempresa::Company.SENAEMPRESA.courses_senaempresa', $data);
    }
}
