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
        $senaempresas = senaempresa::get();
        $data = ['title' => 'SenaEmpresa - Estrategias', 'senaempresas' => $senaempresas];
        return view('senaempresa::Company.SENAEMPRESA.senaempresa', $data);
    }
    public function agregar()
    {
        $senaempresas = Senaempresa::all();
        $data = ['title' => 'Nuevo senaempresa', 'senaempresas' => $senaempresas];
        return view('senaempresa::Company.SENAEMPRESA.senaempresa_registration', $data);
    }

    public function store(Request $request)
    {
        $sena = new Senaempresa();

        // Verifica si el objeto se creó correctamente antes de asignar propiedades
        if ($sena) {
            $sena->name = $request->input('name');
            $sena->description = $request->input('description');

            if ($sena->save()) {
                // Redirigir a la vista adecuada con un mensaje de éxito
                return redirect()->route('cefa.senaempresa')->with('success', 'Cargo creado exitosamente.');
            } else {
                // Manejar el caso de error si la inserción falla
                return redirect()->back()->with('error', 'Error al crear el cargo.');
            }
        } else {
            return redirect()->back()->with('error', 'Error al crear el objeto PositionCompany.');
        }
    }

    public function edit($id)
    {


        $company = Senaempresa::find($id);
        $data = ['title' => 'Editar senaempresa', 'company' => $company];
        return view('senaempresa::Company.SENAEMPRESA.senaempresa_edit', $data);
    }
    public function update(Request $request, $id)
    {
        $company = Senaempresa::find($id);
        $company->name = $request->input('name');
        $company->description = $request->input('description');

        // Actualiza otros campos según necesites
        $company->save();

        return redirect()->route('cefa.senaempresa')->with('warning', 'Registro actualizado exitosamente.');
    }


    public function destroy($id)
    {
        try {
            $compan = Senaempresa::findOrFail($id);
            $compan->delete();

            return response()->json(['mensaje' => 'Vacante eliminada con éxito']);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al eliminar la vacante'], 500);
        }
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

        return redirect()->back()->with('success', 'Curso asignado a la senaempresa exitosamente.');
    }
    public function mostrar_registros()
    {
        $senaempresas = senaempresa::get();
        $courses = Course::with('program')->get();
        $data = ['title' => 'Asignar Cursos a SenaEmpresa', 'courses' => $courses, 'senaempresas' => $senaempresas];
        return view('senaempresa::Company.SENAEMPRESA.courses_senaempresa', $data);
    }
    public function mostrar_asociado()
    {
        $senaempresas = senaempresa::get();
        $courses = Course::with('vacancy')->get();
        $data = ['title' => 'Asociados Cursos-Senaempresa', 'courses' => $courses, 'senaempresas' => $senaempresas];
        return view('senaempresa::Company.SENAEMPRESA.courses_senaempresa', $data);
    }
    public function eliminar_asociacion_empresa(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'senaempresa_id' => 'required|exists:senaempresas,id',
        ]);

        $courseId = $request->input('course_id');
        $senaempresaId = $request->input('senaempresa_id');

        $course = Course::findOrFail($courseId);
        $senaempresa = senaempresa::findOrFail($senaempresaId);

        // Desasigna el curso de la senaempresa
        $course->senaempresa()->detach($senaempresa);

        return redirect()->back()->with('danger', 'Asociación eliminada con exito.');
    }
}
