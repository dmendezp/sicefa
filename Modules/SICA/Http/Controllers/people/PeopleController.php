<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PensionEntity;
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
        $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
        $rules = [
            'search' => 'required'
        ];
        $messages = [
            'search.required' => 'El campo consulta es requerido.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect(route('sica.'.$role_name.'.people.personal_data.index'))->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert', 'danger')->withInput();
        else:
        $doc =$request->input('search');
        $person = Person::where('document_number',$doc)->with('users')->first();
        switch ($person) {
            case '':
                return redirect(route('sica.'.$role_name.'.people.personal_data.create', $doc));
                break;
            default:
            return redirect(route('sica.'.$role_name.'.people.personal_data.edit', $person));
                break;
        }
        endif;
    }

    /* Formulario de registro de datos personales */
    public function personal_data_create($doc){
        $eps = Eps::pluck('name','id');
        $population_groups = PopulationGroup::pluck('name', 'id');
        $pension_entities = PensionEntity::pluck('name', 'id');
        $title = 'Registrar persona';
        $data = ['doc'=>$doc,'title'=>$title, 'eps'=>$eps, 'population_groups' => $population_groups, 'pension_entities' => $pension_entities];
        return view('sica::admin.people.personal_data.create', $data);
    }

    /* Registrar datos personales */
    public function personal_data_store(Request $request){
        $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
        $rules = [
            'document_number' => 'required|unique:people',
            'document_type' => 'required',
            'first_name' => 'required',
            'first_last_name' => 'required',
            'eps_id' => 'required',
            'population_group_id' => 'required',
            'pension_entity_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()):
            return redirect(route('sica.'.$role_name.'.people.personal_data.create', $request->input('document_number')))->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert', 'danger')->withInput();
        else:
            if(Person::create($request->all())){
                return redirect(route('sica.'.$role_name.'.people.personal_data.index'))->with('message', 'Persona registrada exitosamente.')->with('typealert', 'success');
            } else {
                return redirect(route('sica.'.$role_name.'.people.personal_data.index'))->with('message', 'Ocurrió un error en el registro de la persona.')->with('typealert', 'error');
            }
        endif;
    }

    /* Formulario de actualización de datos personales */
    public function personal_data_edit($id){
        $person = Person::findOrFail($id);
        $eps = Eps::pluck('name','id');
        $population_groups = PopulationGroup::pluck('name', 'id');
        $pension_entities = PensionEntity::pluck('name', 'id');
        $title = 'Actualizar persona';
        $data = ['person'=>$person,'title'=>$title, 'eps'=>$eps, 'population_groups' => $population_groups, 'pension_entities' => $pension_entities];
        return view('sica::admin.people.personal_data.edit', $data);
    }

    /* Actualizar datos personales */
    public function personal_data_update(Request $request, Person $person){
        $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
        $rules = [
            'document_number' => 'required|unique:people,document_number,'.$person->id,
            'document_type' => 'required',
            'first_name' => 'required',
            'first_last_name' => 'required',
            'eps_id' => 'required',
            'population_group_id' => 'required',
            'pension_entity_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()):
            return redirect(route('sica.'.$role_name.'.people.personal_data.edit', $person))->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert', 'danger')->withInput();
        else:
            if($person->update($request->all())){
                return redirect(route('sica.'.$role_name.'.people.personal_data.index'))->with('message', 'Datos personales actualizado exitosamente.')->with('typealert', 'success');
            }
        endif;
    }

}
