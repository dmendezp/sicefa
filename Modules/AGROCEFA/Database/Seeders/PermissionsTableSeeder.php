<?php

namespace Modules\AGROCEFA\Database\Seeders;

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
        // crear listas para almacenar los permisos de cada rol
        $permissions_admin = [];
        $permissions_passant = [];


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'AGROCEFA')->first();


        /* -------------------------------------------------------------------------------
        // -------------- Realizar el registro de los permisos para AGROCEFA -------------
           -------------------------------------------------------------------------------
        */

        // ---------- Registro o actualización de permiso ---------

        // Gestionar Parametros
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.parameters.index'], [
            'name' => 'Gestionar los Parametros',
            'description' => 'Tendra el acceso a gestionar los parametros',
            'description_english' => 'You will have access to manage the parameters',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Gestionar el Inventario
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.inventory.index'], [
            'name' => 'Gestionar le inventario',
            'description' => 'Puede gestionar el inventario de las bodegas de agrocefa',
            'description_english' => 'You can manage the inventory of agrocefa warehouses',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        $permissions_passant[] = $permission->id;

        // Gestionar acciones del Inventario
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.admin.inventory.manage'], [
            'name' => 'Gestionar acciones del inventario',
            'description' => 'Puede gestionar las diferentes acciones del inventario',
            'description_english' => 'You can manage the different inventory actions',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        // Gestionar Regitro de Labor
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.labormanagement.index'], [
            'name' => 'Gestionar el registro de Labores',
            'description' => 'Puede gestionar el registro de la labor realizada',
            'description_english' => 'You can manage the record of the work done',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        $permissions_passant[] = $permission->id;

        // Visualizacion de Reportes
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.reports'], [
            'name' => 'Visualizacion y Descarga de Reportes',
            'description' => 'Puede ver y descargar los diferentes reportes del sector agricola del cefa',
            'description_english' => 'You can see and download the different reports of the agricultural sector of Cefa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Visualizacion de Reportes Pasante
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.reports'], [
            'name' => 'Visualizacion y Descarga de Reportes de Consumo y Balance',
            'description' => 'Puede ver y descargar los reportes de consumo y balance del sector agricola del cefa',
            'description_english' => 'You can see and download the reports of consumption and balance of the agricultural sector of Cefa',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id; // Almacenar permiso para rol

        // Visualizar productos de invetario
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.inventory.index'], [
            'name' => 'Visualizar elementos de inventario',
            'description' => 'Puede ver los elementos que se encuentran en inventario del sector agricola del cefa',
            'description_english' => 'You can see the elements that are in the inventory of the agricultural sector of Cefa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        $permissions_passant[] = $permission->id;


        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'agrocefa.admin')->first();
        $rol_passant = Role::where('slug', 'agrocefa.pasante')->first();

        // Asignación de permisos para roles
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        $rol_passant->permissions()->syncWithoutDetaching($permissions_passant);
    }
}
