<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SG\Entities\SupplyCattleRaising;

class SupplyCattleRaisingController extends Controller
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

        $supplies = SupplyCattleRaising::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%"))
            ->when($filter === 'low_stock', fn($q) => $q->lowStock())
            ->when($filter === 'near_expiration', fn($q) => $q->nearExpiration())
            ->when($filter === 'expired', fn($q) => $q->expired())
            ->when(!$filter, fn($q) => $q->active())
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'lowStock' => SupplyCattleRaising::lowStock()->count(),
            'nearExpiration' => SupplyCattleRaising::nearExpiration()->count(),
            'expired' => SupplyCattleRaising::expired()->count(),
        ];

        return view('sg::admin.insumos.index', compact('supplies', 'stats', 'filter', 'search'));
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
        return view('sg::admin.insumos.create');
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

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'code' => 'required|unique:supplies_cattle_raising,code|max:50',
    //         'name' => 'required|max:255',
    //         'type' => 'required|in:consumable,equipment,medication',
    //         'unit' => 'required|max:50',
    //         'presentation' => 'nullable|max:100',
    //         'current_stock' => 'required|numeric|min:0',
    //         'minimum_stock' => 'required|numeric|min:0',
    //         'unit_price' => 'required|numeric|min:0',
    //         'supplier' => 'nullable|max:255',
    //         'expiration_date' => 'nullable|date',
    //         'batch_number' => 'nullable|max:100',
    //         'observations' => 'nullable|string',
    //         'is_active' => 'sometimes|boolean',
    //     ]);

    //     SupplyCattleRaising::create($validated);

    //     return redirect()->route('sg.admin.sg.insumos.index')->with('success', 'Insumo creado exitosamente.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'code'             => 'required|string|max:50|unique:supplies_cattle_raising',
            'name'             => 'required|string|max:150',
            'type'             => 'required|in:MEDICINE,VACCINE,FEED,SUPPLEMENT,OTHER',
            'unit'             => 'required|in:ml,cm³,g,kg,units,liters',
            'presentation'     => 'nullable|string|max:100',
            'current_stock'    => 'required|numeric|min:0',
            'minimum_stock'    => 'required|numeric|min:0',
            'unit_price'       => 'nullable|numeric|min:0',
            'supplier'         => 'nullable|string|max:150',
            'expiration_date'  => 'nullable|date',
            'batch_number'     => 'nullable|string|max:100',
            'observations'     => 'nullable|string',
            'is_active' => 'sometimes|boolean',
        ]);

        SupplyCattleRaising::create($request->all());

        return redirect()->route('sg.admin.sg.insumos.index')->with('success', 'Insumo registrado exitosamente');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $supply = SupplyCattleRaising::findOrFail($id);
        return view('sg::admin.insumos.show', compact('supply'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $supply = SupplyCattleRaising::findOrFail($id);
        return view('sg::admin.insumos.edit', compact('supply'));
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
        $supply = SupplyCattleRaising::findOrFail($id);

        $request->validate([
            'code'             => 'required|string|max:50|unique:supplies_cattle_raising,code,' . $supply->id,
            'name'             => 'required|string|max:150',
            'type'             => 'required|in:MEDICINE,VACCINE,FEED,SUPPLEMENT,OTHER',
            'unit'             => 'required|in:ml,cm³,g,kg,units,liters',
            'presentation'     => 'nullable|string|max:100',
            'current_stock'    => 'required|numeric|min:0',
            'minimum_stock'    => 'required|numeric|min:0',
            'unit_price'       => 'nullable|numeric|min:0',
            'supplier'         => 'nullable|string|max:150',
            'expiration_date'  => 'nullable|date',
            'batch_number'     => 'nullable|string|max:100',
            'observations'     => 'nullable|string',
            'is_active' => 'sometimes|boolean',
        ]);

        $supply->update($request->all());

        return redirect()->route('sg.admin.sg.insumos.index')->with('success', 'Insumo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $supply = SupplyCattleRaising::findOrFail($id);
        $supply->update(['is_active' => false]);

        return redirect()->route('sg.admin.sg.insumos.index')->with('success', 'Insumo desactivado exitosamente');
    }
}
