<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\BusDriver;
use Illuminate\Support\Facades\Route;

class BusDriversController extends Controller
{
    public function drivers()
    {   
        $busdrivers = BusDriver::all();
        return view('bienestar::drivers', ['busdrivers' => $busdrivers]);
    }

    public function driversAdd(Request $request)
    {
        $request->validate([
            'namedriver' => 'required|unique:bus_drivers,name',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
        ]);

        BusDriver::create([
            'name' => $request->input('namedriver'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.transportation.crud.drivers')->with('success', 'Conductor agregado exitosamente.');
    }

    public function driversUp(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
        ]);

        $busdriver = BusDriver::find($id);

        if (!$busdriver) {
            return redirect()->route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.transportation.crud.drivers')->with('error', 'El conductor no existe.');
        }

        $busdriver->name = $request->input('name');
        $busdriver->email = $request->input('email');
        $busdriver->phone = $request->input('phone');
        $busdriver->save();

        return redirect()->route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.transportation.crud.drivers')->with('success', 'Conductor actualizado con éxito');
    }

    public function delete($id)
    {
        
    try {
        $busdriver = BusDriver::find($id);
        $busdriver->delete();

        return response()->json(['mensaje' =>'Vacancy eliminated with success']);
    } catch (\Exception $e) {
        return response()->json(['mensaje' =>'Error when deleting the vacancy'], 500);
    }
 }
}
