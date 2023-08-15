<?php

namespace Modules\SICA\Http\Controllers\security;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;
use App\Models\User;
use Modules\SICA\Entities\App;
use Validator;

class UserController extends Controller
{


    /* Listado  de usuarios disponibles */
    public function index(){
        $users = User::orderBy('updated_at','DESC')->get();
        $data = ['title'=>trans('sica::menu.Users'), 'users'=>$users];
        return view('sica::admin.security.users.index', $data);
    }

    /* Formulario de registro de usuario */
    public function create(){
        $data = ['title'=>'Usuarios - Registro'];
        return view('sica::admin.security.users.create', $data);
    }

    /* Consultar persona por número de identificación */
    public function search_person(){
        $data = json_decode($_POST['data']);
        $person = Person::where('document_number', $data->document_number)->first();
        if($person):
            $user = User::where('person_id',$person->id)->first();
            $apps = App::orderBy('name','ASC')->get();
            $data=['person'=>$person, 'apps'=>$apps, 'user'=>$user];
            return view('sica::admin.security.users.search_person',$data);
        else:
            return '<div class="row d-flex justify-content-center"><span class="h5 text-danger">La persona consultada no se encuentra registrada.</span><div>';
        endif;
    }

    /* Registrar usuario */
    public function store(Request $request){
        $rules = [
            'person_id' => 'required|unique:users',
            'nickname' => 'required|unique:users',
            'personal_email' => 'required|email|unique:users,email',
            'roles_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Ocurrió un error con el formulario.')->with('typealert', 'danger')->withInput($request->except('password'))->with('scriptJS', 'ajaxSearchPersonUser()');
        } else {
            $u = new User;
            $u->nickname = e($request->input('nickname'));
            $u->person_id = e($request->input('person_id'));
            $u->email = e($request->input('personal_email'));
            if($u->save()){
                $u->roles()->syncWithoutDetaching($request->input('roles_id')); // Sincronizar los nuevos roles al usuario
                $message = ['message'=>'Se registró exitosamente el usuario.', 'typealert'=>'success'];
            } else {
                $message = ['message'=>'No se pudo realizar el registro del usuario.', 'typealert'=>'danger'];
            }
            return redirect(route('sica.admin.security.users.index'))->with($message);

        }
    }

    /* Formulario de actualización de usuario */
    public function edit(User $user){
        $apps = App::orderBy('name','ASC')->get();
        $data = ['title'=>'Usuarios - Actualizar', 'user'=>$user, 'apps'=>$apps];
        return view('sica::admin.security.users.edit',$data);
    }

    /* Actualizar usuario */
    public function update(Request $request, User $user){
        // Vefirificar si hay algun cambio en los roles del usuario
        if ($user->roles->pluck('id')->toArray() != $request->input('roles_id')) {
            $rules = [
                'roles_id' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
            }
            try {
                // Eliminar roles vinculados al usuario
                $user->roles()->detach();
                // Sincronizar los nuevos roles al usuario
                $user->roles()->syncWithoutDetaching($request->input('roles_id'));
                $user->touch(); // Actualizar el dato updated_at del usuario
                $message = ['message' => 'Se actualizó exitosamente el usuario.', 'typealert' => 'success'];
            } catch (\Exception $e) {
                $message = ['message' => 'No se pudo realizar la actualización del usuario.', 'typealert' => 'danger'];
            }
        } else {
            $message = ['message' => 'No se realizó ninguna actualización por que no hay cambios en los datos del usuario.', 'typealert' => 'info'];
        }
        return redirect(route('sica.admin.security.users.index'))->with($message);
    }

    /* Eliminar usuario */
    public function destroy(User $user){
        if ($user->delete()){
            $message = ['message'=>'Se eliminó exitosamente el usuario.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo eliminar el usuario.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.security.users.index'))->with($message);
    }

}
