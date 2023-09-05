<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PopulationGroup;
use Validator;

class PeopleController extends Controller
{

    /* Vista principal de datos personales */
    public function personal_data_index(){
        $data = ['title'=>'Consultar persona'];
        return view('sica::admin.people.personal_data.index',$data);
    }

    /* Buscar datos personales por número de documento */
    public function personal_data_search(Request $request){
        $rules = [
            'search' => 'required'
        ];
        $messages = [
            'search.required' => 'El campo consulta es requerido.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect(route('sica.admin.people.personal_data.index'))->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert', 'danger')->withInput();
        else:
        $doc =$request->input('search');
        $person = Person::where('document_number',$doc)->with('users')->first();
        switch ($person) {
            case '':
                return redirect(route('sica.admin.people.personal_data.create', $doc));
                break;
            default:
            return redirect(route('sica.admin.people.personal_data.edit', $person->id));
                break;
        }
        endif;
    }

    /* Formulario de registro de datos personales */
    public function personal_data_create($doc){
        $eps = Eps::pluck('name','id');
        $population_groups = PopulationGroup::pluck('name', 'id');
        $title = 'Registrar persona';
        $data = ['doc'=>$doc,'title'=>$title, 'eps'=>$eps, 'population_groups' => $population_groups];
        return view('sica::admin.people.personal_data.create', $data);
    }

    /* Registrar datos personales */
    public function personal_data_store(Request $request){
        $rules = [
            'document_number' => 'required|unique:people',
            'document_type' => 'required',
            'first_name' => 'required',
            'first_last_name' => 'required',
            'second_last_name' => 'required',
            'eps_id' => 'required',
            'population_group_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()):
            return redirect(route('sica.admin.people.personal_data.create', $request->input('document_number')))->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert', 'danger')->withInput();
        else:
            $p = new Person;
            $p->document_type = e($request->input('document_type'));
            $p->document_number = e($request->input('document_number'));
            $p->date_of_issue = $request->input('date_of_issue');
            $p->first_name = $request->input('first_name');
            $p->first_last_name = e($request->input('first_last_name'));
            $p->second_last_name = e($request->input('second_last_name'));
            $p->date_of_birth = e($request->input('date_of_birth'));
            $p->blood_type = e($request->input('blood_type'));
            $p->gender = e($request->input('gender'));
            $p->eps_id = e($request->input('eps_id'));
            $p->marital_status = e($request->input('marital_status'));
            $p->military_card = e($request->input('military_card'));
            $p->socioeconomical_status = e($request->input('socioeconomical_status'));
            $p->sisben_level = e($request->input('sisben_level'));
            $p->address = e($request->input('address'));
            $p->telephone1 = e($request->input('telephone1'));
            $p->telephone2 = e($request->input('telephone2'));
            $p->telephone3 = e($request->input('telephone3'));
            $p->personal_email = e($request->input('personal_email'));
            $p->misena_email = e($request->input('misena_email'));
            $p->sena_email = e($request->input('sena_email'));
            // $p->avatar = e($request->input('avatar'));
            $p->population_group_id = e($request->input('population_group_id'));
            if($p->save()){
                return redirect(route('sica.admin.people.personal_data.index'))->with('message', 'Persona registrada exitosamente.')->with('typealert', 'success');
            } else {
                return redirect(route('sica.admin.people.personal_data.index'))->with('message', 'Ocurrió un error en el registro de la persona.')->with('typealert', 'error');
            }
        endif;
    }

    /* Formulario de actualización de datos personales */
    public function personal_data_edit($id){
        $person = Person::findOrFail($id);
        $eps = Eps::pluck('name','id');
        $population_groups = PopulationGroup::pluck('name', 'id');
        $title = 'Actualizar persona';
        $data = ['person'=>$person,'title'=>$title, 'eps'=>$eps, 'population_groups' => $population_groups];
        return view('sica::admin.people.personal_data.edit', $data);
    }

    /* Actualizar datos personales */
    public function personal_data_update(Request $request, $id){
        $rules = [
            'document_number' => 'required|unique:people,document_number,'.$id,
            'document_type' => 'required',
            'first_name' => 'required',
            'first_last_name' => 'required',
            'eps_id' => 'required',
            'population_group_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()):
            return redirect(route('sica.admin.people.personal_data.edit', $id))->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert', 'danger')->withInput();
        else:
            $p = Person::findOrFail($id);
            $p->document_type = e($request->input('document_type'));
            $p->document_number = e($request->input('document_number'));
            $p->date_of_issue = $request->input('date_of_issue');
            $p->first_name = $request->input('first_name');
            $p->first_last_name = e($request->input('first_last_name'));
            $p->second_last_name = e($request->input('second_last_name'));
            $p->date_of_birth = e($request->input('date_of_birth'));
            $p->blood_type = e($request->input('blood_type'));
            $p->gender = e($request->input('gender'));
            $p->eps_id = e($request->input('eps_id'));
            $p->marital_status = e($request->input('marital_status'));
            $p->military_card = e($request->input('military_card'));
            $p->socioeconomical_status = e($request->input('socioeconomical_status'));
            $p->sisben_level = e($request->input('sisben_level'));
            $p->address = e($request->input('address'));
            $p->telephone1 = e($request->input('telephone1'));
            $p->telephone2 = e($request->input('telephone2'));
            $p->telephone3 = e($request->input('telephone3'));
            $p->personal_email = e($request->input('personal_email'));
            $p->misena_email = e($request->input('misena_email'));
            $p->sena_email = e($request->input('sena_email'));
            // $p->avatar = e($request->input('avatar'));
            $p->population_group_id = e($request->input('population_group_id'));
            if($p->save()){
                return redirect(route('sica.admin.people.personal_data.index'))->with('message', 'Datos personales actualizado exitosamente.')->with('typealert', 'success');
            }
        endif;
    }

}
