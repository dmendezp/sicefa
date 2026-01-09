<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SG\Entities\WarehouseCattleRaising;

class WarehouseCattleRaisingController extends Controller
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
        $warehouses = WarehouseCattleRaising::orderBy('name')->paginate(15);
        return view('sg::admin.bodegas.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sg::admin.bodegas.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    public function store(Request $request)
    {
        $request->validate([
            'code'        => 'required|string|max:50|unique:warehouses_cattle_raising,code',
            'name'        => 'required|string|max:100',
            'location'    => 'nullable|string|max:150',
            'description' => 'nullable|string',
            'is_active'   => 'boolean'
        ]);

        WarehouseCattleRaising::create($request->all());

        return redirect()->route('sg.admin.sg.bodegas.index')->with('success', 'Bodega creada exitosamente');
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
        $warehouse = WarehouseCattleRaising::findOrFail($id);
        return view('sg::admin.bodegas.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    // public function edit($id)
    // {
    //     return view('sg::edit');
    // }

    public function edit($id)
    {
        $warehouse = WarehouseCattleRaising::findOrFail($id);
        return view('sg::admin.bodegas.edit', compact('warehouse'));
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
        $warehouse = WarehouseCattleRaising::findOrFail($id);

        $request->validate([
            'code'        => 'required|string|max:50|unique:warehouses_cattle_raising,code,' . $warehouse->id,
            'name'        => 'required|string|max:100',
            'location'    => 'nullable|string|max:150',
            'description' => 'nullable|string',
            'is_active'   => 'boolean'
        ]);

        $warehouse->update($request->all());

        return redirect()->route('sg.admin.sg.bodegas.index')->with('success', 'Bodega actualizada exitosamente');
    }   

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $warehouse = WarehouseCattleRaising::findOrFail($id);
        $warehouse->delete();

        return redirect()->route('sg.admin.sg.bodegas.index')->with('success', 'Bodega eliminada exitosamente');
    }
}
