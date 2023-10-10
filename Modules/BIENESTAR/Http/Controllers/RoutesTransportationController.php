<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\RouteTransportation;
use Modules\BIENESTAR\Entities\BusDriver;
use Modules\BIENESTAR\Entities\Bus;

class RoutesTransportationController extends Controller

{

    public function index()
    {
        // Obtén los datos de buses con sus conductores relacionados
        $buses = Bus::with('bus_driver')->whereHas('bus_driver')->get();
        $busDrivers = BusDriver::all();
        $routestransportations = RouteTransportation::with('bus.bus_driver')->get();
        $buses = Bus::with('bus_driver')->whereHas('bus_driver')->get();
        $busDrivers = BusDriver::all();
        $routestransportations = RouteTransportation::with('bus.bus_driver')->get();

        return view('bienestar::transportroutes', ['buses' => $buses, 'busDrivers' => $busDrivers, 'routestransportations' => $routestransportations]);
    }

    public function store(Request $request)
    {
        // Valida los datos enviados por el formulario
        $validatedData = $request->validate([
            'route_number' => 'required',
            'name_route' => 'required|string',
            'bus' => 'required',
            'stop_bus' => 'required|string',
            'arrival_time' => 'required',
            'departure_time' => 'required',
            
        ]);

        // Crea una nueva instancia del modelo TransportRoute y asigna los valores
        $transportRoute = new RouteTransportation();
        $transportRoute->route_number = $request->input('route_number');
        $transportRoute->stop_bus = $request->input('stop_bus');
        $transportRoute->name_route = $request->input('name_route');
        $transportRoute->bus_id = $request->input('bus');
        $transportRoute->arrival_time = $request->input('arrival_time');
        $transportRoute->departure_time = $request->input('departure_time');

        // Guarda el registro en la base de datos
        $transportRoute->save();

    // Puedes agregar un mensaje de éxito
        return redirect()->route('cefa.bienestar.transportroutes')->with('success', 'Registro de ruta de transporte exitoso.');
    }

    public function edit($id){
        $idTransport = RouteTransportation::findOrFail($id);
        return redirect()->route('cefa.bienestar.transportroutes', compact('idTransport'));
    }

    public function update(Request $request)
    {
        // Valida los datos enviados por el formulario
        $validatedData = $request->validate([
            'new_route_number' => 'required',
            'new_name_route' => 'required|string',
            'new_bus' => 'required',
            'new_stop_bus' => 'required|string',
            'new_arrival_time' => 'required',
            'new_departure_time' => 'required',
        ]);

        // Busca el registro existente por su ID
        $transportRoute = RouteTransportation::findOrFail($request->input('id_transport'));
        
        
        // Actualiza los campos del registro con los datos del formulario
        $transportRoute->route_number = $request->input('new_route_number');
        $transportRoute->stop_bus = $request->input('new_stop_bus');
        $transportRoute->name_route = $request->input('new_name_route');
        $transportRoute->bus_id = $request->input('new_bus');
        $transportRoute->arrival_time = $request->input('new_arrival_time');
        $transportRoute->departure_time = $request->input('new_departure_time');

        // Guarda los cambios en la base de datos
        $transportRoute->save();

        // Puedes agregar un mensaje de éxito
        return redirect()->route('cefa.bienestar.transportroutes')->with('success', 'Registro de ruta de transporte exitoso.');
    }

    public function destroy($id)
    {
        try {
            $beneficio = RouteTransportation::findOrFail($id);
            $beneficio->delete();

            return response()->json(['mensaje' =>'Vacancy eliminated with success']);
        } catch (\Exception $e) {
            return response()->json(['mensaje' =>'Error when deleting the vacancy'], 500);
        }
        
    }


    

}
