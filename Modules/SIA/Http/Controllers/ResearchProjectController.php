<?php

namespace Modules\SIA\Http\Controllers;

use Illuminate\Http\Request;
use Modules\SICA\Entities\Person;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\SIA\Entities\ResearchProject;
use Illuminate\Contracts\Support\Renderable;
use Modules\SIA\Entities\ResearchProjectApplication;

class ResearchProjectController extends Controller
{
    public function index()
    {
        $view = ['titlePage' => 'Proyectos de Investigación', 'titleView' => 'Proyectos de Investigación'];
        $projects = ResearchProject::with('person')->latest()->get();
        return view('sia::research_project.index', compact('projects', 'view'));
    }

    public function searchperson(Request $request)
    {
        $term = $request->input('q');

        $persons = Person::whereRaw("CONCAT(first_name, ' ', first_last_name, ' ', second_last_name) LIKE ?", ['%' . $term . '%'])->get();

        $results = [];
        foreach ($persons as $person) {
            $results[] = [
                'id' => $person->id,
                'text' => $person->first_name . ' ' . $person->first_last_name,
            ];
        }

        return response()->json($results);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'estado' => 'required|in:En Curso,Finalizado,Cancelado',
            'person_id' => 'required|exists:people,id',
            'pdf_report' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('pdf_report')) {
            $path = $request->file('pdf_report')->store('public/research_projects');
            $validated['pdf_report_path'] = Storage::url($path);
        }

        ResearchProject::create($validated);

        return redirect()->back()
            ->with('success', 'Proyecto creado correctamente.');
    }

    public function update(Request $request, ResearchProject $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'estado' => 'required|in:En Curso,Finalizado,Cancelado',
            'person_id' => 'required|exists:people,id',
            'pdf_report' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('pdf_report')) {
            // Eliminar PDF anterior si existe
            if ($project->pdf_report_path) {
                $oldPath = str_replace('/storage/', 'public/', $project->pdf_report_path);
                Storage::delete($oldPath);
            }

            $path = $request->file('pdf_report')->store('public/research_projects');
            $validated['pdf_report_path'] = Storage::url($path);
        }

        $project->update($validated);

        return redirect()->back()
            ->with('success', 'Proyecto actualizado correctamente.');
    }

    public function destroy(ResearchProject $project)
    {
        // Borrar PDF si existe
        if ($project->pdf_report_path) {
            $oldPath = str_replace('/storage/', 'public/', $project->pdf_report_path);
            Storage::delete($oldPath);
        }

        $project->delete();

        return redirect()->back()
            ->with('success', 'Proyecto eliminado correctamente.');
    }


    public function showApplicationForm()
    {
        $view = ['titlePage' => 'Postulación de proyectos de investigación', 'titleView' => 'Postulación de proyectos de investigación'];
        $projects = ResearchProject::where('state', 'En Curso')->get();
        return view('sia::research_project.apply', compact('projects', 'view'));
    }

    public function showProjectInfo(Request $request)
    {
        $project = ResearchProject::with('person')->findOrFail($request->id);

        return response()->json([
            'description' => $project->description,
            'start_date' => $project->start_date,
            'end_date' => $project->end_date,
            'state' => $project->state,
            'responsible' => $project->person ? $project->person->full_name : 'No asignado',
            'pdf_report_path' => $project->pdf_report_path,
        ]);
    }


    public function apply(Request $request)
    {
        $request->validate([
            'research_project_id' => 'required|exists:research_projects,id',
        ]);

        $personId = Auth::user()->person->apprentices->first()->id;

        // Evitar postulaciones duplicadas
        $exists = ResearchProjectApplication::where([
            ['research_project_id', $request->research_project_id],
            ['apprentice_id', $personId]
        ])->exists();

        if ($exists) {
            return back()->with('error', 'Ya estás postulado a este proyecto.');
        }

        ResearchProjectApplication::create([
            'research_project_id' => $request->research_project_id,
            'apprentice_id' => $personId,
            'status' => 'Pendiente',
        ]);

        return back()->with('success', 'Te postulaste correctamente.');
    }

    public function manageApplications()
    {
        $view = ['titlePage' => 'Gestion de postulaciones', 'titleView' => 'Gestion de postulaciones'];
        $applications = ResearchProjectApplication::with(['project', 'apprentice'])->latest()->get();
        return view('sia::research_project.manage_applications', compact('applications', 'view'));
    }

    public function updateStatus(Request $request, $id)
    {
        $application = ResearchProjectApplication::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Aprobado,Rechazado',
            'observation' => 'nullable|string',
        ]);

        if ($validated['status'] == 'Rechazado' && empty($validated['observation'])) {
            return redirect()->back()->with('error', 'Debe ingresar una observación para rechazar.');
        }

        $application->status = $validated['status'];
        $application->observation = $validated['status'] == 'Rechazado' ? $validated['observation'] : null;
        $application->save();

        return redirect()->back()->with('success', 'Estado actualizado correctamente.');
    }

    public function group(Request $request)
    {
        $projects = ResearchProject::all();

        $project = null;
        $applications = [];

        if ($request->filled('project_id')) {
            $project = ResearchProject::findOrFail($request->project_id);
            $applications = $project->research_project_applications()
                ->with(['apprentice.person'])
                ->where('status', '!=', 'Rechazado')
                ->get();
        }

        $view = ['titlePage' => 'Grupos de Semillero', 'titleView' => 'Grupos de Semillero'];
        return view('sia::research_project.groups', compact('projects', 'project', 'applications', 'view'));
    }

    public function detachApplication($id)
    {
        $application = ResearchProjectApplication::findOrFail($id);
        $application->delete();

        return redirect()->back()->with('success', 'Aprendiz desasociado correctamente.');
    }

}
