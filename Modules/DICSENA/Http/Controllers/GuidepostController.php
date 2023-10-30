<?php

namespace Modules\DICSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Person;
use Modules\DICSENA\Entities\Guidepost;

class GuidepostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $guideposts = Guidepost::all();
        return view('dicsena::crudguide.index', compact('guideposts'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $programs = Program::all();
        return view('dicsena::crudguide.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
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
        $file->storeAs('guidepost_file', $fileName);

        $guidepost = Guidepost::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'url' => $fileName,
            'program_id' => $validatedData['program_id'],
        ]);

        return redirect()->route('dicsena.instructor.guidepost.index')->with('success', 'Guidepost created successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('dicsena::crudguide.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $guidepost = Guidepost::findOrFail($id);
        $programs = Program::all();
        return view('dicsena::crudguide.edit', compact('guidepost', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
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
            $file->storeAs('guideposts_file', $fileName);
            $guidepost->url = $fileName;
        }

        $guidepost->title = $validatedData['title'];
        $guidepost->description = $validatedData['description'];
        $guidepost->program_id = $validatedData['program_id'];
        $guidepost->save();

        return redirect()->route('dicsena.instructor.guidepost.index')->with('success', 'Guidepost updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $guidepost = Guidepost::findOrFail($id);
        $guidepost->delete();

        return redirect()->route('dicsena.instructor.guidepost.index')->with('success', 'Guidepost deleted successfully');
    }
}
