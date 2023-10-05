<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\SENAEMPRESA\Entities\Postulate;
use Modules\SENAEMPRESA\Entities\Vacancy;
use Modules\SICA\Entities\Apprentice;

class PostulateController extends Controller
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

    public function inscription(Request $request)
    {
        $Apprentice = auth()->user()->person->apprentices()->first();

        if (!$Apprentice) {
            return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.You don’t have an associate apprentice.'));
        }

        $ApprenticeId = $Apprentice->id;

        // Obtén el curso del aprendiz logueado
        $course = $Apprentice->course;

        // Obtén las vacantes relacionadas con ese curso
        $vacancies = DB::table('course_vacancy')
            ->join('vacancies', 'course_vacancy.vacancy_id', '=', 'vacancies.id')
            ->where('course_vacancy.course_id', '=', $course->id)
            ->get();

        $Postulates = Postulate::with('Apprentice.Person')->get();
        $data = [
            'title' =>  trans('senaempresa::menu.Registration'),
            'Postulates' => $Postulates,
            'ApprenticeId' => $ApprenticeId,
            'vacancies' => $vacancies,
            // Solo las vacantes relacionadas con el curso
            'vacancy_id' => $request->input('vacancy_id'),
            'vacancy_name' => $request->input('vacancy_name'),
        ];

        return view('senaempresa::Company.Inscription.inscription', $data);
    }

    public function store(Request $request)
    {
        $Apprentice = auth()->user()->person->apprentices()->first();

        if (!$Apprentice) {
            return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.You don’t have an associate apprentice.'));
        }

        $ApprenticeId = $Apprentice->id;

        $existingPostulatesCount = Postulate::where('apprentice_id', $ApprenticeId)->count();

        if ($existingPostulatesCount >= 2) {
            return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.You cannot make more than two entries.'));
        }

        $existingPostulate = Postulate::where('apprentice_id', $ApprenticeId)
            ->where('vacancy_id', $request->input('vacancy_id'))
            ->first();

        if ($existingPostulate) {
            return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.You’ve already applied for this position.'));
        }

        $postulate = new Postulate();
        $postulate->apprentice_id = $ApprenticeId;
        $postulate->vacancy_id = $request->input('vacancy_id');
        $postulate->state = 'Inscrito';
        $postulate->score_total = null;
        $cvPath = $request->file('cv')->store('public/cv');
        $personalitiesPath = $request->file('personalities')->store('public/personalities');
        $proposalPath = $request->file('proposal')->store('public/proposal');
        $postulate->cv = $cvPath;
        $postulate->personalities = $personalitiesPath;
        $postulate->proposal = $proposalPath;
        $postulate->score_total = '0';
        $postulate->save();
        $data = [
            'ApprenticeId' => $ApprenticeId,
        ];

        return redirect()->route('company.vacant.vacantes', $data)->with('success', trans('senaempresa::menu.Registration made with success!'));
    }

    public function postulates()
    {
        $postulates = Postulate::with(['apprentice.person', 'vacancy'])->get();
        $data = ['title' => 'Postulados', 'postulates' => $postulates];
        if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa') {
            return view('senaempresa::Company.Postulate.postulate', $data);
        } else {
            return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.Its not authorized'));
        }
    }
    public function score()
    {
        $postulates = Postulate::with(['apprentice.person', 'vacancy'])->get();
        $data = ['title' => 'Asignar Puntaje', 'postulates' => $postulates];
        return view('senaempresa::Company.Postulate.score', $data);
    }
}
