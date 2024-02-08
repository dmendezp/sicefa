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
        $permissions_trainer = [];
        $permissions_passant = [];


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'AGROCEFA')->first();


        /* -------------------------------------------------------------------------------
        // -------------- Realizar el registro de los permisos para AGROCEFA -------------
           -------------------------------------------------------------------------------
        */

        // ---------- Registro o actualización de permiso ---------

        // Gestionar Parametros
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.index'], [
            'name' => 'Gestionar los Parametros',
            'description' => 'Tendra el acceso a gestionar los parametros',
            'description_english' => 'You will have access to manage the parameters',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        // Gestionar acciones de parametrizacion
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.manage'], [
            'name' => 'Gestionar acciones de parametrizacion',
            'description' => 'Puede gestionar las diferentes acciones de la seccion de parámetros',
            'description_english' => 'You can manage the different actions of the parameters section',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        //  Acceso el Inventario
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.inventory.index'], [
            'name' => 'Gestionar le inventario',
            'description' => 'Puede tener acceso al inventario de las bodegas de agrocefa',
            'description_english' => 'You can access the inventory of agrocefa warehouses',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        // Acceso el Inventario
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.inventory.index'], [
            'name' => 'Gestionar le inventario',
            'description' => 'Puede tener acceso al inventario de las bodegas de agrocefa',
            'description_english' => 'You can access the inventory of agrocefa warehouses',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        // Gestionar acciones del Inventario
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.inventory.manage'], [
            'name' => 'Gestionar acciones del inventario',
            'description' => 'Puede gestionar las diferentes acciones del inventario',
            'description_english' => 'You can manage the different inventory actions',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;


        // Acceso a Movimientos
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.movements.index'], [
            'name' => 'Gestionar le inventario',
            'description' => 'Puede tener acceso a realizar movimientos de inventario',
            'description_english' => 'You can have access to perform inventory movements',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.movements.index'], [
            'name' => 'Gestionar le inventario',
            'description' => 'Puede tener acceso a realizar movimientos de inventario',
            'description_english' => 'You can have access to perform inventory movements',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        // Gestionar Regitro de Labor
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.labormanagement.index'], [
            'name' => 'Gestionar el registro de Labores',
            'description' => 'Puede gestionar el registro de la labor realizada',
            'description_english' => 'You can manage the record of the work done',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        // Gestionar Regitro de Labor
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.labormanagement.index'], [
            'name' => 'Gestionar el registro de Labores',
            'description' => 'Puede gestionar el registro de la labor realizada',
            'description_english' => 'You can manage the record of the work done',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        // Visualizacion de Reportes
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.reports.index'], [
            'name' => 'Visualizacion y Descarga de Reportes',
            'description' => 'Puede ver y descargar los diferentes reportes del sector agricola del cefa',
            'description_english' => 'You can see and download the different reports of the agricultural sector of Cefa',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; 

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.reports.index'], [
            'name' => 'Visualizacion y Descarga de Reportes',
            'description' => 'Puede ver y descargar los diferentes reportes del sector agricola del cefa',
            'description_english' => 'You can see and download the different reports of the agricultural sector of Cefa',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        // Visualizar productos de invetario
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.inventory.index'], [
            'name' => 'Visualizar elementos de inventario',
            'description' => 'Puede ver los elementos que se encuentran en inventario del sector agricola del cefa',
            'description_english' => 'You can see the elements that are in the inventory of the agricultural sector of Cefa',
            'app_id' => $app->id
        ]);
        
        // Visualizar notificaiones movimientos
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.movements.notification'], [
            'name' => 'Visualizar notificaiones movimientos',
            'description' => 'Puede ver las notificaciones de los movimientos pendientes',
            'description_english' => 'You can see notifications of pending movements',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; 

        // Visualizar notificaciones stock
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.inventory.stock'], [
            'name' => 'Visualizar notificaciones stock',
            'description' => 'Puede ver las notificaciones de los productos por agotarse',
            'description_english' => 'You can see notifications of products that are out of stock',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; 


        
        // Consulta de ROLES
        $rol_trainer = Role::where('slug', 'agrocefa.trainer')->first();
        $rol_passant = Role::where('slug', 'agrocefa.passant')->first();

        // Asignación de permisos para roles
        $rol_trainer->permissions()->syncWithoutDetaching($permissions_trainer);
        $rol_passant->permissions()->syncWithoutDetaching($permissions_passant);
    }
}
