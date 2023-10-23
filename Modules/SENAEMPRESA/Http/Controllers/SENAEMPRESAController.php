<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SENAEMPRESA\Entities\senaempresa;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\CourseSenaempresa;
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

    //Asociar cursos a senaempresa
    public function curso_asociado_senaempresa(Request $request)
    {
        try {
            $courseId = $request->input('course_id');
            $senaempresaId = $request->input('senaempresa_id');
            $isChecked = $request->input('checked') === 'true';

            if ($isChecked) {
                // Si el checkbox está marcado, crea una nueva relación
                CourseSenaempresa::create([
                    'course_id' => $courseId,
                    'senaempresa_id' => $senaempresaId,
                ]);

                $message = 'Relación creada correctamente.';
            } else {
                // Si el checkbox no está marcado, elimina la relación existente si existe
                CourseSenaempresa::where('course_id', $courseId)
                    ->where('senaempresa_id', $senaempresaId)
                    ->delete();

                // Marca todas las relaciones existentes como eliminadas
                CourseSenaempresa::where('course_id', $courseId)
                    ->whereNull('deleted_at')
                    ->update(['deleted_at' => now()]);

                $message = 'Relación eliminada correctamente.';
            }

            return response()->json(['success' => $message], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error. Detalles: ' . $e->getMessage()], 500);
        }
    }
    public function getAssociation(Request $request)
    {
        $courseId = $request->query('course_id');
        $course = Course::findOrFail($courseId);

        // Obtén todas las relaciones, incluidas las marcadas como eliminadas
        $associations = CourseSenaempresa::where('course_id', $courseId)
            ->pluck('senaempresa_id')
            ->toArray();

        return response()->json(['associations' => $associations], 200);
    }

    public function mostrar_asociado()
    {
        $senaempresas = senaempresa::get();
        $courses = Course::where('status', 'Activo')->with('senaempresa')->get();
        $courseofsenaempresa = CourseSenaempresa::all();

        if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa') {
            $data = [
                'title' => trans('senaempresa::menu.Assign Course to SenaEmpresa'),
                'courses' => $courses,
                'senaempresas' => $senaempresas,
                'courseofsenaempresa' => $courseofsenaempresa,
            ];

            return view('senaempresa::Company.SENAEMPRESA.courses_senaempresa', $data);
        } else {
            return redirect()->route('company.senaempresa')->with('error', trans('senaempresa::menu.Its not authorized'));
        }
    }

}


