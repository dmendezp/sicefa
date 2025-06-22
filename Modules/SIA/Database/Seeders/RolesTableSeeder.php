<?php

namespace Modules\SIA\Database\Seeders;

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
        // Consultar aplicación SIA para registrar los roles
        $app = App::where('name', 'SIA')->firstOrFail();

        // Registrar o actualizar rol de INSTRUCTOR INVESTIGADOR
        $rol_instructor = Role::updateOrCreate(['slug' => 'sia.inst-inv'], [
            'name' => 'Instructor Investigador',
            'description' => 'Rol instructor investigador de la aplicación SIA',
            'description_english' => 'SIA application instructor investigator role',
            'full_access' => 'no',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de APRENDIZ INVESTIGADOR
        $rol_apprentice = Role::updateOrCreate(['slug' => 'sia.ap-inv'], [
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
            'full_access' => 'no',
            'app_id' => $app->id
        ]);

        // Consulta de usuarios
        $user_instructor = User::where('nickname', 'LFHerre')->firstOrFail(); // Usuario Instructor Investigador (Lola Fernanda Herrera Hernandez)
        $user_apprentice = User::where('nickname', 'Nicolas Soriano')->firstOrFail(); // Usuario Aprendiz Investigador (Nicolas Estiven Soriano Polania) 
        $user_admin = User::where('nickname', 'ydmoreno')->firstOrFail(); // Usuario administrador (Yoly Dayana Moreno Ortega)

        // Asignación de ROLES para los USUARIOS de la aplicación SIA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_instructor->roles()->syncWithoutDetaching([$rol_instructor->id]);
        $user_apprentice->roles()->syncWithoutDetaching([$rol_apprentice->id]);
        $user_admin->roles()->syncWithoutDetaching([$rol_admin->id]); 
    }
}