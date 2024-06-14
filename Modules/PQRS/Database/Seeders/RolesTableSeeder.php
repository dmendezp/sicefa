<?php

namespace Modules\PQRS\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        // Consultar aplicación AGROINDUSTRIA para registrar los roles
        $app = App::where('name','PQRS')->first();

        // Registrar o actualizar rol de ADMINISTRADOR
        $rol_tracking = Role::updateOrCreate(['slug' => 'pqrs.tracking'], [
            'name' => 'Monitor',
            'description' => 'Rol monitor de PQRS',
            'description_english' => 'Role monitor of PQRS',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de INSTRUCTOR de carnicos, panaderia, pasteleria, frutas
        $rol_official = Role::updateOrCreate(['slug' => 'pqrs.official'], [
            'name' => 'Funcionario',
            'description' => 'Rol funcionario',
            'description_english' => 'Official role',
            'app_id' => $app->id
        ]);

        // Consulta de usuarios
        $user_tracking = User::where('nickname','Julian')->first(); // Usuario Administrador (Julian Javier Ramirez Diaz)
        $user_official = User::where('nickname','Bonilla')->first(); // Usuario Administrador (Juan Diego Bonilla Aroca)

        // Asignación de ROLES para los USUARIOS de la aplicación PQRS (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_tracking->roles()->syncWithoutDetaching([$rol_tracking->id]);
        $user_official->roles()->syncWithoutDetaching([$rol_official->id]);
    }
}
