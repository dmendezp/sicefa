<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon; // Esta línea ya importa Carbon, no es necesario importarlo de nuevo
use Modules\HANGARAUTO\Entities\Vehicle;
use Modules\HANGARAUTO\Entities\Tecnomecanic;
use Modules\HANGARAUTO\Entities\Soat;
use Modules\HANGARAUTO\Entities\Driver;
use Modules\HANGARAUTO\Entities\FuelConsumption;
use Modules\SICA\Entities\MeasurementUnit;
use Illuminate\Support\Facades\Route;
use Validator, Str;

class RevisionesController extends Controller
{

    // Traer Toda La Información De La Tabla De Soat
    public function seguroobligatorio()
    {
        $Soat = Soat::orderBy('id','asc')->with('person')->get();
        $vehicles = Vehicle::pluck('name', 'id');
        $drivers = Driver::with('person')->get()->pluck('person.fullname', 'person.id');
        $data = ['Soat' => $Soat, 'vehicles' => $vehicles, 'drivers' => $drivers];
        return view('hangarauto::admin.revisiones.SOAT.index', $data);
    }


    
    // Agregar Registro De Soat 
    public function postSoatAdd(Request $request)
    {
        $rules = [
            'vehicle_id' => 'required',
            'person_id' => 'required',
            'review_date' => 'required',
        ];
        $messages = [
            'vehicle_id.required' => 'Ingrese El Nombre Del Vehiculo',
            'person_id.required' => 'Ingrese Quien Realizó La Renovación Del Soat',
            'review_date.required' => 'Ingrese La Fecha En Que Se Renovó El Soat',
           
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se Ha Producido Un Error')->with('typealert','danger');
         else:
            $Soat = new Soat();
            $Soat->vehicle_id = $request->input('vehicle_id');
            $Soat->person_id = $request->input('person_id');
            $Soat->review_date = $request->input('review_date');
            $Soat->expiration_date = Carbon::parse($request->input('review_date'))->addYear();
            if($Soat->save()){
                return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.soat'))->with('messages','Nuevo Registro De Soat Agregado Exitosamente')->with('typealert','success');
            }
        endif;
        return view('hangarauto::admin.revisiones.SOAT.index');
    }

    // Eliminar Registro De Soat
    public function getSoatDelete($id)
    {
        $Soat = Soat::find($id);
        if($Soat->delete()):
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.soat'))->with('messages','Registro Elimado Con Exito')->with('typealert','success');
        endif;
    }

    
    // Trae Toda Los Datos De La Tabla De Tecnomecanica
    public function tecnomecanica()
    {
        $Tecnomecanic = Tecnomecanic::with('person')->get();
        $vehicles = Vehicle::pluck('name', 'id');
        $drivers = Driver::with('person')->get()->pluck('person.fullname', 'person.id');
        $data = ['Tecnomecanic' => $Tecnomecanic, 'vehicles' => $vehicles, 'drivers' => $drivers];
        return view('hangarauto::admin.revisiones.tecnomecanica.index', $data);
    }

    // Agregar Tecnomecanica
    public function getTecnomecanicaAdd(){
        return view('hangarauto.admin.tecnomecanica');
    }

    public function postTecnomecanicaAdd(Request $request)
    {
        $rules = [
            'vehicle_id' => 'required',
            'person_id' => 'required',
            'review_date' => 'required|date',
        ];

        $messages = [
            'vehicle_id.required' => 'Debe Ingresar El Nombre Del Vehiculo',
            'person_id.required' => 'Ingrese Quien Hizo La Renovación De La Tecnomecanica',
            'review_date.required' => 'La Fecha En Que Renovó La Tecnomecanica',
            'review_date.date' => 'La Fecha En Que Renovó La Tecnomecanica debe ser una fecha válida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('messages','Se Ha Producido Un Error')->with('typealert','danger');
        }

        $Tecnomecanic = new Tecnomecanic();
        $Tecnomecanic->vehicle_id = $request->input('vehicle_id');
        $Tecnomecanic->person_id = $request->input('person_id');
        $Tecnomecanic->review_date = $request->input('review_date');
        $Tecnomecanic->expiration_date = Carbon::parse($request->input('review_date'))->addYear();

        if ($Tecnomecanic->save()) {
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.tecnomecanica'))->with('messages','Nuevo Registro De Tecnomecanica Agregado Con Exito')->with('typealert','success');
        }

        return back()->with('messages', 'Se Ha Producido Un Error')->with('typealert', 'danger');
    }

    // Eliminar Registro De Tecnomecanica
    public function getTecnomecanicaDelete($id)
    {
        $Tecnomecanic = Tecnomecanic::find($id);
        if($Tecnomecanic->delete()):
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.tecnomecanica'))->with('messages', 'Registro Eliminado Con Exito')->with('typealert','success');
        endif;
    }

    // Trae Toda Los Datos De La Tabla De Tecnomecanica
    public function consumo()
    {
        $consumo = FuelConsumption::get();
        $vehicles = Vehicle::pluck('name', 'id');
        $drivers = Driver::with('person')->get()->pluck('person.fullname', 'person.id');
        $measurement_units = MeasurementUnit::where('name','=','Galon')->pluck('name', 'id');
        $data = ['consumo' => $consumo,'measurement_units' => $measurement_units, 'vehicles' => $vehicles, 'drivers' => $drivers];
        return view('hangarauto::admin.con_gaso.index', $data);
    }



    public function postConsumoAdd(Request $request)
    {
        $rules = [
            'vehicle_id' => 'required',
            'person_id' => 'required',
            'date' => 'required|date',
        ];

        $messages = [
            'vehicle_id.required' => 'Debe Ingresar El Nombre Del Vehiculo',
            'person_id.required' => 'Ingrese Quien Hizo La Renovación De La Tecnomecanica',
            'date.required' => 'La Fecha En Que Renovó La Tecnomecanica es obligatoria',
            'date.date' => 'La Fecha En Que Renovó La Tecnomecanica debe ser una fecha válida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('messages','Se Ha Producido Un Error')->with('typealert','danger');
        }

        $consumo = new FuelConsumption();
        $consumo->vehicle_id = $request->input('vehicle_id');
        $consumo->person_id = $request->input('person_id');
        $consumo->date = $request->input('date');
        $consumo->type = $request->input('type');
        $consumo->measurement_unit_id = $request->input('measurement_unit_id');
        $consumo->amount = $request->input('amount');
        $consumo->price = $request->input('price');
        $consumo->mileage = $request->input('mileage');
        

        if ($consumo->save()) {
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.consumo'))->with('messages','Nuevo Registro De Consumo Agregado Con Exito')->with('typealert','success');
        }

        return back()->with('messages', 'Se Ha Producido Un Error al guardar el registro')->with('typealert', 'danger');
    }


    // Eliminar Registro De Tecnomecanica
    public function getConsumoDelete($id)
    {
        $Tecnomecanic = FuelConsumption::find($id);
        if($Tecnomecanic->delete()):
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.consumo'))->with('messages', 'Registro Eliminado Con Exito')->with('typealert','success');
        endif;
    }
}
