<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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
        $permissions_cashier = []; // Permisos para Cajero


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name','PTVENTA')->first();


        // ===================== Registro de todos los permisos de la aplicación PTVENTA ==================
        // Vista principal del administrador
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal del administrador',
            'description' => 'Pueder ver la vista principal del administrador',
            'description_english' => 'You can see the main view of the administrator',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal del cajero
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal del cajero',
            'description' => 'Pueder ver la vista principal del cajero',
            'description_english' => 'You can see the main view of the cashier',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Vista de configuración del administrador
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.configuration.index'], [ // Registro o actualización de permiso
            'name' => 'Vista de configuración del administrador',
            'description' => 'Configuración de parametros generales y testeo de impresión pos',
            'description_english' => 'Configuration of general parameters and post printing test',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de configuración del cajero
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.configuration.index'], [ // Registro o actualización de permiso
            'name' => 'Vista de configuración del cajero',
            'description' => 'Configuración de parametros generales y testeo de impresión pos',
            'description_english' => 'Configuration of general parameters and post printing test',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol



        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'ptventa.admin')->first(); // Rol Administrador
        $rol_cashier = Role::where('slug', 'ptventa.cashier')->first(); // Rol Operador de Cajero

        // Asignación de PERMISOS para los ROLES de la aplicación PTVENTA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()-> syncWithoutDetaching($permissions_admin);
        $rol_cashier->permissions()-> syncWithoutDetaching($permissions_cashier);
    }
}
