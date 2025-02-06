<?php

namespace Modules\SICA\Http\Controllers\security;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
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

    /* Listado de asociaciones de roles y unidades productivas */
    public function pu_roles_index(){
        $data = ['title'=>'Roles y unidades productivas'];
        return view('sica::admin.security.pu_roles.index', $data);
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

    /* Listado de responsabilidades disponibles */
    public function roles_permission_create($role_id){
        $role = Role::where('id', $role_id)->first();
        $app_id = $role->app->id;
        $permisisons = Permission::whereHas('app', function ($query) use ($app_id) {
            $query->where('id', $app_id);
        })->get();
        $permisisonsasociate = Permission::whereHas('roles', function ($query) use ($role_id) {
            $query->where('roles.id', $role_id);
        })->pluck('permissions.id')->toArray();
        $data = ['title'=>'Asociación de permisos',
        'permissions' => $permisisons,
        'permisisonsasociate'=> $permisisonsasociate,
        'role'=> $role];
        return view('sica::admin.security.pu_roles.create', $data);
    }

    //Asociar permisos a rol

public function roles_permission_store(Request $request)
{
    try {
        $permissionId = $request->input('permissionId');
        $role_id = $request->input('role_id');
        $isChecked = $request->input('checked') === 'true';

        $role = Role::findOrFail($role_id);

        // Verificar si el permiso existe
        $permissionExists = Permission::where('id', $permissionId)->exists();

        if (!$permissionExists) {
            return response()->json(['error' => 'El permiso especificado no existe.'], 404);
        }

        $permission = Permission::findOrFail($permissionId);

        if ($isChecked) {
            // Si el checkbox está marcado, asociar el permiso al rol
            $role->permissions()->attach($permissionId);
            $message = trans('senaempresa::menu.Association created successfully.');
        } else {
            // Si el checkbox está desmarcado, desasociar el permiso del rol
            $role->permissions()->detach($permissionId);
            $message = trans('senaempresa::menu.Association deleted successfully.');
        }

        return response()->json(['success' => $message], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred. Details: ' . $e->getMessage()], 500);
    }
}

}
