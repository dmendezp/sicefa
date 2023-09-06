<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\Benefits;


class BenefitsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function BenefitsView()
    {
        $benefits = Benefits::all();
        return view('bienestar::BenefitsView',['benefits'=>$benefits]);
    } 

    public function BenefitsViewAdd(Request $request)
    {
        // Define las reglas de validación para los campos name y porcentaje
        $rules = [
            'name' => 'required|string', // Asegura que el campo sea una cadena de texto
            'porcentege' => 'required|numeric|min:0|max:100', // Asegura que el campo sea un número entre 0 y 100
        ];
    
        // Define mensajes personalizados para las reglas de validación
        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'porcentege.required' => 'El campo porcentaje es obligatorio.',
            'porcentege.numeric' => 'El campo porcentaje debe ser un número.',
            'porcentege.min' => 'El campo porcentaje debe ser como mínimo 0.',
            'porcentege.max' => 'El campo porcentaje debe ser como máximo 100.',
        ];
    
        // Valida los datos del formulario con las reglas definidas
        $request->validate($rules, $messages);
    
        // Si la validación pasa, crea el registro en la base de datos
        $name = $request->input('name');
        $porcentege = $request->input('porcentege');
    
        Benefits::create([
            'name' => $name,
            'porcentege' => $porcentege,
        ]);
    
        return redirect()->route('bienestar.benefits')->with('success', 'Beneficio agregado correctamente');
    }

     public function update(Request $request, $id)
     {
         
         $benefit = Benefits::find($id);
     
         // Actualizar los datos
         $benefit->name = $request->input('name');
         $benefit->porcentege = $request->input('porcentege');
         $benefit->save();
     
         // Redirigir o devolver una respuesta según tus necesidades
         return redirect()->route('bienestar.benefits')->with('success', 'Beneficio actualizado con éxito');
     }

     public function delete(Request $request, $id)
     {
         // Obtener el beneficio que deseas eliminar
         $benefit = Benefits::find($id);
     
         // Verificar si el beneficio existe
         if (!$benefit) {
             return redirect()->route('bienestar.benefits')->with('error', 'El beneficio no existe.');
         }
     
         // Eliminar el beneficio
         $benefit->delete();
     
         // Redirigir con un mensaje de éxito
         return redirect()->route('bienestar.benefits')->with('success', 'Beneficio eliminado con éxito');
     }
     
     
}


