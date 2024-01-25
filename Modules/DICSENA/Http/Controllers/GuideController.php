<?php

namespace Modules\DICSENA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Program;
use Modules\DICSENA\Entities\Guidepost;
use Illuminate\Support\Facades\Response;

class GuideController extends Controller
{
    public function index(Request $request)
    {
        $vista = "vista-2";
        $programs = Program::orderBy('name', 'asc')->get();
        $selectedProgram = $request->input('program_name');

        if ($selectedProgram) {
            $guideposts = Guidepost::query();
            $guideposts->whereHas('program', function ($query) use ($selectedProgram) {
                $query->where('name', 'like', "%$selectedProgram");
            });
            $guideposts = $guideposts->orderBy('created_at', 'asc')->get();
        } else {
            $guideposts = collect([]);
        }

        return view('dicsena::guide', compact('guideposts', 'programs', 'selectedProgram', 'vista'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'url' => 'required|file|mimes:pdf',
            'program_id' => 'required|exists:programs,id',
        ]);

        $file = $request->file('url');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('guidepost_file'), $fileName);

        $guidepost = Guidepost::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'url' => $fileName,
            'program_id' => $validatedData['program_id'],
        ]);

        return redirect()->route('dicsena.instructor.guidepost.index')->with('success', 'Guidepost created successfully');
    }

    public function download($id)
    {
        $guidepost = Guidepost::findOrFail($id);
        $filePath = public_path('guidepost_file/' . $guidepost->url);

        if (File::exists($filePath)) {
            $headers = [
                'Content-Type' => 'application/pdf',
            ];

            return response()->download($filePath, $guidepost->url, $headers);
        } else {
            return response()->json(['error' => 'El archivo no existe'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        // Lógica de actualización
    }

    public function destroy($id)
    {
        // Lógica de eliminación
    }
}
