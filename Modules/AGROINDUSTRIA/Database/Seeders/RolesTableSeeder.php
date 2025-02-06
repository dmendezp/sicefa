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
            'name' => 'Instructor',
            'description' => 'Rol instructor',
            'description_english' => 'Instructor role',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de INSTRUCTOR de carnicos, panaderia, pasteleria, frutas
        $rol_instructor_chocolateria = Role::updateOrCreate(['slug' => 'agroindustria.instructor.chocolate'], [
            'name' => 'Instructor - Chocolate',
            'description' => 'Rol instructor para el area de chocolateria',
            'description_english' => 'Role instructor for the chocolate area',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de INSTRUCTOR de carnicos, panaderia, pasteleria, frutas
        $rol_instructor_cerveceria = Role::updateOrCreate(['slug' => 'agroindustria.instructor.cerveceria'], [
            'name' => 'Instructor - Cerveceria',
            'description' => 'Rol instructor para el area de cerveceria',
            'description_english' => 'Role instructor for the brewery area',
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
        $user_admin = User::where('nickname','Vilmer')->first(); // Usuario Administrador (Julian Javier Ramirez Diaz)

        // Asignación de ROLES para los USUARIOS de la aplicación AGROINDUSTRIA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_admin->roles()->syncWithoutDetaching([$rol_admin->id]);




    }
}
