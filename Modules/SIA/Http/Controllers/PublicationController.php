<?php

namespace Modules\SIA\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Modules\SIA\Entities\Publication;
use Auth;

class PublicationController extends Controller
{
    /**
     * Muestra la lista de publicaciones.
     */
    public function index()
    {
        $view = [
            'titlePage' => trans('sia::controllers.SIA_publication_index_title_page'),
            'titleView' => trans('sia::controllers.SIA_publication_index_title_view'),
        ];
        $user = Auth::user();
        $publications = $user->hasRole('admin|sia.inst-inv')
            ? Publication::withTrashed()->paginate(10)
            : Publication::where('author_id', $user->id)->withTrashed()->paginate(10);
        return view('sia::publications.index', compact('view', 'publications'));
    }

    /**
     * Muestra el formulario para crear una nueva publicación.
     */
    public function create()
    {
        $this->authorize('create', Publication::class);
        $view = [
            'titlePage' => trans('sia::controllers.SIA_publication_create_title_page'),
            'titleView' => trans('sia::controllers.SIA_publication_create_title_view'),
        ];
        return view('sia::publications.create', compact('view'));
    }

    /**
     * Almacena una nueva publicación en la base de datos.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Publication::class);
        $rules = [
            'title' => 'required|string|max:255',
            'pdf_path' => 'required|file|mimes:pdf|max:2048', // Máximo 2MB
            'publication_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:pending,published,rejected',
        ];

        $messages = [
            'title.required' => trans('sia::controllers.SIA_publication_title_required'),
            'pdf_path.required' => trans('sia::controllers.SIA_publication_pdf_path_required'),
            'pdf_path.file' => trans('sia::controllers.SIA_publication_pdf_must_be_file'),
            'pdf_path.mimes' => trans('sia::controllers.SIA_publication_pdf_must_be_pdf'),
            'pdf_path.max' => trans('sia::controllers.SIA_publication_pdf_max_size'),
            'publication_date.required' => trans('sia::controllers.SIA_publication_date_required'),
            'publication_date.after_or_equal' => trans('sia::controllers.SIA_publication_date_valid'),
            'status.required' => trans('sia::controllers.SIA_publication_status_required'),
            'status.in' => trans('sia::controllers.SIA_publication_status_valid'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $status = Auth::user()->hasRole('admin|sia.inst-inv') ? $request->input('status') : 'pending';
        $pdfPath = $request->file('pdf_path')->store('publications', 'public');
        
        \DB::transaction(function () use ($request, $status, $pdfPath) {
            Publication::create([
                'author_id' => Auth::id(),
                'reviewer_id' => null,
                'title' => $request->input('title'),
                'pdf_path' => $pdfPath,
                'publication_date' => $request->input('publication_date'),
                'status' => $status,
                'review_date' => null,
                'reviewer_comments' => null,
            ]);
        });

        return redirect()->route('sia.admin.publications.index')
            ->with('message_sia', trans('sia::controllers.SIA_publication_store_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Muestra el formulario para editar una publicación existente.
     */
    public function edit(Publication $publication)
    {
        $user = Auth::user();
        if (!$user->hasRole('admin|sia.inst-inv')) {
            abort(403, 'Unauthorized action');
        }
        $this->authorize('update', $publication);
        $view = [
            'titlePage' => trans('sia::controllers.SIA_publication_edit_title_page'),
            'titleView' => trans('sia::controllers.SIA_publication_edit_title_view'),
        ];
        return view('sia::publications.edit', compact('view', 'publication'));
    }

