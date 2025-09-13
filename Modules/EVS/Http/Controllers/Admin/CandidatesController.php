<?php

namespace Modules\EVS\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\SICA\Entities\Person;
use Modules\EVS\Entities\Election;
use Modules\EVS\Entities\Candidate;

use Validator, Str;
use Illuminate\Support\Facades\Gate;
use Modules\SICA\Entities\Program;

class CandidatesController extends Controller
{

    public function getCandidates(){
        // return"a";
       /*  Gate::authorize('haveaccess', 'candidates.list'); */
        $candidates = Election::with('candidates.person.apprentices.course.program')->orderBy('id','Desc')->get();


        // $test = User::where("email",  "kikemurcia14@gmail.com")->first();

        // dd($test);
    //   dd($candidates->toArray());
        return view('evs::admin.candidates.home', ['candidates' => $candidates]);
    }


    public function getCandidatesAdd($id){
       /*  Gate::authorize('haveaccess', 'candidates.add'); */
        $election = Election::findOrFail($id);
        
        return view('evs::admin.candidates.add', ['election' => $election]);
    }


    public function postCandidatesSearch(Request $request, $id){

        // return"a";
    	$rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'El campo consulta es requerido.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return redirect('evs/admin/candidates/add')->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert', 'danger')->withInput();
        else:
            $election = Election::findOrFail($id);
          	$people = Person::where('document_number', $request->input('search'))->first();
            $data = ['people' => $people];

        return view('evs::admin.candidates.add', $data, ['election' => $election]);
        endif;
    }

    public function postCandidateAdd(Request $request){
    /* Gate::authorize('haveaccess', 'candidates.add'); */
    $rules = [
        'number' => 'required',
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
    $messages = [
        'number.required' => 'Se requiere un Número para el candidato.',
        'avatar.required' => 'Se requiere la fotografia del candidato.',
    ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
    else:
        $c = new Candidate;
        $c->person_id = e($request->input('person_id'));
        $c->election_id = e($request->input('election_id'));
        $c->number = e($request->input('number'));

        // 🔹 Guardar la imagen en carpeta candidatos_avatar
        if($request->hasFile('avatar')):
            $file = $request->file('avatar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('modules/evs/images/candidatos_avatar/'), $filename);
            $c->avatar = 'modules/evs/images/candidatos_avatar/'.$filename; // Guardamos ruta relativa
        endif;

        if($c->save()){
            return redirect(route('evs.admin.candidates'))->with('message', 'Guardado con éxito')->with('typealert', 'success');
        }
    endif; 
}

    public function getCandidateEdit($id){
        Gate::authorize('haveaccess', 'evs.admin.candidates.edit');
        $candidate = Candidate::findOrFail($id);
        $data = ['candidate' => $candidate];
        $pid = $candidate->person_id;
        $people = Person::findOrFail($pid);
        $eid = $candidate->election_id;
        $election = Election::findOrFail($eid);
        return view('evs::admin.candidates.edit', $data)->with('name_election', $election->name)->with('name_people',$people->first_name." ".$people->first_last_name." ".$people->second_last_name);
    }

   public function postCandidateEdit(Request $request, $id){
    Gate::authorize('haveaccess', 'evs.admin.candidates.edit');
    $rules = [
        'number' => 'required',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
    $messages = [
        'number.required' => 'Se requiere un Número para el candidato.',
    ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
    else:
        $c = Candidate::findOrFail($id);
        $c->number = e($request->input('number'));

        // 🔹 Si subió un nuevo avatar lo reemplazamos
        if($request->hasFile('avatar')):
            // Borrar el archivo anterior si existe
            if($c->avatar && file_exists(public_path($c->avatar))):
                unlink(public_path($c->avatar));
            endif;

            $file = $request->file('avatar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('modules/evs/images/candidatos_avatar/'), $filename);
            $c->avatar = 'modules/evs/images/candidatos_avatar/'.$filename; // Guardamos ruta relativa
        endif;

        if($c->save()){
            return redirect(route('evs.admin.candidates'))->with('message', 'Modificado con éxito')->with('typealert', 'success');
        }
    endif;         
}

public function getCandidateDelete($id){
    Gate::authorize('haveaccess', 'evs.admin.candidates.delete');

    $c = Candidate::findOrFail($id);

    // 🔹 Eliminar el archivo avatar si existe
    if ($c->avatar && file_exists(public_path($c->avatar))) {
        unlink(public_path($c->avatar));
    }

    if ($c->delete()) {
        return back()->with('message', 'Candidato eliminado junto con su imagen')
                     ->with('typealert', 'success');
    }
}



}
