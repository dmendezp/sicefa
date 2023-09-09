<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\BenefitsTypesOfBenefits;
use Modules\BIENESTAR\Entities\TypesOfBenefits;
use Modules\BIENESTAR\Entities\Benefits;


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

        // Crear un nuevo registro en la tabla pivot
        BenefitsTypesOfBenefits::create([
            'benefit_id' => $request->benefit_id,
            'type_of_benefit_id' => $request->type_of_benefit_id,
        ]);

        return redirect()->route('cefa.bienestar.benefitstypeofbenefits')->with('success', 'Registro creado correctamente.');
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
            return redirect()->route('cefa.bienestar.benefitstypeofbenefits')->with('error', 'Registro no encontrado.');
        }

        // Actualizar los valores
        $type->benefit_id = $request->benefit_id;
        $type->type_of_benefit_id = $request->type_of_benefit_id;
        $type->save();

        return redirect()->route('cefa.bienestar.benefitstypeofbenefits')->with('success', 'Registro actualizado correctamente.');
    }

    public function destroy($id)
    {
        // Encuentra y elimina el registro por su ID
        BenefitsTypesOfBenefits::destroy($id);

        return redirect()->route('cefa.bienestar.benefitstypeofbenefits')->with('success', 'Registro eliminado correctamente.');
    }
}