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
    // Mostrar publicaciones a gestionar
    public function index()
    {
        $view = ['titlePage' => 'Gestión de Publicaciones', 'titleView' => 'Gestión de Publicaciones'];
        $publications = Publication::with('author')->latest()->get();
        return view('sia::publication.index', compact('publications', 'view'));
    }

    // Actualizar estado y observación
    public function updateStatus(Request $request, $publication)
    {
        $publication = Publication::find($publication);
        $publication->status = $request->input('status');
        $publication->reviewer_id = auth()->user()->person->id;
        $publication->review_date = now();
        $publication->reviewer_comments = $request->input('reviewer_comments');
        $publication->save();

        return redirect()->back()->with('success', 'Publicación actualizada correctamente.');
    }

    public function store_admin(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'author_id' => 'required|exists:people,id',
            'publication_date' => 'required|date',
            'pdf' => 'required|mimes:pdf|max:10240',
            'image' => 'nullable|image|max:2048',
        ]);

        $pdfPath = $request->file('pdf')->store('publications/pdfs', 'public');
        $imagePath = $request->hasFile('image') ?
            $request->file('image')->store('publications/images', 'public') : null;

        Publication::create([
            'title' => $request->title,
            'description' => $request->description,
            'author_id' => $request->author_id,
            'publication_date' => $request->publication_date,
            'pdf_path' => 'storage/' . $pdfPath,
            'image' => $imagePath ? 'storage/' . $imagePath : null,
            'status' => 'Publicada',
        ]);

        return redirect()->route('sia.admin.publication.index')->with('success', 'Publicación creada correctamente.');
    }


    public function create()
    {
        $view = ['titlePage' => 'Publicaciones', 'titleView' => 'Mis Publicaciones'];
        $publications = Publication::where('author_id', auth()->user()->person->id)->latest()->get();
        return view('sia::publication.create', compact('publications', 'view'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'pdf_file' => 'required|mimes:pdf|max:2048',
            'image' => 'nullable|image|max:2048',
            'publication_date' => 'required|date',
        ]);

        $pdfPath = $request->file('pdf_file')->store('public/publications');
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/publications/images');
        }

        Publication::create([
            'author_id' => auth()->user()->person->id,
            'title' => $request->title,
            'description' => $request->description,
            'pdf_path' => Storage::url($pdfPath),
            'image' => $imagePath ? Storage::url($imagePath) : null,
            'publication_date' => $request->publication_date,
            'status' => 'Pendiente',
        ]);

        return redirect()->back()->with('success', 'Publicación enviada para revisión.');
    }
}
