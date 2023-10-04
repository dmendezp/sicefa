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

    
    public function updateInline(Request $request)
    {
        $benefitId = $request->input('benefit_id');
        $typeId = $request->input('type_of_benefit_id');
        $isChecked = $request->input('checked');
        $recordId = $request->input('record_id'); 
    
        if ($isChecked) {
            // El checkbox está marcado, verificar si existe un registro
            $record = BenefitsTypesOfBenefits::withTrashed()
                ->where('benefit_id', $benefitId)
                ->where('type_of_benefit_id', $typeId)
                ->first();
    
            if (!$record) {
                // Si no existe el registro, crearlo
                $newRecord = BenefitsTypesOfBenefits::create([
                    'benefit_id' => $benefitId,
                    'type_of_benefit_id' => $typeId,
                ]);
    
                // Capturar el ID del nuevo registro
                $recordId = $newRecord->id;
            } elseif ($record->trashed()) {
                // Si el registro está en estado eliminado, restaurarlo
                $record->restore();
    
                // Capturar el ID del registro restaurado
                $recordId = $record->id;
            }
        } else {
            // El checkbox está desmarcado, verificar si existe el registro y marcarlo como eliminado
            if ($recordId) {
                // Soft delete del registro utilizando el ID
                BenefitsTypesOfBenefits::withTrashed()->where('id', $recordId)->update(['deleted_at' => null]);
            }
        }
    
        // Responder con una confirmación y el ID del registro (puede ser nulo si no se crea/elimina ningún registro)
        return response()->json(['success' => 'Actualización en línea exitosa.', 'record_id' => $recordId], 200);   
    }
    

}
