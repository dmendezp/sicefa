<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Consultar aplicación SENAEMPRESA para registrar los roles
        $app = App::where('name', 'SENAEMPRESA')->first();

        // Registrar o actualizar rol de ADMINISTRADOR
        $rol_admin = Role::updateOrCreate(['slug' => 'senaempresa.admin'], [
            'name' => 'Administrador Senaempresa',
            'description' => 'Rol administrador de la aplicacion SENAEMPRESA',
            'description_english' => 'SENAEMPRESA Application Administrator',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);
        // Registrar o actualizar rol de PASANTE
        $rol_pasante = Role::updateOrCreate(['slug' => 'senaempresa.passant'], [
            'name' => 'Pasante Senaempresa',
            'description' => 'Rol pasante de la aplicacion SENAEMPRESA',
            'description_english' => 'SENAEMPRESA application trainee role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);
        // Registrar o actualizar rol de USUARIO
        $rol_usuario = Role::updateOrCreate(['slug' => 'senaempresa.usuario'], [
            'name' => 'Usuario Senaempresa',
            'description' => 'Rol usuario de la aplicacion SENAEMPRESA',
            'description_english' => 'SENAEMPRESA Application User Role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        // Consulta de usuarios
        $user_jsm6580 = User::where('nickname', 'JSM6580')->first();
        $user_jmm6580 = User::where('nickname', 'JMM6580')->first();
        $user_dap6580 = User::where('nickname', 'DAP6580')->first();

        // Asignacion de roles a usuarios
        $user_jsm6580->roles()->syncWithoutDetaching([$rol_admin->id]);
        $user_jmm6580->roles()->syncWithoutDetaching([$rol_admin->id]);
        $user_dap6580->roles()->syncWithoutDetaching([$rol_admin->id]);
    }
}
