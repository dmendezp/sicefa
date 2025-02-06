<?php

namespace Modules\EVS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\SICA\Entities\Person;
use Modules\EVS\Entities\Authorized;
use Modules\EVS\Entities\Election;
use Modules\EVS\Entities\Elected;
use Modules\EVS\Entities\Vote;

use Validator, Str;

class EVSController extends Controller
{
    
    public function index()
    {
        session(['conn' => 'mysql']);
        $elected = Elected::where('status', 'Activo')->with('candidate.person')->with('candidate.election')->get();
        return view('evs::voto.index',['elected' => $elected]);
    }

    public function getVotar(){
        return view('evs::voto.votar');
    }

    public function postValidar(Request $request){
        $rules = [
            'document' => 'required|numeric',
            'securityCode' => 'required'
        ];

        $messages = [
            'document.required' => 'El campo Documento es requerido.',
            'document.numeric' => 'El campo Documento debe ser un numero.',
            'securityCode.required' => 'El campo Codigo de seguridad es requerido.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        else:

            $people = Person::where('document', $request->input('document'))->whereHas('authorizeds.election', function ($query) { $query->where('status','Activo');})->get();

            if(count($people)==0):
                return redirect(route('cefa.evs.voto.votar'))->with('message', 'El numero de documento no se encuentra o no esta habilitado para votar')->with('typealert', 'warning');
            endif;
            $fini = $people[0]->authorizeds[0]->election->start_date;
            $ffin = $people[0]->authorizeds[0]->election->end_date;
            date_default_timezone_set('America/Bogota');
            $factual = date("Y-m-d H:i:s");
            $ffini = date_create($fini);
            $ffini = date_format($ffini,"d/m/Y h:ia");

            $fffin = date_create($ffin);
            $fffin = date_format($fffin,"d/m/Y h:ia");

            if($factual<$fini or $factual>$ffin):
                return redirect(route('cefa.evs.voto.votar'))->with('message', 'Las fechas y horas de votación son del '.$ffini." al ".$fffin)->with('typealert', 'warning');
            endif;

            if($people[0]->authorizeds[0]->status=='Inactivo'):
                return redirect(route('cefa.evs.voto.votar'))->with('message', 'Ya registro su voto en el sistema')->with('typealert', 'danger');
            endif;

            if($request->input('securityCode')!=$people[0]->authorizeds[0]->code):
                return redirect(route('cefa.evs.voto.votar'))->with('message', 'El codigo de seguridad no coincide, intente de nuevo')->with('typealert', 'warning');
            endif;

            $dataelecciones = Election::where('status', 'Activo')->with('candidates.person.apprentices.course.program')->orderBy('id','Desc')->get();
            return view('evs::voto.tarjeton', ['people' => $people], ['dataelecciones' => $dataelecciones]);
        endif;
    }

    public function postRegistrar(Request $request){
        $a = Authorized::findOrFail($request->input('authorized_id'));
        if($a->status=='Activo'){
            $v = new Vote;
            $v->candidate_id = e($request->input('candidate_id'));
            $v->election_id = e($request->input('election_id'));
            if($v->save()){
                $a = Authorized::findOrFail($request->input('authorized_id'));
                $a->status = "Inactivo";
                if($a->save()){
                    return redirect(route('cefa.evs.voto.votar'))->with('message', 'Su voto se ha registrado con éxito')->with('typealert', 'success');
                }
            }
        }
        else{
            return redirect(route('cefa.evs.voto.votar'))->with('message', 'Ya registro su voto en el sistema')->with('typealert', 'danger');
        }
    }
    
    public function getResultados(){
        //$elected = Elected::where('status', 'Activo')->with('candidate.person')->with('candidate.election')->get();
        $dataelecciones = Election::with('candidates.person.apprentices.course.program')->with('electeds.candidate.person')->with('candidates.votes')->withCount(['votes'=>function($query){$query->where('candidate_id',0);}])->orderBy('id','Desc')->get();

        //return $dataelecciones;
     
        return view('evs::voto.resultados', ['dataelecciones' => $dataelecciones]);
    }

    public function normatividad(){
        return view('evs::voto.normatividad');
    }

    public function desarrolladores(){
        return view('evs::voto.desarrolladores');
    }


 
}
