<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SG\Entities\HealthRecordCattleRaising;
use Modules\SG\Entities\HealthRecordCattleRaisingHistory;
use Modules\SG\Entities\Animal;

class HealthRecordCattleRaisingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index(Request $request)
    {
        $animalId = $request->get('animal_id');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $records = HealthRecordCattleRaising::with('animal')
            ->when($animalId, fn($q) => $q->where('animal_id', $animalId))
            ->when($dateFrom, fn($q) => $q->whereDate('record_date', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('record_date', '<=', $dateTo))
            ->orderBy('record_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $animals = Animal::orderBy('id')->get();

        return view('sg::admin.salud.index', compact('records', 'animals', 'animalId', 'dateFrom', 'dateTo'));
    }

    public function indexliderDeUnidad(Request $request)
    {
        $animalId = $request->get('animal_id');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $records = HealthRecordCattleRaising::with('animal')
            ->when($animalId, fn($q) => $q->where('animal_id', $animalId))
            ->when($dateFrom, fn($q) => $q->whereDate('record_date', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('record_date', '<=', $dateTo))
            ->orderBy('record_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $animals = Animal::orderBy('id')->get();

        return view('sg::liderDeUnidad.health.index', compact('records', 'animals', 'animalId', 'dateFrom', 'dateTo'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    public function create()
    {
        $animals = Animal::orderBy('id')->get();
        return view('sg::admin.salud.create', compact('animals'));
    }

    public function createliderDeUnidad()
    {
        $animals = Animal::orderBy('id')->get();
        return view('sg::liderDeUnidad.health.create', compact('animals'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request)
    {
        $request->validate([
            'animal_id'           => 'required|exists:animals,id',
            'record_date'         => 'required|date',
            'symptoms'            => 'nullable|string',
            'temperature'         => 'nullable|numeric|min:30|max:42',
            'heart_rate'          => 'nullable|integer|min:40|max:120',
            'respiratory_rate'    => 'nullable|integer|min:10|max:60',
            'ruminal_movements'   => 'nullable|string|max:100',
            'fecal_consistency'   => 'nullable|string|max:100',
            'urine_description'   => 'nullable|string|max:100',
            'diagnosis'           => 'nullable|string',
            'veterinarian'        => 'nullable|string|max:100',
            'responsible'         => 'nullable|string|max:100',
            'observations'        => 'nullable|string',
        ]);

        // Si ya existe una historia clínica para este animal, redirigir a edición
        $existing = HealthRecordCattleRaising::where('animal_id', $request->animal_id)->first();
        if ($existing) {
            return redirect()->route('sg.admin.sg.salud.edit', $existing->id)
                ->with('warning', 'Ya existe una historia clínica para este animal. Puede actualizarla y se guardará un historial de cambios.');
        }

        HealthRecordCattleRaising::create($request->all());

        return redirect()->route('sg.admin.sg.salud.index')->with('success', 'Historia clínica registrada exitosamente');
    }

    public function storeliderDeUnidad(Request $request)
    {
        $request->validate([
            'animal_id'           => 'required|exists:animals,id',
            'record_date'         => 'required|date',
            'symptoms'            => 'nullable|string',
            'temperature'         => 'nullable|numeric|min:30|max:42',
            'heart_rate'          => 'nullable|integer|min:40|max:120',
            'respiratory_rate'    => 'nullable|integer|min:10|max:60',
            'ruminal_movements'   => 'nullable|string|max:100',
            'fecal_consistency'   => 'nullable|string|max:100',
            'urine_description'   => 'nullable|string|max:100',
            'diagnosis'           => 'nullable|string',
            'veterinarian'        => 'nullable|string|max:100',
            'responsible'         => 'nullable|string|max:100',
            'observations'        => 'nullable|string',
        ]);

        $existing = HealthRecordCattleRaising::where('animal_id', $request->animal_id)->first();
        if ($existing) {
            return redirect()->route('sg.liderDeUnidad.sg.health.edit', $existing->id)
                ->with('warning', 'Ya existe una historia clínica para este animal. Puede actualizarla y se guardará un historial de cambios.');
        }

        HealthRecordCattleRaising::create($request->all());

        return redirect()->route('sg.liderDeUnidad.sg.health.index')->with('success', 'Historia clínica registrada exitosamente');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    
    public function show($id)
    {
        $healthRecord = HealthRecordCattleRaising::with('histories')->findOrFail($id);
        return view('sg::admin.salud.show', compact('healthRecord'));
    }

    public function showliderDeUnidad($id)
    {
        $healthRecord = HealthRecordCattleRaising::with('histories')->findOrFail($id);
        return view('sg::liderDeUnidad.health.show', compact('healthRecord'));
    }
    

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $healthRecord = HealthRecordCattleRaising::findOrFail($id);
        $animals = Animal::orderBy('id')->get();
        return view('sg::admin.salud.edit', compact('healthRecord', 'animals'));
    }

    public function editliderDeUnidad($id)
    {
        $healthRecord = HealthRecordCattleRaising::findOrFail($id);
        $animals = Animal::orderBy('id')->get();
        return view('sg::liderDeUnidad.health.edit', compact('healthRecord', 'animals'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'animal_id'           => 'required|exists:animals,id',
            'record_date'         => 'required|date',
            'symptoms'            => 'nullable|string',
            'temperature'         => 'nullable|numeric|min:30|max:42',
            'heart_rate'          => 'nullable|integer|min:40|max:120',
            'respiratory_rate'    => 'nullable|integer|min:10|max:60',
            'ruminal_movements'   => 'nullable|string|max:100',
            'fecal_consistency'   => 'nullable|string|max:100',
            'urine_description'   => 'nullable|string|max:100',
            'diagnosis'           => 'nullable|string',
            'veterinarian'        => 'nullable|string|max:100',
            'responsible'         => 'nullable|string|max:100',
            'observations'        => 'nullable|string',
        ]);

        $healthRecord = HealthRecordCattleRaising::findOrFail($id);

        // Guardar snapshot previo en historial
        try {
            $createdBy = auth()->check() ? optional(auth()->user())->name : null;
        } catch (\Throwable $e) {
            $createdBy = null;
        }

        $historyData = $healthRecord->toArray();
        $healthRecord->histories()->create([
            'animal_id' => $healthRecord->animal_id,
            'snapshot'  => $historyData,
            'created_by'=> $createdBy,
        ]);

        $healthRecord->update($validated);

        return redirect()->route('sg.admin.sg.salud.index')->with('success', 'Historia clínica actualizada exitosamente');
    }

    public function updateliderDeUnidad(Request $request, $id)
    {
        $validated = $request->validate([
            'animal_id'           => 'required|exists:animals,id',
            'record_date'         => 'required|date',
            'symptoms'            => 'nullable|string',
            'temperature'         => 'nullable|numeric|min:30|max:42',
            'heart_rate'          => 'nullable|integer|min:40|max:120',
            'respiratory_rate'    => 'nullable|integer|min:10|max:60',
            'ruminal_movements'   => 'nullable|string|max:100',
            'fecal_consistency'   => 'nullable|string|max:100',
            'urine_description'   => 'nullable|string|max:100',
            'diagnosis'           => 'nullable|string',
            'veterinarian'        => 'nullable|string|max:100',
            'responsible'         => 'nullable|string|max:100',
            'observations'        => 'nullable|string',
        ]);

        $healthRecord = HealthRecordCattleRaising::findOrFail($id);

        try {
            $createdBy = auth()->check() ? optional(auth()->user())->name : null;
        } catch (\Throwable $e) {
            $createdBy = null;
        }

        $historyData = $healthRecord->toArray();
        $healthRecord->histories()->create([
            'animal_id' => $healthRecord->animal_id,
            'snapshot'  => $historyData,
            'created_by'=> $createdBy,
        ]);

        $healthRecord->update($validated);

        return redirect()->route('sg.liderDeUnidad.sg.health.index')->with('success', 'Historia clínica actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $healthRecord = HealthRecordCattleRaising::findOrFail($id);
        $healthRecord->delete();

        return redirect()->route('sg.admin.sg.salud.index')->with('success', 'Historia clínica eliminada exitosamente');
    }

    public function destroyliderDeUnidad($id)
    {
        $healthRecord = HealthRecordCattleRaising::findOrFail($id);
        $healthRecord->delete();

        return redirect()->route('sg.liderDeUnidad.sg.health.index')->with('success', 'Historia clínica eliminada exitosamente');
    }
}