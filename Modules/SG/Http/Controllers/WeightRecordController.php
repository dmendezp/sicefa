<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SG\Entities\WeightRecord;
use Modules\SG\Entities\Animal;

class WeightRecordController extends Controller
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

        $records = WeightRecord::with('animal')
            ->when($animalId, fn($q) => $q->where('animal_id', $animalId))
            ->when($dateFrom, fn($q) => $q->whereDate('weigh_date', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('weigh_date', '<=', $dateTo))
            ->orderBy('weigh_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $animals = Animal::orderBy('id')->get();

        return view('sg::admin.pesos.index', compact('records', 'animals', 'animalId', 'dateFrom', 'dateTo'));
    }

    public function indexliderDeUnidad(Request $request)
    {
        $animalId = $request->get('animal_id');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $records = WeightRecord::with('animal')
            ->when($animalId, fn($q) => $q->where('animal_id', $animalId))
            ->when($dateFrom, fn($q) => $q->whereDate('weigh_date', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('weigh_date', '<=', $dateTo))
            ->orderBy('weigh_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $animals = Animal::orderBy('id')->get();

        return view('sg::liderDeUnidad.weight.index', compact('records', 'animals', 'animalId', 'dateFrom', 'dateTo'));
    }

    public function indexaprendiz(Request $request)
    {
        $animalId = $request->get('animal_id');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $records = WeightRecord::with('animal')
            ->when($animalId, fn($q) => $q->where('animal_id', $animalId))
            ->when($dateFrom, fn($q) => $q->whereDate('weigh_date', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('weigh_date', '<=', $dateTo))
            ->orderBy('weigh_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $animals = Animal::orderBy('id')->get();

        return view('sg::aprendiz.PESOS.index', compact('records', 'animals', 'animalId', 'dateFrom', 'dateTo'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    public function create()
    {
        $animals = Animal::orderBy('id')->get();
        return view('sg::admin.pesos.create', compact('animals'));
    }

    public function createliderDeUnidad()
    {
        $animals = Animal::orderBy('id')->get();
        return view('sg::liderDeUnidad.weight.create', compact('animals'));
    }

    public function createaprendiz()
    {
        $animals = Animal::orderBy('id')->get();
        return view('sg::aprendiz.PESOS.create', compact('animals'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request)
    {
        $request->validate([
            'animal_id'              => 'required|exists:animals,id',
            'weigh_date'             => 'required|date|before_or_equal:today',
            'weight_kg'              => 'required|numeric|min:0',
            'body_condition_score'   => 'nullable|string|max:50',
            'observations'           => 'nullable|string',
        ]);

        WeightRecord::create($request->all());

        return redirect()->route('sg.admin.sg.pesos.index')->with('success', 'Pesaje registrado exitosamente');
    }

    public function storeliderDeUnidad(Request $request)
    {
        $request->validate([
            'animal_id'              => 'required|exists:animals,id',
            'weigh_date'             => 'required|date|before_or_equal:today',
            'weight_kg'              => 'required|numeric|min:0',
            'body_condition_score'   => 'nullable|string|max:50',
            'observations'           => 'nullable|string',
        ]);

        WeightRecord::create($request->all());

        return redirect()->route('sg.liderDeUnidad.sg.weight.index')->with('success', 'Pesaje registrado exitosamente');
    }

    public function storeaprendiz(Request $request)
    {
        $request->validate([
            'animal_id'              => 'required|exists:animals,id',
            'weigh_date'             => 'required|date|before_or_equal:today',
            'weight_kg'              => 'required|numeric|min:0',
            'body_condition_score'   => 'nullable|string|max:50',
            'observations'           => 'nullable|string',
        ]);

        WeightRecord::create($request->all());

        return redirect()->route('sg.aprendiz.sg.PESOS.index')->with('success', 'Pesaje registrado exitosamente');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $record = WeightRecord::with('animal')->findOrFail($id);
        return view('sg::admin.pesos.show', compact('record'));
    }

    public function showliderDeUnidad($id)
    {
        $record = WeightRecord::with('animal')->findOrFail($id);
        return view('sg::liderDeUnidad.weight.show', compact('record'));
    }

    public function showaprendiz($id)
    {
        $record = WeightRecord::with('animal')->findOrFail($id);
        return view('sg::aprendiz.PESOS.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $record = WeightRecord::findOrFail($id);
        $animals = Animal::orderBy('id')->get();
        return view('sg::admin.pesos.edit', compact('record', 'animals'));
    }

    public function editliderDeUnidad($id)
    {
        $record = WeightRecord::findOrFail($id);
        $animals = Animal::orderBy('id')->get();
        return view('sg::liderDeUnidad.weight.edit', compact('record', 'animals'));
    }

    public function editaprendiz($id)
    {
        $record = WeightRecord::findOrFail($id);
        $animals = Animal::orderBy('id')->get();
        return view('sg::aprendiz.PESOS.edit', compact('record', 'animals'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $record = WeightRecord::findOrFail($id);

        $request->validate([
            'animal_id'              => 'required|exists:animals,id',
            'weigh_date'             => 'required|date|before_or_equal:today',
            'weight_kg'              => 'required|numeric|min:0',
            'body_condition_score'   => 'nullable|string|max:50',
            'observations'           => 'nullable|string',
        ]);

        $record->update($request->all());

        return redirect()->route('sg.admin.sg.pesos.index')->with('success', 'Pesaje actualizado exitosamente');
    }

    public function updateliderDeUnidad(Request $request, $id)
    {
        $record = WeightRecord::findOrFail($id);

        $request->validate([
            'animal_id'              => 'required|exists:animals,id',
            'weigh_date'             => 'required|date|before_or_equal:today',
            'weight_kg'              => 'required|numeric|min:0',
            'body_condition_score'   => 'nullable|string|max:50',
            'observations'           => 'nullable|string',
        ]);

        $record->update($request->all());

        return redirect()->route('sg.liderDeUnidad.sg.weight.index')->with('success', 'Pesaje actualizado exitosamente');
    }

    public function updateaprendiz(Request $request, $id)
    {
        $record = WeightRecord::findOrFail($id);

        $request->validate([
            'animal_id'              => 'required|exists:animals,id',
            'weigh_date'             => 'required|date|before_or_equal:today',
            'weight_kg'              => 'required|numeric|min:0',
            'body_condition_score'   => 'nullable|string|max:50',
            'observations'           => 'nullable|string',
        ]);

        $record->update($request->all());

        return redirect()->route('sg.aprendiz.sg.PESOS.index')->with('success', 'Pesaje actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $record = WeightRecord::findOrFail($id);
        $record->delete();

        return redirect()->route('sg.admin.sg.pesos.index')->with('success', 'Pesaje eliminado exitosamente');
    }

    public function destroyliderDeUnidad($id)
    {
        $record = WeightRecord::findOrFail($id);
        $record->delete();

        return redirect()->route('sg.liderDeUnidad.sg.weight.index')->with('success', 'Pesaje eliminado exitosamente');
    }

    public function destroyaprendiz($id)
    {
        $record = WeightRecord::findOrFail($id);
        $record->delete();

        return redirect()->route('sg.aprendiz.sg.PESOS.index')->with('success', 'Pesaje eliminado exitosamente');
    }
}
