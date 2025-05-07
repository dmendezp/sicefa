<?php

namespace Modules\GDF\Database\Seeders;

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

        // Crear una lista de permisos para el rol 
        $permissions_admin = []; // Lista de permisos para el rol de administrador

        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'GDF')->first();


        // Vista de configuración (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'gdf.admin.welcome'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de Administrador',
            'description' => 'Acceso al Rol de Administrador',
            'description_english' => 'Access to the Administrator Role',
            'app_id' => $app->id
        ]);

        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        
        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'gdf.admin')->first(); // Rol Administrador

        // Asignación de PERMISOS para los ROLES de la aplicación GDF (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);




        // Crear una lista de permisos para el rol 
        $permissions_admin = []; // Lista de permisos para el rol de administrador

        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'GDF')->first();


        // Vista de configuración (Funcionario)
        $permission = Permission::updateOrCreate(['slug' => 'gdf.funcionario.welcome'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de Funcionario',
            'description' => 'Acceso al Rol de Funcionario',
            'description_english' => 'Access to the Employee Role',
            'app_id' => $app->id
        ]);

        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'gdf.funcionario')->first(); // Rol Funcionario

        // Asignación de PERMISOS para los ROLES de la aplicación GDF (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);




        
        // Vista de configuración (Superadministrador)
        $permission = Permission::updateOrCreate(['slug' => 'gdf.superadmin.welcome'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de Super Administrador',
            'description' => 'Acceso al Rol de Super Administrador',
            'description_english' => 'Access to the Super Administrator Role',
            'app_id' => $app->id
        ]);

        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'gdf.superadmin')->first(); // Rol Funcionario

        // Asignación de PERMISOS para los ROLES de la aplicación GDF (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
    }
}
