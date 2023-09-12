<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\BusDrivers;

class BusDriversController extends Controller
{
    public function drivers()
    {   
        $busdrivers = BusDrivers::all();
        return view('bienestar::drivers', ['busdrivers' => $busdrivers]);
    }

    public function driversAdd(Request $request)
    {
        $request->validate([
            'namedriver' => 'required|unique:bus_drivers,name',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
        ]);

        BusDrivers::create([
            'name' => $request->input('namedriver'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->route('cefa.bienestar.drivers')->with('success', 'Conductor agregado exitosamente.');
    }

    public function driversUp(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
        ]);

        $busdriver = BusDrivers::find($id);

        if (!$busdriver) {
            return redirect()->route('cefa.bienestar.drivers')->with('error', 'El conductor no existe.');
        }

        $busdriver->name = $request->input('name');
        $busdriver->email = $request->input('email');
        $busdriver->phone = $request->input('phone');
        $busdriver->save();

        return redirect()->route('cefa.bienestar.drivers')->with('success', 'Conductor actualizado con éxito');
    }

    public function delete(Request $request, $id)
    {
        $busdriver = BusDrivers::find($id);

        if (!$busdriver) {
            return redirect()->route('cefa.bienestar.drivers')->with('error', 'El conductor no existe.');
        }

        $busdriver->delete();

        return redirect()->route('cefa.bienestar.drivers')->with('success', 'Conductor eliminado con éxito');
    }
}
