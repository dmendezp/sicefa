<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Modules\SENAEMPRESA\Entities\CourseVacancy;
use Modules\SENAEMPRESA\Entities\senaempresa;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\Vacancy;
use Modules\SENAEMPRESA\Entities\PositionCompany;
use Illuminate\Support\Str;
use Modules\SICA\Entities\Quarter;

class VacantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getVacancyDetails($id)
    {
        $vacancy = Vacancy::find($id);
        return response()->json($vacancy);
    }
    public function vacantes(Request $request)
    {
        $selectedCourseId = null;
        $selectedSenaempresaId = $request->input('senaempresaFilter', null);

        $vacancies = Vacancy::query();

        if (Auth::check()) {
            $user = Auth::user();

            if ($user->roles[0]->name === 'Usuario Senaempresa') {
                // User is of role 'Usuario Senaempresa'
                if ($user->courses && $user->courses->count() > 0) {
                    $cursoUsuario = $user->courses->first(); // Obtener el curso del usuario
                    $selectedCourseId = $cursoUsuario->id;
                }
            } elseif ($user->roles[0]->name === 'Administrador Senaempresa') {
                // User is of role 'Administrador Senaempresa'
                $courses = Course::with('program')->get();

                if ($request->has('cursoFilter')) {
                    $selectedCourseId = $request->input('cursoFilter');
                }
            }
        }

        // Add a condition to filter by senaempresa_id in the vacancies table
        if ($selectedSenaempresaId !== null) {
            $vacancies->where('senaempresa_id', $selectedSenaempresaId);
        }

        $senaempresas = Senaempresa::all(); // Obtén todas las Senaempresas
        $PositionCompany = PositionCompany::all();

        $vacancies = $vacancies->get(); // Execute the query and get the results

        $data = [
            'title' => trans('senaempresa::menu.Vacancies'),
            'courses' => $courses ?? [],
            'vacancies' => $vacancies,
            'PositionCompany' => $PositionCompany,
            'selectedCourseId' => $selectedCourseId,
            'selectedSenaempresaId' => $selectedSenaempresaId,
            'senaempresas' => $senaempresas,
            // Pasa las Senaempresas a la vista
        ];

        return view('senaempresa::Company.Vacant.vacant', $data);
    }

    public function agregar_vacante(Request $request)
    {
        // Obtén solo los cargos activos
        $activePositions = PositionCompany::where('state', 'activo')->get();

        // Obtén el trimestre actual en base a la fecha actual
        $currentDate = Carbon::now();
        $currentQuarter = Quarter::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->first();

        if (!$currentQuarter) {
            // Manejar el caso en que no se encuentre un trimestre actual
            // Puedes lanzar una excepción o tomar otra acción apropiada aquí.
        }

        // Obtén la empresa asociada al trimestre actual
        $currentSenaempresa = Senaempresa::where('quarter_id', $currentQuarter->id)->first();

        if (!$currentSenaempresa) {
            // Manejar el caso en que no se encuentre una empresa asociada al trimestre actual
            // Puedes lanzar una excepción o tomar otra acción apropiada aquí.
        }

        // Obtén el nombre de la empresa
        $currentSenaempresaName = $currentSenaempresa->name;

        $vacancies = Vacancy::get();
        $data = [
            'title' => trans('senaempresa::menu.New vacancy'),
            'vacancies' => $vacancies,
            'PositionCompany' => $activePositions,
            'currentQuarterId' => $currentQuarter->id,
            'currentSenaempresaId' => $currentSenaempresa->id,
            'currentSenaempresaName' => $currentSenaempresaName,
            // Pasar el nombre de la empresa a la vista
        ];

        if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa') {
            return view('senaempresa::Company.Vacant.new_vacant', $data);
        } else {
            return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.Its not authorized'));
        }
    }

    public function store(Request $request)
    {
        // Obtener el archivo de imagen del formulario
        if ($image = $request->file('image')) {
            $extension = $image->getClientOriginalExtension(); // Obtener la extensión del archivo
            $nameWithoutExtension = Str::slug($request->input('name')); // Generar un nombre sin espacios y en minúsculas
            $name_image = $nameWithoutExtension . '_' . time() . '.' . $extension; // Agregar una marca de tiempo para evitar conflictos de nombre
            $image->move(public_path('modules/senaempresa/images/vacancies/'), $name_image); // Mover la imagen a la ubicación deseada
        }

        $vacancy = new Vacancy();
        $vacancy->name = $request->input('name');
        $vacancy->image = 'modules/senaempresa/images/vacancies/' . $name_image;
        $vacancy->description_general = $request->input('description_general');
        $vacancy->requirement = $request->input('requirement');
        $vacancy->senaempresa_id = $request->input('senaempresa_id');
        $vacancy->position_company_id = $request->input('position_company_id');
        $vacancy->start_datetime = $request->input('start_datetime');
        $vacancy->end_datetime = $request->input('end_datetime');

        // Comprobar si la fecha y hora de finalización ya ha pasado
        if (now() > $vacancy->end_datetime) {
            $vacancy->state = 'No Disponible';
        } else {
            $vacancy->state = 'Disponible';
        }

        if ($vacancy->save()) {
            $data = ['title' => 'Nueva Vacante', 'vacancy' => $vacancy];
            return redirect()->route('company.vacant.vacantes', $data)->with('success', trans('senaempresa::menu.Vacant added with success'));
        }
    }



    public function edit($id)
    {
        $vacancy = Vacancy::findOrFail($id);

        $activePositions = PositionCompany::where('state', 'activo')->get();

        $data = ['title' => trans('senaempresa::menu.Edit vacancy'), 'vacancy' => $vacancy, 'positionCompany' => $activePositions];

        if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa') {
            return view('senaempresa::Company.Vacant.vacant_edit', $data);
        } else {
            return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.Its not authorized'));
        }
    }


    public function update(Request $request, $id)
    {
        $vacancy = Vacancy::findOrFail($id);

        // Verifica si se ha cargado una nueva imagen
        if ($request->hasFile('image')) {
            // Elimina la imagen existente si existe
            if (File::exists(public_path($vacancy->image))) {
                File::delete(public_path($vacancy->image));
            }

            // Procesa la nueva imagen
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $nameWithoutExtension = Str::slug($request->input('name'));
            $name_image = $nameWithoutExtension . '_' . time() . '.' . $extension;
            $image->move(public_path('modules/senaempresa/images/vacancies/'), $name_image);

            // Actualiza la propiedad 'image' de la vacante con la nueva ruta de la imagen
            $vacancy->image = 'modules/senaempresa/images/vacancies/' . $name_image;
        }

        // Actualiza los otros campos de la vacante
        $vacancy->name = $request->input('name');
        $vacancy->description_general = $request->input('description_general');
        $vacancy->requirement = $request->input('requirement');
        $vacancy->position_company_id = $request->input('position_company_id');
        $vacancy->start_datetime = $request->input('start_datetime');
        $vacancy->end_datetime = $request->input('end_datetime');

        // Comprobar si la fecha y hora de finalización ya ha pasado
        if (now() > $vacancy->end_datetime) {
            $vacancy->state = 'No Disponible';
        } else {
            $vacancy->state = 'Disponible';
        }

        if ($vacancy->save()) {
            return redirect()->route('company.vacant.vacantes')->with('success', trans('senaempresa::menu.Vacancy successfully updated.'));
        } else {
            return redirect()->back()->with('error', trans('senaempresa::menu.Error updating the Vacancy.'));
        }
    }
    public function destroy($id)
    {
        try {
            $vacante = Vacancy::findOrFail($id);
            $vacante->delete();

            return response()->json(['mensaje' => trans('senaempresa::menu.Vacancy eliminated with success')]);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => trans('senaempresa::menu.Error when deleting the vacancy')], 500);
        }
    }


    //Asociar cursos a vacantes
    public function curso_asociado(Request $request)
    {
        try {
            $courseId = $request->input('course_id');
            $vacancyId = $request->input('vacancy_id');
            $isChecked = $request->input('checked') === 'true';

            if ($isChecked) {
                // Si el checkbox está marcado, crea una nueva relación
                CourseVacancy::create([
                    'course_id' => $courseId,
                    'vacancy_id' => $vacancyId,
                ]);

                $message = 'Relación creada correctamente.';
            } else {
                // Si el checkbox no está marcado, elimina la relación existente si existe
                CourseVacancy::where('course_id', $courseId)
                    ->where('vacancy_id', $vacancyId)
                    ->delete();

                // Marca todas las relaciones existentes como eliminadas
                CourseVacancy::where('course_id', $courseId)
                    ->whereNull('deleted_at')
                    ->update(['deleted_at' => now()]);

                $message = 'Relación eliminada correctamente.';
            }

            return response()->json(['success' => $message], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error. Detalles: ' . $e->getMessage()], 500);
        }
    }



    public function getAssociations(Request $request)
{
    $courseId = $request->query('course_id');
    $course = Course::findOrFail($courseId);

    // Obtén todas las relaciones, incluidas las marcadas como eliminadas
    $associations = CourseVacancy::where('course_id', $courseId)
        ->pluck('vacancy_id')
        ->toArray();

    return response()->json(['associations' => $associations], 200);
}


    public function mostrar_asociados()
    {
        $vacancies = Vacancy::get();
        $courses = Course::where('status', 'Activo')->with('vacancy')->get();
        $courseofvacancy = CourseVacancy::all();

        if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa') {
            $data = [
                'title' => trans('senaempresa::menu.Assign Courses to Vacancies'),
                'courses' => $courses,
                'vacancies' => $vacancies,
                'courseofvacancy' => $courseofvacancy,
            ];

            return view('senaempresa::Company.Vacant.courses_vacancies', $data);
        } else {
            return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.Its not authorized'));
        }
    }

}
