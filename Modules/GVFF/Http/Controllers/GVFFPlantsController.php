<?php

namespace Modules\GVFF\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GVFF\Entities\Plants;
use Modules\GVFF\Entities\nurseries;

class GVFFPlantsController extends Controller
{
    public function index()
    {
        $plants = Plants::all();
        return view('gvff::admin.plants.index', compact('plants'));
    }

    public function create()
    {
        $nurseries = nurseries::all();
        return view('gvff::admin.plants.create', compact('nurseries'));
    }

    public function store(Request $request)
{
    $rules = [
        'nurseries_id' => 'required|exists:nurseries,id',
        'scientific_name' => 'required|string|max:255|unique:plants,scientific_name',
        'common_name' => 'required|string|max:255',
        'plant_type' => 'required|in:ornamental,forestal,medicinal,venta',
        'structure_type' => 'nullable|in:tree,shrub,herb',
        'family' => 'nullable|string|max:255',
        'characteristics' => 'nullable|string',
        'benefits' => 'nullable|string',
        'properties' => 'nullable|string',
        'traditional_uses' => 'nullable|string',
        'status' => 'nullable|in:healthy,endangered,critical',
        'inventory' => 'required|integer|min:0',
        'price' => 'nullable|numeric|min:0', // ← Agrega si usarás el precio
        'location' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'available' => 'boolean',
        'observations' => 'nullable|string',
    ];

    $validatedData = $request->validate($rules);

    // Manejo de imagen (si la suben)
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('plants', 'public');
        $validatedData['image'] = $imagePath;
    }

    // Crea la planta
    Plants::create($validatedData);

    return redirect()->route('gvff.admin.plants.index')->with('success', 'Planta creada con éxito.');
}

    public function sell($id)
    {
        $plants = Plants::findOrFail($id);
        return view('gvff::admin.plants.sell', compact('plants'));
    }
    
    public function processSell(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);
    
        $plants = Plants::findOrFail($id);
        $plants->price = $request->price;
        $plants->save();
    
        return redirect()->route('gvff.admin.plants.index')->with('success', 'Precio de venta actualizado con éxito.');
    }
    

    
    public function edit(Plants $plants)
    {
        $nurseries = nurseries::all();
        return view('gvff::admin.plants.edit', compact('plants', 'nurseries'));
    }

    public function update(Request $request, Plants $plants)
    {
        $request->validate([
            'nurseries_id' => 'required|exists:nurseries,id',
            'scientific_name' => 'required|string|max:255|unique:plants,scientific_name,' . $plants->id,
            'common_name' => 'required|string|max:255',
            'plant_type' => 'required|in:ornamental,forestal,medicinal,venta',
            'structure_type' => 'nullable|in:tree,shrub,herb',
            'family' => 'nullable|string|max:255',
            'characteristics' => 'nullable|string',
            'benefits' => 'nullable|string',
            'properties' => 'nullable|string',
            'traditional_uses' => 'nullable|string',
            'status' => 'nullable|in:healthy,endangered,critical',
            'inventory' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'available' => 'boolean',
            'observations' => 'nullable|string',
        ]);

        $plants->nurseries_id = $request->input('nurseries_id');
        $plants->scientific_name = $request->input('scientific_name');
        $plants->common_name = $request->input('common_name');
        $plants->plant_type = $request->input('plant_type');
        $plants->structure_type = $request->input('structure_type');
        $plants->family = $request->input('family');
        $plants->characteristics = $request->input('characteristics');
        $plants->benefits = $request->input('benefits');
        $plants->properties = $request->input('properties');
        $plants->traditional_uses = $request->input('traditional_uses');
        $plants->status = $request->input('status');
        $plants->inventory = $request->input('inventory');
        $plants->price = $request->input('price');
        $plants->location = $request->input('location');
        $plants->available = $request->boolean('available', true);
        $plants->observations = $request->input('observations');

        if ($request->hasFile('image')) {
            if ($plants->image && file_exists(public_path($plants->image))) {
                unlink(public_path($plants->image));
            }
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $name_image = \Str::slug($plants->common_name) . '-' . time() . '.' . $extension;
            $image->move(public_path('modules/gvff/images/plants/'), $name_image);
            $plants->image = 'modules/gvff/images/plants/' . $name_image;
        }

        $plants->save();

        return redirect()->route('gvff.admin.plants.index')->with('success', 'Planta actualizada con éxito.');
    }

    public function destroy(Plants $plants)
    {
        if ($plants->image && file_exists(public_path($plants->image))) {
            unlink(public_path($plants->image));
        }
        $plants->delete();
        return redirect()->route('gvff.admin.plants.index')->with('success', 'Planta eliminada con éxito.');
    }
}