<?php

namespace Modules\SIPORK\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SIPORK\Entities\ReproductiveCycle;
use Modules\SIPORK\Entities\Pig;

class ReproductiveCycleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $reproductiveCycles = ReproductiveCycle::with('sow')->get();
        return view('sipork::admin.ciclos_reproductivos.index', compact('reproductiveCycles'));
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pigs = Pig::where('gender', 'F')->get(); // Solo cerdas
        return view('sipork::admin.ciclos_reproductivos.create', compact('pigs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'sow_id' => 'required|exists:pigs,id_pig',
            'service_date' => 'nullable|date',
            'birth_date' => 'nullable|date',
            'live_piglets' => 'nullable|integer|min:0',
            'dead_piglets' => 'nullable|integer|min:0',
            'lactation_end_date' => 'nullable|date',
        ]);

        ReproductiveCycle::create($request->all());
        return redirect()->route('sipork.admin.sipork.ciclos_reproductivos.index')->with('success', 'Reproductive Cycle created successfully.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('sipork::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
{
    $reproductiveCycle = ReproductiveCycle::findOrFail($id);
    $pigs = Pig::where('gender', 'F')->get();
    return view('sipork::admin.ciclos_reproductivos.edit', compact('reproductiveCycle', 'pigs'));
}

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, ReproductiveCycle $reproductiveCycle)
    {
        $request->validate([
            'sow_id' => 'required|exists:pigs,id_pig',
            'service_date' => 'nullable|date',
            'birth_date' => 'nullable|date',
            'live_piglets' => 'nullable|integer|min:0',
            'dead_piglets' => 'nullable|integer|min:0',
            'lactation_end_date' => 'nullable|date',
        ]);

        $reproductiveCycle->update($request->all());
        return redirect()->route('sipork.admin.sipork.ciclos_reproductivos.index')->with('success', 'Reproductive Cycle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
