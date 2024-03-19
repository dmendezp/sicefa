<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Modules\SENAEMPRESA\Entities\CourseSenaempresa;
use Modules\SENAEMPRESA\Entities\Senaempresa;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Quarter;

class PhaseSenaempresaController extends Controller
{
    public function phases()

    {
        $senaempresas = Senaempresa::get();
        $staff = Senaempresa::with('Quarter')->get();
        $data = ['title' => trans('senaempresa::menu.SenaEmpresa - Phases'), 'senaempresas' => $senaempresas, 'staff' => $staff];
        return view('senaempresa::Company.phases_senaempresa.index', $data);
    }
    public function new()
    {
        $senaempresas = Senaempresa::all();
        $quarters = Quarter::all();
        $data = ['title' => trans('senaempresa::menu.New SenaEmpresa'), 'senaempresas' => $senaempresas, 'quarters' => $quarters];

        return view('senaempresa::Company.phases_senaempresa.new', $data);
    }

    public function saved(Request $request)
    {
        // Verificar si ya existe un registro con el mismo nombre
        $existingSena = Senaempresa::where('name', $request->input('name'))->first();

        // Obtener el ID del trimestre desde la solicitud
        $quarterId = $request->input('quarter_id');

        if ($existingSena) {
            // Si existe una fase con el mismo nombre, verifica si está asociada al mismo trimestre
            if ($existingSena->quarter_id == $quarterId) {
                // Si está asociada al mismo trimestre, muestra una alerta o toma la acción necesaria
                return redirect()->back()->with('info', trans('senaempresa::menu.SenaEmpresa already exists in the same quarter'));
            }

            // Si la fase existe pero en un trimestre diferente, verifica si está eliminada
            if ($existingSena->trashed()) {
                // Restaura la fase eliminada suavemente
                $existingSena->restore();
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.index')->with('success', trans('senaempresa::menu.SenaEmpresa Successfully restored'));
            } else {
                // Si la fase no está eliminada, muestra una alerta
                return redirect()->back()->with('info', trans('senaempresa::menu.SenaEmpresa already exists in the database'));
            }
        } else {
            // El registro no existe, crea uno nuevo
            $sena = new Senaempresa();
            $sena->name = $request->input('name');
            $sena->description = $request->input('description');
            $sena->quarter_id = $quarterId;

            if ($sena->save()) {
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.index')->with('success', trans('senaempresa::menu.SenaEmpresa successfully created'));
            }
        }
    }



    public function edit($id)
    {
        $company = Senaempresa::find($id);
        $quarters = Quarter::all();
        $data = ['title' => trans('senaempresa::menu.Edit SenaEmpresa'), 'company' => $company, 'quarters' => $quarters];

        return view('senaempresa::Company.phases_senaempresa.edit', $data);
    }
    public function updated(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quarter_id' => 'required|exists:quarters,id'
            // Agrega validaciones para otros campos si es necesario
        ]);

        // Busca el registro en la base de datos
        $company = Senaempresa::find($id);

        // Verifica si el registro existe
        if (!$company) {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.index')->with('error', trans('senaempresa::menu.Record not found.'));
        }

        // Actualiza los campos del registro con los datos del formulario
        $company->name = $request->input('name');
        $company->description = $request->input('description');
        $company->quarter_id = $request->input('quarter_id');
        // Actualiza otros campos según sea necesario

        // Intenta guardar los cambios en la base de datos
        if ($company->save()) {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.index')->with('success', trans('senaempresa::menu.Registration successfully updated.'));
        } else {
            // Maneja el caso en el que no se pudo guardar
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.index')->with('error', trans('senaempresa::menu.Error updating registration.'));
        }
    }

    public function delete($id)
    {
        try {
            $compan = Senaempresa::findOrFail($id);
            $compan->delete();

            return response()->json(['mensaje' => trans('senaempresa::menu.SenaEmpresa deleted!')]);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => trans('senaempresa::menu.Error deleting the senaempresa')], 500);
        }
    }

    //Asociar cursos a senaempresa
    public function associated_course(Request $request)
    {
        try {
            $courseId = $request->input('course_id');
            $senaempresaId = $request->input('senaempresa_id');
            $isChecked = $request->input('checked') === 'true';

            $association = CourseSenaempresa::where('course_id', $courseId)
                ->where('senaempresa_id', $senaempresaId)
                ->first();

            if ($isChecked) {
                // If the checkbox is checked, create a new association
                if (!$association) {
                    CourseSenaempresa::create([
                        'course_id' => $courseId,
                        'senaempresa_id' => $senaempresaId,
                    ]);
                } else {
                    // If the association exists but was deleted, restore it
                    $association->restore();
                }
                $message = trans('senaempresa::menu.Association created successfully.');
            } else {
                // If the checkbox is unchecked, delete the association if it exists
                if ($association) {
                    $association->delete();
                }
                $message = trans('senaempresa::menu.Association deleted successfully.');
            }

            return response()->json(['success' => $message], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred. Details: ' . $e->getMessage()], 500);
        }
    }

    public function get_associations(Request $request)
    {
        $senaempresaId = $request->query('senaempresa_id');

        $associations = CourseSenaempresa::where('senaempresa_id', $senaempresaId)
            ->whereNull('deleted_at')
            ->pluck('course_id')
            ->toArray();

        return response()->json(['associations' => $associations], 200);
    }

    public function show_associates()
    {
        $currentDate = now();

        $currentQuarter = Quarter::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->first();

        $nextQuarter = Quarter::where('start_date', '>', $currentDate)
            ->orderBy('start_date', 'asc')
            ->first();

        if (!$currentQuarter && !$nextQuarter) {
            // No SenaEmpresa for the current or next quarter, show alert
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.index')
                ->with('info', trans('senaempresa::menu.No SenaEmpresa related to the current or next quarter'));
        }

        $currentQuarterSenaempresa = $currentQuarter
            ? DB::table('senaempresas')
            ->join('quarters', 'senaempresas.quarter_id', '=', 'quarters.id')
            ->where('quarters.id', $currentQuarter->id)
            ->select('senaempresas.*')
            ->get()
            : collect(); // If no current quarter, create an empty collection

        $nextQuarterSenaempresa = $nextQuarter
            ? DB::table('senaempresas')
            ->join('quarters', 'senaempresas.quarter_id', '=', 'quarters.id')
            ->where('quarters.id', $nextQuarter->id)
            ->select('senaempresas.*')
            ->get()
            : collect(); // If no next quarter, create an empty collection

        // Merge SenaEmpresas for both the current and next quarters
        $senaempresas = $currentQuarterSenaempresa->merge($nextQuarterSenaempresa);

        $courses = Course::where('status', 'Activo')->with('senaempresa')->get();
        $courseofsenaempresa = CourseSenaempresa::all();

        $data = [
            'title' => trans('senaempresa::menu.Assign Course to SenaEmpresa'),
            'courses' => $courses,
            'senaempresas' => $senaempresas,
            'courseofsenaempresa' => $courseofsenaempresa,
        ];

        return view('senaempresa::Company.phases_senaempresa.show_associates', $data);
    }
}
