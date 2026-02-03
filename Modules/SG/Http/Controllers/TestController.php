<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SG\Entities\Test;;
use Modules\SG\Entities\Animal;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index(Request $request)
    {
        $animalId = $request->get('animal_id');
        $testType = $request->get('test_type');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $tests = Test::with('animal')
            ->when($animalId, fn($q) => $q->where('animal_id', $animalId))
            ->when($testType, fn($q) => $q->where('test_type', $testType))
            ->when($dateFrom, fn($q) => $q->whereDate('test_date', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('test_date', '<=', $dateTo))
            ->orderBy('test_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $animals = Animal::orderBy('id')->get();
        $testTypes = Test::distinct()->orderBy('test_type')->pluck('test_type');

        return view('sg::admin.diagnosticos.index', compact('tests', 'animals', 'testTypes', 'animalId', 'testType', 'dateFrom', 'dateTo'));
    }

    public function indexliderDeUnidad(Request $request)
    {
        $animalId = $request->get('animal_id');
        $testType = $request->get('test_type');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $tests = Test::with('animal')
            ->when($animalId, fn($q) => $q->where('animal_id', $animalId))
            ->when($testType, fn($q) => $q->where('test_type', $testType))
            ->when($dateFrom, fn($q) => $q->whereDate('test_date', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('test_date', '<=', $dateTo))
            ->orderBy('test_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $animals = Animal::orderBy('id')->get();
        $testTypes = Test::distinct()->orderBy('test_type')->pluck('test_type');

        return view('sg::liderDeUnidad.diagnostics.index', compact('tests', 'animals', 'testTypes', 'animalId', 'testType', 'dateFrom', 'dateTo'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    public function create()
    {
        $animals = Animal::orderBy('id')->get();
        return view('sg::admin.diagnosticos.create', compact('animals'));
    }

    public function createliderDeUnidad()
    {
        $animals = Animal::orderBy('id')->get();
        return view('sg::liderDeUnidad.diagnostics.create', compact('animals'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request)
    {
        $request->validate([
            'animal_id'     => 'required|exists:animals,id',
            'test_date'     => 'required|date',
            'test_type'     => 'required|string|max:100',
            'result'        => 'nullable|string|max:100',
            'observations'  => 'nullable|string',
        ]);

        Test::create($request->all());

        return redirect()->route('sg.admin.sg.diagnosticos.index')->with('success', 'Prueba diagnóstica registrada exitosamente');
    }

    public function storeliderDeUnidad(Request $request)
    {
        $request->validate([
            'animal_id'     => 'required|exists:animals,id',
            'test_date'     => 'required|date',
            'test_type'     => 'required|string|max:100',
            'result'        => 'nullable|string|max:100',
            'observations'  => 'nullable|string',
        ]);

        Test::create($request->all());

        return redirect()->route('sg.liderDeUnidad.sg.diagnostics.index')->with('success', 'Prueba diagnóstica registrada exitosamente');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function show($id)
    {
        $test = Test::with('animal')->findOrFail($id);
        return view('sg::admin.diagnosticos.show', compact('test'));
    }

    public function showliderDeUnidad($id)
    {
        $test = Test::with('animal')->findOrFail($id);
        return view('sg::liderDeUnidad.diagnostics.show', compact('test'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function edit($id)
    {
        $test = Test::findOrFail($id);
        $animals = Animal::orderBy('id')->get();
        return view('sg::admin.diagnosticos.edit', compact('test', 'animals'));
    }

    public function editliderDeUnidad($id)
    {
        $test = Test::findOrFail($id);
        $animals = Animal::orderBy('id')->get();
        return view('sg::liderDeUnidad.diagnostics.edit', compact('test', 'animals'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'animal_id'     => 'required|exists:animals,id',
            'test_date'     => 'required|date',
            'test_type'     => 'required|string|max:100',
            'result'        => 'nullable|string|max:100',
            'observations'  => 'nullable|string',
        ]);

        $test = Test::findOrFail($id);
        $test->update($request->all());

        return redirect()->route('sg.admin.sg.diagnosticos.index')->with('success', 'Prueba diagnóstica actualizada exitosamente');
    }

    public function updateliderDeUnidad(Request $request, $id)
    {
        $request->validate([
            'animal_id'     => 'required|exists:animals,id',
            'test_date'     => 'required|date',
            'test_type'     => 'required|string|max:100',
            'result'        => 'nullable|string|max:100',
            'observations'  => 'nullable|string',
        ]);

        $test = Test::findOrFail($id);
        $test->update($request->all());

        return redirect()->route('sg.liderDeUnidad.sg.diagnostics.index')->with('success', 'Prueba diagnóstica actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $test = Test::findOrFail($id);
        $test->delete();

        return redirect()->route('sg.admin.sg.diagnosticos.index')->with('success', 'Prueba diagnóstica eliminada exitosamente');
    }

    public function destroyliderDeUnidad($id)
    {
        $test = Test::findOrFail($id);
        $test->delete();

        return redirect()->route('sg.liderDeUnidad.sg.diagnostics.index')->with('success', 'Prueba diagnóstica eliminada exitosamente');
    }
}
