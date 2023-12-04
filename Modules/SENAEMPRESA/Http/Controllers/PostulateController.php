<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Modules\SENAEMPRESA\Entities\FileSenaempresa;
use Modules\SENAEMPRESA\Entities\PositionCompany;
use Modules\SENAEMPRESA\Entities\Postulate;
use Modules\SENAEMPRESA\Entities\Vacancy;

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
    public function inscription(Request $request, $vacancy_id)
    {
        $Apprentice = auth()->user()->person->apprentices()->first();

        if (!$Apprentice) {
            return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.You don’t have an associate apprentice.'));
        }

        $ApprenticeId = $Apprentice->id;
        $vacancy = Vacancy::find($vacancy_id);
        $Postulates = Postulate::with('Apprentice.Person')->get();
        $data = [
            'title' =>  trans('senaempresa::menu.Registration'),
            'Postulates' => $Postulates,
            'ApprenticeId' => $ApprenticeId,
            'vacancy' => $vacancy,
        ];

        return view('senaempresa::Company.Inscription.inscription', $data);
    }

    public function registered(Request $request)
    {
        $Apprentice = auth()->user()->person->apprentices()->first();

        if (!$Apprentice) {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index')->with('error', trans('senaempresa::menu.You don’t have an associate apprentice.'));
        }

        $ApprenticeId = $Apprentice->id;

        $existingPostulatesCount = Postulate::where('apprentice_id', $ApprenticeId)->count();

        if ($existingPostulatesCount >= 2) {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index')->with('error', trans('senaempresa::menu.You cannot make more than two entries.'));
        }

        $existingPostulate = Postulate::where('apprentice_id', $ApprenticeId)
            ->where('vacancy_id', $request->input('vacancy_id'))
            ->first();

        if ($existingPostulate) {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index')->with('error', trans('senaempresa::menu.You’ve already applied for this position.'));
        }

        $postulate = new Postulate();
        $postulate->apprentice_id = $ApprenticeId;
        $postulate->vacancy_id = $request->input('vacancy_id');
        $postulate->state = 'Inscrito';
        $postulate->score_total = 0; // Initialize score_total to 0

        // Validar el archivo CV como PDF
        if ($cvFile = $request->file('cv')) {
            if ($cvFile->getClientOriginalExtension() === 'pdf') {
                $cvFileName = Str::slug($ApprenticeId) . 'cv_' . time() . '.pdf';
                $cvFile->move(public_path('modules/senaempresa/files/cv/'), $cvFileName);
                $postulate->cv = 'modules/senaempresa/files/cv/' . $cvFileName;
            } else {
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index')->with('error', trans('senaempresa::menu.CV file must be in PDF format.'));
            }
        }

        // Validar el archivo de personalidades como PDF
        if ($personalitiesFile = $request->file('personalities')) {
            if ($personalitiesFile->getClientOriginalExtension() === 'pdf') {
                $personalitiesFileName = Str::slug($ApprenticeId) . 'personalities_' . time() . '.pdf';
                $personalitiesFile->move(public_path('modules/senaempresa/files/personalities/'), $personalitiesFileName);
                $postulate->personalities = 'modules/senaempresa/files/personalities/' . $personalitiesFileName;
            } else {
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index')->with('error', trans('senaempresa::menu.Personalities file must be in PDF format.'));
            }
        }

        // Validar el archivo de propuesta como PDF
        if ($proposalFile = $request->file('proposal')) {
            if ($proposalFile->getClientOriginalExtension() === 'pdf') {
                $proposalFileName = Str::slug($ApprenticeId) . 'proposal_' . time() . '.pdf';
                $proposalFile->move(public_path('modules/senaempresa/files/proposal/'), $proposalFileName);
                $postulate->proposal = 'modules/senaempresa/files/proposal/' . $proposalFileName;
            } else {
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index')->with('error', trans('senaempresa::menu.Proposal file must be in PDF format.'));
            }
        }
        if ($postulate->save())
            $data = [
                'ApprenticeId' => $ApprenticeId,
            ];
        return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index', $data)->with('success', trans('senaempresa::menu.Registration made with success!'));
    }


    public function postulates(Request $request)
    {
        $selectedPositionId = $request->input('positionFilter');
        $PositionCompanies = PositionCompany::where('state', 'Activo')->get();

        // Consulta para obtener los postulantes filtrados por cargo
        $postulates = Postulate::with(['apprentice.person', 'vacancy'])
            ->when($selectedPositionId, function ($query) use ($selectedPositionId) {
                $query->whereHas('vacancy.positionCompany', function ($q) use ($selectedPositionId) {
                    $q->where('id', $selectedPositionId);
                });
            })
            ->get();

        $data = [
            'title' => trans('senaempresa::menu.Postulated'),
            'postulates' => $postulates,
            'PositionCompanies' => $PositionCompanies,
            'selectedPositionId' => $selectedPositionId, // Pasa la variable a la vista
        ];

        return view('senaempresa::Company.postulate.index', $data);
    }

    public function assign_score($apprenticeId)
    {
        // Buscar el postulado por apprentice_id
        $postulate = postulate::where('apprentice_id', $apprenticeId)->first();

        // Comprobar si se encontró un postulado
        if (!$postulate) {
            return redirect()->back()->with('error', 'No se encontró un postulado con el ID proporcionado.');
        }

        $data = ['title' => 'Asignar Puntaje', 'postulate' => $postulate];

        return view('senaempresa::Company.postulate.assign_score', $data);
    }

    public function score_assigned(Request $request)
    {
        // Validar el formulario si es necesario
        $request->validate([
            'postulate_id' => 'required',
            'cv_score' => 'required|integer',
            'personalities_score' => 'required|integer',
            'proposal_score' => 'required|integer',
        ]);

        $filesenaempresa = new FileSenaempresa();
        $filesenaempresa->postulate_id = $request->input('postulate_id');
        $filesenaempresa->cv_score = $request->input('cv_score');
        $filesenaempresa->personalities_score = $request->input('personalities_score');
        $filesenaempresa->proposal_score = $request->input('proposal_score');

        if ($filesenaempresa->save()) {
            // Calcular el puntaje total
            $totalScore = $filesenaempresa->cv_score + $filesenaempresa->personalities_score + $filesenaempresa->proposal_score;

            // Actualizar el puntaje total en la tabla 'postulates'
            Postulate::where('id', $request->input('postulate_id'))
                ->update(['score_total' => $totalScore]);

            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.index')
                ->with('success', 'Puntaje asignado correctamente');
        }
    }
}
