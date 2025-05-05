<?php

namespace Modules\GVFF\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GVFF\Entities\nurseries;


class GVFFNurseriesController extends Controller
{
    
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
    
        // Crear una nueva instancia del modelo
        $nursery = new Nurseries();
        $nursery->name = $request->input('name');
        $nursery->location = $request->input('location');
        $nursery->max_capacity = $request->input('max_capacity');
        $nursery->classification = $request->input('classification');
        $nursery->description = $request->input('description');
    
        // Manejar la subida de la imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension(); // Obtener la extensión
            $name_image = \Str::slug($nursery->name) . '-' . time() . '.' . $extension; // Generar un nombre único
            $image->move(public_path('modules/gvff/images/nurseries/'), $name_image); // Mover la imagen a la carpeta
            $nursery->image = 'modules/gvff/images/nurseries/' . $name_image; // Guardar la ruta relativa
        }
    
        // Guardar el modelo
        $nursery->save();
    
        return redirect()->route('gvff.admin.nurseries.index')->with('success', 'Vivero creado con éxito.');
    }
    public function showPlants(Nurseries $nurseries)
{
    $plants = $nurseries->plants()->get();
    return view('gvff::admin.nurseries.plants', compact('nurseries', 'plants'));
}

    // Mostrar el formulario para editar un vivero
public function edit(Nurseries $nurseries)
{
    // Check the nursery data
    return view('gvff::admin.nurseries.edit', compact('nurseries'));
}
    // Actualizar un vivero
    public function update(Request $request, Nurseries $nurseries)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:nurseries,name,' . $nurseries->id,
        'location' => 'required|string|max:255',
        'max_capacity' => 'required|integer|min:1',
        'classification' => 'required|in:public,private',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Actualizar los campos
    $nurseries->name = $request->input('name');
    $nurseries->location = $request->input('location');
    $nurseries->max_capacity = $request->input('max_capacity');
    $nurseries->classification = $request->input('classification');
    $nurseries->description = $request->input('description');

    // Manejar la subida de la imagen
    if ($request->hasFile('image')) {
        // Eliminar la imagen anterior si existe
        if ($nurseries->image && file_exists(public_path($nurseries->image))) {
            unlink(public_path($nurseries->image));
        }
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $name_image = \Str::slug($nurseries->name) . '-' . time() . '.' . $extension;
        $image->move(public_path('modules/gvff/images/nurseries/'), $name_image);
        $nurseries->image = 'modules/gvff/images/nurseries/' . $name_image;
    }

    // Guardar los cambios
    $nurseries->save();

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