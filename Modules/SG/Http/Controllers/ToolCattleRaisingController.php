<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SG\Entities\ToolCattleRaising;

class ToolCattleRaisingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    // public function index()
    // {
    //     return view('sg::index');
    // }

    public function index(Request $request)
    {
        $filter = $request->get('filter');
        $search = $request->get('search');

        $tools = ToolCattleRaising::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%")
                                        ->orWhere('code', 'like', "%{$search}%"))
            ->when($filter === 'operational', fn($q) => $q->operational())
            ->when($filter === 'maintenance', fn($q) => $q->inMaintenance())
            ->when($filter === 'damaged', fn($q) => $q->damaged())
            ->when($filter === 'out_of_service', fn($q) => $q->outOfService())
            ->when(!$filter, fn($q) => $q->active())
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'operational' => ToolCattleRaising::operational()->count(),
            'maintenance' => ToolCattleRaising::inMaintenance()->count(),
            'damaged'     => ToolCattleRaising::damaged()->count(),
            'outOfService' => ToolCattleRaising::outOfService()->count(),
        ];

        return view('sg::admin.herramientas.index', compact('tools', 'stats', 'filter', 'search'));
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
        return view('sg::admin.herramientas.create');
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
            'code'              => 'required|string|max:50|unique:tools_cattle_raising',
            'name'              => 'required|string|max:150',
            'type'              => 'required|in:SCALE,EAR_TAG,SYRINGE,THERMOMETER,OTHER',
            'brand'             => 'nullable|string|max:100',
            'model'             => 'nullable|string|max:100',
            'serial_number'     => 'nullable|string|max:100',
            'status'            => 'required|in:OPERATIONAL,MAINTENANCE,DAMAGED,OUT_OF_SERVICE',
            'location'          => 'nullable|string|max:100',
            'acquisition_date'  => 'nullable|date',
            'purchase_value'    => 'nullable|numeric|min:0',
            'current_responsible' => 'nullable|string|max:100',
            'observations'      => 'nullable|string'
        ]);

        ToolCattleRaising::create($request->all());

        return redirect()->route('sg.admin.sg.herramientas.index')->with('success', 'Herramienta registrada exitosamente');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $tool = ToolCattleRaising::findOrFail($id);
        return view('sg::admin.herramientas.show', compact('tool'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $tool = ToolCattleRaising::findOrFail($id);
        return view('sg::admin.herramientas.edit', compact('tool'));
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
        $request->validate([
            'code'              => "required|string|max:50|unique:tools_cattle_raising,code,{$id}",
            'name'              => 'required|string|max:150',
            'type'              => 'required|in:SCALE,EAR_TAG,SYRINGE,THERMOMETER,OTHER',
            'brand'             => 'nullable|string|max:100',
            'model'             => 'nullable|string|max:100',
            'serial_number'     => 'nullable|string|max:100',
            'status'            => 'required|in:OPERATIONAL,MAINTENANCE,DAMAGED,OUT_OF_SERVICE',
            'location'          => 'nullable|string|max:100',
            'acquisition_date'  => 'nullable|date',
            'purchase_value'    => 'nullable|numeric|min:0',
            'current_responsible' => 'nullable|string|max:100',
            'observations'      => 'nullable|string'
        ]);

        $tool = ToolCattleRaising::findOrFail($id);
        $tool->update($request->all());

        return redirect()->route('sg.admin.sg.herramientas.index', $tool)->with('success', 'Herramienta actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $tool = ToolCattleRaising::findOrFail($id);
        $tool->delete();

        return redirect()->route('sg.admin.sg.herramientas.index')->with('success', 'Herramienta eliminada exitosamente');
    }
}
