<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\BenefitsTypesOfBenefits;
use Modules\BIENESTAR\Entities\TypesOfBenefits;
use Modules\BIENESTAR\Entities\Benefits;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;


class BenefitsTypesOfBenefitsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function benefitstypeofbenefits()
    {
        $benefitstypeofbenefits = BenefitsTypesOfBenefits::all();
        $benefits = Benefits::all();
        $typeOfBenefits = TypesOfBenefits::all();

        return view('bienestar::benefitstypeofbenefits', compact('benefitstypeofbenefits', 'benefits', 'typeOfBenefits'));
    }

    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'benefit_id' => 'required|exists:benefits,id',
        'type_of_benefit_id' => 'required|exists:types_of_benefits,id',
    ]);

    // Buscar si hay un registro eliminado con los mismos valores
    $existingRecord = BenefitsTypesOfBenefits::withTrashed()
        ->where([
            'benefit_id' => $request->benefit_id,
            'type_of_benefit_id' => $request->type_of_benefit_id,
        ])->first();

    if ($existingRecord) {
        if ($existingRecord->trashed()) {
            // Restaurar el registro si está eliminado
            $existingRecord->restore();
            return response()->json(['success' => 'Registro restaurado correctamente.'], 200);
        } else {
            // Mostrar un mensaje de error si el registro ya existe
            return response()->json(['error' => 'El registro ya existe.'], 400);
        }
    }

    // Si no existe un registro eliminado, crear uno nuevo en la tabla pivot
    BenefitsTypesOfBenefits::create([
        'benefit_id' => $request->benefit_id,
        'type_of_benefit_id' => $request->type_of_benefit_id,
    ]);

    return response()->json(['success' => 'Registro creado correctamente.'], 200);
}


public function update(Request $request, $id)
{
    // Validar los datos del formulario
    $request->validate([
        'benefit_id' => 'required|exists:benefits,id',
        'type_of_benefit_id' => 'required|exists:types_of_benefits,id',
    ]);

    // Buscar el registro por su ID
    $type = BenefitsTypesOfBenefits::find($id);

    if (!$type) {
        return response()->json(['error' => 'Registro no encontrado.'], 404);
    }

    // Verificar si el registro está eliminado
    if ($type->trashed()) {
        return response()->json(['error' => 'No se puede editar un registro eliminado.'], 400);
    }

    // Verificar si los nuevos valores son diferentes de los valores actuales
    if (
        $type->benefit_id != $request->benefit_id ||
        $type->type_of_benefit_id != $request->type_of_benefit_id
    ) {
        // Actualizar los valores solo si son diferentes
        $type->benefit_id = $request->benefit_id;
        $type->type_of_benefit_id = $request->type_of_benefit_id;
        $type->save();

        return response()->json(['success' => 'Registro actualizado correctamente.'], 200);
    } else {
        // Mostrar un mensaje de error si los valores son iguales
        return response()->json(['error' => 'Los nuevos valores son iguales a los valores actuales.'], 400);
    }
}


    
    public function destroy($id)
    {
        try {
            $benefitstypeofbenefits = BenefitsTypesOfBenefits::findOrFail($id);
            $benefitstypeofbenefits->delete(); // Esto debería activar el Soft Delete

            return response()->json(['success' =>'Vacancy eliminated with success']);
        } catch (\Exception $e) {
            return response()->json(['error' =>'Error when deleting the vacancy'], 500);
        }
    }
}