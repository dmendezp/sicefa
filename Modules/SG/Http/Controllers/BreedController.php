<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SG\Entities\Breed;

class BreedController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    // public function index()
    // {
    //     return view('sg::index');
    // }

    public function index()
    {
        $breeds = Breed::orderBy('name')->paginate(15);
        return view('sg::admin.razas.index', compact('breeds'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    // public function create()
    // {
    //     return view('sg::create');
    // }

    public function create()
    {
        return view('sg::admin.razas.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:breeds,name',
            'description' => 'nullable|string',
        ]);

        Breed::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('sg.admin.sg.razas.index')->with('success', 'Raza creada exitosamente.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    // public function show($id)
    // {
    //     return view('sg::show');
    // }

    public function show($id)
    {
        $breed = Breed::findOrFail($id);
        return view('sg::admin.razas.show', compact('breed'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $breed = Breed::findOrFail($id);
        return view('sg::admin.razas.edit', compact('breed'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    public function update(Request $request, $id)
    {
        $breed = Breed::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:breeds,name,' . $breed->id,
            'description' => 'nullable|string',
        ]);

        $breed->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('sg.admin.sg.razas.index')->with('success', 'Raza actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    // public function destroy($id)
    // {
    //     //
    // }

    public function destroy($id)
    {
        $breed = Breed::findOrFail($id);
        $breed->delete();

        return redirect()->route('sg.admin.sg.razas.index')->with('success', 'Raza eliminada exitosamente.');
    }
}
