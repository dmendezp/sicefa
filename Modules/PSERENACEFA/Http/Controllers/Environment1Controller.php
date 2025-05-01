<?php

namespace Modules\PSERENACEFA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PSERENACEFA\Entities\Environment1;


class Environment1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $environments = Environment1::get();
        return view('pserenacefa::admin.index', ['environments1' => $environments]);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pserenacefa::admin.create');

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $capacity = $request->capacity;
        $location = $request->location;
        $description = $request->description;
        $status = $request->status;

        $Environmentsserena = new Environment1();
        $Environmentsserena->name = $name;
        $Environmentsserena->capacity = $capacity;
        $Environmentsserena->location = $location;
        $Environmentsserena->description = $description;
        $Environmentsserena->status = $status;
        $Environmentsserena->save();

        return redirect()->back()->with('success', 'El ambiente se ha creado correctamente');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('pserenacefa::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $ambiente = Environment1::findOrFail($id);
        return view('pserenacefa::admin.edit', compact('ambiente'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $ambiente = Environment1::findOrFail($id);
        $ambiente->update($request->only(['name', 'capacity', 'location', 'description', 'status']));

        return redirect()->back()->with('success', 'Ambiente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $ambiente = Environment1::findOrFail($id);
        $ambiente->delete();
    
        return redirect()->back()->with('success', 'Ambiente eliminado correctamente.');
    }
}
