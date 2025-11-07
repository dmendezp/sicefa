<?php

namespace Modules\EVS\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Validator, Str;

use Modules\EVS\Entities\Election;
use Illuminate\Support\Facades\Gate;

class ElectionsController extends Controller
{
    public function getElections(){
        Gate::authorize('haveaccess', 'elections.list');
        $elections = Election::orderBy('id','Desc')->get();
        $data = ['elections'=>$elections];
        return view('evs::admin.elections.home', $data);
    }

    public function getElectionAdd(){
        Gate::authorize('haveaccess', 'elections.add');
        return view('evs::admin.elections.add');
    }

    public function postElectionAdd(Request $request){
        $rules = [
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ];

        $messages = [
            'name.required' => 'Se requiere un nombre para la elección.',
            'start_date.required' => 'Se requiere la fecha y hora de inicio de la elección.',
            'end_date.required' => 'Se requiere la fecha y hora de finalización de la elección.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        else:
            $e = new Election;
            $e->name = e($request->input('name'));
            $e->start_date = e($request->input('start_date'));
            $e->end_date = e($request->input('end_date'));
            $e->status = 'Inactivo';
            if($e->save()){
                return redirect(route('evs.admin.elections'))->with('message', 'Guardado con éxito')->with('typealert', 'success');
            }
        endif; 
    }

    public function getElectionEdit($id){
        $election = Election::findOrFail($id);
        $data = ['election' => $election];
        return view('evs::admin.elections.edit',$data);
    }

    public function postElectionEdit(Request $request, $id){
        $rules = [
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ];

        $messages = [
            'name.required' => 'Se requiere un nombre para el Electiono.',
            'start_date.required' => 'Se requiere la fecha y hora de inicio de la elección.',
            'end_date.required' => 'Se requiere la fecha y hora de finalización del elección.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        else:
            $e = Election::findOrFail($id);
            $e->name = e($request->input('name'));
            $e->start_date = $request->input('start_date');
            $e->end_date = e($request->input('end_date'));
            $e->status = e($request->input('status'));;
            if($e->save()){
                return redirect('evs/admin/elections')->with('message', 'Guardado con éxito')->with('typealert', 'success');
            }
        endif;         
    }

    public function getElectionDelete($id){
        $e = Election::findOrFail($id);
        if($e->delete()):
            return back()->with('message', 'Elección enviada a la papelera de reciclaje')->with('typealert', 'success');
        endif;
    }
}
