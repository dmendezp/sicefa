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
        $name = $request->input('name');
        $porcentege = $request->input('porcentege');

        Benefits::create([
            'name'=>$name,
            'porcentege'=>$porcentege,
        ]);

        return redirect()->route('bienestar.benefits')->with('success', 'Beneficio agregado correctamente');

    }
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


