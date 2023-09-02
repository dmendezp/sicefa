<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\Vacancy;
use Modules\SENAEMPRESA\Entities\PositionCompany;


class VacantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function vacantes()
    {
        $vacancies = Vacancy::get();
        $PositionCompany = PositionCompany::all();
        $courses = Course::with('program')->get();
        $data = ['title' => 'Vacantes', 'courses' => $courses, 'vacancies' => $vacancies, 'PositionCompany' => $PositionCompany];
        return view('senaempresa::Company.Vacant.vacant', $data);
    }
    public function store(Request $request)
    {
        $imagePath = $request->file('image')->store('images', 'public');

        $vacancy = new Vacancy();
        $vacancy->name = $request->input('name');
        $vacancy->image = $imagePath;
        $vacancy->description_general = $request->input('description_general');
        $vacancy->requirement = $request->input('requirement');
        $vacancy->position_company_id = $request->input('position_company_id');
        $vacancy->start_datetime = $request->input('start_datetime');
        $vacancy->end_datetime = $request->input('end_datetime');

        if ($vacancy->save()) {
            $vacancy = Vacancy::all();

            $data = ['title' => 'Nueva Vacante', 'vacancy' => $vacancy];
            return redirect()->route('vacantes', $data)->with('success', 'Vacante agregado exitosamente.');
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
        $positionCompany = PositionCompany::all();
        $data = ['title' => 'Editar Vacante', 'vacancy' => $vacancy, 'positionCompany' => $positionCompany];
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
            return redirect()->route('vacantes')->with('warning', 'Vacante actualizado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar el Vacante.');
        }
    }
    public function destroy($id)
    {
        try {
            $vacante = Vacancy::findOrFail($id);
            $vacante->delete();

            return response()->json(['mensaje' => 'Vacante eliminada con éxito']);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al eliminar la vacante'], 500);
        }
    }






    //Asociar cursos a vacantes
    public function asociar_curso()
    {
        $vacancies = Vacancy::get();
        $courses = Course::with('program')->get();
        $data = ['title' => 'Asignar Cursos a Vacantes', 'courses' => $courses, 'vacancies' => $vacancies];
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

        return redirect()->back()->with('success', 'Curso asignado a la vacante exitosamente.');
    }

    public function mostrar_asociados()
    {
        $courses = Course::with('vacancy')->get();

        return view('senaempresa::Company.Vacant.courses_vacancies', compact('courses'));
    }
}
