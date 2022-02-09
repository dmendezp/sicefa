<?php

namespace Modules\EVS\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use Modules\EVS\Entities\Jury;
use Modules\EVS\Entities\Election;
use Modules\SICA\Entities\Person;


use Validator, Str;

class JuriesController extends Controller
{
    public function getJuries(){
        $juries = Election::with('juries.person')->orderBy('id','Desc')->get();
        return view('evs::admin.juries.home', ['juries' => $juries]);
    }

    public function getJuriesAdd($id){
        $election = Election::findOrFail($id);
        $data = ['election'=>$election];
        return view('evs::admin.juries.add', $data);
    }

    public function postJuriesSearch(Request $request, $id){
        $rules = [
            'search' => 'required'
        ];
        $messages = [
            'search.required' => 'El campo consulta es requerido.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('evs/admin/juries/add/'.$id)->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert', 'danger')->withInput();
        else:
            $election = Election::findOrFail($id);
            $person = Person::where('document', $request->input('search'))->first();
            $data = ['person' => $person, 'election' => $election];
            return view('evs::admin.juries.add',$data);
        endif;

    }

    public function postJuriesAdd(Request $request){
        $rules = [
            'password' => 'required',
        ];
        $messages = [
            'password.required' => 'Se requiere que asigne una contraseña.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        else:
            $j = new Jury;
            $j->person_id = e($request->input('person_id'));
            $j->election_id = e($request->input('election_id'));
            $j->password = Hash::make($request->input('password'));
            if($j->save()){
                return redirect(route('evs.admin.juries'))->with('message', 'Guardado con éxito')->with('typealert', 'success');
            }
        endif;         
    }

    public function getJuriesEdit($id){
        $juries = Jury::findOrFail($id);
        $data = ['juries' => $juries];
        $pid = $juries->person_id;
        $people = Person::findOrFail($pid);
        $eid = $juries->election_id;
        $election = Election::findOrFail($eid);
        return view('evs::admin.juries.edit', $data)->with('name_election', $election->name)->with('name_people',$people->first_name." ".$people->first_last_name." ".$people->second_last_name);
    }

    public function postJuriesEdit(Request $request, $id){
        $rules = [
            'password' => 'required',
        ];
        $messages = [
            'password.required' => 'Se requiere asignar una contraseña.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        else:
            $j = Jury::findOrFail($id);
            $j->password = Hash::make($request->input('password'));
            if($j->save()){
                return redirect(route('evs.admin.juries'))->with('message', 'Modificado con éxito')->with('typealert', 'success');
            }
        endif; 
    }

    public function getJuriesDelete($id){
        $j = Jury::findOrFail($id);
        if($j->delete()):
            return back()->with('message', 'Jurado enviado a la papelera de reciclaje')->with('typealert', 'success');
        endif;
    }
    
}
