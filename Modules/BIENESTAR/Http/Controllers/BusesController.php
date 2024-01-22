<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\BusDriver;
use Modules\BIENESTAR\Entities\Bus;
use Illuminate\Support\Facades\Route;

class BusesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        //obtenemos el listado de buses
        $buses = Bus::with('bus_driver')->get();
        $busDrivers = BusDriver::pluck('name', 'id');
        return view('bienestar::buses.home', ['buses' => $buses, 'busDrivers' => $busDrivers]);
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
                    $existingBus = Bus::where('plate', $value)->first();

                    if ($existingBus) {
                        $fail("Ya existe un bus con esta placa en la base de datos.");
                    }
                },
            ],
            'quota' => 'required|numeric',
            'bus_driver' => 'required|exists:bus_drivers,id',
        ]);


        // Create and save a new bus
        $buses = new Bus;
        $buses->plate = $request->input('plate');
        $buses->quota = $request->input('quota');
        $buses->bus_driver_id = $request->input('bus_driver');

        if ($buses->save()) {
            // Redirige con un mensaje de éxito
            return response()->json(['success' => 'Bus creado correctamente.']);
        } else {
            return response()->json(['error' => 'Se Ha Producido Un Error.'], 422);
        }
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

        $buses = Bus::findOrFail($id);
        $buses->plate = $request->input('plate');
        $buses->quota = $request->input('quota');
        $buses->bus_driver_id = $request->input('bus_driver'); // Corrige el nombre del campo
        $buses->save();

        if ($buses->save()) {
            return response()->json(['success' => 'Bus actualizado correctamente.']);
        } else {
            return response()->json(['mensaje' => 'error al actualizar el autobús'], 422);
        }
    }



    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $bus = Bus::findOrFail($id);
            $bus->delete();
            return response()->json(['mensaje' => 'eliminado con éxito']);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error deleting trainee'], 500);
        }
    }
}
