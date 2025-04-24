<?php

namespace Modules\GVFF\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Role;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Listas de permisos
        $permissions_admin = [];
        $permissions_user = [];

        // Consultar aplicación GVFF
        $app = App::where('name', 'GVFF')->firstOrFail();

        // Permiso para el rol de administrador
        $permission = Permission::updateOrCreate(['slug' => 'gvff.index'], [
            'name' => 'Acceso al Panel de Administrador',
            'description' => 'Permite acceder al panel de bienvenida de administrador',
            'description_english' => 'Allows access to the administrator welcome panel',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        // Permiso para el rol de usuario
        $permission = Permission::updateOrCreate(['slug' => 'gvff.user.users'], [
            'name' => 'Acceso al Panel de Usuarios',
            'description' => 'Permite acceder al panel de usuarios',
            'description_english' => 'Allows access to the users panel',
            'app_id' => $app->id
        ]);
        $permissions_user[] = $permission->id;

        // Consultar roles
        $rol_admin = Role::where('slug', 'gvff.admin')->first();
        $rol_user = Role::where('slug', 'gvff.user')->first();

        // Asignar permisos a los roles
        if ($rol_admin) {
            $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        }
        if ($rol_user) {
            $rol_user->permissions()->syncWithoutDetaching($permissions_user);
        }
    }
}