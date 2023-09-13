<?php

namespace Modules\SICA\Http\Controllers\security;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Permission;

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

    /* Lista de la asociación de roles y permisos */
    public function roles_permission_role(){
        $apps = App::orderBy('name','ASC')->get();
        $data = ['title'=>'Roles y permisos', 'apps'=>$apps];
        return view('sica::admin.security.permission_role.index', $data);
    }

    /* Lista de permisos disponibles */
    public function permissions_index(){
        $permissions = Permission::join('apps', 'apps.id', '=', 'permissions.app_id') // Unir las tablas roles y apps
                        ->select('permissions.*') // Seleccionar todos los campos de roles
                        ->orderBy('apps.name', 'ASC') // Ordenar por el campo 'name' de la relación 'app'
                        ->orderBy('permissions.slug', 'ASC') // Luego ordenar por el campo 'name' de roles
                        ->get();
        $data = ['title'=>trans('sica::menu.Permissions'), 'permissions'=>$permissions];
        return view('sica::admin.security.permissions.index', $data);
    }

    /* Listado de responsabilidades disponibles */
    public function responsibilities_index(){
        $data = ['title'=>'Responsabilidades'];
        return view('sica::admin.security.responsibilities.index', $data);
    }

}
