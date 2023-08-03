<?php

namespace Modules\EVS\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use Modules\EVS\Entities\Jury;
use Modules\EVS\Entities\Election;
use Modules\EVS\Entities\Authorized;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Program;


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
            $person = Person::where('document_number', $request->input('search'))->first();
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
            $j->password = md5($request->input('password'));
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
            $j->password = md5($request->input('password'));
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

    public function login(){
        session()->forget('jury_id');
        return view('evs::jurados.login');
    }
    public function logout(){
        return redirect(route('cefa.evs.juries.login'));
    }
    

    public function access(Request $request){
        $document_number = $request->input('document_number');
        $rules = [
            'document_number' => 'required',
            'password' => 'required',
        ];
        $messages = [
            'document_number.required' => 'Se requiere el numero de documento.',
            'password.required' => 'Se requiere la contraseña.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        else:
            $person = Person::with('juries')->with(['juries.election'=>function($query){$query->where('status','Activo');}])->where('document_number',$document_number)->first();
            if(isset($person->juries[0]['password'])):
                if($person->juries[0]['password']==md5($request->input('password'))):
                    session(['jury_id' => $person->juries[0]['id']]);
                    return view('evs::jurados.authorized',['person'=>$person]);
                else:
                    session()->forget('jury_id');
                    return back()->withErrors(['No se encuentran registros con estas credenciales'])->with('message', 'Se ha producido un error')->with('typealert', 'danger');
                endif;
            else:
                    session()->forget('jury_id');
                    return back()->withErrors(['No se encuentran registros con estas credenciales'])->with('message', 'Se ha producido un error')->with('typealert', 'danger');
            endif;
        endif; 
    }


    public function getaccess(){

        if(session()->has('jury_id')):
            $jury = Jury::findOrFail(session('jury_id'))->with('person')->first();
            $document_number = $jury->person->document_number;

            $person = Person::with('juries')->with(['juries.election'=>function($query){$query->where('status','Activo');}])->where('document_number',$document_number)->first();
            return view('evs::jurados.authorized',['person'=>$person]);
        endif; 
    }

    public function search(){
        parse_str($_POST['data'], $data);
        $person = Person::where('document_number',$data['document_v'])->first();
        if($person):
            return view('evs::jurados.search',['person'=>$person]);
        else:
            return '<span class="h5 text-danger">No se encontró registro</span>';
        endif;
        
    } 

    public function authorized(){
        //parse_str($_POST['data'], $data);
        $data = json_decode($_POST['data']);
        //print_r($data);
        //return false;
        $person = Person::where('document_number',$data->document_v)->first();
        //return $data->code;
        if($person):
            try{
                $a = new Authorized;
                $a->election_id = $data->election;
                $a->person_id = $person->id;
                $a->jury_id = $data->jury;
                $a->code = $data->code;
                $a->status = 'Activo';
                if($a->save()):
                    return '<span class="h5 text-success">Registro exitoso - Autorizado</span>';
                endif;
            }
            catch(\Exception $e){
                $a = Authorized::where('election_id',$data->election)->where('person_id',$person->id)->first();
                return '<span class="h5 text-danger">Votante ya Autorizado, codigo: '.$a->code.'</span>';
            }

        else:
            return '<span class="h5 text-danger">No se pudo guardar la autorización</span>';
        endif;
        
    }

    public function report(){
        /*$program = Program::with('courses.apprentices.person.authorizeds')->whereHas('courses.apprentices.person.authorizeds', function($q){
                    $q->where('status', '=', 'Activo');
                })->get();*/
        //$program = Authorized::with('person.apprentices.course.program')->get();
        
        $program = DB::table('programs')
            ->join('courses', 'programs.id', '=', 'courses.program_id')
            ->join('apprentices', 'courses.id', '=', 'apprentices.course_id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('authorizeds', 'people.id', '=', 'authorizeds.person_id')
            ->select('courses.id','courses.code','programs.name')
            ->where('courses.status','=','Activo')
            ->groupBy('courses.id')
            ->get();
        $authorizeds = DB::table('programs')
            ->join('courses', 'programs.id', '=', 'courses.program_id')
            ->join('apprentices', 'courses.id', '=', 'apprentices.course_id')
            ->join('people', 'apprentices.person_id', '=', 'people.id')
            ->join('authorizeds', 'people.id', '=', 'authorizeds.person_id')
            ->where('courses.status','=','Activo')
            ->select('courses.id','people.first_name', 'people.first_last_name', 'people.second_last_name','authorizeds.status')
            ->get();
        return view('evs::jurados.report', ['program'=>$program, 'authorizeds'=>$authorizeds]);
    }

      
    
}
