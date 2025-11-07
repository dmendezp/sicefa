<?php

namespace Modules\EVS\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Validator, Str;

use Modules\EVS\Entities\Election;

class EventController extends Controller
{
     public function getEvents(){
     	$events = Election::orderBy('enesId','Desc')->get();
     	$data = ['events'=>$events];
        return view('evs::admin.events.home', $data);
    }

    public function getEventAdd(){
        return view('evs::admin.events.add');
    }

    public function postEventAdd(Request $request){
    	$rules = [
    		'enesNombre' => 'required',
    		'enesFechHoraInic' => 'required',
    		'enesFechHorafin' => 'required'
    	];

    	$messages = [
    		'enesNombre.required' => 'Se requiere un nombre para el evento.',
    		'enesFechHoraInic.required' => 'Se requiere la fecha y hora de inicio del evento.',
    		'enesFechHorafin.required' => 'Se requiere la fecha y hora de finalización del evento.',
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
    	else:
    		$e = new Election;
    		$e->enesNombre = e($request->input('enesNombre'));
    		$e->enesFechHoraInic = e($request->input('enesFechHoraInic'));
    		$e->enesFechHorafin = e($request->input('enesFechHorafin'));
    		$e->enesEstado = 'I';
    		if($e->save()){
    			return redirect(route('evs.admin.events'))->with('message', 'Guardado con éxito')->with('typealert', 'success');
    		}
    	endif; 
    }

    public function getEventEdit($id){
        $event = Election::findOrFail($id);
        $data = ['event' => $event];
        return view('evs::admin.events.edit',$data);
    }

    public function postEventEdit(Request $request, $id){
        $rules = [
            'enesNombre' => 'required',
            'enesFechHoraInic' => 'required',
            'enesFechHorafin' => 'required'
        ];

        $messages = [
            'enesNombre.required' => 'Se requiere un nombre para el evento.',
            'enesFechHoraInic.required' => 'Se requiere la fecha y hora de inicio del evento.',
            'enesFechHorafin.required' => 'Se requiere la fecha y hora de finalización del evento.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        else:
            $e = Election::findOrFail($id);
            $e->enesNombre = e($request->input('enesNombre'));
            $e->enesFechHoraInic = $request->input('enesFechHoraInic');
            $e->enesFechHorafin = e($request->input('enesFechHorafin'));
            $e->enesEstado = e($request->input('enesEstado'));;
            if($e->save()){
                return redirect('evs/admin/events')->with('message', 'Guardado con éxito')->with('typealert', 'success');
            }
        endif;         
    }

    public function getEventDelete($id){
        $e = Election::findOrFail($id);
        if($e->delete()):
            return back()->with('message', 'Evento enviado a la papelera de reciclaje')->with('typealert', 'success');
        endif;
    }

}
