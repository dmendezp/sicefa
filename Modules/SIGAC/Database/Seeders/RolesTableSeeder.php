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
        $app = App::where('name','SIGAC')->first();


        // Registrar o actualizar rol de Coordinador Académico
        $rol_academic_coordinator = Role::firstOrCreate(['slug' => 'sigac.academic_coordinator'], [
            'name' => 'Coordinador Academico',
            'description' => 'Rol Coordinador Académio de la aplicación SIGAC',
            'description_english' => 'Role Academic Coordinator of the SIGAC application',
            'app_id' => $app->id
        ]);


        // Consulta de usuarios
        $user_academic_coordinator = User::where('nickname','mgonzalezg')->first(); // Usuario Coordinador Académico (María Antonia Gonzáles Gonzáles)


        // Asignación de ROLES para los USUARIOS de la aplicación SIGAC (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_academic_coordinator->roles()->syncWithoutDetaching([$rol_academic_coordinator->id]);
    }
}
