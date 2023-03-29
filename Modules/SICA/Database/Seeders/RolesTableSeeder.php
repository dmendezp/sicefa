<?php

namespace Modules\SICA\Database\Seeders;

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

        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name','SICA')->first();


        // Registrar o actualizar rol de SUPERADMINISTRADOR
        $user_super_admin = Role::updateOrCreate(['slug' => 'superadmin'], [
            'name' => 'Super Administrador',
            'description' => 'Rol Superadministrador de SICEFA',
            'description_english' => 'Role Super administrator of SICEFA',
            'full_access' => 'yes',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de ADMINISTRADOR
        $rol_admin = Role::updateOrCreate(['slug' => 'sica.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol Administrador de la aplicacion SICA',
            'description_english' => 'SICA Application Administrator Role',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de COORDINADOR
        $rol_coordinator = Role::updateOrCreate(['slug' => 'sica.coordinator'], [
            'name' => 'Coordinador Académico',
            'description' => 'Rol Coordinador Académico de la aplicación SICA',
            'description_english' => 'Role Academic Coordinator of the SICA application',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de REGISTRO ASISTENCIA
        $rol_attendance = Role::updateOrCreate(['slug' => 'sica.attendance'], [
            'name' => 'Registro Asistencia',
            'description' => 'Rol para el registro de asistencias de la aplicación SICA',
            'description_english' => 'Role for the attendance record of the SICA application',
            'app_id' => $app->id
        ]);


        // Consulta de usuarios
        $user_super_admin = User::where('nickname','damendez')->first(); // Usuario Administrador con full-access (Diego Andrés Mendéz Pastrana)
        $user_admin = User::where('nickname','JDGM0331')->first(); // Usuario Administrador (Jesús David Guevara Munar)
        $user_coordinator = User::where('nickname','gmsanchez')->first(); // Usuario Administrador (Gloria Maritza Sanchez Alarcón)
        $user_attendance = User::where('nickname','DiegoT')->first(); // Usuario Administrador (Diego Andrés Tovar Rodriguez)

        // Asignación de ROLES para los USUARIOS de la aplicación SICA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_super_admin->roles()->syncWithoutDetaching([$user_super_admin->id]);
        $user_admin->roles()->syncWithoutDetaching([$rol_admin->id]);
        $user_coordinator->roles()->syncWithoutDetaching([$rol_coordinator->id]);
        $user_attendance->roles()->syncWithoutDetaching([$rol_attendance->id]);

    }
}
