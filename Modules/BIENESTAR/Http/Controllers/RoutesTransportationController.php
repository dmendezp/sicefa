<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\RouteTransportation;
use Modules\BIENESTAR\Entities\BusDriver;
use Modules\BIENESTAR\Entities\Bus;
use Illuminate\Support\Facades\Route;

class RoutesTransportationController extends Controller

{

    public function index()
    {
        // Obtén los datos de buses con sus conductores relacionados
        $buses = Bus::with('bus_driver')->get();
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
        $transportRoute->quota = $request->input('bus_quota');
        $transportRoute->arrival_time = $request->input('arrival_time');
        $transportRoute->departure_time = $request->input('departure_time');

        // Guarda el registro en la base de datos
        $transportRoute->save();

        // Puedes agregar un mensaje de éxito
        return redirect()->route('bienestar.admin.transportation.crud.transportroutes')->with('success', 'Registro de ruta de transporte exitoso.');
    }

    public function update(Request $request, $id)
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
        $transportRoute = RouteTransportation::findOrFail($id);


        // Actualiza los campos del registro con los datos del formulario
        $transportRoute->route_number = $request->input('new_route_number');
        $transportRoute->stop_bus = $request->input('new_stop_bus');
        $transportRoute->name_route = $request->input('new_name_route');
        $transportRoute->bus_id = $request->input('new_bus');
        $transportRoute->quota = $request->input('new_bus_quota');
        $transportRoute->arrival_time = $request->input('new_arrival_time');
        $transportRoute->departure_time = $request->input('new_departure_time');

        // Guarda los cambios en la base de datos
        $transportRoute->save();

        // Puedes agregar un mensaje de éxito
        return redirect()->route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.transportation.crud.transportroutes')->with('success', 'Registro de ruta de transporte exitoso.');
    }

    public function destroy($id)
    {
        try {
            $beneficio = RouteTransportation::findOrFail($id);
            $beneficio->delete();

            return response()->json(['mensaje' => 'Vacancy eliminated with success']);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error when deleting the vacancy'], 500);
        }
    }


    //FUNCIONES API
    public function BusDriverRoute()
    {
        $names = BusDriver::select('id', 'name')->get();
        $routes = RouteTransportation::select('id', 'name_route')->get();
        $results = [$names, $routes];
        return response()->json(['data' => $results], 200);
    }

    public function UpdateBusDriverRouteTransportation(Request $request)
{
    $idBusDriver = $request->input('id_bus_driver');
    $idTransportRoute = $request->input('id_transport_route');

    if ($idTransportRoute) {
        // Obtener el modelo Bus asociado a la ruta
        $route = RouteTransportation::find($idTransportRoute);

        if ($route) {
            $bus = $route->bus;

            if ($bus) {
                // Actualizar el bus_driver_id en el modelo Bus
                $bus->bus_driver_id = $idBusDriver;
                $bus->save();
                
                return response()->json(['message' => 'Actualización exitosa']);
            } else {
                return response()->json(['message' => 'Bus no encontrado para la ruta'], 404);
            }
        } else {
            return response()->json(['message' => 'Ruta de transporte no encontrada'], 404);
        }
    } else {
        return response()->json(['message' => 'Falta el parámetro id_transport_route'], 400);
    }
}

}
