<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\TypeOfBenefit;
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
         $typeofbenefits = TypeOfBenefit::all();
         return view('bienestar::typeofbenefits', compact('typeofbenefits'));
     }
 
     public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'name' => [
            'required',
            'max:255',
            Rule::unique('types_of_benefits')->whereNull('deleted_at'), // Verificar que el nombre sea único y que no esté eliminado
        ],
    ]);

    // Buscar un registro eliminado con el mismo nombre
    $existingDeletedRecord = TypeOfBenefit::onlyTrashed()
        ->where('name', $request->name)
        ->first();

    if ($existingDeletedRecord) {
        // Restaurar el registro eliminado
        $existingDeletedRecord->restore();
        return response()->json(['success' => 'Tipo de beneficiario restaurado correctamente.'], 200);
    }

    // Crear un nuevo registro
    try {
        TypeOfBenefit::create([
            'name' => $request->name,
        ]);

        return response()->json(['success' => 'Tipo de beneficiario creado correctamente.'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ha ocurrido un error al intentar crear el tipo de beneficiario.'], 500);
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
    $type = TypeOfBenefit::findOrFail($id);

    if (!$type) {
        // Manejar el error con un mensaje de error y un código de estado 404
        return response()->json(['error' => 'Tipo de beneficio no encontrado.'], 404);
    }

    // Verificar si el nuevo valor del campo 'name' ya existe en otros registros
    $existingRecord = TypeOfBenefit::where('name', $request->name)
        ->where('id', '!=', $type->id) // Excluye el registro actual de la comprobación
        ->first();

    if ($existingRecord) {
        // Manejar el error con un mensaje de error y un código de estado 409 (Conflicto)
        return response()->json(['error' => 'No se puede actualizar el tipo de beneficiario. El nombre ya está en uso.'], 409);
    }

    // Actualizar el nombre del tipo de beneficio
    $type->name = $request->name;
    $type->save();

    // Retornar una respuesta JSON para manejarla en el script de SweetAlert
    return response()->json(['success' => 'Tipo de beneficio actualizado correctamente.'], 200);
}



    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    
    public function destroy($id)
    {
        try {
            $typeofbenefits = TypeOfBenefit::findOrFail($id);
            $typeofbenefits->delete();

            return response()->json(['success' =>'Vacancy eliminated with success']);
        } catch (\Exception $e) {
            return response()->json(['error' =>'Error when deleting the vacancy'], 500);
        }
        
    }
}