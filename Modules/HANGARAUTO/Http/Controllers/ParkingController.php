<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HANGARAUTO\Entities\Petition;
use Modules\HANGARAUTO\Entities\Drivers;
use Modules\HANGARAUTO\Entities\Vehicle;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Country;
use Modules\SICA\Entities\Department;
use Modules\SICA\Entities\Municipality;

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
        $municipality = Municipality::where('department_id',$request->department_id)->get();
        $data = ['department' => $department , 'vehicles' => $vehicles];
        return view('hangarauto::request_form.solicitar', $data);
    }

    // Solicitar
    public function postSolicitarAdd(Request $request){
        $rules = [
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'department' => 'required',
            'municipality' => 'required',
            'numstudents' => 'required|numeric',
            'reason' => 'required',
        ];
        $messages = [
          'name.required' => 'Debe Ingresar su nombre.',
          'start_date.required' => 'Debe Seleccionar Una Fecha Para Cuando Requiera El Vehiculo.',
          'end_date.required' => 'Debe Seleccionar La Fecha De Devolucion Del Vehiculo.',
          'department.required' => 'El Departamento Es Obligatorio.',
          'municipality.required' => 'Debe Ingresar La Ciudad A La Que Se Dirige.',
          'numstudents.required' => 'Por Favor Digite La Cantidad De Aprendices Que Va A Llevar.',
          'reason.required' => 'Debe Escribir El Motivo De Su Viaje.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se Ha Producido Un Error')->with('typealert','danger');
            else:
                $p = new Petition;
                $p->start_date = $request->date('start_date');
                $p->end_date = $request->date('end_date');
                $p->municipality_id = $request->input('municipality');
                $p->reason = $request->input('reason');
                $p->numstudents = $request->input('numstudents');
                $p->vehicle_id = $request->input('vehicle');
                if($p->save()){
                    return redirect(route('cefa.parking.table'))->with('message','Solicitud Enviada Exitosamente.')->with('typealert','success');
                }
        endif;
            return view('hangarauto::request_form.table');
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
            return redirect('hangarauto::solicitar')->withErrors('message','Se Ha Producido Un Error')->with('typealert','danger')->withInput();
            else:
                $people = Person::where('document', $request->input('search'))->first();
                $department = Department::where('country_id')->pluck('name','id');
                $data = ['people' => $people, 'department' => $department];
                return view('hangarauto::solicitar',$data);
        endif;
    }

    public function table()
    {
        $requests = Petition::with('municipality.department')->orderBy('id','asc')->get();
        return view('hangarauto::request_form.resultform', compact('requests'));
    }

    public function getMunicipalities($departmentId)
    {
        // Buscar los municipios correspondientes al departamento seleccionado
        $municipalities = Municipality::where('department_id', $departmentId)->pluck('name', 'id');

        // Devolver los municipios como respuesta en formato JSON
        return response()->json($municipalities);
    }
}