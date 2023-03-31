<?php

namespace Modules\SICA\Http\Controllers\security;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;
use App\Models\User;

use Validator, Str, Hash;

class UserController extends Controller
{


    public function users()
    {
        $users = User::with('person')->get();
        $data = ['title'=>trans('sica::menu.Users'),'users'=>$users];
        return view('sica::admin.security.users.home',$data);
    }
    
    public function getUserAdd()
    {
        $users = User::with('person')->get();
        $data = ['title'=>trans('sica::menu.Users'),'users'=>$users];
        return view('sica::admin.security.users.add',$data);
    }

    public function postUserSearch(){
        $datas = json_decode($_POST['data']);
        //$old = $datas->old;
        $doc = $datas->document_number;
        //return $datas->personal_email;
        if($doc):
            $person = Person::where('document_number',$doc)->first();
            if($person):

                if(isset($datas->nickname)):
                    $person->nickname = $datas->nickname;
                    $person->personal_email = $datas->personal_email;
                endif;
                $data=['person'=>$person];
                return view('sica::admin.security.users.search',$data);
            else:
                return '<div class="row d-flex justify-content-center"><span class="h5 text-danger">No se encontró registros</span><div>';
            endif;
        endif;
    }

    public function postUserAdd(Request $request)
    {
        $rules = [
            'document_number' => 'required',
            'id' => 'required',
            'nickname' => 'required',
            'personal_email' => 'required',
            'password' => 'required|min:8',
            'password_confirm' => 'required|min:8|same:password'
        ];
        $messages = [
            'document_number.required' => 'El numero de documento es requerido',
            'id.required' => 'NO ha seleccionado una persona exixtente en la base de datos',
            'nickname.required' => 'El nombre de usuario es requerido',
            'personal_email.required' => 'El correo electrónico es requerido',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password_confirm.required' => 'La confirmación de la contraseña es requerida',
            'password_confirm.min' => 'La confirmación de la contraseña debe tener al menos 8 caracteres',
            'password_confirm.same' => 'Las contraseñas no coinciden'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert', 'danger')->withInput($request->except('password'))->with('scriptJS', 'ajaxSearchPersonUser()');
        else:
            //return "Guarda";
            $u = new User;
            $u->nickname = e($request->input('nickname'));
            $u->person_id = e($request->input('id'));
            $u->email = e($request->input('personal_email'));
            $u->password = Hash::make($request->input('password'));

            if($u->save()){
                return redirect(route('sica.admin.security.users'))->with('message', 'Creado con éxito')->with('typealert', 'success');
            }
        
    endif;       
    }
}
