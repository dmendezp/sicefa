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
    $buses = Buses::with('busDriver')->whereHas('busDriver')->get();
    $busDrivers = BusDrivers::all();
    $routestransportations = RoutesTransportations::all();
 
    return view('bienestar::transportroutes', ['buses'=>$buses, 'busDrivers'=>$busDrivers,'routestransportations'=>$routestransportations]);
}

    public function store(Request $request) 
    {
        $request->validate([
            'route_number' => 'required',
            'route_name' =>'required',
            'stop_bus' => 'required',
            'arrival_time' => 'required',
            'departure_time' => 'required',
            'bus_id' => 'required'

            
        ]);

        $routes = RoutesTransportations::all();
        $busDrivers = BusDrivers::all();
        $buses = Buses::all();
        if($transportation->save()){
            return redirect()->route('bienestar::transportroutes')->with('message', 'Ruta De Transporte Registrado Correctamente')->with('typealert', 'success');
        }
        return redirect()->route('bienestar::transportroutes')->with('message', 'Se Ha Producido Un Error')->with('typealert', 'danger');
    }

    

}
