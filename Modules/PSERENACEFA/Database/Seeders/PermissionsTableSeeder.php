<?php

namespace Modules\PSERENACEFA\Database\Seeders;

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

        $permissions_pasante = []; // Lista de permisos para el rol de pasante
        
        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'PSERENACEFA')->first();


        // Vista de configuración (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'pserenacefa.admin.welcome'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de Administrador',
            'description' => 'Acceso al Rol de Administrador (Coordinador)',
            'description_english' => 'Access to the Administrator Role (Coordinator)',
            'app_id' => $app->id
        ]);

        $permission = Permission::updateOrCreate(['slug' => 'pserenacefa.admin.admin.create'], [ // Registro o actualización de permiso
            'name' => 'Registro de ambientes',
            'description' => 'Acceso a registar ambientes',
            'description_english' => 'Access to register environments',
            'app_id' => $app->id
        ]);

        $permission = Permission::updateOrCreate(['slug' => 'pserenacefa.admin.admin.index'], [ // Registro o actualización de permiso
            'name' => 'Lista de ambientes',
            'description' => 'Acceso a mirar ambientes',
            'description_english' => 'Access to view environments',
            'app_id' => $app->id
        ]);

        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

    
        $rol_admin = Role::where('slug', 'pserenacefa.admin')->first(); // Rol Administrador
       

        // Asignación de PERMISOS para los ROLES de la aplicación AGROSOFT (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);

        
        //Pasante

        $permission = Permission::updateOrCreate(['slug' => 'pserenacefa.pasante.welcomepasante'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de Pasante',
            'description' => 'Acceso al Rol de Pasante',
            'description_english' => 'Access to the intern Role',
            'app_id' => $app->id
        ]);
        $permissions_pasante[] = $permission->id; // Almacenar permiso para rol

     

        // Consulta de ROLES
        $rol_pasante = Role::where('slug', 'pserenacefa.pasante')->first(); // Rol Administrador
       

        // Asignación de PERMISOS para los ROLES de la aplicación AGROSOFT (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_pasante->permissions()->syncWithoutDetaching($permissions_pasante);

      
    }
}