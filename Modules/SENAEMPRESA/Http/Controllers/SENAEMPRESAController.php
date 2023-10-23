<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SENAEMPRESA\Entities\senaempresa;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\CourseSenaempresa;


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


