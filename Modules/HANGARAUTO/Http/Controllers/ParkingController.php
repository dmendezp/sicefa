<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HANGARAUTO\Entities\Petition;
use Modules\HANGARAUTO\Entities\Driver;
use Modules\HANGARAUTO\Entities\PetitionAssignment;
use Modules\HANGARAUTO\Entities\Vehicle;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Country;
use Modules\SICA\Entities\Department;
use Modules\SICA\Entities\Municipality;
use Modules\HANGARAUTO\Entities\VehicleType;
use App\Models\User;

use Validator, Str;

class ParkingController extends Controller
{

    // Traer Toda La Información De La Base De Datos
    public function solicitudes() {
        $requests = Petition::with('person','municipality.department')->orderBy('name','asc')->get();
    }

    public function getSolicitarAdd(Request $request){
        $pais = Country::where('name','=','Colombia')->pluck('id');
        $department = Department::where('country_id', $pais)->pluck('name','id');
        $vehicles = [];
        foreach (Vehicle::all() as $vehicle) {
            $vehicles[$vehicle->id] = $vehicle->name . ' - ' . $vehicle->license;
        }
        $vehicletype = VehicleType::pluck('name','id');
        $municipality = Municipality::where('department_id',$request->department_id)->get();
        $data = ['department' => $department , 'vehicles' => $vehicles, 'vehicletype' => $vehicletype];
        return view('hangarauto::request_form.solicitar', $data);
    }

    // Solicitar
    public function postSolicitarAdd(Request $request){
        $rules = [
            'start_date' => 'required',
            'end_date' => 'required',
            'department' => 'required',
            'municipality' => 'required',
            'vehicletype' => 'required',
            'numstudents' => 'required|numeric',
            'reason' => 'required',
        ];
        $messages = [
            'start_date.required' => 'Debe seleccionar una fecha para cuando requiera el vehículo.',
            'end_date.required' => 'Debe seleccionar la fecha de devolución del vehículo.',
            'department.required' => 'El departamento es obligatorio.',
            'municipality.required' => 'Debe ingresar la ciudad a la que se dirige.',
            'vehicletype.required' => 'Debe seleccionar el tipo de vehículo.',
            'numstudents.required' => 'Por favor digite la cantidad de aprendices que va a llevar.',
            'reason.required' => 'Debe escribir el motivo de su viaje.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return back()->withErrors($validator)->with('error', 'Se ha producido un error')->with('typealert','danger');
        } else {
            // Obtiene el usuario autenticado
            $user = Auth::user();
            $personid = $user->person->id;
            $p = new Petition;
            $p->start_date = $request->start_date;
            $p->end_date = $request->end_date;
            $p->municipality_id = $request->input('municipality');
            $p->reason = $request->input('reason');
            $p->numstudents = $request->input('numstudents');
            $p->vehicle_type_id = $request->input('vehicletype');
            $p->person_id = $personid;
            if ($p->save()) {
                if (Route::is('hangarauto.admin.*')) {
                    // Si el usuario tiene el rol "admin", redirige a una ruta específica
                    return redirect(route('hangarauto.admin.petitions'))->with('success', 'Solicitud enviada exitosamente.')->with('typealert', 'success');
    
                } elseif (Route::is('hangarauto.charge.*')) {
                    // Si el usuario tiene el rol "charge", redirige a una ruta específica
                    return redirect(route('hangarauto.charge.petitions'))->with('success', 'Solicitud enviada exitosamente.')->with('typealert', 'success');
                } else {
                    // Si el usuario no tiene el rol "admin" ni "charge", redirige a otra ruta
                    return redirect(route('cefa.parking.table'))->with('success', 'Solicitud enviada exitosamente.')->with('typealert', 'success');
                }
            } else {
                // En caso de que la solicitud no se haya guardado correctamente, redirige a otra ruta
                return view('hangarauto::request_form.table');
            }
        }
    }

    public function assignadd(Request $request){
        $rules = [
            'petition_id' => 'required',
            'vehicle' => 'required',
            'driver' => 'required',
           
        ];
        $messages = [
            'petition_id.required' => 'Requiere la peticion.',
            'vehicle.required' => 'Debe seleccionar el vehiculo.',
            'driver.required' => 'Debe seleccionar el conductor.',
           
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return back()->withErrors($validator)->with('error', 'Se ha producido un error')->with('typealert','danger');
        } else {
            // Obtiene el usuario autenticado
            $p = new PetitionAssignment;
            $p->petition_id = $request->input('petition_id');
            $p->vehicle_id = $request->input('vehicle');
            $p->driver_id = $request->input('driver');
            if ($p->save()) {
                $petition = Petition::find($request->input('petition_id'));
                $petition->status = 'Asignado';
                $petition->save();
                if (Route::is('hangarauto.admin.*')) {
                    // Si el usuario tiene el rol "admin", redirige a una ruta específica
                    return redirect(route('hangarauto.admin.petitions'))->with('success', 'Solicitud asignada exitosamente.')->with('typealert', 'success');
    
                } elseif (Route::is('hangarauto.charge.*')) {
                    // Si el usuario tiene el rol "charge", redirige a una ruta específica
                    return redirect(route('hangarauto.charge.petitions'))->with('success', 'Solicitud asignada exitosamente.')->with('typealert', 'success');
                } else {
                    // Si el usuario no tiene el rol "admin" ni "charge", redirige a otra ruta
                    return redirect(route('cefa.parking.table'))->with('success', 'Solicitud asignada exitosamente.')->with('typealert', 'success');
                }
            } else {
                // En caso de que la solicitud no se haya guardado correctamente, redirige a otra ruta
                return view('hangarauto::request_form.table');
            }
        }
    }

