<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\SG\Entities\MilkProduction;
use Modules\SG\Entities\Animal;

class MilkProductionController extends Controller
{
    public function __construct()
    {
        // Limpiar transacciones pendientes al instanciar el controlador
        $this->cleanPendingTransactions();
    }

    /**
     * Limpia cualquier transacción pendiente de la conexión a BD
     */
    private function cleanPendingTransactions()
    {
        try {
            if (DB::getPdo() && DB::getPdo()->inTransaction()) {
                DB::rollBack();
                Log::warning('Se limpió una transacción pendiente en MilkProductionController');
            }
        } catch (\Exception $e) {
            // Silenciosamente ignorar si no hay conexión activa
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */

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

    public function indexliderDeUnidad(Request $request)
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

        return view('sg::liderDeUnidad.production.index', compact('productions', 'animals', 'date', 'shift', 'animalId', 'stats'));
    }

    public function indexaprendiz(Request $request)
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

        return view('sg::aprendiz.PRODUCCION.index', compact('productions', 'animals', 'date', 'shift', 'animalId', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    public function create()
    {
        $animals = Animal::females()->inProduction()->orderBy('id')->get();
        return view('sg::admin.produccion.create', compact('animals'));
    }

    public function createliderDeUnidad()
    {
        $animals = Animal::females()->inProduction()->orderBy('id')->get();
        return view('sg::liderDeUnidad.production.create', compact('animals'));
    }

    public function createaprendiz()
    {
        $animals = Animal::females()->inProduction()->orderBy('id')->get();
        return view('sg::aprendiz.PRODUCCION.create', compact('animals'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    private function validateMilkProduction(Request $request)
    {
        return $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'production_date' => 'required|date',
            'shift' => 'required|in:MORNING,AFTERNOON,NIGHT',
            'liters' => 'required|numeric|min:0',
            'quality' => 'required|in:HIGH,MEDIUM,LOW',
            'milk_temperature' => 'nullable|numeric',
            'responsible' => 'nullable|string|max:100',
            'observations' => 'nullable|string'
        ]);
    }

    private function checkDuplicateProduction($animal_id, $production_date, $shift, $excludeId = null)
    {
        $query = MilkProduction::where('animal_id', $animal_id)
            ->where('production_date', $production_date)
            ->where('shift', $shift);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    private function storeProductionData($validated)
    {
        $this->cleanPendingTransactions();
        
        try {
            DB::transaction(function () use ($validated) {
                MilkProduction::create($validated);
            });
            return true;
        } catch (\Exception $e) {
            Log::error('Error al registrar producción: ' . $e->getMessage(), ['exception' => $e]);
            return false;
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validateMilkProduction($request);
            MilkProduction::create($validated);
            
            return redirect()->route('sg.admin.sg.produccion.index', ['date' => $validated['production_date']])
                ->with('success', 'Producción registrada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error en store: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Error al guardar']);
        }
    }

    public function storeliderDeUnidad(Request $request)
    {
        try {
            $validated = $this->validateMilkProduction($request);
            MilkProduction::create($validated);
            
            return redirect()->route('sg.liderDeUnidad.sg.production.index', ['date' => $validated['production_date']])
                ->with('success', 'Producción registrada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error en storeliderDeUnidad: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Error al guardar']);
        }
    }

    public function storeaprendiz(Request $request)
    {
        try {
            $validated = $this->validateMilkProduction($request);
            MilkProduction::create($validated);
            
            return redirect()->route('sg.aprendiz.sg.PRODUCCION.index', ['date' => $validated['production_date']])
                ->with('success', 'Producción registrada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error en storeaprendiz: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Error al guardar']);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function show($id)
    {
        $milkProduction = MilkProduction::with('animal')->findOrFail($id);
        return view('sg::admin.produccion.show', compact('milkProduction'));
    }

    public function showliderDeUnidad($id)
    {
        $milkProduction = MilkProduction::with('animal')->findOrFail($id);
        return view('sg::liderDeUnidad.production.show', compact('milkProduction'));
    }

    public function showaprendiz($id)
    {
        $milkProduction = MilkProduction::with('animal')->findOrFail($id);
        return view('sg::aprendiz.PRODUCCION.show', compact('milkProduction'));
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

    public function editliderDeUnidad($id)
    {
        $milkProduction = MilkProduction::with('animal')->findOrFail($id);
        $animals = Animal::females()->inProduction()->orderBy('id')->get();
        return view('sg::liderDeUnidad.production.edit', compact('milkProduction', 'animals'));
    }

    public function editaprendiz($id)
    {
        $milkProduction = MilkProduction::with('animal')->findOrFail($id);
        $animals = Animal::females()->inProduction()->orderBy('id')->get();
        return view('sg::aprendiz.PRODUCCION.edit', compact('milkProduction', 'animals'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */

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

    public function updateliderDeUnidad(Request $request, $id)
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

        return redirect()->route('sg.liderDeUnidad.sg.production.index', ['date' => $request->production_date])->with('success', 'Producción actualizada exitosamente');
    }

    public function updateaprendiz(Request $request, $id)
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

        return redirect()->route('sg.aprendiz.sg.PRODUCCION.index', ['date' => $request->production_date])->with('success', 'Producción actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    
    public function destroy($id)
    {
        $milkProduction = MilkProduction::findOrFail($id);
        $milkProduction->delete();

        return redirect()->route('sg.admin.sg.produccion.index')->with('success', 'Producción eliminada exitosamente');
    }

    public function destroyliderDeUnidad($id)
    {
        $milkProduction = MilkProduction::findOrFail($id);
        $milkProduction->delete();

        return redirect()->route('sg.liderDeUnidad.sg.production.index')->with('success', 'Producción eliminada exitosamente');
    }

    public function destroyaprendiz($id)
    {
        $milkProduction = MilkProduction::findOrFail($id);
        $milkProduction->delete();

        return redirect()->route('sg.aprendiz.sg.PRODUCCION.index')->with('success', 'Producción eliminada exitosamente');
    }
}
