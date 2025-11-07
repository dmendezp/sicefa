<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\HANGARAUTO\Entities\Driver;
use Modules\HANGARAUTO\Entities\DriverVehicle;
use Modules\HANGARAUTO\Entities\Vehicle;
use Modules\SICA\Entities\Person;
use Validator, Str;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function conductores()
    {
        $drivers = Driver::with('person')->orderBy('id','asc')->get();
        $data = ['drivers'=>$drivers];
        return view('hangarauto::admin.drivers', $data);
    }

    // Solicitudess
    public function getCreateAdd()
    {
        return view('hangarauto::admin.conductores.create');
    }
    public function getDriversUpdate(Request $request,$id)
    {
        $drivers = Driver::where('person_id',$id)->first();

        if (!$drivers) {
            $drivers->person_id = $request->input('person_id');
            if ($drivers->save()){
                return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.drivers'))->with('success', 'Conductor Actualizado Con Exito')->with('typealert','success');
            } else {
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.drivers.edit'))->with('error', 'Ocurrio un error')->with('typealert','error');
            }
        } else {
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.drivers.edit', ['id' => $drivers]))->with('error', 'El conductor ya existe')->with('typealert','error');
        }
    }

    // Agregar Conductor
    public function postCreateAdd(Request $request){
        $drivers = new Driver();
        $drivers->person_id = $request->input('person_id');
        if ($drivers->save()){
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.drivers'))->with('success', 'Conductor Agregado Con Exito')->with('typealert','success');
        }
        return view('hangarauto::admin.drivers');
    }

    // Buscar Conductores
    public function postDriversSearch(Request $request)
    {
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'El Campo Consultar Es Requerido.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect('hangarauto::admin.conductores.create')->withErrors($validator)->with('error', 'Se Ha Producido Un Error')->with('typealert', 'danger')->withInput();
        else:
            $people = Person::where('document_number', $request->input('search'))->first();
            $data = ['people' => $people];
            return view('hangarauto::admin.conductores.create', $data);
        endif;
    }

    public function postDriversSearchEdit(Request $request,$id)
    {
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'El Campo Consultar Es Requerido.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect('hangarauto::admin.conductores.create')->withErrors($validator)->with('error', 'Se Ha Producido Un Error')->with('typealert', 'danger')->withInput();
        else:
            $people = Person::find($id);
            $personid = $people->id;
            $drivers = Driver::with('person')->where('person_id',$personid)->first();
            $peopleupdate = Person::where('document_number',$request->input('search'))->first();
            $data = ['people' => $people,'drivers' => $drivers,'peopleupdate' => $peopleupdate];
            return view('hangarauto::admin.conductores.edit', $data);
        endif;
    }

    
    // Editar Conductores
    public function getDriversEdit($id)
    {
        $drivers = Driver::find($id);
        $data = ['drivers' => $drivers];
        return view('hangarauto::admin.conductores.edit', $data);
    }

    // Mostar Conductores Actualizados
    public function postDriversEdit(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'id_number' => 'required',
        ];

        $messages = [
            'name.required' => 'El Nombre Es Obligatorio.',
            'last_name.required' => 'El Apellido Es Obligatorio.',
            'email.required' => 'El Correo Es Obligatorio.',
            'phone.required' => 'El Numero Telefonico Es Obligatorio,',
            'id_number.required' => 'El Numero Del Documento es Obligatorio',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('error', 'Se Ha Producido Un Error')->with('typealert', 'danger');
        else:
            $drivers = Driver::findOrFail($id);
            $drivers->name = $request->input('name');
            $drivers->last_name = $request->input('last_name');
            $drivers->email = $request->input('email');
            $drivers->phone = $request->input('phone');
            $drivers->i_number = $request->input('id_number');
            if($drivers->save()){
                return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.drivers'))->with('success','Conductor Actualizado Con Exito.')->with('typealert','success');

            }
        endif;
    }

    // Eliminar Conductores
    public function getDriversDelete($id)
    {
        $driver = Driver::find($id);
        if(!$driver) {
            return redirect()->back()->with('error', 'Conductor no encontrado.');
        }

        if($driver->delete()) {
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.drivers'))->with('success','Conductor Eliminado Con Exito.')->with('typealert','success');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar el conductor.');
        }
}


    public function driversvehicles_index(){
        $drivervehicles_pus = DriverVehicle::join('drivers', 'driver_vehicles.driver_id', '=', 'drivers.id')
                                    ->join('vehicles', 'driver_vehicles.vehicle_id', '=', 'vehicles.id')
                                    ->select('driver_vehicles.*')
                                    ->orderBy('vehicles.name', 'asc')
                                    ->get();
        $drivers = Driver::get();
        $vehicles = Vehicle::orderBy('name','ASC')->get();
        $data = ['title'=>'Ambientes U.P.', 'drivervehicles_pus'=>$drivervehicles_pus, 'drivers'=>$drivers, 'vehicles'=>$vehicles];
        return view('hangarauto::admin.drivervehicles', $data);
    }

    public function driversvehicles_add(Request $request){
        $rules = [
            'driver_id' => 'required',
            'vehicle_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['error'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Verificar que no exista un registro con los datos recibidos en la base de datos
        $existingRecord = DriverVehicle::where([
            'driver_id' => e($request->input('driver_id')),
            'vehicle_id' => e($request->input('vehicle_id'))
        ])->exists();
        if (!$existingRecord) {
            /* Realizar el registro */
            if (DriverVehicle::create($request->all())) {
                $message = ['success' => 'Se sincronizó exitosamente el conductor y el vehiculo.', 'typealert' => 'success'];
            } else {
                $message = ['error' => 'No se pudo sincronizar el conductor y el vehiculo.', 'typealert' => 'danger'];
            }
        } else {
            $message = ['error' => 'Ya existe un registro con los datos enviados.', 'typealert' => 'warning'];
        }
        return redirect(route('hangarauto.admin.drivervehicles'))->with($message);
    }

    public function driversvehicles_delete(DriverVehicle $epu){
        if ($epu->delete()){
            $message = ['success'=>'Se eliminó exitosamente la asociación de el conductor y el vehiculo.', 'typealert'=>'success'];
        } else {
            $message = ['error'=>'No se pudo eliminar la asociación de el conductor y el vehiculo.', 'typealert'=>'danger'];
        }
        return redirect(route('hangarauto.admin.drivervehicles'))->with($message);
    }

    

    
}
