<?php

namespace Modules\SIGAC\Database\Seeders;

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
        // Consultar aplicación SIGAC para registrar los roles
        $app = App::where('name', 'SIGAC')->firstOrFail();

        // Registrar o actualizar rol de SUPERADMINISTRADOR
        $role_super_admin = Role::firstOrCreate(['slug' => 'superadmin'], [
            'name' => 'Super Administrador',
            'description' => 'Rol Superadministrador de SICEFA',
            'description_english' => 'Role Super administrator of SICEFA',
            'full_access' => 'Si',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de Coordinador Académico
        $rol_academic_coordinator = Role::firstOrCreate(['slug' => 'sigac.academic_coordinator'], [
            'name' => 'Coordinador Académico',
            'description' => 'Rol Coordinador Académico de la aplicación SIGAC',
            'description_english' => 'Role Academic Coordinator of the SIGAC application',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de Instructor
        $rol_instructor = Role::firstOrCreate(['slug' => 'sigac.instructor'], [
            'name' => 'Instructor',
            'description' => 'Rol Instructor de la aplicación SIGAC',
            'description_english' => 'Role Instructor of the SIGAC application',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de Bienestar
        $rol_wellness = Role::firstOrCreate(['slug' => 'sigac.wellbeing'], [
            'name' => 'Bienestar',
            'description' => 'Rol Bienestar de la aplicación SIGAC',
            'description_english' => 'Role Wellness of the SIGAC application',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de Aprendiz
        $rol_apprentice = Role::firstOrCreate(['slug' => 'sigac.apprentice'], [
            'name' => 'Aprendiz',
            'description' => 'Rol Aprendiz de la aplicación SIGAC',
            'description_english' => 'Role Apprentice of the SIGAC application',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de Aprendiz
        $rol_support = Role::firstOrCreate(['slug' => 'sigac.support'], [
            'name' => 'Apoyo',
            'description' => 'Rol Apoyo de la aplicación SIGAC',
            'description_english' => 'Role support of the SIGAC application',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol del personal de seguridad
        $rol_security = Role::firstOrCreate(['slug' => 'sigac.securitystaff'], [
            'name' => 'Personal Seguridad',
            'description' => 'Rol Personal Seguridad de la aplicación SIGAC',
            'description_english' => 'Role security staff of the SIGAC application',
            'app_id' => $app->id
        ]);


      /*   // Consulta de usuarios
        $user_academic_coordinator = User::where('nickname', 'mgonzalezg')->first(); // Usuario Coordinador Académico (María Antonia Gonzáles Gonzáles)
        $user_instructor = User::where('nickname', 'rudelgadoc')->first(); // Usuario Instructor (Diego Andrés Mendez Pastrana)
        $user_wellness = User::where('nickname', 'epascuasp')->first(); // Usuario Bienestar (Esperanza Pascuas Perdomo)
        $user_apprentice = User::where('nickname', 'JDGM0331')->first(); // Usuario Aprendiz (Jesús David Guevara Munar)
        $user_superadmin = User::where('nickname', 'Resmerveilons')->first(); // Usuario Super Administrador (Manuel Steven Ossa Lievano)

        // Asignación de ROLES para los USUARIOS de la aplicación SIGAC (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_academic_coordinator->roles()->syncWithoutDetaching([$rol_academic_coordinator->id]);
        $user_instructor->roles()->syncWithoutDetaching([$rol_instructor->id]);
        $user_wellness->roles()->syncWithoutDetaching([$rol_wellness->id]);
        $user_apprentice->roles()->syncWithoutDetaching([$rol_apprentice->id]);
        $user_superadmin->roles()->syncWithoutDetaching([$role_super_admin->id]); */
    }
}
