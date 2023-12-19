<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\Benefit;


class BenefitsController extends Controller
{
    public function benefitsView()
    {
        $benefits = Benefit::all();
        return view('bienestar::benefits-View', ['benefits' => $benefits]);
    }

    public function BenefitsViewAdd(Request $request)
    {
        $role_name = getRoleRouteName(Route::currentRouteName());
        // Define las reglas de validación para los campos name y porcentaje
        $rules = [
            'name' => 'required|string', // Asegura que el campo sea una cadena de texto
            'porcentege' => 'required|numeric|min:0|max:100', // Asegura que el campo sea un número entre 0 y 100
        ];

        $request->validate($rules);

        // Obtén el nombre y el porcentaje del formulario
        $name = $request->input('name');
        $porcentege = $request->input('porcentege');

        // Busca un beneficio con el mismo nombre y porcentaje en la base de datos
        $existingBenefit = Benefit::where('name', $name)->where('porcentege', $porcentege)->first();

        // Verifica si ya existe un beneficio con el mismo nombre y porcentaje
        if ($existingBenefit) {
            return response()->json(['error' => 'Ya existe un beneficio con el mismo nombre y porcentaje.'], 422);
        }

        // Si la validación pasa y no existe un beneficio con el mismo nombre y porcentaje, crea el registro en la base de datos
        Benefit::create([
            'name' => $name,
            'porcentege' => $porcentege,
        ]);

        return response()->json(['success' => 'Beneficio agregado con exitosamente!']);
    }


    public function update(Request $request, $id)
    {
        // Encontrar el beneficio existente
        $benefit = Benefit::find($id);

        // Validar si ya existe otro beneficio con el mismo nombre y porcentaje
        $existingBenefit = Benefit::where('name', $request->input('name'))
            ->where('porcentege', $request->input('porcentege'))
            ->where('id', '!=', $id)
            ->first();

        if ($existingBenefit) {
            // Ya existe un beneficio con el mismo nombre y porcentaje
            return response()->json(['error' => 'Ya existe un beneficio con el mismo nombre y porcentaje.'], 422);
        }

        // Actualizar los datos
        $benefit->name = $request->input('name');
        $benefit->porcentege = $request->input('porcentege');
        $benefit->save();

        // Redirigir o devolver una respuesta según tus necesidades
        return response()->json(['success' => 'Beneficio actualizado con éxito']);
    }



    public function destroy($id)
    {
        try {
            $beneficio = Benefit::findOrFail($id);
            $beneficio->delete();

            return response()->json(['mensaje' => 'Beneficio eliminado Correctamente']);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error when deleting the vacancy'], 500);
        }
    }
}
