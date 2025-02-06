<?php

namespace Modules\SICA\Http\Controllers\security;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\SICA\Entities\Person;
use App\Models\User;
use App\Rules\AtLeastOneRoleSelected;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Employee;
use Modules\SICA\Entities\EmployeeType;
use Modules\SICA\Entities\Contractor;
use Modules\SICA\Entities\Apprentice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


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
            'roles_id' => ['required', new AtLeastOneRoleSelected()]
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Ocurrió un error con el formulario.')->with('typealert', 'danger')->withInput($request->except('password'))->with('scriptJS', 'ajaxSearchPersonUser()');
        } else {
            $user = new User;
            $user->nickname = e($request->input('nickname'));
            $user->person_id = e($request->input('person_id'));
            $user->email = e($request->input('personal_email'));
            try {
                DB::beginTransaction(); // Iniciar transacción
                $user = new User;
                $user->nickname = e($request->input('nickname'));
                $user->person_id = e($request->input('person_id'));
                $user->email = e($request->input('personal_email'));
                $user->save(); // Registrar usuario
                // Obtener los id de roles a partir de los valores de roles_id
                $roles_ids = array_values($request->input('roles_id'));
                $roles_id_int = array_values(array_map('intval', array_filter($roles_ids, function($value) {
                    return $value !== null;
                })));
                $user->roles()->syncWithoutDetaching($roles_id_int); // Sincronizar los nuevos roles al usuario
                DB::commit(); // Confirmar la transacción
                $message = ['message'=>'Se registró exitosamente el usuario.', 'typealert'=>'success'];
            } catch (\Exception $e) {
                DB::rollBack(); // Revertir cambios realizados en la transacción
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
                'roles_id' => ['required', new AtLeastOneRoleSelected()]
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
            }
            try {
                DB::beginTransaction(); // Iniciar transacción
                $user->roles()->detach(); // Eliminar roles vinculados al usuario
                // Obtener los id de roles a partir de los valores de roles_id
                $roles_ids = array_values($request->input('roles_id'));
                $roles_id_int = array_values(array_map('intval', array_filter($roles_ids, function($value) {
                    return $value !== null;
                })));
                $user->roles()->syncWithoutDetaching($roles_id_int); // Sincronizar los nuevos roles al usuario
                $user->touch(); // Actualizar el dato updated_at del usuario
                DB::commit(); // Confirmar la transacción
                $message = ['message' => 'Se actualizó exitosamente el usuario.', 'typealert' => 'success'];
            } catch (\Exception $e) {
                DB::rollBack(); // Revertir cambios realizados en la transacción
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

    public function change(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user_id = $user->person->id;
            
            // Verificar si hay una contraseña guardada en la sesión para este usuario
            if (Session::has('passwords.' . $user_id)) {
                $session_password = Session::get('passwords.' . $user_id);

                $first_change = 1;
                return view('auth.passwords.change')->with(['firstchange' => $first_change]);
            }
        }

        return view('auth.passwords.change');
    }
 
    public function changesave(Request $request)
    {
        $rules = [
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $auth = Auth::user();
 

        if (!Hash::check($request->get('current_password'), $auth->password)) 
        {
            return back()->with('current_password', "La contraseña actual es invalida");
        }
 

        if (strcmp($request->get('current_password'), $request->new_password) == 0) 
        {
            return redirect()->back()->with("new_password", "La nueva contraseña no puede ser la misma que su contraseña actual.");
        }
 
        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        if ($nickname = $request->input('nickname')) {
            $user->nickname =  $nickname;
        }
        
        $user->save();

        // Eliminar la contraseña de la sesión
        Session::forget('passwords.' . $user->person->id);

        return back()->with('success', "Contraseña cambiada exitosamente");
    }

    public function user_register()
    {
        return view('auth.passwords.request_user');
    }

    public function user_search_person(Request $request)
    {
        $document_number = $request->input('document_number');
        $employee_type = EmployeeType::where('name','=','Instructor')->pluck('id');
        $person = Person::where('document_number',$document_number)->first();

        if ($person) {
            $user = User::where('person_id', $person->id)->first();

            if ($user) {
                return response()->json(['error' => 'Esta persona ya cuenta con un usuario']);
            }
            $employee = Employee::where('person_id',$person->id)->where('employee_type_id',$employee_type)->first();
            $contractor = Contractor::where('person_id',$person->id)->where('employee_type_id',$employee_type)->first();
            $apprentice = Apprentice::where('person_id',$person->id)->first();
            if ($employee || $contractor) {
                $rol = 'Instructor';
            } elseif ($apprentice) {
                $rol = 'Aprendiz';
            } else {
                $rol = 'Ninguno';
            }

            return response()->json(['person' => $person,'rol' => $rol], 200);
        } else {
            return response()->json(['error' => 'Persona no encontrada']);
        }
    }

    public function user_register_store(Request $request){
        $document_number = $request->input('document_number');
        $role = $request->input('role');
        $person = Person::where('document_number', $document_number)->first();

        // Verificar si se encontró una persona con el número de documento proporcionado
        if ($person) {
            // Crear un nuevo usuario con la información de esa persona
            $user = User::create([
                'nickname' => $person->first_name,
                'person_id' => $person->id,
                'email' => $person->misena_email,
            ]);

            if ($role === 'Instructor') {
                
                $rolesinstructor = Role::where('name','LIKE','%instructor%')->get();
                
                $user->roles()->sync($rolesinstructor);

            }

            if ($role === 'Aprendiz') {
            
                $roles = Role::where('slug','LIKE','%.apprentice%')->get();

                $user->roles()->sync($roles);

            }

            // Obtener el correo electrónico y la contraseña desencriptada del usuario recién creado
            $email = $person->misena_email;
            $first_name = Str::ascii($user->person->first_name); // Eliminar caracteres especiales del nombre
            $first_last_name = Str::ascii($user->person->first_last_name); // Eliminar caracteres especiales del primer apellido
            $password =
                ucfirst( // Convertir el primer caracter en mayúscula
                    strtolower( // Convertir todo en minúsculas
                        substr($first_name, 0, 2) // Extraer los dos primeros caracteres del nombre
                        .substr($first_last_name, 0, 2) // Extraer los dos primeros caracteres del primer apellido
                        .substr($user->person->document_number, -4) // Extraer los cuatro últimos caracteres del número de documento
                    )
                );


            // Enviar un correo electrónico con esta información
            $asunto = "Solicitud de Usuario";
            Mail::send('auth.passwords.content_email', compact('asunto', 'email', 'password'), function ($msg) use ($asunto, $email) {
                $msg->from($email);
                $msg->subject($asunto);
                $msg->to($email);
            });

            return redirect(route('cefa.home'));
        } else {
            // No se encontró ninguna persona con el número de documento proporcionado
            // Redireccionar o mostrar un mensaje de error
        }
    }



    /* Registrar usuario google */
    public function storer_usergoogle(Request $request){ 
        $rules = [
            'nickname' => 'required|unique:users',
            'document_number' => 'required',
            'personal_email' => 'required|email|unique:users,email',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Ocurrió un error con el formulario.')->with('typealert', 'danger')->withInput($request->except('password'))->with('scriptJS', 'ajaxSearchPersonUser()');
        } else {
            $app = App::where('name','SENAEMPRESA')->pluck('id');
            $person_id = Person::where('document_number',$request->input('document_number'))->first();
            
            try {
                DB::beginTransaction(); // Iniciar transacción
                $user = new User;
                $user->nickname = e($request->input('nickname'));
                $user->person_id = $person_id->id;
                $user->email = e($request->input('personal_email'));
                $user->save(); // Registrar usuario
                $role = Role::where('name','Aprendiz Senaempresa')->where('app_id', $app)->first();
                $user->roles()->syncWithoutDetaching($role); // Sincronizar los nuevos roles al usuario
                Auth::login($user);
                DB::commit(); // Confirmar la transacción
                $message = ['message'=>'Se registró exitosamente el usuario.', 'typealert'=>'success'];
            } catch (\Exception $e) {
                DB::rollBack(); // Revertir cambios realizados en la transacción
                dd($e);
                $message = ['message'=>'No se pudo realizar el registro del usuario.', 'typealert'=>'danger'];
            }
            return redirect(route('cefa.home'))->with($message);
        }
    }

}
