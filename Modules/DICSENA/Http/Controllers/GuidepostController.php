<?php

namespace Modules\DICSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Modules\SICA\Entities\Program;
use Modules\DICSENA\Entities\Guidepost;
use Illuminate\Support\Facades\Storage;

class GuidepostController extends Controller
{
    public function index()
    {
        $guideposts = Guidepost::all();
        return view('dicsena::crudguide.index', compact('guideposts'));
    }

    public function create()
    {
        $programs = Program::orderBy('name', 'ASC')->get();
        return view('dicsena::crudguide.create', compact('programs'));
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

    public function show($id)
    {
        $guidepost = Guidepost::findOrFail($id);
        $filePath = 'guidepost_file/' . $guidepost->url;

        if (File::exists(public_path($filePath))) {
            return response()->file(public_path($filePath));
        } else {
            return response()->json(['error' => 'El archivo no existe'], 404);
        }
    }

    public function edit($id)
    {
        $guidepost = Guidepost::findOrFail($id);
        $programs = Program::orderBy('name', 'ASC')->get();
        return view('dicsena::crudguide.edit', compact('guidepost', 'programs'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'program_id' => 'required|exists:programs,id',
        ]);

        $guidepost = Guidepost::findOrFail($id);

        if ($request->hasFile('url')) {
            $file = $request->file('url');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('guidepost_file', $fileName, 'public');
            $guidepost->url = $fileName;
        }

        $guidepost->title = $validatedData['title'];
        $guidepost->description = $validatedData['description'];
        $guidepost->program_id = $validatedData['program_id'];
        $guidepost->save();

        return redirect()->route('dicsena.instructor.guidepost.index')->with('success', 'Guidepost updated successfully');
    }

    public function destroy($id)
    {
        $guidepost = Guidepost::findOrFail($id);
        $guidepost->delete();

        return redirect()->route('dicsena.instructor.guidepost.index')->with('success', 'Guidepost deleted successfully');
    }
}
