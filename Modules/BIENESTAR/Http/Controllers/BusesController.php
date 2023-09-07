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
        $buses = Buses::get();
        $busDrivers = BusDrivers::pluck('name','id');
        $data = ['buses'=>$buses,'busDrivers'=>$busDrivers];
        return view('bienestar::buses.home',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'plate' => 'required|string|max:255',
            'quota' => 'required|numeric',
            'bus_driver' => 'required|exists:bus_drivers,id', // Asegura que bus_driver exista en la tabla bus_drivers
        ]);

        $buses = new Buses;
        $buses->plate = $request->input('plate');
        $buses->quota = $request->input('quota');
        $buses->bus_driver_id = $request->input('bus_driver');
        if($buses->save()){
            return redirect()->route('bienestar.buses')->with('message', 'Bus creado correctamente.')->with('typealert', 'success');
        }

        return redirect()->route('bienestar.buses')->with('message', 'Se ha producido un error')->with('typealert', 'danger');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'plate' => 'required|string|max:255',
            'quota' => 'required|numeric',
            'bus_driver' => 'required|exists:bus_drivers,id', // Asegura que bus_driver exista en la tabla bus_drivers
        ]);
        
        $buses = Buses::findOrFail($id);
        $buses->plate = $request->input('plate');
        $buses->quota = $request->input('quota');
        $buses->bus_driver_id = $request->input('bus_driver');
        if($buses->save()){
            return redirect()->route('bienestar.buses')->with('message', 'Bus actualizado correctamente.')->with('typealert', 'success');
        }

        return redirect()->route('bienestar.buses')->with('message', 'Se ha producido un error')->with('typealert', 'danger');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $bus = Buses::findOrFail($id);
        if($bus->delete()):
            return back()->with('message', 'Bus eliminado')->with('typealert', 'danger');
        endif;
    }
}
