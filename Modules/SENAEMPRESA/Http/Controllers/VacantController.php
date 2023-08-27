<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

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

        $vacancy = new Vacancy(); // Asegúrate de usar el nombre correcto de la clase
        $vacancy->name = $request->input('name');
        $vacancy->image = $imagePath; // Asignar la ruta de la imagen correctamente
        $vacancy->description_general = $request->input('description_general');
        $vacancy->requirement = $request->input('requirement');
        $vacancy->position_company_id = $request->input('position_company_id');
        $vacancy->start_date = $request->input('start_date');
        $vacancy->end_date = $request->input('end_date');

        if ($vacancy->save()) {
            $vacancy = Vacancy::all();

            $data = ['title' => 'Nueva Vacante', 'vacancy' => $vacancy];
            return redirect()->route('vacantes', $data)->with('success', 'Registro agregado exitosamente.');
        }
    }
    public function getVacancyDetails($id)
    {
        $vacancy = Vacancy::find($id);
        return response()->json($vacancy);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('senaempresa::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('senaempresa::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
