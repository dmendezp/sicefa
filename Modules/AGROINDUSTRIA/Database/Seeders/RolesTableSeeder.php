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

        // Registrar o actualizar rol de INSTRUCTOR de carnicos, panaderia, pasteleria, frutas
        $rol_instructor_vilmer = Role::updateOrCreate(['slug' => 'agroindustria.instructor.vilmer'], [
            'name' => 'Instructor- carnicos, panaderia, pasteleria, frutas',
            'description' => 'Rol instructor de las unidades productivas carnicos, panaderia, pasteleria y frutas',
            'description_english' => 'Instructor role of meat, bakery, pastry and fruit production units',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de INSTRUCTOR de chocolateria
        $rol_instructor_chocolate = Role::updateOrCreate(['slug' => 'agroindustria.instructor.chocolate'], [
            'name' => 'Instructor- chocolateria',
            'description' => 'Rol instructor de las unidad productiva chocolateria',
            'description_english' => 'Instructor role of the chocolate production unit',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de INSTRUCTOR de cerveceria
        $rol_instructor_brewery = Role::updateOrCreate(['slug' => 'agroindustria.instructor.cerveceria'], [
            'name' => 'Instructor- cerveceria',
            'description' => 'Rol instructor de las unidad productiva cerveceria',
            'description_english' => 'Instructor role of the brewery production unit',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de ALMACENISTA
        $rol_storer = Role::updateOrCreate(['slug' => 'agroindustria.almacenista'], [
            'name' => 'Almacenista',
            'description' => 'Rol almacenista de AGROINDUSTRIA',
            'description_english' => 'Role storer of AGROINDUSTRIA',
            'app_id' => $app->id
        ]);

        // Consulta de usuarios
        $user_admin = User::where('nickname','Julian')->first(); // Usuario Administrador (Julian Javier Ramirez Diaz)
        $user_instructor_vilmer = User::where('nickname','Bonilla')->first(); // Usuario Instructor (Juan Diego Bonilla Aroca)
        $user_instructor_chocolate = User::where('nickname','Jennifer')->first(); // Usuario Instructor (Juan Diego Bonilla Aroca)
        $user_storer = User::where('nickname','Cadena')->first(); // Usuario Almacenista (David Juliam Cadena Barrera)

        // Asignación de ROLES para los USUARIOS de la aplicación AGROINDUSTRIA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_admin->roles()->syncWithoutDetaching([$rol_admin->id]);
        $user_instructor_vilmer->roles()->syncWithoutDetaching([$rol_instructor_vilmer->id]);
        $user_instructor_chocolate->roles()->syncWithoutDetaching([$rol_instructor_chocolate->id]);
        $user_storer->roles()->syncWithoutDetaching([$rol_storer->id]);



    }
}
