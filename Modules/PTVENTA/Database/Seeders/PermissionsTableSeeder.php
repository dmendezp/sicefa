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


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name','PTVENTA')->first();



        // ===================== Registro de todos los permisos de la aplicación PTVENTA ==================
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



        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'ptventa.admin')->first(); // Rol Administrador

        // Asignación de PERMISOS para los ROLES de la aplicación PTVENTA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()-> syncWithoutDetaching($permissions_admin);
    }
}