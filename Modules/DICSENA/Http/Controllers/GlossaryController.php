<?php

namespace Modules\DICSENA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Program;
use Modules\DICSENA\Entities\Glossary;
use Illuminate\Pagination\LengthAwarePaginator;

class GlossaryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $glossaries = Glossary::get();
        return view('dicsena::crudglossary.index', compact('glossaries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $programs = Program::all();
        return view('dicsena::crudglossary.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'word' => 'required',
            'traduction' => 'required',
            'meaning' => 'required',
            'program_id' => 'required|exists:programs,id',
        ]);

        Glossary::create($validatedData);

        return redirect()->route('dicsena.instructor.glossary.index')->with('success', 'Glosario creado exitosamente');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('dicsena::crudglossary.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $programs = Program::all();
        $glossary = Glossary::find($id);
        if (!$glossary) {
            return redirect()->route('dicsena.instructor.glossary.index')->with('error', 'Glosario no encontrado');
        }
        return view('dicsena::crudglossary.edit', compact('glossary', 'programs'));
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
            'word' => 'required',
            'traduction' => 'required',
            'meaning' => 'required',
            'program_id' => 'required|exists:programs,id',
        ]);

        $glossary = Glossary::find($id); // Agregar esta línea para obtener el objeto Glossary
        if (!$glossary) {
            return redirect()->route('')->with('error', 'Glosario no encontrado');
        }

        $glossary->update($validatedData);

        return redirect()->route('dicsena.instructor.glossary.index')->with('success', 'Glosario actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $glossary = Glossary::find($id);

        if (!$glossary) {
            return redirect()->route('dicsena::crudglossary.index')->with('error', 'Glosario no encontrado');
        }

        $glossary->delete();

        return redirect()->route('dicsena.instructor.glossary.index')->with('success', 'Glosario eliminado exitosamente');
    }
}
