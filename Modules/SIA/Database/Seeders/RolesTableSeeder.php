<?php

namespace Modules\SIA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SIA\Entities\App;
use Modules\SIA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Consultar aplicación SIA para registrar los roles
        $app = App::where('name', 'SIA')->firstOrFail();

        // Consultar rol de superadministrador
        $rol_superadmin = Role::where('slug', 'superadmin')->firstOrFail();

        // Registrar o actualizar rol de INSTRUCTOR INVESTIGADOR
        $rol_instructor = Role::updateOrCreate(['slug' => 'sia.inst.inv'], [
            'name' => 'Instructor Investigador',
            'description' => 'Rol instructor investigador de la aplicación SIA',
            'description_english' => 'SIA application instructor investigator role',
            'full_access' => 'no',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de APRENDIZ INVESTIGADOR
        $rol_apprentice = Role::updateOrCreate(['slug' => 'sia.ap.inv'], [
            'name' => 'Aprendiz Investigador',
            'description' => 'Rol aprendiz investigador de la aplicación SIA',
            'description_english' => 'SIA application apprentice investigator role',
            'full_access' => 'no',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de ADMINISTRADOR
        $rol_admin = Role::updateOrCreate(['slug' => 'sia.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación SIA',
            'description_english' => 'SIA application administrator role',
            'full_access' => 'yes',
            'app_id' => $app->id
        ]);

        // Consulta de usuarios
        $user_instructor = User::where('nickname', 'CAPerez')->firstOrFail(); // Usuario Instructor Investigador (Carlos Andrés Pérez)
        $user_apprentice = User::where('nickname', 'NESoriano')->firstOrFail(); // Usuario Aprendiz Investigador (Nicolas Estiven Soriano Polania)
        $user_superadmin = User::where('nickname', 'JDGM0331')->firstOrFail(); // Usuario Super Administrador (Jesús David Guevara Munar)
        $user_admin = User::updateOrCreate(['nickname' => 'NewAdmin'], [ // Nuevo usuario administrador
            'email' => 'newadmin@example.com',
            'password' => bcrypt('password123') // Cambia la contraseña según sea necesario
        ]);

        // Asignación de ROLES para los USUARIOS de la aplicación SIA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_instructor->roles()->syncWithoutDetaching([$rol_instructor->id]);
        $user_apprentice->roles()->syncWithoutDetaching([$rol_apprentice->id]);
        $user_superadmin->roles()->syncWithoutDetaching([$rol_superadmin->id]);
        $user_admin->roles()->syncWithoutDetaching([$rol_admin->id]); // Asignar rol de administrador al nuevo usuario
    }
}