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
        $data = ['title' => 'Inicio'];
        return view('senaempresa::index', $data);
    }
    public function senaempresa()

    {
        $senaempresas = senaempresa::get();
        $data = ['title' => trans('senaempresa::menu.SenaEmpresa - Strategies'), 'senaempresas' => $senaempresas];
        return view('senaempresa::Company.SENAEMPRESA.senaempresa', $data);
    }
    public function agregar()
    {
        $senaempresas = Senaempresa::all();
        $data = ['title' => trans('senaempresa::menu.New SenaEmpresa'), 'senaempresas' => $senaempresas];
        return view('senaempresa::Company.SENAEMPRESA.senaempresa_registration', $data);
    }

    public function store(Request $request)
    {
        // Verificar si ya existe un registro con el mismo nombre
        $existingSena = Senaempresa::where('name', $request->input('name'))->first();



        if ($existingSena) {
            // Si existe una vacante con el mismo nombre, verifica si está eliminada
            if ($existingSena->trashed()) {
                // Restaura la vacante eliminada suavemente
                $existingSena->restore();
                return redirect()->route('company.senaempresa')->with('success', 'SenaEmpresa Restaurado con exito!');
            } else {
                // Si la vacante no está eliminada, muestra una alerta
                return redirect()->back()->with('error', 'SenaEmpresa ya existe en la base de datos');
            }
        } else {

            // El registro no existe, crea uno nuevo
            $sena = new Senaempresa();
            $sena->name = $request->input('name');
            $sena->description = $request->input('description');

            if ($sena->save()) {
                // Redirigir a la vista adecuada con un mensaje de éxito
                alert()->success('success', trans('senaempresa::menu.Position successfully created.'));
                return redirect()->route('company.senaempresa');
            } else {
                // Manejar el caso de error si la inserción falla
                alert()->error('error', trans('senaempresa::menu.Error in creating the position.'));
                return redirect()->back();
            }
        }
    }


    public function edit($id)
    {


        $company = Senaempresa::find($id);
        $data = ['title' => trans('senaempresa::menu.Edit SenaEmpresa'), 'company' => $company];
        return view('senaempresa::Company.SENAEMPRESA.senaempresa_edit', $data);
    }
    public function update(Request $request, $id)
    {
        $company = Senaempresa::find($id);
        $company->name = $request->input('name');
        $company->description = $request->input('description');

        // Actualiza otros campos según necesites
        $company->save();

        return redirect()->route('company.senaempresa')->with('warning', trans('senaempresa::menu.Registration successfully updated.'));
    }


    public function destroy($id)
    {
        try {
            $compan = Senaempresa::findOrFail($id);
            $compan->delete();

            return response()->json(['mensaje' => trans('senaempresa::menu.Vacancy successfully eliminated')]);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => trans('senaempresa::menu.Error when deleting the vacancy')], 500);
        }
    }



    //Asociar cursos a vacantes
    public function cursos_senamepresa()
    {
        $senaempresas = senaempresa::get();
        $courses = Course::with('program')->get();
        $data = ['title' => trans('senaempresa::menu.Assign Courses to SenaEmpresa'), 'courses' => $courses, 'senaempresas' => $senaempresas];
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

        return redirect()->back()->with('success', trans('senaempresa::menu.Course assigned to senaempresa successfully.'));
    }
    public function mostrar_registros()
    {
        $senaempresas = senaempresa::get();
        $courses = Course::with('program')->get();
        $data = ['title' => trans('senaempresa::menu.Assign Courses to SenaEmpresa'), 'courses' => $courses, 'senaempresas' => $senaempresas];
        return view('senaempresa::Company.SENAEMPRESA.courses_senaempresa', $data);
    }
    public function mostrar_asociado()
    {
        $senaempresas = senaempresa::get();
        $courses = Course::with('vacancy')->get();
        $data = ['title' => trans('senaempresa::menu.Assign Courses to SenaEmpresa'), 'courses' => $courses, 'senaempresas' => $senaempresas];
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

        return redirect()->back()->with('danger', trans('senaempresa::menu.Association eliminated with success.'));
    }
}
