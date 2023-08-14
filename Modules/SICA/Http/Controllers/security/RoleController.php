<?php

namespace Modules\SICA\Http\Controllers\security;

use Illuminate\Routing\Controller;

use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Responsibility;

class RoleController extends Controller
{

    /* Lista de roles disponibles */
    public function roles_index(){
        $roles = Role::join('apps', 'apps.id', '=', 'roles.app_id') // Unir las tablas roles y apps
                        ->select('roles.*') // Seleccionar todos los campos de roles
                        ->orderBy('apps.name', 'ASC') // Ordenar por el campo 'name' de la relación 'app'
                        ->orderBy('roles.name', 'ASC') // Luego ordenar por el campo 'name' de roles
                        ->get();
        $data = ['title'=>trans('sica::menu.Roles'), 'roles'=>$roles];
        return view('sica::admin.security.roles.index', $data);
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
}
