<?php

namespace Modules\GVFF\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Permission;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Consultar la aplicación GVFF
        $app = App::where('name', 'GVFF')->firstOrFail();

        // Crear o actualizar el rol de Administrador
        $rol_admin = Role::updateOrCreate(['slug' => 'gvff.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación GVFF',
            'description_english' => 'GVFF application administrator role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        // Asignar el rol de Administrador al usuario Dquiza
        $user_admin = User::where('nickname', 'Dquiza')->firstOrFail();
        $user_admin->roles()->syncWithoutDetaching([$rol_admin->id]);

        // Crear o actualizar el rol de Usuario
        $rol_user = Role::updateOrCreate(['slug' => 'gvff.user'], [
            'name' => 'Usuario',
            'description' => 'Rol usuario de la aplicación GVFF',
            'description_english' => 'GVFF application user role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        // Crear o actualizar el rol de Usuario
        $rol_user = Role::updateOrCreate(['slug' => 'gvff.user'], [
            'name' => 'Usuario',
            'description' => 'Rol usuario de la aplicación GVFF',
            'description_english' => 'GVFF application user role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        // Asignar el rol de Usuario al usuario Mgomez
        $user_mgomez = User::where('nickname', 'Mpenagos')->firstOrFail();
        $user_mgomez->roles()->syncWithoutDetaching([$rol_user->id]);

        // Asignar permisos al rol de Usuario
        $permissions_user = [];
        $permission = Permission::updateOrCreate(['slug' => 'gvff.user'], [
            'name' => 'Acceso al Rol de Usuario',
            'description' => 'Acceso a funcionalidades básicas de usuario',
            'description_english' => 'Access to basic user functionalities',
            'app_id' => $app->id
        ]);
        $permissions_user[] = $permission->id;

        $rol_user->permissions()->syncWithoutDetaching($permissions_user);
    }
}