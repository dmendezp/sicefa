<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Modules\SG\Entities\Insemination;;
use Modules\SG\Entities\Animal;

class InseminationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index(Request $request)
    {
        $animalId = $request->get('animal_id');
        $status = $request->get('status');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $inseminations = Insemination::with('animal', 'bull')
            ->when($animalId, fn($q) => $q->where('animal_id', $animalId))
            ->when($status === 'pending', fn($q) => $q->pendingPalpation())
            ->when($status === 'positive', fn($q) => $q->where('palpation_result', 'POSITIVE'))
            ->when($status === 'negative', fn($q) => $q->where('palpation_result', 'NEGATIVE'))
            ->when($dateFrom, fn($q) => $q->whereDate('insemination_date', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('insemination_date', '<=', $dateTo))
            ->orderBy('insemination_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $animals = Animal::females()->orderBy('id')->get();

        return view('sg::admin.inseminaciones.index', compact('inseminations', 'animals', 'animalId', 'status', 'dateFrom', 'dateTo'));
    }

    public function indexliderDeUnidad(Request $request)
    {
        $animalId = $request->get('animal_id');
        $status = $request->get('status');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $inseminations = Insemination::with('animal', 'bull')
            ->when($animalId, fn($q) => $q->where('animal_id', $animalId))
            ->when($status === 'pending', fn($q) => $q->pendingPalpation())
            ->when($status === 'positive', fn($q) => $q->where('palpation_result', 'POSITIVE'))
            ->when($status === 'negative', fn($q) => $q->where('palpation_result', 'NEGATIVE'))
            ->when($dateFrom, fn($q) => $q->whereDate('insemination_date', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('insemination_date', '<=', $dateTo))
            ->orderBy('insemination_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $animals = Animal::females()->orderBy('id')->get();

        return view('sg::liderDeUnidad.inseminations.index', compact('inseminations', 'animals', 'animalId', 'status', 'dateFrom', 'dateTo'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    public function create()
    {
        $animals = Animal::females()->orderBy('id')->get();
        $bulls = Animal::where('sex', 'MALE')->orderBy('id')->get();
        return view('sg::admin.inseminaciones.create', compact('animals', 'bulls'));
    }

    public function createliderDeUnidad()
    {
        $animals = Animal::females()->orderBy('id')->get();
        $bulls = Animal::where('sex', 'MALE')->orderBy('id')->get();
        return view('sg::liderDeUnidad.inseminations.create', compact('animals', 'bulls'));
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
            'insemination_date'   => 'required|date|before_or_equal:today',
            'straw_code'          => 'nullable|string|max:100',
            'bull_id'             => 'nullable|exists:animals,id',
            'bull_name'           => 'nullable|string|max:100',
            'technician'          => 'nullable|string|max:100',
            'method'              => 'required|in:AI,ET,NM',
            'observations'        => 'nullable|string',
        ]);

        // Calcular fecha esperada de parto (aprox 283 días)
        $data = $request->all();
        $data['expected_birth_date'] = Carbon::parse($request->insemination_date)->addDays(283);

        Insemination::create($data);

        return redirect()->route('sg.admin.sg.inseminaciones.index')->with('success', 'Inseminación registrada exitosamente');
    }

    public function storeliderDeUnidad(Request $request)
    {
        $request->validate([
            'animal_id'           => 'required|exists:animals,id',
            'insemination_date'   => 'required|date|before_or_equal:today',
            'straw_code'          => 'nullable|string|max:100',
            'bull_id'             => 'nullable|exists:animals,id',
            'bull_name'           => 'nullable|string|max:100',
            'technician'          => 'nullable|string|max:100',
            'method'              => 'required|in:AI,ET,NM',
            'observations'        => 'nullable|string',
        ]);

        // Calcular fecha esperada de parto (aprox 283 días)
        $data = $request->all();
        $data['expected_birth_date'] = Carbon::parse($request->insemination_date)->addDays(283);

        Insemination::create($data);

        return redirect()->route('sg.liderDeUnidad.sg.inseminations.index')->with('success', 'Inseminación registrada exitosamente');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function show($id)
    {
        $insemination = Insemination::with('animal', 'bull')->findOrFail($id);
        return view('sg::admin.inseminaciones.show', compact('insemination'));
    }

    public function showliderDeUnidad($id)
    {
        $insemination = Insemination::with('animal', 'bull')->findOrFail($id);
        return view('sg::liderDeUnidad.inseminations.show', compact('insemination'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function edit($id)
    {
        $insemination = Insemination::findOrFail($id);
        $animals = Animal::females()->orderBy('id')->get();
        $bulls = Animal::where('sex', 'MALE')->orderBy('id')->get();
        return view('sg::admin.inseminaciones.edit', compact('insemination', 'animals', 'bulls'));
    }

    public function editliderDeUnidad($id)
    {
        $insemination = Insemination::findOrFail($id);
        $animals = Animal::females()->orderBy('id')->get();
        $bulls = Animal::where('sex', 'MALE')->orderBy('id')->get();
        return view('sg::liderDeUnidad.inseminations.edit', compact('insemination', 'animals', 'bulls'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */

    public function update(Request $request, $id)
    {
        $insemination = Insemination::findOrFail($id);

        $request->validate([
            'animal_id'           => 'required|exists:animals,id',
            'insemination_date'   => 'required|date|before_or_equal:today',
            'straw_code'          => 'nullable|string|max:100',
            'bull_id'             => 'nullable|exists:animals,id',
            'bull_name'           => 'nullable|string|max:100',
            'technician'          => 'nullable|string|max:100',
            'method'              => 'required|in:AI,ET,NM',
            'observations'        => 'nullable|string',
        ]);

        $data = $request->all();
        $data['expected_birth_date'] = Carbon::parse($request->insemination_date)->addDays(283);

        $insemination->update($data);

        return redirect()->route('sg.admin.sg.inseminaciones.index')->with('success', 'Inseminación actualizada exitosamente');
    }

    public function updateliderDeUnidad(Request $request, $id)
    {
        $insemination = Insemination::findOrFail($id);

        $request->validate([
            'animal_id'           => 'required|exists:animals,id',
            'insemination_date'   => 'required|date|before_or_equal:today',
            'straw_code'          => 'nullable|string|max:100',
            'bull_id'             => 'nullable|exists:animals,id',
            'bull_name'           => 'nullable|string|max:100',
            'technician'          => 'nullable|string|max:100',
            'method'              => 'required|in:AI,ET,NM',
            'observations'        => 'nullable|string',
        ]);

        $data = $request->all();
        $data['expected_birth_date'] = Carbon::parse($request->insemination_date)->addDays(283);

        $insemination->update($data);

        return redirect()->route('sg.liderDeUnidad.sg.inseminations.index')->with('success', 'Inseminación actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $insemination = Insemination::findOrFail($id);
        $insemination->delete();

        return redirect()->route('sg.admin.sg.inseminaciones.index')->with('success', 'Inseminación eliminada exitosamente');
    }

    public function destroyliderDeUnidad($id)
    {
        $insemination = Insemination::findOrFail($id);
        $insemination->delete();

        return redirect()->route('sg.liderDeUnidad.sg.inseminations.index')->with('success', 'Inseminación eliminada exitosamente');
    }
}
