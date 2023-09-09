<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\Vacancy;
use Modules\SENAEMPRESA\Entities\PositionCompany;


class VacantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function vacantes(Request $request)
    {
        // Obtén la lista de todos los cursos
        $courses = Course::with('program')->get();

        // Inicializa la variable $selectedCourseId a null
        $selectedCourseId = null;

        // Obtén el ID del curso seleccionado del formulario si está presente
        if ($request->has('cursoFilter')) {
            $selectedCourseId = $request->input('cursoFilter');
        }

        // Obtén las vacantes relacionadas con el curso seleccionado (si se ha seleccionado uno)
        $vacancies = Vacancy::query();

        if (!is_null($selectedCourseId)) {
            $vacancies->whereExists(function ($query) use ($selectedCourseId) {
                $query->select(DB::raw(1))
                    ->from('course_vacancy')
                    ->whereRaw('course_vacancy.vacancy_id = vacancies.id')
                    ->where('course_vacancy.course_id', $selectedCourseId);
            });
        }

        $vacancies = $vacancies->get();

        $PositionCompany = PositionCompany::all();
        $data = ['title' => trans('senaempresa::menu.Vacancies'), 'courses' => $courses, 'vacancies' => $vacancies, 'PositionCompany' => $PositionCompany, 'selectedCourseId' => $selectedCourseId];
        return view('senaempresa::Company.Vacant.vacant', $data);
    }

    public function agregar_vacante()
    {
        // Obtén solo los cargos activos
        $activePositions = PositionCompany::where('state', 'activo')->get();

        $vacancies = Vacancy::get();
        $data = ['title' => trans('senaempresa::menu.New vacancy'), 'vacancies' => $vacancies, 'PositionCompany' => $activePositions];

        return view('senaempresa::Company.Vacant.registration', $data);
    }

    public function store(Request $request)
    {
        $imagePath = $request->file('image')->store('images', 'public');

        // Verificar si ya existe una vacante con el mismo nombre (ignorando eliminaciones suaves)
        $existingVacancy = Vacancy::withTrashed()->where('name', $request->input('name'))->first();

        if ($existingVacancy) {
            // Si existe una vacante con el mismo nombre, verifica si está eliminada
            if ($existingVacancy->trashed()) {
                // Restaura la vacante eliminada suavemente
                $existingVacancy->restore();
                return redirect()->route('cefa.vacantes')->with('success', 'Vacante Restaurado con exito!');
            } else {
                // Si la vacante no está eliminada, muestra una alerta
                return redirect()->back()->with('error', 'Vacante ya existe en la base de datos');
            }
        } else {
            // Si no existe una vacante con el mismo nombre, crea una nueva
            $vacancy = new Vacancy();
            $vacancy->name = $request->input('name');
            $vacancy->image = $imagePath;
            $vacancy->description_general = $request->input('description_general');
            $vacancy->requirement = $request->input('requirement');
            $vacancy->position_company_id = $request->input('position_company_id');
            $vacancy->start_datetime = $request->input('start_datetime');
            $vacancy->end_datetime = $request->input('end_datetime');

            if ($vacancy->save()) {
                $data = ['title' => 'Nueva Vacante', 'vacancy' => $vacancy];
                return redirect()->route('cefa.vacantes', $data)->with('success', trans('senaempresa::menu.Vacancy added with success'));
            }
        }
    }

    public function getVacancyDetails($id)
    {
        $vacancy = Vacancy::find($id);
        return response()->json($vacancy);
    }

    public function edit($id)
    {
        $vacancy = Vacancy::findOrFail($id);

        $activePositions = PositionCompany::where('state', 'activo')->get();

        $data = ['title' => trans('senaempresa::menu.Edit vacancy'), 'vacancy' => $vacancy, 'positionCompany' => $activePositions];

        return view('senaempresa::Company.Vacant.vacant_edit', $data);
    }


    public function update(Request $request, $id)
    {
        $vacancy = Vacancy::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $vacancy->image = $imagePath;
        }

        $vacancy->name = $request->input('name');
        $vacancy->description_general = $request->input('description_general');
        $vacancy->requirement = $request->input('requirement');
        $vacancy->position_company_id = $request->input('position_company_id');
        $vacancy->start_datetime = $request->input('start_datetime');
        $vacancy->end_datetime = $request->input('end_datetime');

        if ($vacancy->save()) {
            return redirect()->route('cefa.vacantes')->with('success', trans('senaempresa::menu.Vacancy successfully updated.'));
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
    public function asociar_curso()
    {
        $vacancies = Vacancy::get();
        $courses = Course::with('program')->get();
        $data = ['title' => trans('senaempresa::menu.Assign Courses to Vacancies'), 'courses' => $courses, 'vacancies' => $vacancies];
        return view('senaempresa::Company.Vacant.courses_vacancies', $data);
    }

    public function curso_asociado(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'vacancy_id' => 'required|exists:vacancies,id',
        ]);

        // Obtén los IDs de los cursos y las vacantes
        $courseId = $request->input('course_id');
        $vacancyId = $request->input('vacancy_id');

        // Encuentra los modelos correspondientes
        $course = Course::findOrFail($courseId);
        $vacancy = Vacancy::findOrFail($vacancyId);

        // Asigna el curso a la vacante
        $course->vacancy()->attach($vacancy);

        return redirect()->back()->with('success', trans('senaempresa::menu.Course assigned to the vacancy successfully.'));
    }

    public function mostrar_asociados()
    {
        $vacancies = Vacancy::get();
        $courses = Course::with('vacancy')->get();
        $data = ['title' => trans('senaempresa::menu.Show Associates'), 'courses' => $courses, 'vacancies' => $vacancies];
        return view('senaempresa::Company.Vacant.courses_vacancies', $data);
    }
    public function eliminarAsociacion(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'vacancy_id' => 'required|exists:vacancies,id',
        ]);

        $courseId = $request->input('course_id');
        $vacancyId = $request->input('vacancy_id');

        $course = Course::findOrFail($courseId);
        $vacancy = Vacancy::findOrFail($vacancyId);

        // Desasigna el curso de la vacante
        $course->vacancy()->detach($vacancy);

        return redirect()->back()->with('danger', trans('senaempresa::menu.Association eliminated with success.'));
    }
}
