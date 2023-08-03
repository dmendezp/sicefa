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
        // Vista de configuración del administrador
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.configuration'], [ // Registro o actualización de permiso
            'name' => 'Vista de configuración del administrador',
            'description' => 'Configuración de parametros generales y testeo de impresión pos',
            'description_english' => 'Configuration of general parameters and post printing test',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de configuración del cajero
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.configuration'], [ // Registro o actualización de permiso
            'name' => 'Vista de configuración del cajero',
            'description' => 'Configuración de parametros generales y testeo de impresión pos',
            'description_english' => 'Configuration of general parameters and post printing test',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

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

        // Listar inventario
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.inventory.index'], [ // Registro o actualización de permiso
            'name' => 'Listar inventario',
            'description' => 'Puede ver el listado de inventario en bodega',
            'description_english' => 'You can see the list of inventory in the warehouse',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Listar ventas del día
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.sale.index'], [ // Registro o actualización de permiso
            'name' => 'Listar ventas del día',
            'description' => 'Puede ver el listado de ventas del día',
            'description_english' => 'You can see the list of sales of the day',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Listar imágenes de elementos
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.element.image.index'], [ // Registro o actualización de permiso
            'name' => 'Listar imágenes de elementos',
            'description' => 'Puede ver las imágenes de los elementos (productos)',
            'description_english' => 'You can see the images of the elements (products)',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Visualizar productos de invetario
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.inventory.index'], [ // Registro o actualización de permiso
            'name' => 'Visualizar elementos de inventario',
            'description' => 'Puede ver los elementos que se encuentran en inventario (productos)',
            'description_english' => 'You can see the items that are in inventory (products)',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol


        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'ptventa.admin')->first(); // Rol Administrador
        $rol_cashier = Role::where('slug', 'ptventa.cashier')->first(); // Rol Operador de Cajero

        // Asignación de PERMISOS para los ROLES de la aplicación PTVENTA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()-> syncWithoutDetaching($permissions_admin);
        $rol_cashier->permissions()-> syncWithoutDetaching($permissions_cashier);
    }
}
