<?php

namespace Modules\SIGAC\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Definir arreglos de PERMISOS que van ser asignados a los ROLES
        $permissions_instructor = []; // Permisos para el Adminstrador

        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name','SIGAC')->firstOrFail();


        // ===================== Registro de todos los permisos de la aplicación SIGAC ==================
        // Panel de control del instructor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control del instructor (Instructor)',
            'description' => 'Panel de control del instructor',
            'description_english' => "Instructor's control panel",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES
        $rol_instructor = Role::where('slug', 'sigac.instructor')->firstOrFail(); // Rol Coordinado Académico

        // Asignación de PERMISOS para los ROLES de la aplicación SIGAC (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_instructor->permissions()->syncWithoutDetaching($permissions_instructor);

    }
}
