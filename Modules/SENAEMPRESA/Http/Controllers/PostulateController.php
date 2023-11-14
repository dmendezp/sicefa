<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\SENAEMPRESA\Entities\File_senaempresa;
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

        // Obtén el curso del aprendiz logueado
        $course = $Apprentice->course;
        $vacancies = DB::table('course_vacancy')
            ->join('vacancies', 'course_vacancy.vacancy_id', '=', 'vacancies.id')
            ->where('course_vacancy.course_id', '=', $course->id)
            ->where('vacancies.state', '=', 'Disponible')
            ->get();

        $Postulates = Postulate::with('Apprentice.Person')->get();
        $data = [
            'title' =>  trans('senaempresa::menu.Registration'),
            'Postulates' => $Postulates,
            'ApprenticeId' => $ApprenticeId,
            'vacancies' => $vacancies,
            'vacancy' => $vacancy,
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
    $postulate->score_total = 0; // Initialize score_total to 0

    // Validar el archivo CV como PDF
    if ($cvFile = $request->file('cv')) {
        if ($cvFile->getClientOriginalExtension() === 'pdf') {
            $cvFileName = Str::slug($ApprenticeId) . 'cv_' . time() . '.pdf';
            $cvFile->move(public_path('modules/senaempresa/files/cv/'), $cvFileName);
            $postulate->cv = 'modules/senaempresa/files/cv/' . $cvFileName;
        } else {
            return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.CV file must be in PDF format.'));
        }
    }

    // Validar el archivo de personalidades como PDF
    if ($personalitiesFile = $request->file('personalities')) {
        if ($personalitiesFile->getClientOriginalExtension() === 'pdf') {
            $personalitiesFileName = Str::slug($ApprenticeId) . 'personalities_' . time() . '.pdf';
            $personalitiesFile->move(public_path('modules/senaempresa/files/personalities/'), $personalitiesFileName);
            $postulate->personalities = 'modules/senaempresa/files/personalities/' . $personalitiesFileName;
        } else {
            return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.Personalities file must be in PDF format.'));
        }
    }

    // Validar el archivo de propuesta como PDF
    if ($proposalFile = $request->file('proposal')) {
        if ($proposalFile->getClientOriginalExtension() === 'pdf') {
            $proposalFileName = Str::slug($ApprenticeId) . 'proposal_' . time() . '.pdf';
            $proposalFile->move(public_path('modules/senaempresa/files/proposal/'), $proposalFileName);
            $postulate->proposal = 'modules/senaempresa/files/proposal/' . $proposalFileName;
        } else {
            return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.Proposal file must be in PDF format.'));
        }
    }

    $postulate->save();
    $data = [
        'ApprenticeId' => $ApprenticeId,
    ];

    return redirect()->route('company.vacant.vacantes', $data)->with('success', trans('senaempresa::menu.Registration made with success!'));
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

    if (Auth::check() && Auth::user()->roles[0]->name === 'Administrador Senaempresa') {
        return view('senaempresa::Company.Postulate.postulate', $data);
    } else {
        return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.Its not authorized'));
    }
}



    public function score($apprenticeId)
    {
        // Buscar el postulado por apprentice_id
        $postulate = Postulate::where('apprentice_id', $apprenticeId)->first();

        // Comprobar si se encontró un postulado
        if (!$postulate) {
            return redirect()->back()->with('error', 'No se encontró un postulado con el ID proporcionado.');
        }

        $data = ['title' => 'Asignar Puntaje', 'postulate' => $postulate];

        return view('senaempresa::Company.Postulate.score', $data);
    }

    public function assignScore(Request $request)
    {
        // Validar los datos del formulario aquí si es necesario
        $request->validate([
            'postulate_id' => 'required|numeric|min:0|max:100',
            'cv_score' => 'required|numeric|min:0|max:100',
            'personalities_score' => 'required|numeric|min:0|max:100',
            'proposal_score' => 'required|numeric|min:0|max:100',
        ]);
        $file_senaempresa = new File_senaempresa();
        $file_senaempresa->postulate_id = $request->input('postulate_id');
        $file_senaempresa->cvScore = $request->input('cv_score');
        $file_senaempresa->personalitiesScore = $request->input('personalities_score');
        $file_senaempresa->proposalScore = $request->input('proposal_score');
        if ($file_senaempresa->save()) {
            return redirect()->route('company.postulate')->with('success', 'Puntaje Asignado');
        }
        // Manejar el caso en el que no se pudo guardar
        return redirect()->route('company.postulate')->with('error', 'No se pudieron asignar los puntajes.');
    }
}
