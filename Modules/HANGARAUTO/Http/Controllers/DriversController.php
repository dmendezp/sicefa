<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\HANGARAUTO\Entities\Driver;
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

    // Agregar Conductor
    public function postCreateAdd(Request $request){
        $drivers = new Driver();
        $drivers->person_id = $request->input('person_id');
        if ($drivers->save()){
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.drivers'))->with('messages', 'Conductor Agregado Con Exito')->with('typealert','success');
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
            return redirect('hangarauto::admin.conductores.create')->withErrors($validator)->with('messages', 'Se Ha Producido Un Error')->with('typealert', 'danger')->withInput();
        else:
            $people = Person::where('document_number', $request->input('search'))->first();
            $data = ['people' => $people];
            return view('hangarauto::admin.conductores.create', $data);
        endif;
    }

    
    // Editar Conductores
    public function getDriversEdit($id)
    {
        $drivers = Driver::find($id);
        $data = ['drivers' => $dirvers];
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
            return back()->withErrors($validator)->with('messages', 'Se Ha Producido Un Error')->with('typealert', 'danger');
        else:
            $drivers = Driver::findOrFail($id);
            $drivers->name = $request->input('name');
            $drivers->last_name = $request->input('last_name');
            $drivers->email = $request->input('email');
            $drivers->phone = $request->input('phone');
            $drivers->i_number = $request->input('id_number');
            if($drivers->save()){
                return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.drivers'))->with('messages','Conductor Actualizado Con Exito.')->with('typealert','success');
            }
        endif;
    }

    // Eliminar Conductores
    public function getDriversDelete($id)
    {
        $driver = Driver::find($id);
        if($driver->delete()):
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.drivers.delete'))->with('messages','Conductor Eliminado Con Exito.')->with('typealert','success');
        endif;
    }
}
