<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\SENAEMPRESA\Entities\file_senaempresa;
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

        // Save CV file
        if ($cvFile = $request->file('cv')) {
            $cvFileName = Str::slug($ApprenticeId) . 'cv_' . time() . '.' . $cvFile->getClientOriginalExtension();
            $cvFile->move(public_path('modules/senaempresa/files/cv/'), $cvFileName);
            $postulate->cv = 'modules/senaempresa/files/cv/' . $cvFileName;
        }

        // Save personalities file
        if ($personalitiesFile = $request->file('personalities')) {
            $personalitiesFileName = Str::slug($ApprenticeId) . 'personalities_' . time() . '.' . $personalitiesFile->getClientOriginalExtension();
            $personalitiesFile->move(public_path('modules/senaempresa/files/personalities/'), $personalitiesFileName);
            $postulate->personalities = 'modules/senaempresa/files/personalities/' . $personalitiesFileName;
        }

        // Save proposal file
        if ($proposalFile = $request->file('proposal')) { // Correct the file input name
            $proposalFileName = Str::slug($ApprenticeId) . 'proposal_' . time() . '.' . $proposalFile->getClientOriginalExtension();
            $proposalFile->move(public_path('modules/senaempresa/files/proposal/'), $proposalFileName);
            $postulate->proposal = 'modules/senaempresa/files/proposal/' . $proposalFileName;
        }

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
            'cv_score' => 'required|numeric|min:0|max:100',
            'personalities_score' => 'required|numeric|min:0|max:100',
            'proposal_score' => 'required|numeric|min:0|max:100',
            'apprentice_id' => 'required|exists:apprentices,id', // Validar que el apprentice_id exista en la tabla de aprendices
        ]);

        // Obtener los valores de los campos del formulario
        $cvScore = $request->input('cv_score');
        $personalitiesScore = $request->input('personalities_score');
        $proposalScore = $request->input('proposal_score');
        $averageScore = ($cvScore + $personalitiesScore + $proposalScore) / 3;

        // Obtener el ID del aprendiz desde el formulario
        $apprenticeId = $request->input('apprentice_id');

        // Buscar el aprendiz por su ID
        $apprentice = Apprentice::find($apprenticeId);

        if (!$apprentice) {
            // Manejar el caso en el que no se encuentra el aprendiz
            // Puedes redirigir o mostrar un mensaje de error aquí
            return redirect()->route('company.vacant.vacantes')->with('error', trans('senaempresa::menu.Its not authorized'));
        }

        // Buscar el archivo file_senaempresa asociado al postulado
        $fileSenaempresa = file_senaempresa::where('postulate_id', $apprentice->postulate->id)->first();

        if ($fileSenaempresa) {
            // Actualizar los campos de puntuación en el modelo file_senaempresa
            $fileSenaempresa->cv_score = $cvScore;
            $fileSenaempresa->personalities_score = $personalitiesScore;
            $fileSenaempresa->proposal_score = $proposalScore;

            if ($fileSenaempresa->save()) {
                // Actualizar el campo de score_total en el modelo Postulate
                $postulate = Postulate::find($apprentice->postulate->id);
                $postulate->score_total = $averageScore;
                $postulate->save();

                // Redirigir con un mensaje de éxito
                return redirect()->route('company.postulate')->with('success', 'Puntajes asignados con éxito');
            }
        }

        // Manejar el caso en el que no se pudo guardar
        return redirect()->route('company.postulate')->with('error', 'No se pudieron asignar los puntajes.');
    }
}
