<?php

namespace Modules\AGROINDUSTRIA\Database\Seeders;

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
        // Consultar aplicación AGROINDUSTRIA para registrar los roles
        $app = App::where('name','AGROINDUSTRIA')->first();

        // Registrar o actualizar rol de ADMINISTRADOR
        $rol_admin = Role::updateOrCreate(['slug' => 'agroindustria.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de AGROINDUSTRIA',
            'description_english' => 'Role administrator of AGROINDUSTRIA',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de INSTRUCTOR
        $rol_instructor = Role::updateOrCreate(['slug' => 'agroindustria.instructor'], [
            'name' => 'Instructor',
            'description' => 'Rol instructor de AGROINDUSTRIA',
            'description_english' => 'Role instructor of AGROINDUSTRIA',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de ALMACENISTA
        $rol_storer = Role::updateOrCreate(['slug' => 'agroindustria.almacenista'], [
            'name' => 'Almacenista',
            'description' => 'Rol almacenista de AGROINDUSTRIA',
            'description_english' => 'Role storer of AGROINDUSTRIA',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de VISITANTE
        $rol_visitor = Role::updateOrCreate(['slug' => 'agroindustria.visitante'], [
            'name' => 'Visitante',
            'description' => 'Rol visitante de AGROINDUSTRIA',
            'description_english' => 'Role visitor of AGROINDUSTRIA',
            'app_id' => $app->id
        ]);
    }
}
