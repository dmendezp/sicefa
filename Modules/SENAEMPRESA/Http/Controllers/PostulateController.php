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
use TCPDF;

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
            return redirect()->route('company.vacant.vacantes')->with('info', trans('senaempresa::menu.You don’t have an associate apprentice.'));
        }

        $ApprenticeId = $Apprentice->id;
        $vacancy = Vacancy::find($vacancy_id);
        $Postulates = Postulate::with('Apprentice.Person')->get();
        $existingPostulatesCount = Postulate::where('apprentice_id', $ApprenticeId)->count(); // Añadido aquí

        $data = [
            'title' => trans('senaempresa::menu.Registration'),
            'Postulates' => $Postulates,
            'ApprenticeId' => $ApprenticeId,
            'vacancy' => $vacancy,
            'existingPostulatesCount' => $existingPostulatesCount, // Añadido aquí
        ];

        return view('senaempresa::Company.Inscription.inscription', $data);
    }


    public function registered(Request $request)
    {
        $Apprentice = auth()->user()->person->apprentices()->first();

        if (!$Apprentice) {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index')->with('info', trans('senaempresa::menu.You don’t have an associate apprentice.'));
        }

        $ApprenticeId = $Apprentice->id;

        $existingPostulatesCount = Postulate::where('apprentice_id', $ApprenticeId)->count();

        if ($existingPostulatesCount >= 2) {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index')->with('info', trans('senaempresa::menu.You cannot make more than two entries.'));
        }

        $existingPostulate = Postulate::where('apprentice_id', $ApprenticeId)
            ->where('vacancy_id', $request->input('vacancy_id'))
            ->first();

        if ($existingPostulate) {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index')->with('info', trans('senaempresa::menu.You’ve already applied for this position.'));
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

        if ($employment_certificateFile = $request->file('employment_certificate')) {
            if ($employment_certificateFile->getClientOriginalExtension() === 'pdf') {
                $employment_certificateFileeName = Str::slug($ApprenticeId) . 'employment_certificate_' . time() . '.pdf';
                $employment_certificateFile->move(public_path('modules/senaempresa/files/employment_certificate/'), $employment_certificateFileeName);
                $postulate->employment_certificate = 'modules/senaempresa/files/employment_certificate/' . $employment_certificateFileeName;
            } else {
                return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index')->with('info', 'El archivo del certificado debe estar en formato PDF.');
            }
        }

        // Verificar si ya existe un registro en 'filesenaempresa' para el mismo aprendiz y vacante
        $existingFileSenaempresa = Postulate::where('apprentice_id', $ApprenticeId)->first();

        if ($existingFileSenaempresa) {
            // Usar los archivos existentes para la nueva inscripción
            $postulate->cv = $existingFileSenaempresa->cv;
            $postulate->personalities = $existingFileSenaempresa->personalities;
            $postulate->proposal = $existingFileSenaempresa->proposal;
            $postulate->employment_certificate = $existingFileSenaempresa->employment_certificate;
        }

        if ($postulate->save()) {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index')->with('success', trans('senaempresa::menu.Successfully registered.'));
        } else {
            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index')->with('error', trans('senaempresa::menu.Error registering.'));
        }
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

        return view('senaempresa::Company.Postulate.index', $data);
    }


    public function assign_score($apprenticeId, $vacancyId)
    {
        // Find the postulate by apprentice_id and vacancy_id
        $postulate = Postulate::where('apprentice_id', $apprenticeId)
            ->where('vacancy_id', $vacancyId)
            ->first();

        // Check if a postulate is found
        if (!$postulate) {
            return redirect()->back()->with('info', 'No se encontró un postulado ');
        }

        $data = [
            'title' => 'Asignar Puntaje',
            'postulate' => $postulate,
        ];

        return view('senaempresa::Company.postulate.assign_score', $data);
    }


    public function score_assigned(Request $request)
    {
        $postulateId = $request->input('postulate_id');
        $vacancyId = Postulate::where('id', $postulateId)->value('vacancy_id');

        // Verificar si ya existe un registro en 'filesenaempresa' para el mismo postulate_id y vacancy_id
        $existingFileSenaempresa = FileSenaempresa::where('postulate_id', $postulateId)
            ->where('vacancy_id', $vacancyId)
            ->first();

        if ($existingFileSenaempresa) {
            // Verificar si los campos cv_score y proposal_score son nulos y actualizar si es necesario
            if ($existingFileSenaempresa->cv_score === null) {
                $existingFileSenaempresa->cv_score = $request->input('cv_score');
            }

            if ($existingFileSenaempresa->proposal_score === null) {
                $existingFileSenaempresa->proposal_score = $request->input('proposal_score');
            }

            if ($existingFileSenaempresa->personalities_score === null) {
                $existingFileSenaempresa->personalities_score = $request->input('personalities_score');
            }

            // Verificar si los campos interview_admin e interview_psychologo son nulos y actualizar si es necesario
            if ($existingFileSenaempresa->interview_admin === null) {
                $existingFileSenaempresa->interview_admin = $request->input('interview_admin');
            }

            if ($existingFileSenaempresa->interview_psychologo === null) {
                $existingFileSenaempresa->interview_psychologo = $request->input('interview_psychologo');
            }

            // Guardar los cambios
            $existingFileSenaempresa->save();

            // Verificar si todos los puntajes están establecidos
            if (
                $existingFileSenaempresa->cv_score !== null &&
                $existingFileSenaempresa->personalities_score !== null &&
                $existingFileSenaempresa->interview_admin !== null &&
                $existingFileSenaempresa->interview_psychologo !== null &&
                $existingFileSenaempresa->proposal_score !== null
            ) {
                // Calcular el puntaje total
                $totalScore = (
                    $existingFileSenaempresa->cv_score +
                    $existingFileSenaempresa->personalities_score +
                    $existingFileSenaempresa->interview_admin +
                    $existingFileSenaempresa->interview_psychologo +
                    $existingFileSenaempresa->proposal_score
                );

                // Actualizar el puntaje total en la tabla 'postulates' para el mismo postulate_id y vacancy_id
                Postulate::where('id', $postulateId)
                    ->where('vacancy_id', $vacancyId)
                    ->update(['score_total' => $totalScore]);
            }

            return redirect()->route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.index')
                ->with('success', 'Puntaje actualizado correctamente');
        }

        $filesenaempresa = new FileSenaempresa();
        $filesenaempresa->postulate_id = $postulateId;
        $filesenaempresa->vacancy_id = $vacancyId;
        $filesenaempresa->cv_score = $request->input('cv_score');
        $filesenaempresa->personalities_score = $request->input('personalities_score');
        $filesenaempresa->interview_admin = $request->input('interview_admin');
        $filesenaempresa->interview_psychologo = $request->input('interview_psychologo');
        $filesenaempresa->proposal_score = $request->input('proposal_score');

        if ($filesenaempresa->save()) {
            // Verificar si existen puntajes para los cinco criterios
            $cvScore = $filesenaempresa->cv_score;
            $personalitiesScore = $filesenaempresa->personalities_score;
            $interviewAdminScore = $filesenaempresa->interview_admin;
            $interviewPsychologoScore = $filesenaempresa->interview_psychologo;
            $proposalScore = $filesenaempresa->proposal_score;

            if (
                $cvScore !== null &&
                $personalitiesScore !== null &&
                $interviewAdminScore !== null &&
                $interviewPsychologoScore !== null &&
                $proposalScore !== null
            ) {
                // Calcular el puntaje total
                $totalScore = (
                    $cvScore +
                    $personalitiesScore +
                    $interviewAdminScore +
                    $interviewPsychologoScore +
                    $proposalScore
                );

                // Actualizar el puntaje total en la tabla 'postulates' para el mismo postulate_id y vacancy_id
                Postulate::where('id', $postulateId)
                    ->where('vacancy_id', $vacancyId)
                    ->update(['score_total' => $totalScore]);
            }

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
            return redirect()->back()->with('info', 'No se encontró un postulado.');
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
        $Apprentice = auth()->user()->person->apprentices()->first(); // Obtener el usuario autenticado
        if (!$Apprentice) {
            return redirect()->back()->withInput()->with('info', 'No eres una Aprendiz');
        }
        $postulations = Postulate::where('apprentice_id', $Apprentice->id)->get();

        $data = ['title' => 'Estado Aprendiz', 'postulations' => $postulations];
        return view('senaempresa::Company.Postulate.state_apprentice', $data);
    }


    public function seleccionados()
    {
        $postulates = postulate::with(['apprentice.person'])
            ->get();
        $data = ['title' => 'Seleccionados', 'postulates' => $postulates];
        return view('senaempresa::Company.Postulate.Application', $data);
    }

    public function generateseleccionadosPDF(Request $request)
    {
        $postulates = Postulate::with(['apprentice.person'])
            ->where('state', '=', 'Seleccionado')
            ->get();

        // Create a new instance of TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set the title of the document with the current date and time in 12-hour format
        $title = 'Reporte de Seleccionados - ' . date('Y-m-d h:i:s A');
        $pdf->SetTitle($title);

        // Define the font and size for the PDF content
        $pdf->SetFont('helvetica', '', 10);

        // Add a new page
        $pdf->AddPage();

        // Define styles for the table
        $tableStyle = 'border-collapse: collapse; width: 100%; margin: auto; text-align: center;';
        $cellStyle = 'border: 1px solid #000; text-align: center; padding: 0 auto 8px;';

        // Add the logo to the top left
        $logoPath = public_path('AdminLTE/dist/img/logo P SENA.png');
        $pdf->Image($logoPath, 176, 10, 22, '', 'PNG');

        // Set the header content centered
        $pdf->SetY(15);
        $header = 'Centro de Formación Agroindustrial "La Angostura" | Campoalegre - Huila';
        $pdf->Cell(0, 0, $header, 0, 1, 'C');

        // Set the content of the PDF
        $html = '<h4 style="text-align: center;">SENAEMPRESA</h4>';
        $html .= '<h3 style="text-align: center;">' . $title . '</h3>';
        $html .= '<table style="' . $tableStyle . '">';
        $html .= '<thead><tr>
                <th style="border: 1px solid #000; text-align: center; padding: 0 auto 8px; width: 20px;">#</th>
                <th style="' . $cellStyle . '">Aprendiz</th>
                <th style="' . $cellStyle . '">Número de documento</th>
                <th style="' . $cellStyle . '">Correo</th>
                <th style="' . $cellStyle . '">Telefono</th>
                <th style="' . $cellStyle . '">Cargo</th>
            </tr></thead>';
        $html .= '<tbody>';

        foreach ($postulates as $postulate) {
            $html .= '<tr>
                    <td style="' . $cellStyle . '">' . $postulate->id . '</td>
                    <td style="' . $cellStyle . '">' . $postulate->apprentice->person->full_name . '</td>
                    <td style="' . $cellStyle . '">' . $postulate->apprentice->person->document_number . '</td>
                    <td style="' . $cellStyle . '">' . $postulate->apprentice->person->personal_email . '</td>
                    <td style="' . $cellStyle . '">' . $postulate->apprentice->person->telephone1 . '</td>
                    <td style="' . $cellStyle . '">' . $postulate->vacancy->positionCompany->name . '</td>
                </tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, 'C');

        // Generate the PDF and return it for download with the date in the filename
        $filename = 'reporte_seleccionados' . date('Ymd') . '.pdf';
        $pdf->Output($filename, 'I');
    }
}
