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
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function LisRutas()
    {
        return view('bienestar::LisRutas'); 
    }

     
    public function transportroutes()
    {
        $busDrivers = BusDrivers::all();
        $buses = Buses::all();
        return view('bienestar::transportroutes',['busDrivers'=> $busDrivers, 'buses'=> $buses]);
    }
    
    public function transportroutesAdd(Request $request)
    {
        $numberRoute = $request->input('name');
        $nameRoute = $request->input('porcentege');
        $bus = $request->input('bus');
        $timeArrival = $request->input('timeArrival');
        $hourExit = $request->input('hourExit');
        $stopBus = $request->input('stopBus');
        $timeArrival = $request->input('timeArrival');
        $hourExit = $request->input('hourExit');

        RoutesTransportations::create([
            'route_number'=>$numberRoute,
            'name_route'=>$nameRoute,
            'bus'=> $bus,
            'stop_bus'=> $stopBus,
            'arrival_time'=> $timeArrival,
            'departure_time'=> $hourExit,
            'bus_id'=> $bus,

        ]);

        return redirect()->route('bienestar.transportroutes')->with('success', 'Beneficio agregado correctamente');

    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('bienestar::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

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
