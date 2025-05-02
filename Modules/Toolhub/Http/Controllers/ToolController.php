<?php

namespace Modules\Toolhub\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Toolhub\Entities\Tool;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $tools = Tool::get();
        return view('toolhub::admin.indextools')->with ([ 'tools' => $tools,]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('toolhub::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
{
    // Recibir los valores del formulario
    $code = $request->code;
    $name = $request->name;
    $description = $request->description;
    $condition = $request->condition;
    $category = $request->category;

    // Validar los datos
    $request->validate([
        'code' => 'required|string|max:10',
        'name' => 'required|string|max:25',
        'description' => 'required|string|max:255',
        'condition' => 'required|in:new,used',
        'category' => 'required|in:Manual,Electrica,Mecanica',
    ]);

    // Crear la herramienta y asignar valores
    $tool = new Tool();
    $tool->code = $code;
    $tool->name = $name;
    $tool->description = $description;
    $tool->condition = $condition;
    $tool->is_available = 1;  // Asignar como disponible por defecto
    $tool->category = $category;

    // Guardar la herramienta en la base de datos
    $tool->save();

    // Redirigir con mensaje de éxito
    return redirect()->back()->with('success', 'Herramienta registrada con éxito');
}

       
       
    

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('toolhub::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        
        return view('toolhub::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        // Validar datos
        $request->validate([
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'condition' => 'required|in:new,used',
            'category' => 'required|in:Manual,Electrica,Mecanica',
        ]);
    
        // Buscar y actualizar herramienta
        $tool = Tool::findOrFail($id);
        $tool->code = $request->input('code');
        $tool->name = $request->input('name');
        $tool->description = $request->input('description');
        $tool->condition = $request->input('condition');
        $tool->is_available = 1;
        $tool->category = $request->input('category');
        $tool->save();
    
        // Redirigir con mensaje
        return redirect()->back()->with('success', 'Herramienta actualizada con éxito');
    }
    
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        // Buscar y eliminar herramienta
        $tool = Tool::findOrFail($id);

        if ($tool){
        $tool->delete();
        }
        // Redirigir con mensaje
        return redirect()->back()->with('success', 'Herramienta eliminada con éxito');
    }
}
