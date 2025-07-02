<?php

namespace Modules\SIA\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\SIA\Entities\Publication;
use Auth;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|sia.inst-inv|sia.appr-inv');
    }

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
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string|max:255',
            'fecha_publicacion' => 'required|date|after_or_equal:today',
            'estado' => 'required|in:PENDIENTE,PUBLICADO,RECHAZADO',
        ];

        $messages = [
            'titulo.required' => trans('sia::controllers.SIA_publication_title_required'),
            'contenido.required' => trans('sia::controllers.SIA_publication_pdf_path_required'),
            'fecha_publicacion.required' => trans('sia::controllers.SIA_publication_date_required'),
            'fecha_publicacion.after_or_equal' => trans('sia::controllers.SIA_publication_date_valid'),
            'estado.required' => trans('sia::controllers.SIA_publication_status_required'),
            'estado.in' => trans('sia::controllers.SIA_publication_status_valid'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $status = Auth::user()->hasRole('admin|sia.inst-inv') ? $request->input('estado') : 'PENDIENTE';
        \DB::transaction(function () use ($request, $status) {
            Publication::create([
                'author_id' => Auth::id(),
                'reviewer_id' => null,
                'title' => $request->input('titulo'),
                'pdf_path' => $request->input('contenido'),
                'publication_date' => $request->input('fecha_publicacion'),
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

        $rules = [
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string|max:255',
            'fecha_publicacion' => 'required|date|after_or_equal:today',
            'estado' => 'required|in:PENDIENTE,PUBLICADO,RECHAZADO',
        ];

        $messages = [
            'titulo.required' => trans('sia::controllers.SIA_publication_title_required'),
            'contenido.required' => trans('sia::controllers.SIA_publication_pdf_path_required'),
            'fecha_publicacion.required' => trans('sia::controllers.SIA_publication_date_required'),
            'fecha_publicacion.after_or_equal' => trans('sia::controllers.SIA_publication_date_valid'),
            'estado.required' => trans('sia::controllers.SIA_publication_status_required'),
            'estado.in' => trans('sia::controllers.SIA_publication_status_valid'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request, $publication) {
            $publication->update([
                'title' => $request->input('titulo'),
                'pdf_path' => $request->input('contenido'),
                'publication_date' => $request->input('fecha_publicacion'),
                'status' => $request->input('estado'),
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
            'estado' => 'required|in:PUBLICADO,RECHAZADO',
            'comentarios_revisor' => 'nullable|string',
        ];

        $messages = [
            'estado.required' => trans('sia::controllers.SIA_publication_review_status_required'),
            'estado.in' => trans('sia::controllers.SIA_publication_review_status_valid'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request, $publication) {
            $publication->updateStatus($request->input('estado'), Auth::id(), $request->input('comentarios_revisor'));
        });

        return redirect()->route('sia.admin.publications.pending')
            ->with('message_sia', trans('sia::controllers.SIA_publication_review_success'))
            ->with('message_sia_type', 'success');
    }
}