<?php

namespace Modules\SG\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SG\Entities\Medicine;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        $medicines = Medicine::orderBy('name')->paginate(12);
        $lowStockCount = Medicine::lowStock()->count();
        $nearExpirationCount = Medicine::nearExpiration()->count();
        $expiredCount = Medicine::expired()->count();

        return view('sg::admin.medicamentos.index', compact(
            'medicines',
            'lowStockCount',
            'nearExpirationCount',
            'expiredCount'
        ));
    }

    public function indexliderDeUnidad()
    {
        $medicines = Medicine::orderBy('name')->paginate(12);
        $lowStockCount = Medicine::lowStock()->count();
        $nearExpirationCount = Medicine::nearExpiration()->count();
        $expiredCount = Medicine::expired()->count();

        return view('sg::liderDeUnidad.medicines.index', compact(
            'medicines',
            'lowStockCount',
            'nearExpirationCount',
            'expiredCount'
        ));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sg::admin.medicamentos.create');
    }

    public function createliderDeUnidad()
    {
        return view('sg::liderDeUnidad.medicines.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:150|unique:medicines',
            'active_principle'  => 'required|string|max:150',
            'presentation'      => 'required|string|max:100',
            'dose_unit'         => 'required|string|max:50',
            'manufacturer'      => 'nullable|string|max:100',
            'batch'             => 'nullable|string|max:50',
            'expiration_date'   => 'required|date|after_or_equal:today',
            'stock'             => 'required|numeric|min:0',
            'minimum_stock'     => 'required|numeric|min:1',
            'observations'      => 'nullable|string'
        ]);

        Medicine::create($request->all());

        return redirect()->route('sg.admin.sg.medicamentos.index')->with('success', 'Medicamento registrado exitosamente');
    }

    public function storeliderDeUnidad(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:150|unique:medicines',
            'active_principle'  => 'required|string|max:150',
            'presentation'      => 'required|string|max:100',
            'dose_unit'         => 'required|string|max:50',
            'manufacturer'      => 'nullable|string|max:100',
            'batch'             => 'nullable|string|max:50',
            'expiration_date'   => 'required|date|after_or_equal:today',
            'stock'             => 'required|numeric|min:0',
            'minimum_stock'     => 'required|numeric|min:1',
            'observations'      => 'nullable|string'
        ]);

        Medicine::create($request->all());

        return redirect()->route('sg.liderDeUnidad.sg.medicines.index')->with('success', 'Medicamento registrado exitosamente');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */

    public function show($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('sg::admin.medicamentos.show', compact('medicine'));
    }

    public function showliderDeUnidad($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('sg::liderDeUnidad.medicines.show', compact('medicine'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('sg::admin.medicamentos.edit', compact('medicine'));
    }

     public function editliderDeUnidad($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('sg::liderDeUnidad.medicines.edit', compact('medicine'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $medicine = Medicine::findOrFail($id);

        $request->validate([
            'name'              => 'required|string|max:150|unique:medicines,name,'.$medicine->id,
            'active_principle'  => 'required|string|max:150',
            'presentation'      => 'required|string|max:100',
            'dose_unit'         => 'required|string|max:50',
            'manufacturer'      => 'nullable|string|max:100',
            'batch'             => 'nullable|string|max:50',
            'expiration_date'   => 'required|date|after_or_equal:today',
            'stock'             => 'required|numeric|min:0',
            'minimum_stock'     => 'required|numeric|min:1',
            'observations'      => 'nullable|string'
        ]);

        $medicine->update([
            'name'              => $request->input('name'),
            'active_principle'  => $request->input('active_principle'),
            'presentation'      => $request->input('presentation'),
            'dose_unit'         => $request->input('dose_unit'),
            'manufacturer'      => $request->input('manufacturer'),
            'batch'             => $request->input('batch'),
            'expiration_date'   => $request->input('expiration_date'),
            'stock'             => $request->input('stock'),
            'minimum_stock'     => $request->input('minimum_stock'),
            'observations'      => $request->input('observations')
        ]);

        return redirect()->route('sg.admin.sg.medicamentos.index')->with('success', 'Medicamento actualizado exitosamente');
    }

    public function updateliderDeUnidad(Request $request, $id)
    {
        $medicine = Medicine::findOrFail($id);

        $request->validate([
            'name'              => 'required|string|max:150|unique:medicines,name,'.$medicine->id,
            'active_principle'  => 'required|string|max:150',
            'presentation'      => 'required|string|max:100',
            'dose_unit'         => 'required|string|max:50',
            'manufacturer'      => 'nullable|string|max:100',
            'batch'             => 'nullable|string|max:50',
            'expiration_date'   => 'required|date|after_or_equal:today',
            'stock'             => 'required|numeric|min:0',
            'minimum_stock'     => 'required|numeric|min:1',
            'observations'      => 'nullable|string'
        ]);

        $medicine->update([
            'name'              => $request->input('name'),
            'active_principle'  => $request->input('active_principle'),
            'presentation'      => $request->input('presentation'),
            'dose_unit'         => $request->input('dose_unit'),
            'manufacturer'      => $request->input('manufacturer'),
            'batch'             => $request->input('batch'),
            'expiration_date'   => $request->input('expiration_date'),
            'stock'             => $request->input('stock'),
            'minimum_stock'     => $request->input('minimum_stock'),
            'observations'      => $request->input('observations')
        ]);

        return redirect()->route('sg.liderDeUnidad.sg.medicines.index')->with('success', 'Medicamento actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();

        return redirect()->route('sg.admin.sg.medicamentos.index')->with('success', 'Medicamento eliminado exitosamente');
    }

    public function destroyliderDeUnidad($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();

        return redirect()->route('sg.liderDeUnidad.sg.medicines.index')->with('success', 'Medicamento eliminado exitosamente');
    }
}
