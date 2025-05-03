<?php

namespace Modules\SENAAPICOLA\Database\Seeders;

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


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'SENAAPICOLA')->first();


        // Permisos Rol (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaapicola.admin.index'], [ // Registro o actualización de permiso
            'name' => 'Vista de configuración (Administrador)',
            'description' => 'Configuración de parametros generales y testeo de impresión pos',
            'description_english' => 'Configuration of general parameters and post printing test',
            'app_id' => $app->id
        ]);

        $permission = Permission::updateOrCreate(['slug' => 'senaapicola.admin.welcome'], [ // Registro o actualización de permiso
            'name' => 'Vista de configuración (Administrador)',
            'description' => 'Configuración de parametros generales y testeo de impresión pos',
            'description_english' => 'Configuration of general parameters and post printing test',
            'app_id' => $app->id
        ]);


        // Permisos Rol (Pasante)
        $permission = Permission::updateOrCreate(['slug' => 'senaapicola.intern.panelpas'], [ // Registro o actualización de permiso
            'name' => 'Vista de configuración (Pasante)',
            'description' => 'Configuración de parametros generales y testeo de impresión pos',
            'description_english' => 'Configuration of general parameters and post printing test',
            'app_id' => $app->id
        ]);

        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        $permissions_intern[] = $permission->id; // Almacenar permiso para rol



        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'senaapicola.admin')->first(); // Rol Administrador
        $rol_intern = Role::where('slug', 'senaapicola.intern')->first(); // Rol Pasante

        // Asignación de PERMISOS para los ROLES de la aplicación SENAAPICOLA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        $rol_intern->permissions()->syncWithoutDetaching($permissions_intern);
    }
}
