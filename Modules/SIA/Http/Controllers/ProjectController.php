<?php

namespace Modules\SIA\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\SIA\Entities\Project;
use Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|sia.inst-inv|sia.appr-inv');
    }

    /**
     * Muestra la lista de proyectos.
     */
    public function index()
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_project_index_title_page'),
            'titleView' => trans('sia::controllers.SIA_project_index_title_view'),
        ];
        $user = Auth::user();
        $projects = $user->hasRole('admin')
            ? Project::withTrashed()->paginate(10)
            : Project::where('leader_id', $user->id)->withTrashed()->paginate(10);
        return view('sia::projects.index', compact('view', 'projects'));
    }

    /**
     * Muestra el formulario para crear un nuevo proyecto.
     */
    public function create()
    {
        $this->authorize('create', Project::class);
        $view = [
            'titlePage' => trans('sia::controllers.SIA_project_create_title_page'),
            'titleView' => trans('sia::controllers.SIA_project_create_title_view'),
        ];
        return view('sia::projects.create', compact('view'));
    }

    /**
     * Almacena un nuevo proyecto en la base de datos.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Project::class);
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'pdf_report_path' => 'nullable|file|mimes:pdf|max:2048',
            'estado' => 'required|in:EN_CURSO,FINALIZADO,CANCELADO',
        ];

        $messages = [
            'name.required' => trans('sia::controllers.SIA_project_title_required'),
            'description.required' => trans('sia::controllers.SIA_project_description_required'),
            'start_date.required' => trans('sia::controllers.SIA_project_start_date_required'),
            'start_date.after_or_equal' => trans('sia::controllers.SIA_project_start_date_valid'),
            'end_date.required' => trans('sia::controllers.SIA_project_end_date_required'),
            'end_date.after' => trans('sia::controllers.SIA_project_end_date_valid'),
            'pdf_report_path.mimes' => trans('sia::controllers.SIA_project_pdf_mimes'),
            'pdf_report_path.max' => trans('sia::controllers.SIA_project_pdf_max'),
            'estado.required' => trans('sia::controllers.SIA_project_status_required'),
            'estado.in' => trans('sia::controllers.SIA_project_status_valid'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pdfPath = $request->file('pdf_report_path') ? $request->file('pdf_report_path')->store('projects/reports', 'public') : null;

        \DB::transaction(function () use ($request, $pdfPath) {
            Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'estado' => $request->input('estado'),
                'pdf_report_path' => $pdfPath,
                'leader_id' => Auth::id(),
            ]);
        });

        return redirect()->route('sia.admin.projects.index')
            ->with('message_sia', trans('sia::controllers.SIA_project_store_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Muestra el formulario para editar un proyecto existente.
     */
    public function edit(Project $project)
    {
        $user = Auth::user();
        if (!$user->hasRole('admin') && $project->leader_id !== $user->id) {
            abort(403, 'Unauthorized action');
        }
        $view = [
            'titlePage' => trans('sia::controllers.SIA_project_edit_title_page'),
            'titleView' => trans('sia::controllers.SIA_project_edit_title_view'),
        ];
        return view('sia::projects.edit', compact('view', 'project'));
    }

    /**
     * Actualiza un proyecto en la base de datos.
     */
    public function update(Request $request, Project $project)
    {
        $user = Auth::user();
        if (!$user->hasRole('admin') && $project->leader_id !== $user->id) {
            abort(403, 'Unauthorized action');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'pdf_report_path' => 'nullable|file|mimes:pdf|max:2048',
            'estado' => 'required|in:EN_CURSO,FINALIZADO,CANCELADO',
        ];

        $messages = [
            'name.required' => trans('sia::controllers.SIA_project_title_required'),
            'description.required' => trans('sia::controllers.SIA_project_description_required'),
            'start_date.required' => trans('sia::controllers.SIA_project_start_date_required'),
            'start_date.after_or_equal' => trans('sia::controllers.SIA_project_start_date_valid'),
            'end_date.required' => trans('sia::controllers.SIA_project_end_date_required'),
            'end_date.after' => trans('sia::controllers.SIA_project_end_date_valid'),
            'pdf_report_path.mimes' => trans('sia::controllers.SIA_project_pdf_mimes'),
            'pdf_report_path.max' => trans('sia::controllers.SIA_project_pdf_max'),
            'estado.required' => trans('sia::controllers.SIA_project_status_required'),
            'estado.in' => trans('sia::controllers.SIA_project_status_valid'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pdfPath = $request->file('pdf_report_path') ? $request->file('pdf_report_path')->store('projects/reports', 'public') : $project->pdf_report_path;

        \DB::transaction(function () use ($request, $project, $pdfPath) {
            $project->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'estado' => $request->input('estado'),
                'pdf_report_path' => $pdfPath,
            ]);
        });

        return redirect()->route('sia.admin.projects.index')
            ->with('message_sia', trans('sia::controllers.SIA_project_update_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Elimina un proyecto de la base de datos.
     */
    public function destroy(Project $project)
    {
        $user = Auth::user();
        if (!$user->hasRole('admin') && $project->leader_id !== $user->id) {
            abort(403, 'Unauthorized action');
        }

        if ($project->delete()) {
            return redirect()->route('sia.admin.projects.index')
                ->with('message_sia', trans('sia::controllers.SIA_project_destroy_success'))
                ->with('message_sia_type', 'success');
        }
        return redirect()->route('sia.admin.projects.index')
            ->with('message_sia', trans('sia::controllers.SIA_project_destroy_error'))
            ->with('message_sia_type', 'error');
    }

    /**
     * Registra a un usuario en un proyecto.
     */
    public function register(Request $request, Project $project)
    {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->back()->with('message_sia', trans('sia::controllers.SIA_project_register_restricted'))->with('message_sia_type', 'error');
        }
        if ($project->users()->where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('message_sia', trans('sia::controllers.SIA_project_already_registered'))->with('message_sia_type', 'error');
        }
        if (!$project->isInProgress()) {
            return redirect()->back()->with('message_sia', trans('sia::controllers.SIA_project_only_in_progress'))->with('message_sia_type', 'error');
        }

        \DB::transaction(function () use ($project) {
            $project->users()->attach(Auth::id());
        });

        return redirect()->back()->with('message_sia', trans('sia::controllers.SIA_project_register_success'))->with('message_sia_type', 'success');
    }
}