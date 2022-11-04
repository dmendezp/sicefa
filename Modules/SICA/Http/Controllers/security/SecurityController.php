<?php

namespace Modules\SICA\Http\Controllers\security;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Responsibility;
use Modules\SICA\Entities\Permission;
use App\Models\User;

class SecurityController extends Controller
{

    public function apps(){
        $apps = App::get();
        $data = ['title'=>trans('sica::menu.Apps'),'apps'=>$apps];
        return view('sica::admin.security.apps.home',$data);
    }

    public function roles()
    {
        $roles = Role::with('app')->get();
        $data = ['title'=>trans('sica::menu.Roles'),'roles'=>$roles];
        return view('sica::admin.security.roles.home',$data);
    }

    public function permissions()
    {
        $permissions = Permission::get();
        $data = ['title'=>trans('sica::menu.Permissions'),'permissions'=>$permissions];
        return view('sica::admin.security.permissions.home',$data);
    }

    public function responsibilities()
    {
        $responsibilities = Responsibility::get();
        $data = ['title'=>trans('sica::menu.Roles'),'responsibilities'=>$responsibilities];
        return view('sica::admin.security.responsibilities.home',$data);
    }

    public function users()
    {
        $users = Responsibility::with('person')->get();
        $data = ['title'=>trans('sica::menu.Users'),'users'=>$users];
        return view('sica::admin.security.users.home',$data);
    }



}
