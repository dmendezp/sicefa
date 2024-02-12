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
            'description_english' => 'SENAEMPRESA application Administrator',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);
        // Registrar o actualizar rol de LIDER DE TALENTO HUMANO
        $rol_human_talent_leader = Role::updateOrCreate(['slug' => 'senaempresa.human_talent_leader'], [
            'name' => 'Lider Talento Humano',
            'description' => 'Rol lider talento humano de la aplicacion SENAEMPRESA',
            'description_english' => 'SENAEMPRESA application human talent leader role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);
        // Registrar o actualizar rol de PSICOLOGO
        $rol_psicologo = Role::updateOrCreate(['slug' => 'senaempresa.psychologo'], [
            'name' => 'Psicologo Senaempresa',
            'description' => 'Rol psicologo de la aplicacion SENAEMPRESA',
            'description_english' => 'Psychologist role of the SENAEMPRESA application',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);
        // Registrar o actualizar rol de APRENDIZ
        $rol_aprendiz = Role::updateOrCreate(['slug' => 'senaempresa.apprentice'], [
            'name' => 'Aprendiz Senaempresa',
            'description' => 'Rol aprendiz de la aplicacion SENAEMPRESA',
            'description_english' => 'SENAEMPRESA application apprentice role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        // Consulta de usuarios
        $useradmin = User::where('nickname', 'LFHerre')->first();
       
        // Asignacion de roles a usuarios
        $useradmin->roles()->syncWithoutDetaching([$rol_admin->id]);
       
    }
}
