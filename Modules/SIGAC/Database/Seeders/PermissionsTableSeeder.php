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
        $permissions_academic_coordinator = []; // Permisos para Coordinador Académico


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name','SIGAC')->first();


        // ===================== Registro de todos los permisos de la aplicación SIGAC ==================
        // Registro de asistencia
        $permission = Permission::updateOrCreate(['slug' => 'sigac.attendace.create'], [ // Registro o actualización de permiso
            'name' => 'Registro de asistencia',
            'description' => 'Acceder al formulario de registro de asistencia',
            'description_english' => 'Access the attendance registration form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol


        // Consulta de ROLES
        $rol_academic_coordinator = Role::where('slug', 'sica.coordinator')->first(); // Rol Coordinado Académico


        // Asignación de PERMISOS para los ROLES de la aplicación SICA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_academic_coordinator->permissions()->syncWithoutDetaching($permissions_academic_coordinator);

    }
}