    /**
     * Actualiza una publicación en la base de datos.
     */
    public function update(Request $request, Publication $publication)
    {
        $user = Auth::user();
        if (!$user->hasRole('admin|sia.inst-inv')) {
            abort(403, 'Unauthorized action');
        }
        $this->authorize('update', $publication);

        $rules = [
            'title' => 'required|string|max:255',
            'pdf_path' => 'nullable|file|mimes:pdf|max:2048', // Opcional en actualización
            'publication_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:pending,published,rejected',
        ];

        $messages = [
            'title.required' => trans('sia::controllers.SIA_publication_title_required'),
            'pdf_path.file' => trans('sia::controllers.SIA_publication_pdf_must_be_file'),
            'pdf_path.mimes' => trans('sia::controllers.SIA_publication_pdf_must_be_pdf'),
            'pdf_path.max' => trans('sia::controllers.SIA_publication_pdf_max_size'),
            'publication_date.required' => trans('sia::controllers.SIA_publication_date_required'),
            'publication_date.after_or_equal' => trans('sia::controllers.SIA_publication_date_valid'),
            'status.required' => trans('sia::controllers.SIA_publication_status_required'),
            'status.in' => trans('sia::controllers.SIA_publication_status_valid'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request, $publication) {
            $pdfPath = $publication->pdf_path;
            if ($request->hasFile('pdf_path')) {
                // Eliminar el archivo anterior si existe
                if ($publication->pdf_path && Storage::disk('public')->exists($publication->pdf_path)) {
                    Storage::disk('public')->delete($publication->pdf_path);
                }
                $pdfPath = $request->file('pdf_path')->store('publications', 'public');
            }

            $publication->update([
                'title' => $request->input('title'),
                'pdf_path' => $pdfPath,
                'publication_date' => $request->input('publication_date'),
                'status' => $request->input('status'),
            ]);
        });

        return redirect()->route('sia.admin.publications.index')
            ->with('message_sia', trans('sia::controllers.SIA_publication_update_success'))
            ->with('message_sia_type', 'success');
    }

    /**
     * Elimina una publicación de la base de datos.
     */
    public function destroy(Publication $publication)
    {
        $user = Auth::user();
        if (!$user->hasRole('admin|sia.inst-inv')) {
            abort(403, 'Unauthorized action');
        }
        $this->authorize('delete', $publication);

        if ($publication->pdf_path && Storage::disk('public')->exists($publication->pdf_path)) {
            Storage::disk('public')->delete($publication->pdf_path);
        }

        if ($publication->delete()) {
            return redirect()->route('sia.admin.publications.index')
                ->with('message_sia', trans('sia::controllers.SIA_publication_destroy_success'))
                ->with('message_sia_type', 'success');
        }
        return redirect()->route('sia.admin.publications.index')
            ->with('message_sia', trans('sia::controllers.SIA_publication_destroy_error'))
            ->with('message_sia_type', 'error');
    }

    /**
     * Muestra la lista de publicaciones pendientes para revisión.
     */
    public function pending()
    {
        $this->authorize('viewAny', [Publication::class, 'pending']);
        $view = [
            'titlePage' => trans('sia::controllers.SIA_publication_pending_title_page'),
            'titleView' => trans('sia::controllers.SIA_publication_pending_title_view'),
        ];
        $publications = Publication::where('status', 'pending')->withTrashed()->paginate(10);
        return view('sia::publications.pending', compact('view', 'publications'));
    }

    /**
     * Procesa la revisión de una publicación.
     */
    public function review(Request $request, Publication $publication)
    {
        $this->authorize('update', $publication);
        $rules = [
            'status' => 'required|in:published,rejected',
            'reviewer_comments' => 'nullable|string',
        ];

        $messages = [
            'status.required' => trans('sia::controllers.SIA_publication_review_status_required'),
            'status.in' => trans('sia::controllers.SIA_publication_review_status_valid'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request, $publication) {
            $publication->updateStatus($request->input('status'), Auth::id(), $request->input('reviewer_comments'));
        });

        return redirect()->route('sia.admin.publications.pending')
            ->with('message_sia', trans('sia::controllers.SIA_publication_review_success'))
            ->with('message_sia_type', 'success');
    }
}