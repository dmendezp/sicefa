<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\TypesOfBenefits;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;

class TypesOfBenefitsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

     public function typeofbenefits()
     {
         $typeofbenefits = TypesOfBenefits::all();
         return view('bienestar::typeofbenefits', compact('typeofbenefits'));
     }
 
     public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'name' => [
            'required',
            'max:255',
            Rule::unique('types_of_benefits'), // Verifica si el valor es único en la tabla
        ],
    ]);

    // Verificar si el registro ya existe en la base de datos
    $existingRecord = TypesOfBenefits::where('name', $request->name)->first();

    if ($existingRecord) {
        return response()->json(['error' => 'El tipo de beneficiario ya existe en la base de datos.'], 409);

    }

    // Si no existe, crea el nuevo registro
    try {
        TypesOfBenefits::create([
            'name' => $request->name,
        ]);

        return response()->json(['success' => 'Tipo de beneficiario creado correctamente.'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Ha ocurrido un error al intentar crear el tipo de beneficiario.'], 500);
    }
}


    

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('bienestar::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('bienestar::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('bienestar::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
{
    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|max:255', // Define las reglas de validación aquí
    ]);

    // Buscar el tipo de beneficio por su ID
    $type = TypesOfBenefits::find($id);

    if (!$type) {
        return redirect()->route('bienestar.typeofbenefits')->with('error', 'Tipo de beneficio no encontrado.');
    }

    // Actualizar el nombre del tipo de beneficio
    $type->name = $request->name;
    $type->save();

    return redirect()->route('bienestar.typeofbenefits')->with('success', 'Tipo de beneficio actualizado correctamente.');
}

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        // Encuentra y elimina el registro por su ID
        TypesOfBenefits::destroy($id);
        // Redirige a la misma vista después de eliminar
        return redirect()->route('bienestar.typeofbenefits');
    }
}