    public function dennypetition(Request $request, $id){
        $rules = [
            'observation' => 'required',
           
        ];
        $messages = [
            'observation.required' => 'Requiere una observacion de su motivo.',
           
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return back()->withErrors($validator)->with('error', 'Se ha producido un error')->with('typealert','danger');
        } else {
            $petition = Petition::find($id);
            $petition->status = 'Denegado';
            $petition->observation = $request->input('observation');
            if ($petition->save()) {
                if (Route::is('hangarauto.admin.*')) {
                    // Si el usuario tiene el rol "admin", redirige a una ruta específica
                    return redirect(route('hangarauto.admin.petitions'))->with('succes', 'Solicitud denegada exitosamente.')->with('typealert', 'success');
    
                } elseif (Route::is('hangarauto.charge.*')) {
                    // Si el usuario tiene el rol "charge", redirige a una ruta específica
                    return redirect(route('hangarauto.charge.petitions'))->with('succes', 'Solicitud denegada exitosamente.')->with('typealert', 'success');
                } else {
                    // Si el usuario no tiene el rol "admin" ni "charge", redirige a otra ruta
                    return redirect(route('cefa.parking.table'))->with('succes', 'Solicitud denegada exitosamente.')->with('typealert', 'success');
                }
            } else {
                // En caso de que la solicitud no se haya guardado correctamente, redirige a otra ruta
                return view('hangarauto::request_form.table');
            }
        }
    }

    public function dennypetitiondriver(Request $request, $id){
        $rules = [
            'observation' => 'required',
           
        ];
        $messages = [
            'observation.required' => 'Requiere una observacion de su motivo.',
           
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return back()->withErrors($validator)->with('error', 'Se ha producido un error')->with('typealert','danger');
        } else {
            $petition = Petition::find($id);
            $petition->status = 'Denegado';
            $petition->observation = $request->input('observation');
            if ($petition->save()) {
                $petitionassigmentid = PetitionAssignment::where('petition_id',$id)->pluck('id');
                $petitionassigment = PetitionAssignment::find($petitionassigmentid)->first();
                $petitionassigment->delete();
                if (Route::is('hangarauto.admin.*')) {
                    // Si el usuario tiene el rol "admin", redirige a una ruta específica
                    return redirect(route('hangarauto.admin.petitions'))->with('succes', 'Solicitud denegada exitosamente.')->with('typealert', 'success');
    
                } elseif (Route::is('hangarauto.charge.*')) {
                    // Si el usuario tiene el rol "charge", redirige a una ruta específica
                    return redirect(route('hangarauto.charge.petitions'))->with('succes', 'Solicitud denegada exitosamente.')->with('typealert', 'success');
                } elseif (Route::is('hangarauto.driver.*')) {
                    // Si el usuario tiene el rol "charge", redirige a una ruta específica
                    return redirect(route('hangarauto.driver.petitions'))->with('succes', 'Solicitud denegada exitosamente.')->with('typealert', 'success');
                } else {
                    // Si el usuario no tiene el rol "admin" ni "charge", redirige a otra ruta
                    return redirect(route('cefa.parking.table'))->with('succes', 'Solicitud denegada exitosamente.')->with('typealert', 'success');
                }
            } else {
                // En caso de que la solicitud no se haya guardado correctamente, redirige a otra ruta
                return view('hangarauto::request_form.table');
            }
        }
    }

    // Bucar Solicitud
    public function getSolicitarSearch(Request $request){
        $department = Department::where('country_id')->pluck('name','id');
        $data = ['department' => $department];
        return view('hangarauto::solicitar', $data);
    }

