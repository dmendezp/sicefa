<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SENAEMPRESA\Entities\senaempresa;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Quarter;

class SENAEMPRESAController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = ['title' => trans('senaempresa::menu.Home')];
        return view('senaempresa::index', $data);
    }
    public function senaempresa()

    {
        $senaempresas = senaempresa::get();
        $staff = senaempresa::with('Quarter')->get();
        $data = ['title' => trans('senaempresa::menu.SenaEmpresa - Strategies'), 'senaempresas' => $senaempresas, 'staff' => $staff];
        return view('senaempresa::Company.SENAEMPRESA.senaempresa', $data);
    }
    public function agregar()
    {
        $senaempresas = Senaempresa::all();
        $quarters = Quarter::all();
        $data = ['title' => trans('senaempresa::menu.New SenaEmpresa'), 'senaempresas' => $senaempresas, 'quarters' => $quarters];
        if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa') {
            return view('senaempresa::Company.SENAEMPRESA.senaempresa_registration', $data);
        } else {
            return redirect()->route('company.senaempresa')->with('error', trans('senaempresa::menu.Its not authorized'));
        }
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
                return redirect()->route('company.senaempresa')->with('success', trans('senaempresa::menu.SenaEmpresa Successfully restored'));
            } else {
                // Si la vacante no está eliminada, muestra una alerta
                return redirect()->back()->with('error', trans('senaempresa::menu.SenaEmpresa already exists in the database'));
            }
        } else {

            // El registro no existe, crea uno nuevo
            $sena = new Senaempresa();
            $sena->name = $request->input('name');
            $sena->description = $request->input('description');
            $sena->quarter_id = $request->input('quarter_id');


            if ($sena->save()) {
                return redirect()->route('company.senaempresa')->with('success', trans('senaempresa::menu.SenaEmpresa successfully created'));
            }
        }
    }


    public function edit($id)
    {


        $company = Senaempresa::find($id);
        $quarters = Quarter::all();
        $data = ['title' => trans('senaempresa::menu.Edit SenaEmpresa'), 'company' => $company, 'quarters' => $quarters];
        if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa') {
            return view('senaempresa::Company.SENAEMPRESA.senaempresa_edit', $data);
        } else {
            return redirect()->route('company.senaempresa')->with('error', trans('senaempresa::menu.Its not authorized'));
        }
    }
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quarter_id' => 'required|exists:quarters,id', // Asegura que el quarter_id exista en la tabla quarters
            // Agrega validaciones para otros campos si es necesario
        ]);

        // Busca el registro en la base de datos
        $company = Senaempresa::find($id);

        // Verifica si el registro existe
        if (!$company) {
            return redirect()->route('company.senaempresa')->with('error', trans('senaempresa::menu.Record not found.'));
        }

        // Actualiza los campos del registro con los datos del formulario
        $company->name = $request->input('name');
        $company->description = $request->input('description');
        $company->quarter_id = $request->input('quarter_id');
        // Actualiza otros campos según sea necesario

        // Intenta guardar los cambios en la base de datos
        if ($company->save()) {
            return redirect()->route('company.senaempresa')->with('success', trans('senaempresa::menu.Registration successfully updated.'));
        } else {
            // Maneja el caso en el que no se pudo guardar
            return redirect()->route('company.senaempresa')->with('error', trans('senaempresa::menu.Error updating registration.'));
        }
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

        // Verifica si la asociación ya existe
        if (!$course->senaempresa()->wherePivot('course_id', $courseId)->wherePivot('senaempresa_id', $senaempresaId)->exists()) {
            // Asigna el curso a la senaempres registrada
            $course->senaempresa()->attach($senaempresa);
            return redirect()->back()->with('success', trans('senaempresa::menu.Course assigned to senaempresa successfully.'));
        } else {
            //Alerta de que esa asociación ya existe
            return redirect()->back()->with('error', trans('senaempresa::menu.Association already exists.'));
        }
    }
    public function mostrar_asociado()
    {
        $senaempresas = senaempresa::get();
        $courses = Course::with('senaempresa')->get();
        $data = ['title' => trans('senaempresa::menu.Assign Courses to SenaEmpresa'), 'courses' => $courses, 'senaempresas' => $senaempresas];
        if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa') {
            return view('senaempresa::Company.SENAEMPRESA.courses_senaempresa', $data);
        } else {
            return redirect()->route('company.senaempresa')->with('error', trans('senaempresa::menu.Its not authorized'));
        }
    }
    public function eliminar_asociacion_empresa(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'senaempresa_id' => 'required|exists:senaempresas,id',
        ]);

        $courseId = $request->input('course_id');
        $senaempresaId = $request->input('senaempresa_id');

        try {
            $course = Course::findOrFail($courseId);
            // Eliminar Asociación Especifica
            $course->senaempresa()->wherePivot('course_id', $courseId)->wherePivot('senaempresa_id', $senaempresaId)->detach();
            return response()->json(['mensaje' => trans('senaempresa::menu.Association eliminated with success.')]);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => trans('senaempresa::menu.Error deleting the association')], 500);
        }
    }
}
