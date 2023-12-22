<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\HANGARAUTO\Entities\Petition;
use Modules\HANGARAUTO\Entities\Drivers;
use Modules\HANGARAUTO\Entities\Vehicle;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Department;
use Modules\SICA\Entities\Municipality;

use Validator, Str;

class ParkingController extends Controller
{
    // Vista inicio
    public function index()
    {
        return view('hangarauto::index');
    }

    // Vista De Administrador
    public function administrator()
    {
        return view('hangarauto::admin.dashboard');
    }

    // Traer Toda La Información De La Base De Datos
    public function solicitudes() {
        $requests = Petition::with('people','municipality.department')->orderBy('id','asc')->get();
    }

    public function getSolicitarAdd(Request $request){
        $department = Department::where('country_id')->pluck('name','id');
        $municipality = Municipality::where('department_id',$request->department_id)->get();
        $data = ['municipality' => $municipality];
        return view('hangarauto::solicitar', compact('department', 'municipality'));
    }

    // Solicitar
    public function postSolicitarAdd(Request $request){
        $rules = [
            'person_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'municipality_id' => 'required',
            'reason' => 'required',
            'numstudents' => 'required',
        ];
        $messages = [
          'person_id.required' => 'Debe Seleccionar La Persona Que Solicita El Vehiculo.',
          'start_date.required' => 'Debe Seleccionar Una Fecha Para Cuando Requiera El Vehiculo.',
          'end_date.required' => 'Debe Seleccionar La Fecha De Devolucion Del Vehiculo.',
          'municipality_id.required' => 'Debe Ingresar La Ciudad A La Que Se Dirige.',
          'reason.required' => 'Debe Escribir El Motivo De Su Viaje.',
          'numstudents.required' => 'Por Favor Digite La Cantidad De Aprendices Que Va A Llevar.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se Ha Producido Un Error'->whith('typealert','danger'));
            else:
                $p = new Petition;
                $p->star_date = $request->date('start_date');
                $p->end_date = $request->date('end_date');
                $p->municipality_id = $request->select('municipality_id');
                $p->reason = $request->input('reason');
                $p->NumStudents = $request->input('numstudents');
                if($p-save()){
                    $p->people()->attach($request->input('person_id'),['kind_of_people' => 'Usuario']);
                    return redirect(route('cefa.parking.index'))->with('message','Solicitud Enviada Exitosamente.')->with('typealert','success');
                }
        endif;
            return view('hangarauto::index');
    }
}