    // Obtener Solicitud
    public function postSolicitarSearch(Request $request){
        $rules = [
            'search' => 'required'
        ];
        $messages = [
            'search.required' => 'El Campo Consulta Es Requerido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('hangarauto::solicitar')->withErrors('error','Se Ha Producido Un Error')->with('typealert','danger')->withInput();
            else:
                $people = Person::where('document', $request->input('search'))->first();
                $department = Department::where('country_id')->pluck('name','id');
                $data = ['people' => $people, 'department' => $department];
                return view('hangarauto::solicitar',$data);
        endif;
    }

    public function table()
    {
        if (checkRol('hangarauto.admin') || checkRol('hangarauto.charge')) {
            $requests = Petition::with('municipality.department')->orderBy('id','asc')->get();
        } elseif (checkRol('hangarauto.driver')) {
            $user = Auth::user();
            $personid = $user->person->id;
            $requests = Petition::with('petition_assignments.driver','municipality.department')
            ->whereHas('petition_assignments.driver', function ($query) use ($personid) {
                $query->where('person_id', $personid);
            })
            ->get();
        
        } else {
            $user = Auth::user();
            $personid = $user->person->id;
            $requests = Petition::where('person_id',$personid)->with('municipality.department')->orderBy('id','asc')->get();
        }
        return view('hangarauto::request_form.resultform', compact('requests'));
    }


    public function tabledriver()
    {
        // Obtiene el usuario autenticado
        $user = Auth::user();

        $personid = $user->person->id;

        $requests = Petition::where('person_id', $personid)->orderBy('id','asc')->get();

        return view('hangarauto::request_form.resultform', compact('requests'));
    }



    public function getMunicipalities($departmentId)
    {
        // Buscar los municipios correspondientes al departamento seleccionado
        $municipalities = Municipality::where('department_id', $departmentId)->pluck('name', 'id');

        // Devolver los municipios como respuesta en formato JSON
        return response()->json($municipalities);
    }

    public function getDrivers($vehicleId)
    {
        // Obtener la fecha de inicio
        $startDate = request()->input('start_date');

       

        // Buscar los conductores que no tienen una petición para la fecha de inicio
        $drivers = Driver::whereDoesntHave('petition_assignments.petition', function ($query) use ($startDate) {
            $query->where('start_date', '<=', $startDate)
                ->where('end_date', '>=', $startDate);
        })
        ->with('person')
        ->get();

     
        // Devolver los conductores como respuesta en formato JSON
        return response()->json($drivers);
    }

    public function getVehicles($petitionId)
    {

        $petition = Petition::find($petitionId);
        $vehiculotype = $petition->vehicle_type_id;
        $startDate = $petition->start_date;

        $vehicletypeid = VehicleType::where('id',$vehiculotype)->pluck('id');
        $vehicles = Vehicle::with('petition_assignments.petition')
        ->where('vehicle_type_id',$vehicletypeid)
        ->whereDoesntHave('petition_assignments.petition', function ($query) use ($startDate) {
            $query->where('start_date', '<=', $startDate)
                ->where('end_date', '>=', $startDate);
        })
        ->get();


        

        // Devolver los conductores como respuesta en formato JSON
        return response()->json($vehicles);
    }

    public function getVehiclessolicitar(Request $request,$start_date)
    {
        
        $vehiculotype = $request->input('vehicletype');
        $vehicletypeid = VehicleType::where('id',$vehiculotype)->pluck('id');
        $vehicles = Vehicle::with('petition_assignments.petition')
        ->where('vehicle_type_id',$vehicletypeid)
        ->whereDoesntHave('petition_assignments.petition', function ($query) use ($start_date) {
            $query->where('start_date', '<=', $start_date)
                ->where('end_date', '>=', $start_date);
        })
        ->get();


        

        // Devolver los conductores como respuesta en formato JSON
        return response()->json($vehicles);
    }

    public function confirmation($id){

        // Obtiene el usuario autenticado
        $petition = Petition::find($id);
        $petition->status = 'Aprobado';
        if ($petition->save()) {
            if (Route::is('hangarauto.admin.*')) {
                // Si el usuario tiene el rol "admin", redirige a una ruta específica
                return redirect(route('hangarauto.admin.petitions'))->with('success', 'Solicitud aprobada exitosamente.')->with('typealert', 'success');
    
            } elseif (Route::is('hangarauto.charge.*')) {
                // Si el usuario tiene el rol "charge", redirige a una ruta específica
                return redirect(route('hangarauto.charge.petitions'))->with('success', 'Solicitud aprobada exitosamente.')->with('typealert', 'success');
            } elseif (Route::is('hangarauto.driver.*')) {
                // Si el usuario tiene el rol "charge", redirige a una ruta específica
                return redirect(route('hangarauto.driver.petitions'))->with('success', 'Solicitud aprobada exitosamente.')->with('typealert', 'success');
            } else {
                // Si el usuario no tiene el rol "admin" ni "charge", redirige a otra ruta
                return redirect(route('cefa.parking.table'))->with('success', 'Solicitud aprobada exitosamente.')->with('typealert', 'success');
            }
        } else {
            return redirect()->back()->with(['error'=>'Ocurrio un error al confirmar', 'typealert'=>'danger']);
        } 
        
    }



}