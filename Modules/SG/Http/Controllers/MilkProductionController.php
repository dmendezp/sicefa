<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SG\Entities\MilkProduction;
use Modules\SG\Entities\Animal;

class MilkProductionController extends Controller
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
        $date = $request->get('date', today()->format('Y-m-d'));
        $shift = $request->get('shift');
        $animalId = $request->get('animal_id');

        $productions = MilkProduction::with('animal')
            ->when($date, fn($q) => $q->whereDate('production_date', $date))
            ->when($shift, fn($q) => $q->where('shift', $shift))
            ->when($animalId, fn($q) => $q->where('animal_id', $animalId))
            ->orderBy('production_date', 'desc')
            ->orderBy('shift')
            ->paginate(20)
            ->withQueryString();

        $animals = Animal::females()->inProduction()->orderBy('id')->get();

        $stats = [
            'totalLiters' => MilkProduction::whereDate('production_date', $date)->sum('liters'),
            'morning' => MilkProduction::morning()->whereDate('production_date', $date)->sum('liters'),
            'afternoon' => MilkProduction::afternoon()->whereDate('production_date', $date)->sum('liters'),
            'night' => MilkProduction::night()->whereDate('production_date', $date)->sum('liters'),
        ];

        return view('sg::admin.produccion.index', compact('productions', 'animals', 'date', 'shift', 'animalId', 'stats'));
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
        $animals = Animal::females()->inProduction()->orderBy('id')->get();
        return view('sg::admin.produccion.create', compact('animals'));
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
            'animal_id' => 'required|exists:animals,id',
            'production_date' => 'required|date',
            'shift' => 'required|in:MORNING,AFTERNOON,NIGHT',
            'liters' => 'required|numeric|min:0|max:100',
            'quality' => 'required|in:HIGH,MEDIUM,LOW',
            'milk_temperature' => 'nullable|numeric|min:30|max:45',
            'responsible' => 'nullable|string|max:100',
            'observations' => 'nullable|string'
        ]);

        // Validar unicidad
        $exists = MilkProduction::where('animal_id', $request->animal_id)
            ->where('production_date', $request->production_date)
            ->where('shift', $request->shift)
            ->exists();

        if ($exists) {
            return back()->withErrors(['shift' => 'Ya existe un registro para este animal en este turno y fecha']);
        }

        MilkProduction::create($request->all());

        return redirect()->route('sg.admin.sg.produccion.index', ['date' => $request->production_date])->with('success', 'Producción registrada exitosamente');
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
        $milkProduction = MilkProduction::with('animal')->findOrFail($id);
        return view('sg::admin.produccion.show', compact('milkProduction'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $milkProduction = MilkProduction::with('animal')->findOrFail($id);
        $animals = Animal::females()->inProduction()->orderBy('id')->get();
        return view('sg::admin.produccion.edit', compact('milkProduction', 'animals'));
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
        $milkProduction = MilkProduction::findOrFail($id);

        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'production_date' => 'required|date',
            'shift' => 'required|in:MORNING,AFTERNOON,NIGHT',
            'liters' => 'required|numeric|min:0|max:100',
            'quality' => 'required|in:HIGH,MEDIUM,LOW',
            'milk_temperature' => 'nullable|numeric|min:30|max:45',
            'responsible' => 'nullable|string|max:100',
            'observations' => 'nullable|string'
        ]);

        // Validar unicidad (excluyendo el registro actual)
        $exists = MilkProduction::where('animal_id', $request->animal_id)
            ->where('production_date', $request->production_date)
            ->where('shift', $request->shift)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['shift' => 'Ya existe un registro para este animal en este turno y fecha']);
        }

        $milkProduction->update($request->all());

        return redirect()->route('sg.admin.sg.produccion.index', ['date' => $request->production_date])->with('success', 'Producción actualizada exitosamente');
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
        $milkProduction = MilkProduction::findOrFail($id);
        $milkProduction->delete();

        return redirect()->route('sg.admin.sg.produccion.index')->with('success', 'Producción eliminada exitosamente');
    }
}
