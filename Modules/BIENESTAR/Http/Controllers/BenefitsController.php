<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\Benefits;


class BenefitsController extends Controller
{
    public function benefitsView()
    {
        $benefits = Benefits::all();
        return view('bienestar::benefits-View', ['benefits' => $benefits]);
    }

    public function BenefitsViewAdd(Request $request)
    {
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
        $existingBenefit = Benefits::where('name', $name)->where('porcentege', $porcentege)->first();

        // Verifica si ya existe un beneficio con el mismo nombre y porcentaje
        if ($existingBenefit) {
            return redirect()->route('cefa.bienestar.benefits')->with('error', 'Ya existe un beneficio con el mismo nombre y porcentaje.');
        }

        // Si la validación pasa y no existe un beneficio con el mismo nombre y porcentaje, crea el registro en la base de datos
        Benefits::create([
            'name' => $name,
            'porcentege' => $porcentege,
        ]);

        return redirect()->route('cefa.bienestar.benefits')->with('success', 'Beneficio agregado correctamente');
    }


    public function update(Request $request, $id)
    {

        $benefit = Benefits::find($id);

        // Actualizar los datos
        $benefit->name = $request->input('name');
        $benefit->porcentege = $request->input('porcentege');
        $benefit->save();

        // Redirigir o devolver una respuesta según tus necesidades
        return redirect()->route('cefa.bienestar.benefits')->with('success', 'Beneficio actualizado con éxito');
    }

    public function destroy($id)
    {
        try {
            $beneficio = Benefits::findOrFail($id);
            $beneficio->delete();

            return response()->json(['mensaje' =>'Vacancy eliminated with success']);
        } catch (\Exception $e) {
            return response()->json(['mensaje' =>'Error when deleting the vacancy'], 500);
        }
        
    }
}
