<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\BusDrivers;

class BusDriversController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function Drivers_view()
    {   
        $busdrivers = BusDrivers::all();
        return view('bienestar::Drivers_view',['busdrivers'=>$busdrivers]);
    }
    public function Drivers_viewAdd(Request $request)
    {

        $name = $request->input('namedriver');
        $email= $request->input('email');
        $phone= $request->input('phone');

        BusDrivers::create([
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone,
        ]);
        return redirect()->route('bienestar.Drivers_view')->with('succes','Se ha agregado con exito!!');
    }



    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function Drivers_viewUp(Request $request, $id)
    {
            // Validar los datos del formulario si es necesario
        
            // Obtener el beneficio que deseas actualizar
            $benefit = BusDrivers::find($id);
        
            // Actualizar los datos
            $benefit->name = $request->input('name');
            $benefit->email = $request->input('email');
            $benefit->phone = $request->input('phone');
            $benefit->save();
        
            // Redirigir o devolver una respuesta según tus necesidades
            return redirect()->route('bienestar.Drivers_view')->with('success', 'Beneficio actualizado con éxito');
     
    }
    public function delete(Request $request, $id)
    {
        // Obtener el conductor que deseas eliminar
        $busdriver = BusDrivers::find($id);
        
    
        // Verificar si el conductor existe
        if (!$busdriver) {
            return redirect()->route('bienestar.Drivers_view')->with('error', 'El conductor no existe.');
        }
    
        // Eliminar el conductor
        $busdriver->delete();
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('bienestar.Drivers_view')->with('success', 'Conductor eliminado con éxito');
    }
    

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
