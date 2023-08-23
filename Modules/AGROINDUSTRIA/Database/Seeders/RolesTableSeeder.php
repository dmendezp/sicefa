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

        // Consulta de usuarios
        $user_admin = User::where('nickname','Julian')->first(); // Usuario Administrador (Julian Javier Ramirez Diaz)
        $user_instructor = User::where('nickname','Bonilla')->first(); // Usuario Instructor (Juan Diego Bonilla Aroca)
        $user_storer = User::where('nickname','Cadena')->first(); // Usuario Almacenista (David Juliam Cadena Barrera)
        $user_visitor = User::where('nickname','Jennifer')->first(); // Usuario Visitante (Jennifer Marin Montealegre)

        // Asignación de ROLES para los USUARIOS de la aplicación AGROINDUSTRIA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_admin->roles()->syncWithoutDetaching([$rol_admin->id]);
        $user_instructor->roles()->syncWithoutDetaching([$rol_instructor->id]);
        $user_storer->roles()->syncWithoutDetaching([$rol_storer->id]);
        $user_visitor->roles()->syncWithoutDetaching([$rol_visitor->id]);



    }
}
