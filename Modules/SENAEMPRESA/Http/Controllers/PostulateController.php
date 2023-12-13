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
        $showAssignedScore = $request->input('showAssignedScore'); // Nuevo filtro

        $PositionCompanies = PositionCompany::where('state', 'Activo')->get();

        $score_total = DB::table('postulates')->select('id', 'score_total')->get();
        // Consulta para obtener los postulantes filtrados por cargo y puntaje asignado/sin asignar
        $postulates = Postulate::with(['apprentice.person', 'vacancy'])
            ->when($selectedPositionId, function ($query) use ($selectedPositionId) {
                $query->whereHas('vacancy.positionCompany', function ($q) use ($selectedPositionId) {
                    $q->where('id', $selectedPositionId);
                });
            })
            ->when($showAssignedScore, function ($query) use ($showAssignedScore) {
                if ($showAssignedScore == 'assigned') {
                    $query->where('score_total', '>', 0);
                } else {
                    $query->where('score_total', 0);
                }
            })
            ->get();

        $data = [
            'title' => trans('senaempresa::menu.Postulated'),
            'postulates' => $postulates,
            'PositionCompanies' => $PositionCompanies,
            'selectedPositionId' => $selectedPositionId,
            'showAssignedScore' => $showAssignedScore, // Pasa el nuevo filtro a la vista
            'score_total' => $score_total
        ];

        return view('senaempresa::Company.postulate.index', $data);
    }


    public function assign_score($apprenticeId, $vacancyId)
    {
        // Find the postulate by apprentice_id and vacancy_id
        $postulate = Postulate::where('apprentice_id', $apprenticeId)
            ->where('vacancy_id', $vacancyId)
            ->first();

        // Check if a postulate is found
        if (!$postulate) {
            return redirect()->back()->with('error', 'No se encontró un postulado con el ID proporcionado.');
        }

        $data = [
            'title' => 'Asignar Puntaje',
            'postulate' => $postulate,
        ];

        return view('senaempresa::Company.postulate.assign_score', $data);
    }


    public function score_assigned(Request $request)
    {
        // Validar el formulario si es necesario
        $request->validate([
            'postulate_id' => 'required',
            'vacancy_id' => 'required',
            'cv_score' => 'required|integer',
            'personalities_score' => 'required|integer',
            'proposal_score' => 'required|integer',
        ]);

        $postulateId = $request->input('postulate_id');
        $vacancyId = Postulate::where('id', $postulateId)->value('vacancy_id');

        // Verificar si ya existe un registro en 'filesenaempresa' para el mismo postulate_id y vacancy_id
        $existingFileSenaempresa = FileSenaempresa::where('postulate_id', $postulateId)
            ->where('vacancy_id', $vacancyId)
            ->first();

        if ($existingFileSenaempresa) {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.index')
                ->with('error', 'Ya se asignó puntaje para este postulado y vacante.');
        }

        $filesenaempresa = new FileSenaempresa();
        $filesenaempresa->postulate_id = $postulateId;
        $filesenaempresa->vacancy_id = $vacancyId;
        $filesenaempresa->cv_score = $request->input('cv_score');
        $filesenaempresa->personalities_score = $request->input('personalities_score');
        $filesenaempresa->proposal_score = $request->input('proposal_score');
        $filesenaempresa->vacancy_id = $vacancyId;

        if ($filesenaempresa->save()) {
            // Calcular el puntaje total
            $totalScore = $filesenaempresa->cv_score + $filesenaempresa->personalities_score + $filesenaempresa->proposal_score;

            // Actualizar el puntaje total en la tabla 'postulates' para el mismo postulate_id y vacancy_id
            Postulate::where('id', $postulateId)
                ->where('vacancy_id', $vacancyId)
                ->update(['score_total' => $totalScore]);

            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.index')
                ->with('success', 'Puntaje asignado correctamente');
        }
    }
    public function state($apprenticeId)
    {
        $estados = ['Seleccionado', 'No Seleccionado'];
        // Find the postulate by apprentice_id and vacancy_id
        $postulate = Postulate::where('apprentice_id', $apprenticeId)
            ->first();

        // Check if a postulate is found
        if (!$postulate) {
            return redirect()->back()->with('error', 'No se encontró un postulado con el ID proporcionado.');
        }

        $data = [
            'title' => 'Actulizar Estado',
            'postulate' => $postulate,
            'estados' => $estados
        ];

        return view('senaempresa::Company.postulate.state', $data);
    }

    public function state_updated(Request $request)
    {
        $request->validate([
            'state' => 'required|in:Seleccionado,No Seleccionado',
            'postulate_id' => 'required|exists:postulates,id',
        ]);

        $postulateId = $request->input('postulate_id');
        $state = $request->input('state');

        // Obtener el postulado actual
        $currentPostulate = Postulate::find($postulateId);

        // Obtener la vacante asociada al postulado actual
        $vacancyId = $currentPostulate->vacancy_id;

        // Actualizar el estado del postulado actual
        $currentPostulate->update(['state' => $state]);

        // Si el estado es 'Seleccionado', actualizar los demás postulados del mismo aprendiz a 'No Seleccionado'
        // y los postulados de otros aprendices para la misma vacante a 'No Seleccionado'
        if ($state == 'Seleccionado') {
            $apprenticeId = $currentPostulate->apprentice_id;

            // Actualizar postulados del mismo aprendiz a 'No Seleccionado'
            Postulate::where('apprentice_id', $apprenticeId)
                ->where('id', '!=', $postulateId)
                ->update(['state' => 'No Seleccionado']);

            // Actualizar postulados de otros aprendices para la misma vacante a 'No Seleccionado'
            Postulate::where('vacancy_id', $vacancyId)
                ->where('apprentice_id', '!=', $apprenticeId)
                ->update(['state' => 'No Seleccionado']);
        }

        return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.index')
            ->with('success', 'Estado actualizado correctamente');
    }

    public function postulations()
{
    $Apprentice = auth()->user()->person->apprentices()->first();// Obtener el usuario autenticado
    $postulations = Postulate::where('apprentice_id', $Apprentice->id)->get();

    $data = ['title' => 'Estado Aprendiz', 'postulations' => $postulations];
        return view('senaempresa::Company.Postulate.state_apprentice', $data);
    }


    public function seleccionados()
    {
        $postulates  = postulate::with(['apprentice.person'])
            ->get();
        $data = ['title' => 'Seleccionados', 'postulates' => $postulates];
        return view('senaempresa::Company.Postulate.Application', $data);
    }
}
