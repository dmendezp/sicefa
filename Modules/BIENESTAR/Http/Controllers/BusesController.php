<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\BusDrivers;
use Modules\BIENESTAR\Entities\Buses;

class BusesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    
    public function index()
    {
        //obtenemos el listado de buses
        $buses = Buses::with('bus_driver')->get();
        $busDrivers = BusDrivers::pluck('name','id');
        return view('bienestar::buses.home',['buses'=>$buses,'busDrivers'=>$busDrivers]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // Primero, realiza la validación
        $request->validate([
            'plate' => [
                'required',
                'regex:/^[A-Za-z]{1,5}\d{1,3}$/',
                function ($attribute, $value, $fail) {
                    // Verifica si existe un registro con la misma placa
                    $existingBus = Buses::where('plate', $value)->first();
    
                    if ($existingBus) {
                        $fail("Ya existe un bus con esta placa en la base de datos.");
                    }
                },
            ],
            'quota' => 'required|numeric',
            'bus_driver' => 'required|exists:bus_drivers,id',
        ]);

    
        // Create and save a new bus
        $buses = new Buses;
        $buses->plate = $request->input('plate');
        $buses->quota = $request->input('quota');
        $buses->bus_driver_id = $request->input('bus_driver');
    
        if ($buses->save()) {
            // Redirige con un mensaje de éxito
            return redirect()->route('cefa.bienestar.buses')->with('message', 'Bus creado correctamente.')->with('typealert', 'success');
        }
    
        // Redirige con un mensaje de error si falla el guardado
        if($buses->save()){
            return redirect()->route('cefa.bienestar.buses')->with('message', 'Bus creado correctamente.')->with('typealert', 'success');
        }

        return redirect()->route('cefa.bienestar.buses')->with('message', 'Se ha producido un error')->with('typealert', 'danger');
    }
    

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        /* $request->validate([
            'plate' => 'required|regex:/^[A-Za-z]{1,5}\d{1,3}$/|unique:buses,plate', // Añade la regla unique
            'quota' => 'required|numeric',
            'bus_driver' => 'required|exists:bus_drivers,id', // Asegura que bus_driver exista en la tabla bus_drivers
        ]); */
         
        $buses = Buses::findOrFail($id);
        $buses->plate = $request->input('plate');
        $buses->quota = $request->input('quota');
        $buses->bus_driver_id = $request->input('bus_driver');
        $buses->save();
        if($buses->save()){
            return redirect()->route('cefa.bienestar.buses')->with('message', 'Bus actualizado correctamente.')->with('typealert', 'success');
        }

        return redirect()->route('cefa.bienestar.buses')->with('message', 'Se ha producido un error')->with('typealert', 'danger');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
       try{
          $bus = Buses::findOrFail($id);
          $bus->delete();
          return response()->json(['mensaje' => 'eliminado with success']);      
        }  catch (\Exception $e) {
            return response()->json(['mensaje' =>'Error when deleting the vacancy'], 500);
        }  
    }
}
