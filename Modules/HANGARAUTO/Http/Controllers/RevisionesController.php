<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\HANGARAUTO\Entities\Vehicle;
use Modules\HANGARAUTO\Entities\Tecnomecanic;
use Modules\HANGARAUTO\Entities\Soat;
use Modules\HANGARAUTO\Entities\Driver;

use Validator, Str;

class RevisionesController extends Controller
{

    // Traer Toda La Información De La Tabla De Soat
    public function seguroobligatorio()
    {
        $Soat = Soat::orderBy('id','asc')->get();
        $vehicles = Vehicle::pluck('name', 'id');
        $data = ['Soat' => $Soat, 'vehicles' => $vehicles];
        return view('hangarauto::admin.revisiones.SOAT.index', $data);
    }

    // Retorne A La Vista Soat
    public function getSoatAdd()
    {
        return view('cefa.parking.soat');
    }

    
    // Agregar Registro De Soat 
    public function postSoatAdd(Request $request)
    {
        $rules = [
            'vehicle_name_id' => 'required',
            'who' => 'required',
            'arrived' => 'required',
            'newdate' => 'required',
        ];
        $messages = [
            'vehicle_name_id.required' => 'Ingrese El Nombre Del Vehiculo',
            'who.required' => 'Ingrese Quien Realizó La Renovación Del Soat',
            'arrived.required' => 'Ingrese La Fecha En Que Se Renovó El Soat',
            'newdate.required' => 'Ingrese La Nueva Fecha De Vencimiento Del Soat'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se Ha Producido Un Error')->with('typealert','danger');
         else:
            $Soat = new Soat();
            $Soat->vehicle_name_id = $request->input('vehicle_name_id');
            $Soat->who = $request->input('who');
            $Soat->arrived = $request->input('arrived');
            $Soat->newdate = $request->input('newdate');
            if($Soat->save()){
                return redirect(route('cefa.parking.soat'))->with('messages','Nuevo Registro De Soat Agregado Exitosamente')->with('typealert','success');
            }
        endif;
        return view('hangarauto::admin.revisiones.SOAT.index');
    }

    // Eliminar Registro De Soat
    public function getSoatDelete($id)
    {
        $Soat = Soat::find($id);
        if($Soat->delete()):
            return redirect(route('cefa.parking.soat'))->with('messages','Registro Elimado Con Exito')->with('typealert','success');
        endif;
    }

    
    // Trae Toda Los Datos De La Tabla De Tecnomecanica
    public function tecnomecanica()
    {
        $Tecnomecanic = Tecnomecanic::orderBy('id','asc')->get();
        $vehicles = Vehicle::pluck('name','id');
        $data = ['Tecnomecanic' => $Tecnomecanic, 'vehicles' => $vehicles];
        return view('hangarauto::admin.revisiones.tecnomecanica.index', $data);
    }

    // Agregar Tecnomecanica
    public function getTecnomecanicaAdd(){
        return view('cefa.parking.tecnomecanica');
    }

    public function postTecnomecanicAdd(Request $request)
    {
        $rules = [
            'vehicle_name_id' => 'required',
            'who' => 'required',
            'arrived' => 'required',
            'newdate' => 'required',
        ];
        $messages = [
            'vehicle_name_id.required' => 'Debe Ingresar El Nombre Del Vehiculo',
            'who.required' => 'Ingrese Quien Hizo La Renovación De La Tecnomecanica',
            'arrived.required' => 'La Fecha En Que Renovó La Tecnomecanica',
            'newdate.required' => 'Ingrese La Nueva Fecha De Vencimiento De La Tecnomecanica'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->withInput('messages','Se Ha Producido Un Error')->with('typealert','danger');
        else:
            $Tecnomecanic = new tecnomecanic();
            $Tecnomecanic->vehicle_name_id = $request->input('vehicle_name_id');
            $Tecnomecanic->who = $request->input('who');
            $Tecnomecanic->arrived = $request->input('arrived');
            $Tecnomecanic->newdate = $request->input('newdate');
            if($Tecnomecanic->save()){
                return redirect(route('cefa.parking.tecnomecanica'))->with('messages','Nuevo Registro De Tecnomecanica Agregado Con Exito')->with('typealert','success');
            }
        endif;
        return view('hangarauto::admin.revisiones.tecnomecanica.index');
    }

    // Eliminar Registro De Tecnomecanica
    public function getTecnomecanicaDelete($id)
    {
        $Tecnomecanic = Tecnomecanic::find($id);
        if($Tecnomecanic->delete()):
            return redirect(route('cefa.parking.tecnomecanica'))->with('messages', 'Registro Eliminado Con Exito')->with('typealert','success');
        endif;
    }
}
