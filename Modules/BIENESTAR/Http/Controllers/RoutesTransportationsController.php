<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\RoutesTransportations;
use Modules\BIENESTAR\Entities\BusDrivers;
use Modules\BIENESTAR\Entities\Buses;

class RoutesTransportationsController extends Controller

{

    public function index()
    {
        // Obtén los datos de buses con sus conductores relacionados
        $buses = Buses::with('bus_driver')->whereHas('bus_driver')->get();
        $busDrivers = BusDrivers::all();
        $routestransportations = RoutesTransportations::with('bus')->get();

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
        $transportRoute = new RoutesTransportations();
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

public function update(Request $request, $id)
{
    // Valida los datos enviados por el formulario
    $validatedData = $request->validate([
        'route_number' => 'required|numeric',
        'name_route' => 'required|string',
        'bus' => 'required|numeric',
        'driver_name' => 'required|string',
        'stop_bus' => 'required|string',
        'arrival_time' => 'required|date_format:H:i',
        'departure_time' => 'required|date_format:H:i',
    ]);

    // Busca el registro que deseas actualizar por su ID
    $transportRoute = TransportRoute::find($id);

    // Actualiza los valores del modelo con los datos validados del formulario
    $transportRoute->route_number = $validatedData['route_number'];
    $transportRoute->name_route = $validatedData['name_route'];
    $transportRoute->bus = $validatedData['bus'];
    $transportRoute->driver_name = $validatedData['driver_name'];
    $transportRoute->stop_bus = $validatedData['stop_bus'];
    $transportRoute->arrival_time = $validatedData['arrival_time'];
    $transportRoute->departure_time = $validatedData['departure_time'];

    // Guarda el registro actualizado en la base de datos
    $transportRoute->save();

    // Redirige a la vista deseada con un mensaje de éxito
    return redirect()->route('cefa.bienestar.transportroutes')->with('success', 'Registro de ruta de transporte actualizado exitosamente.');
}


    public function destroy($id)
    {
        try {
            $routes = RoutesTransportations::findOrFail($id);
            $routes->delete();

            return response()->json(['mensaje' => 'Vacancy eliminated with success']);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error when deleting the vacancy'], 500);
        }
    }
}
