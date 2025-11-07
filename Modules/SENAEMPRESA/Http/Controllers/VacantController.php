<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Modules\SENAEMPRESA\Entities\CourseVacancy;
use Modules\SENAEMPRESA\Entities\Senaempresa;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\Vacancy;
use Modules\SENAEMPRESA\Entities\PositionCompany;
use Illuminate\Support\Str;
use Modules\SICA\Entities\Quarter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Scheduling\Schedule;


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

    public function vacancies(Request $request)
    {

        $vacancies = Vacancy::query();
        $selectedCourseId = null;
        $selectedSenaempresaId = null;
        $courses = Course::where('status', 'Activo')->with('vacancy')->get();

        $vacancies_state = Vacancy::all();
        $currentDateTime = now();

        foreach ($vacancies_state as $vacancy) {
            // Comparar la fecha y hora de finalización con la fecha y hora actual
            $endDatetime = Carbon::parse($vacancy->end_datetime);

            if ($currentDateTime > $endDatetime && $vacancy->state === 'Disponible') {
                $vacancy->state = 'No Disponible';
                $vacancy->save();
            } elseif ($currentDateTime <= $endDatetime && $vacancy->state === 'No Disponible') {
                $vacancy->state = 'Disponible';
                $vacancy->save();
            }
        }

        if (Auth::check()) {
            $user = Auth::user();

            if ($user->roles[0]->name === 'Aprendiz Senaempresa' || (Route::is('senaempresa.apprentice.*'))) {
                // Obtén el curso del aprendiz logueado
                $apprentice = auth()->user()->person->apprentices()->first();
                if (!$apprentice) {
                    return redirect()->back()->withInput()->with('info', 'No eres una Aprendiz');
                }
                $course = $apprentice->course;

                // Obtén la `senaempresa` asociada al próximo trimestre
                $nextQuarter = Quarter::where('start_date', '>', now())->orderBy('start_date', 'asc')->first();

                if ($nextQuarter) {
                    $nextSenaempresa = Senaempresa::where('quarter_id', $nextQuarter->id)->first();

                    if ($nextSenaempresa) {
                        $vacancies = DB::table('course_vacancy')
                            ->join('vacancies', 'course_vacancy.vacancy_id', '=', 'vacancies.id')
                            ->where('course_vacancy.course_id', '=', $course->id)
                            ->where('vacancies.state', '=', 'Disponible')
                            ->where('vacancies.senaempresa_id', '=', $nextSenaempresa->id)
                            ->get();
                    } else {
                        // Handle the case where no `senaempresa` is associated with the next quarter
                        // You can redirect back with an error message or take other appropriate action.
                        return redirect()->back()->with('info', trans('senaempresa::menu.There is no senaempresa associated with the next quarter.'));
                    }
                } else {
                    // Handle the case where no next quarter is found
                    // You can redirect back with an error message or take other appropriate action.
                    return redirect()->back()->with('info', trans('senaempresa::menu.There is no next quarter.'));
                }
            } else {
                // Obtén el ID de la senaempresa seleccionado del formulario si está presente
                if ($request->has('senaempresaFilter')) {
                    $selectedSenaempresaId = $request->input('senaempresaFilter');
                }

                // Obtén el ID del curso seleccionado del formulario si está presente
                if ($request->has('cursoFilter')) {
                    $selectedCourseId = $request->input('cursoFilter');
                }

                // Filtrar por Senaempresa si está seleccionado
                if (!is_null($selectedSenaempresaId)) {
                    $vacancies = $vacancies->where('senaempresa_id', $selectedSenaempresaId);
                }

                // Filtrar por Curso si está seleccionado
                if (!is_null($selectedCourseId)) {
                    $vacancies->whereExists(function ($query) use ($selectedCourseId) {
                        $query->select(DB::raw(1))
                            ->from('course_vacancy')
                            ->whereRaw('course_vacancy.vacancy_id = vacancies.id')
                            ->where('course_vacancy.course_id', $selectedCourseId);
                    });
                }
                $vacancies = $vacancies->get();
            }
        }



        $senaempresas = Senaempresa::get();
        $PositionCompany = PositionCompany::all();
        $data = [
            'selectedCourseId' => $selectedCourseId,
            'title' => trans('senaempresa::menu.Vacancies'),
            'courses' => $courses,
            'vacancies' => $vacancies,
            'PositionCompany' => $PositionCompany,
            'selectedSenaempresaId' => $selectedSenaempresaId,
            'senaempresas' => $senaempresas,
        ];

        return view('senaempresa::Company.vacancies.index', $data);
    }

    public function new(Request $request)
    {
        // Get the current date
        $currentDate = now();

        // Find the current quarter
        $currentQuarter = Quarter::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->first();

        if (!$currentQuarter) {
            // Handle the case where no current quarter is found
            // You can throw an exception or take other appropriate action here.
        }

        // Find the next quarter
        $nextQuarter = Quarter::where('start_date', '>', $currentDate)
            ->orderBy('start_date', 'asc')
            ->first();

        // Check if there is a next quarter
        if (!$nextQuarter) {
            // If there is no next quarter, use the current quarter
            $nextQuarter = $currentQuarter;
            // Optionally, you can redirect back with a warning message
            return redirect()->back()->with('info', 'No hay un trimestre siguiente.');
        } else {
            // Retrieve the senaempresas for the current or next quarter
            $senaempresas = DB::table('senaempresas')
            ->join('quarters', 'senaempresas.quarter_id', '=', 'quarters.id')
            ->where('quarters.id', $nextQuarter->id)
            ->select('senaempresas.*')
            ->get();
        }

        // If no senaempresas are found for the next quarter, use the current quarter
        if ($senaempresas->isEmpty()) {
            // Retrieve senaempresas for the current quarter
            $senaempresas = Senaempresa::where('quarter_id', $currentQuarter->id)->get();

            // Optionally, you can redirect back with a warning message
            // return redirect()->back()->with('warning', 'No hay senaempresas asociadas con el trimestre siguiente.');
        }

        // Obtén solo los cargos activos
        $PositionCompany = PositionCompany::where('state', 'activo')->get();

        $vacancies = Vacancy::get();

        $data = [
            'title' => trans('senaempresa::menu.New vacancy'),
            'senaempresas' => $senaempresas,
            'PositionCompany' => $PositionCompany,
            'vacancies' => $vacancies
        ];

        return view('senaempresa::Company.vacancies.new', $data);
    }




    public function saved(Request $request)
    {
        $image = $request->file('image');
        // Obtener el archivo de imagen del formulario
        if ($image) {
            $extension = $image->getClientOriginalExtension(); // Obtener la extensión del archivo
            $nameWithoutExtension = Str::slug($request->input('name')); // Generar un nombre sin espacios y en minúsculas
            $image = $nameWithoutExtension . '_' . time() . '.' . $extension; // Agregar una marca de tiempo para evitar conflictos de nombre
            $image->move(public_path('modules/senaempresa/images/vacancies/'), $name_image); // Mover la imagen a la ubicación deseada
        }

        $vacancy = new Vacancy();
        $vacancy->name = $request->input('name');
        $vacancy->image = 'modules/senaempresa/images/vacancies/' . $image;
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
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index', $data)->with('success', trans('senaempresa::menu.Vacant added with success'));
        }
    }



    public function edit($id)
    {
        // Get the current date
        $currentDate = now();

        // Find the current quarter
        $currentQuarter = Quarter::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->first();

        if (!$currentQuarter) {
            // Handle the case where no current quarter is found
            // You can throw an exception or take other appropriate action here.
        }

        // Find the next quarter
        $nextQuarter = Quarter::where('start_date', '>', $currentDate)
            ->orderBy('start_date', 'asc')
            ->first();

        // Check if there is a next quarter
        if (!$nextQuarter) {
            // If there is no next quarter, use the current quarter
            $nextQuarter = $currentQuarter;
            // Optionally, you can redirect back with a warning message
            // return redirect()->back()->with('warning', 'No hay un trimestre siguiente.');
        }

        // Retrieve the senaempresas for the current or next quarter
        $senaempresas = DB::table('senaempresas')
            ->join('quarters', 'senaempresas.quarter_id', '=', 'quarters.id')
            ->where('quarters.id', $nextQuarter->id)
            ->select('senaempresas.*')
            ->get();

        // If no senaempresas are found for the next quarter, use the current quarter
        if ($senaempresas->isEmpty()) {
            // Retrieve senaempresas for the current quarter
            $senaempresas = Senaempresa::where('quarter_id', $currentQuarter->id)->get();

            // Optionally, you can redirect back with a warning message
            // return redirect()->back()->with('warning', 'No hay senaempresas asociadas con el trimestre siguiente.');
        }

        $vacancy = Vacancy::findOrFail($id);

        $PositionCompany = PositionCompany::where('state', 'activo')->get();

        $data = [
            'title' => trans('senaempresa::menu.Edit vacancy'),
            'vacancy' => $vacancy,
            'PositionCompany' => $PositionCompany,
            'senaempresas' => $senaempresas
        ];

        return view('senaempresa::Company.vacancies.edit', $data);
    }



    public function updated(Request $request, $id)
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
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index')->with('success', trans('senaempresa::menu.Vacancy successfully updated.'));
        } else {
            return redirect()->back()->with('error', trans('senaempresa::menu.Error updating the Vacancy.'));
        }
    }
    public function delete($id)
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
    public function associated_course(Request $request)
    {
        try {
            $courseId = $request->input('course_id');
            $vacancyId = $request->input('vacancy_id');
            $isChecked = $request->input('checked') === 'true';

            $association = CourseVacancy::where('course_id', $courseId)
                ->where('vacancy_id', $vacancyId)
                ->first();

            if ($isChecked) {
                // If the checkbox is checked, create a new association
                if (!$association) {
                    CourseVacancy::create([
                        'course_id' => $courseId,
                        'vacancy_id' => $vacancyId,
                    ]);
                } else {
                    // If the association exists but was deleted, restore it
                    $association->restore();
                }
                $message = 'Association created successfully.';
            } else {
                // If the checkbox is unchecked, delete the association if it exists
                if ($association) {
                    $association->delete();
                }
                $message = 'Association deleted successfully.';
            }

            return response()->json(['success' => $message], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred. Details: ' . $e->getMessage()], 500);
        }
    }
    public function show_associates(Request $request)
    {
        try {
            $courseId = $request->input('course_id');
            $vacancyId = $request->input('vacancy_id');
            $isChecked = $request->input('checked') === 'true';

            $association = CourseVacancy::where('course_id', $courseId)
                ->where('vacancy_id', $vacancyId)
                ->first();

            if ($isChecked) {
                // If the checkbox is checked, create a new association
                if (!$association) {
                    CourseVacancy::create([
                        'course_id' => $courseId,
                        'vacancy_id' => $vacancyId,
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

    public function partner_course()
    {
        $currentDate = now();

        // Find the next quarter
        $nextQuarter = Quarter::where('start_date', '>', $currentDate)
            ->orderBy('start_date', 'asc')
            ->first();

        if (!$nextQuarter) {
            // Handle the case where no next quarter is found
            return redirect()->back()->with('info', trans('senaempresa::menu.There is no next quarter.'));
        }

        // Retrieve the senaempresa associated with the next quarter
        $nextSenaempresa = Senaempresa::where('quarter_id', $nextQuarter->id)->first();

        if (!$nextSenaempresa) {
            // Handle the case where no senaempresa is found for the next quarter
            return redirect()->back()->with('info', trans('senaempresa::menu.There is no senaempresa associated with the next quarter.'));
        }

        // Retrieve the courses and vacancies related to the next senaempresa
        $courses = $nextSenaempresa->courses;
        $vacancies = Vacancy::where('senaempresa_id', $nextSenaempresa->id)
            ->where('state', 'Disponible')
            ->get();

        if ($courses->isEmpty() && $vacancies->isEmpty()) {
            // Handle the case where no courses and vacancies are found
            return redirect()->back()->with('info', trans('senaempresa::menu.You must first associate courses and vacancies to the next quarters senaempresa.'));
        }

        $courseofvacancy = CourseVacancy::all();

        $data = [
            'title' => trans('senaempresa::menu.Assign Courses to Vacancies'),
            'courses' => $courses,
            'vacancies' => $vacancies,
            'courseofvacancy' => $courseofvacancy,
        ];

        return view('senaempresa::Company.vacancies.partner_course', $data);
    }






}
