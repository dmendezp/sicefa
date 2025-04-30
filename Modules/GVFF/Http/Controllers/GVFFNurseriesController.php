<?php

namespace Modules\GVFF\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GVFF\Entities\nurseries;


class GVFFNurseriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $nurseries = nurseries::all();
        return view('gvff::admin.nurseries.index', compact('nurseries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        
        return view('gvff::admin.nurseries.create');
    }

    // Almacenar un nuevo vivero
    public function store(Request $request)
    {
        

        $request->validate([
            'name' => 'required|string|max:255|unique:nurseries,name',
            'location' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            'classification' => 'required|in:public,private',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'location', 'max_capacity', 'classification', 'description']);

        // Manejar la subida de la imagen (si se proporciona)
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('nurseries', 'public');
        }

        Nurseries::create($data); // Cambiado de Nursery a Nurseries
        return redirect()->route('gvff.admin.nurseries.index')->with('success', 'Vivero creado con éxito.');
    }

    // Mostrar los detalles de un vivero
    public function show(Nurseries $nursery)
{
    return view('gvff::admin.nurseries.show', compact('nursery'));
}

    // Mostrar el formulario para editar un vivero
public function edit(Nurseries $nurseries)
{
    // Check the nursery data
    return view('gvff::admin.nurseries.edit', compact('nurseries'));
}
    // Actualizar un vivero
    public function update(Request $request, Nurseries $nurseries) // Cambiado de Nursery a Nurseries
    {
        
        $request->validate([
            'name' => 'required|string|max:255|unique:nurseries,name,' . $nurseries->id,
            'location' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            'classification' => 'required|in:public,private',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'location', 'max_capacity', 'classification', 'description']);

        // Manejar la subida de la imagen (si se proporciona)
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($nurseries->image) {
                \Storage::disk('public')->delete($nurseries->image);
            }
            $data['image'] = $request->file('image')->store('nurseries', 'public');
        }

        $nurseries->update($data);
        return redirect()->route('gvff.admin.nurseries.index')->with('success', 'Vivero actualizado con éxito.');
    }

    // Eliminar un vivero
    public function destroy(Nurseries $nurseries) // Cambiado de Nursery a Nurseries
    {
        

        // Eliminar la imagen si existe
        if ($nurseries->image) {
            \Storage::disk('public')->delete($nurseries->image);
        }
        $nurseries->delete();
        return redirect()->route('gvff.admin.nurseries.index')->with('success', 'Vivero eliminado con éxito.');
    }
}