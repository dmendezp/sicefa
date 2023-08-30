<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\vacancy;
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
        $courses = Course::with('program')->get();
        $data = ['title' => 'Vacantes', 'courses' => $courses, 'vacancies' => $vacancies];
        return view('senaempresa::Company.Vacant.vacant', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function registration()
    {
        $vacancies = Vacancy::get();
        $PositionCompany = PositionCompany::all();
        $data = ['title' => 'Nueva Vacante', 'vacancies' => $vacancies, 'PositionCompany' => $PositionCompany];
        return view('senaempresa::Company.Vacant.registration', $data);
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
        $vacancy = Vacancy::find($id);

        if ($vacancy->delete()) {
            return redirect()->route('vacantes')->with('danger', 'Vacante eliminado exitosamente.');
        } else {
            return redirect()->route('vacantes')->with('error', 'Error al eliminar el Vacante.');
        }
    }
}
