<?php

namespace Modules\GDMF\Database\Seeders;

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
        // Consultar aplicación GDMF para registrar los roles
        $app = App::where('name', 'GDMF')->firstOrFail();

        // Registrar o actualizar rol de Coordinador Académico
        $rol_academic_coordinator = Role::firstOrCreate(['slug' => 'gdmf.academic_coordinator'], [
            'name' => 'Coordinador Académico GDMF',
            'description' => 'Rol Coordinador Académico de la aplicación GDMF',
            'description_english' => 'Role Academic Coordinator of the GDMF application',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de Instructor
        $rol_instructor = Role::firstOrCreate(['slug' => 'gdmf.instructor'], [
            'name' => 'Instructor GDMF',
            'description' => 'Rol Instructor de la aplicación GDMF',
            'description_english' => 'Role Instructor of the GDMF application',
            'app_id' => $app->id
        ]);



        // Consulta de usuarios
        $user_academic_coordinator = User::where('nickname', 'jesus1')->first(); // Usuario Coordinador Académico (María Antonia Gonzáles Gonzáles)
        $user_instructor = User::where('nickname', 'jesus2')->first(); // Usuario Instructor (Diego Andrés Mendez Pastrana)

        // Asignación de ROLES para los USUARIOS de la aplicación SIGAC (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_academic_coordinator->roles()->syncWithoutDetaching([$rol_academic_coordinator->id]);
        $user_instructor->roles()->syncWithoutDetaching([$rol_instructor->id]);

    }
}
