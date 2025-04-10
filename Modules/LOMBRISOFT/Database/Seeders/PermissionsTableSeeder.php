<?php

namespace Modules\LOMBRISOFT\Database\Seeders;

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
        $permissions_admin = []; // Permisos para Administrador


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'LOMBRISOFT')->first();


        // ===================== Registro de todos los permisos de la aplicación CAFETO ==================
        // Vista principal del administrador
     

        // Vista de configuración (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'lombrisoft.admin.welcome'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de Administrador',
            'description' => 'Acceso al Rol de Administrador',
            'description_english' => 'Access to the Administrator Role',
            'app_id' => $app->id,
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

     

        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'lombrisoft.admin')->first(); // Rol Administrador

        // Asignación de PERMISOS para los ROLES de la aplicación CAFETO (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
    }
}