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
        $permissions_manageragricultural = [];


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'AGROCEFA')->first();


        /* -------------------------------------------------------------------------------
        // -------------- Realizar el registro de los permisos para AGROCEFA -------------
           -------------------------------------------------------------------------------
        */

        // ---------- Registro o actualización de permiso ---------


        // *************** PERMISOS GENERALES DE ACCESO *********************************

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.index'], [
            'name' => 'Acceso al Rol de Administrador',
            'description' => 'Tendra el acceso al rol administrador para la gestion de los cultivos',
            'description_english' => 'You will have access to the administrator role to manage the crops',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.index'], [
            'name' => 'Acceso al Rol de Pasante',
            'description' => 'Tendra el acceso al rol pasante para la gestion de los cultivos',
            'description_english' => 'You will have access to the passant role to manage the crops',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.index'], [
            'name' => 'Acceso al Rol de Gestor Agricola',
            'description' => 'Tendra el acceso al rol gestor agricola para la gestion de los cultivos',
            'description_english' => 'You will have access to the manageragricultural role to manage the crops',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.select-unit'], [
            'name' => 'Acceso a la Unidad Productiva',
            'description' => 'Tendra el acceso de ingreso a la unidad productiva',
            'description_english' => 'You will have entry access to the productive unit',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.select-unit'], [
            'name' => 'Acceso a la Unidad Productiva',
            'description' => 'Tendra el acceso de ingreso a la unidad productiva',
            'description_english' => 'You will have entry access to the productive unit',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.select-unit'], [
            'name' => 'Acceso a la Unidad Productiva',
            'description' => 'Tendra el acceso de ingreso a la unidad productiva',
            'description_english' => 'You will have entry access to the productive unit',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        


        // ****************************** PARAMETROS *******************************************

        // Visualizar parametros
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.index'], [
            'name' => 'Gestionar los Parametros',
            'description' => 'Tendra el acceso a gestionar los parametros',
            'description_english' => 'You will have access to manage the parameters',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.parameters.index'], [
            'name' => 'Gestionar los Parametros',
            'description' => 'Tendra el acceso a gestionar los parametros',
            'description_english' => 'You will have access to manage the parameters',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.index'], [
            'name' => 'Gestionar los Parametros',
            'description' => 'Tendra el acceso a gestionar los parametros',
            'description_english' => 'You will have access to manage the parameters',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol


        // Gestionar acciones de parametrizacion
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.manage'], [
            'name' => 'Gestionar acciones de parametrizacion',
            'description' => 'Puede gestionar las diferentes acciones de la seccion de parámetros',
            'description_english' => 'You can manage the different actions of the parameters section',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.manage'], [
            'name' => 'Gestionar acciones de parametrizacion',
            'description' => 'Puede gestionar las diferentes acciones de la seccion de parámetros',
            'description_english' => 'You can manage the different actions of the parameters section',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol


        // || Actividad ||

        // Registrar actividad
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.activity.store'], [
            'name' => 'Registrar Actividad',
            'description' => 'Realizar el registro de la actividad',
            'description_english' => 'Record the activity',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.activity.store'], [
            'name' => 'Registrar Actividad',
            'description' => 'Realizar el registro de la actividad',
            'description_english' => 'Record the activity',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Actualizar actividad
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.activity.update'], [
            'name' => 'Actualizar Actividad',
            'description' => 'Realizar la actualizacion de la actividad',
            'description_english' => 'Perform activity update',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.activity.update'], [
            'name' => 'Actualizar Actividad',
            'description' => 'Realizar la actualizacion de la actividad',
            'description_english' => 'Perform activity update',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Eliminar actividad
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.activity.destroy'], [
            'name' => 'Eliminar Actividad',
            'description' => 'Realizar la eliminacion de la actividad',
            'description_english' => 'Perform activity delete',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.activity.destroy'], [
            'name' => 'Eliminar Actividad',
            'description' => 'Realizar la eliminacion de la actividad',
            'description_english' => 'Perform activity delete',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // ||   Tipo de Empleado ||

        // Registrar tipo de empleado
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.employeetype.store'], [
            'name' => 'Registrar tipo de empleado',
            'description' => 'Realizar el registro de la tipo de empleado',
            'description_english' => 'Record the variety',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.employeetype.store'], [
            'name' => 'Registrar tipo de empleado',
            'description' => 'Realizar el registro de la tipo de empleado',
            'description_english' => 'Record the variety',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Actualizar tipo de empleado
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.employeetype.update'], [
            'name' => 'Actualizar tipo de empleado',
            'description' => 'Realizar la actualizacion de la tipo de empleado',
            'description_english' => 'Perform variety update',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.employeetype.update'], [
            'name' => 'Actualizar tipo de empleado',
            'description' => 'Realizar la actualizacion de la tipo de empleado',
            'description_english' => 'Perform variety update',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Eliminar tipo de empleado
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.employeetype.destroy'], [
            'name' => 'Eliminar tipo de empleado',
            'description' => 'Realizar la eliminacion de la tipo de empleado',
            'description_english' => 'Perform variety delete',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.employeetype.destroy'], [
            'name' => 'Eliminar tipo de empleado',
            'description' => 'Realizar la eliminacion de la tipo de empleado',
            'description_english' => 'Perform variety delete',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol


        // || Variedad ||

        // Registrar variedad
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.variety.store'], [
            'name' => 'Registrar Variedad',
            'description' => 'Realizar el registro de la variedad',
            'description_english' => 'Record the variety',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.variety.store'], [
            'name' => 'Registrar Variedad',
            'description' => 'Realizar el registro de la variedad',
            'description_english' => 'Record the variety',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Actualizar variedad
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.variety.update'], [
            'name' => 'Actualizar Variedad',
            'description' => 'Realizar la actualizacion de la variedad',
            'description_english' => 'Perform variety update',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.variety.update'], [
            'name' => 'Actualizar Variedad',
            'description' => 'Realizar la actualizacion de la variedad',
            'description_english' => 'Perform variety update',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Eliminar variedad
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.variety.destroy'], [
            'name' => 'Eliminar Variedad',
            'description' => 'Realizar la eliminacion de la variedad',
            'description_english' => 'Perform variety delete',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.variety.destroy'], [
            'name' => 'Eliminar Variedad',
            'description' => 'Realizar la eliminacion de la variedad',
            'description_english' => 'Perform variety delete',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol


        // || Especie ||

        // Registrar especie
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.specie.store'], [
            'name' => 'Registrar Especie',
            'description' => 'Realizar el registro de la especie',
            'description_english' => 'Record the specie',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.specie.store'], [
            'name' => 'Registrar Especie',
            'description' => 'Realizar el registro de la especie',
            'description_english' => 'Record the specie',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Actualizar especie
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.specie.update'], [
            'name' => 'Actualizar Especie',
            'description' => 'Realizar la actualizacion de la especie',
            'description_english' => 'Perform specie update',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.specie.update'], [
            'name' => 'Actualizar Especie',
            'description' => 'Realizar la actualizacion de la especie',
            'description_english' => 'Perform specie update',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Eliminar especie
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.specie.destroy'], [
            'name' => 'Eliminar Especie',
            'description' => 'Realizar la eliminacion de la especie',
            'description_english' => 'Perform specie delete',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.specie.destroy'], [
            'name' => 'Eliminar Especie',
            'description' => 'Realizar la eliminacion de la especie',
            'description_english' => 'Perform specie delete',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol


        // || Cultivo ||

        // Registrar cultivo
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.crop.store'], [
            'name' => 'Registrar Cultivo',
            'description' => 'Realizar el registro de la cultivo',
            'description_english' => 'Record the crop',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.crop.store'], [
            'name' => 'Registrar Cultivo',
            'description' => 'Realizar el registro de la cultivo',
            'description_english' => 'Record the crop',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Actualizar cultivo
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.crop.update'], [
            'name' => 'Actualizar Cultivo',
            'description' => 'Realizar la actualizacion de la cultivo',
            'description_english' => 'Perform crop update',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.crop.update'], [
            'name' => 'Actualizar Cultivo',
            'description' => 'Realizar la actualizacion de la cultivo',
            'description_english' => 'Perform crop update',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Eliminar cultivo
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.parameters.crop.destroy'], [
            'name' => 'Eliminar Cultivo',
            'description' => 'Realizar la eliminacion de la cultivo',
            'description_english' => 'Perform crop delete',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.parameters.crop.destroy'], [
            'name' => 'Eliminar Cultivo',
            'description' => 'Realizar la eliminacion de la cultivo',
            'description_english' => 'Perform crop delete',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol





        // ********************************* INVENTARIO *****************************************

        // Visualizar invetario
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.inventory.index'], [
            'name' => 'Gestionar le inventario',
            'description' => 'Puede tener acceso al inventario de las bodegas de agrocefa',
            'description_english' => 'You can access the inventory of agrocefa warehouses',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.inventory.index'], [
            'name' => 'Visualizar elementos de inventario',
            'description' => 'Puede ver los elementos que se encuentran en inventario del sector agricola del cefa',
            'description_english' => 'You can see the elements that are in the inventory of the agricultural sector of Cefa',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.inventory.index'], [
            'name' => 'Visualizar elementos de inventario',
            'description' => 'Puede ver los elementos que se encuentran en inventario del sector agricola del cefa',
            'description_english' => 'You can see the elements that are in the inventory of the agricultural sector of Cefa',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Gestionar acciones del inventario
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.inventory.manage'], [
            'name' => 'Gestionar acciones del inventario',
            'description' => 'Puede gestionar las diferentes acciones del inventario',
            'description_english' => 'You can manage the different inventory actions',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.inventory.manage'], [
            'name' => 'Gestionar acciones del inventario',
            'description' => 'Puede gestionar las diferentes acciones del inventario',
            'description_english' => 'You can manage the different inventory actions',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Visualizar notificaciones stock
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.inventory.stock'], [
            'name' => 'Visualizar notificaciones stock minimo',
            'description' => 'Puede ver las notificaciones de los productos por agotarse',
            'description_english' => 'You can see notifications of products that are out of stock',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol
 
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.inventory.stock'], [
            'name' => 'Visualizar notificaciones stock minimo',
            'description' => 'Puede ver las notificaciones de los productos por agotarse',
            'description_english' => 'You can see notifications of products that are out of stock',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Filtros inventario
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.inventory.showWarehouseFilter'], [
            'name' => 'Filtrar elemetos por categoria',
            'description' => 'Puede visualizar los elementos segun la categoria',
            'description_english' => 'You can view the elements according to the category',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.inventory.showWarehouseFilter'], [
            'name' => 'Filtrar elemetos por categoria',
            'description' => 'Puede visualizar los elementos segun la categoria',
            'description_english' => 'You can view the elements according to the category',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.inventory.showWarehouseFilter'], [
            'name' => 'Filtrar elemetos por categoria',
            'description' => 'Puede visualizar los elementos segun la categoria',
            'description_english' => 'You can view the elements according to the category',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.inventory.showWarehouseFilterStock'], [
            'name' => 'Filtrar elemetos por agotarse',
            'description' => 'Puede visualizar los elementos agotados',
            'description_english' => 'You can view out of stock items',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.inventory.showWarehouseFilterStock'], [
            'name' => 'Filtrar elemetos por agotarse',
            'description' => 'Puede visualizar los elementos agotados',
            'description_english' => 'You can view out of stock items',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.inventory.showWarehouseFilterStock'], [
            'name' => 'Filtrar elemetos por agotarse',
            'description' => 'Puede visualizar los elementos agotados',
            'description_english' => 'You can view out of stock items',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Visualizar bajas de inventario
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.inventory.low'], [
            'name' => 'Visaulizar Bajas',
            'description' => 'Puede visualizar los elementos vencidos',
            'description_english' => 'You can view expired items',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.inventory.low'], [
            'name' => 'Visaulizar Bajas',
            'description' => 'Puede visualizar los elementos vencidos',
            'description_english' => 'You can view expired items',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Realizar baja de inventario
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.inventory.low'], [
            'name' => 'Movimiento baja del elemento (Pasante)',
            'description' => 'Dar de baja el elemento',
            'description_english' => 'Delete the item',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id; // Almacenar permiso para rol

        // Realizar baja de inventario
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.inventory.movementlow'], [
            'name' => 'Movimiento baja del elemento',
            'description' => 'Dar de baja el elemento',
            'description_english' => 'Delete the item',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.inventory.movementlow'], [
            'name' => 'Movimiento baja del elemento',
            'description' => 'Dar de baja el elemento',
            'description_english' => 'Delete the item',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Registrar categoria
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.inventory.category.store'], [
            'name' => 'Registrar Categoria',
            'description' => 'Realizar el registro de la categoria',
            'description_english' => 'Register the category',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.inventory.category.store'], [
            'name' => 'Registrar Categoria',
            'description' => 'Realizar el registro de la categoria',
            'description_english' => 'Register the category',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol

        // Registrar elemento
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.inventory.element.store'], [
            'name' => 'Registrar Elemento',
            'description' => 'Realizar el registro del elemento',
            'description_english' => 'Register the element',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.inventory.element.store'], [
            'name' => 'Registrar Elemento',
            'description' => 'Realizar el registro del elemento',
            'description_english' => 'Register the element',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id; // Almacenar permiso para rol







        // *********************************** MOVIMINETOS *************************************

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

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.movements.index'], [
            'name' => 'Gestionar le inventario',
            'description' => 'Puede tener acceso a realizar movimientos de inventario',
            'description_english' => 'You can have access to perform inventory movements',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Visualizar historial movimientos
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.movements.list'], [
            'name' => 'Historial de movimientos',
            'description' => 'Visualizar el historial de los moviminetos',
            'description_english' => 'View movement history',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.movements.list'], [
            'name' => 'Historial de movimientos',
            'description' => 'Visualizar el historial de los moviminetos',
            'description_english' => 'View movement history',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.movements.list'], [
            'name' => 'Historial de movimientos',
            'description' => 'Visualizar el historial de los moviminetos',
            'description_english' => 'View movement history',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Visualizar notificaiones movimientos
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.movements.notification'], [
            'name' => 'Visualizar notificaiones movimientos',
            'description' => 'Puede ver las notificaciones de los movimientos pendientes',
            'description_english' => 'You can see notifications of pending movements',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.movements.notification'], [
            'name' => 'Visualizar notificaiones movimientos',
            'description' => 'Puede ver las notificaciones de los movimientos pendientes',
            'description_english' => 'You can see notifications of pending movements',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Obtener bodegas
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.movements.getwarehouse'], [
            'name' => 'Obtener Bodegas',
            'description' => 'Obtener la bodegas de la unidad productiva',
            'description_english' => 'Obtain the warehouses of the productive unit',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.movements.getwarehouse'], [
            'name' => 'Obtener Bodegas',
            'description' => 'Obtener la bodegas de la unidad productiva',
            'description_english' => 'Obtain the warehouses of the productive unit',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.movements.getwarehouse'], [
            'name' => 'Obtener Bodegas',
            'description' => 'Obtener la bodegas de la unidad productiva',
            'description_english' => 'Obtain the warehouses of the productive unit',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Obtener elementos
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.movements.getelement'], [
            'name' => 'Obtener Elementos',
            'description' => 'Obtener elementos de la bodega',
            'description_english' => 'Get items from the warehouse',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.pasant.getelement'], [
            'name' => 'Obtener Elementos',
            'description' => 'Obtener elementos de la bodega',
            'description_english' => 'Get items from the warehouse',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.movements.getelement'], [
            'name' => 'Obtener Elementos',
            'description' => 'Obtener elementos de la bodega',
            'description_english' => 'Get items from the warehouse',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Obtener precio
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.movements.getprice'], [
            'name' => 'Obtener Precio',
            'description' => 'Obtener precio del elemento',
            'description_english' => 'Get item price',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.movements.getprice'], [
            'name' => 'Obtener Precio',
            'description' => 'Obtener precio del elemento',
            'description_english' => 'Get item price',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.movements.getprice'], [
            'name' => 'Obtener Precio',
            'description' => 'Obtener precio del elemento',
            'description_english' => 'Get item price',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Obtener informacion del elemento
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.movements.getinformationelement'], [
            'name' => 'Obtener informacion del elemento',
            'description' => 'Obtener informacion del elemento',
            'description_english' => 'Get item information',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.movements.getinformationelement'], [
            'name' => 'Obtener informacion del elemento',
            'description' => 'Obtener informacion del elemento',
            'description_english' => 'Get item information',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.movements.getinformationelement'], [
            'name' => 'Obtener informacion del elemento',
            'description' => 'Obtener informacion del elemento',
            'description_english' => 'Get item information',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // || Entrada ||

        // Ingresar al formulario de entrada
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.movements.entry.index'], [
            'name' => 'Formulario de entrada',
            'description' => 'Ingresar al formulario de entrada para el registro',
            'description_english' => 'Enter the registration entry form',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.movements.entry.index'], [
            'name' => 'Formulario de entrada',
            'description' => 'Ingresar al formulario de entrada para el registro',
            'description_english' => 'Enter the registration entry form',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.movements.entry.index'], [
            'name' => 'Formulario de entrada',
            'description' => 'Ingresar al formulario de entrada para el registro',
            'description_english' => 'Enter the registration entry form',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Registrar entrada
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.movements.entry.store'], [
            'name' => 'Registrar movimiento de entrada',
            'description' => 'Realizar el registro del movimiento de entrada',
            'description_english' => 'Enter the registration entry form',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.movements.entry.store'], [
            'name' => 'Registrar movimiento de entrada',
            'description' => 'Realizar el registro del movimiento de entrada',
            'description_english' => 'Enter the registration entry form',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.movements.entry.store'], [
            'name' => 'Registrar movimiento de entrada',
            'description' => 'Realizar el registro del movimiento de entrada',
            'description_english' => 'Enter the registration entry form',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;



        // || Salida ||

        // Ingresar al formulario de salida
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.movements.exit.index'], [
            'name' => 'Formulario de salida',
            'description' => 'Ingresar al formulario de salida para el registro',
            'description_english' => 'Enter the registration exit form',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.movements.exit.index'], [
            'name' => 'Formulario de salida',
            'description' => 'Ingresar al formulario de salida para el registro',
            'description_english' => 'Enter the registration exit form',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.movements.exit.index'], [
            'name' => 'Formulario de salida',
            'description' => 'Ingresar al formulario de salida para el registro',
            'description_english' => 'Enter the registration exit form',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Registrar salida
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.movements.exit.store'], [
            'name' => 'Registrar movimiento de salida',
            'description' => 'Realizar el registro del movimiento de salida',
            'description_english' => 'Enter the registration exit form',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.movements.exit.store'], [
            'name' => 'Registrar movimiento de salida',
            'description' => 'Realizar el registro del movimiento de salida',
            'description_english' => 'Enter the registration exit form',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.movements.exit.store'], [
            'name' => 'Registrar movimiento de salida',
            'description' => 'Realizar el registro del movimiento de salida',
            'description_english' => 'Enter the registration exit form',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;





        // *********************************** GESTION LABOR *************************************

        // Formulario gestion de labor
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.labormanagement.index'], [
            'name' => 'Formulario gestion de labor',
            'description' => 'Puede gestionar el registro de la labor realizada',
            'description_english' => 'You can manage the record of the work done',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;
        
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.labormanagement.index'], [
            'name' => 'Formulario gestion de labor',
            'description' => 'Puede gestionar el registro de la labor realizada',
            'description_english' => 'You can manage the record of the work done',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.labormanagement.index'], [
            'name' => 'Formulario gestion de labor',
            'description' => 'Puede gestionar el registro de la labor realizada',
            'description_english' => 'You can manage the record of the work done',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Obtener responsable
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.labormanagement.getresponsability'], [
            'name' => 'Obtener responsable',
            'description' => 'Obtener el responsable de la actividad',
            'description_english' => 'Get the person responsible for the activity',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.labormanagement.getresponsability'], [
            'name' => 'Obtener responsable',
            'description' => 'Obtener el responsable de la actividad',
            'description_english' => 'Get the person responsible for the activity',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.labormanagement.getresponsability'], [
            'name' => 'Obtener responsable',
            'description' => 'Obtener el responsable de la actividad',
            'description_english' => 'Get the person responsible for the activity',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Obtener precio
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.labormanagement.getprice'], [
            'name' => 'Obtener Precio',
            'description' => 'Obtener precio del elemento',
            'description_english' => 'Get item price',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.labormanagement.getprice'], [
            'name' => 'Obtener Precio',
            'description' => 'Obtener precio del elemento',
            'description_english' => 'Get item price',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.labormanagement.getprice'], [
            'name' => 'Obtener Precio',
            'description' => 'Obtener precio del elemento',
            'description_english' => 'Get item price',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Obtener informacion del elemento
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.labormanagement.getinformationelement'], [
            'name' => 'Obtener informacion del elemento',
            'description' => 'Obtener informacion del elemento',
            'description_english' => 'Get item information',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.labormanagement.getinformationelement'], [
            'name' => 'Obtener informacion del elemento',
            'description' => 'Obtener informacion del elemento',
            'description_english' => 'Get item information',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.labormanagement.getinformationelement'], [
            'name' => 'Obtener informacion del elemento',
            'description' => 'Obtener informacion del elemento',
            'description_english' => 'Get item information',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Obtener responsable
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.labormanagement.getsupplies'], [
            'name' => 'Obtener Insumos',
            'description' => 'Obtener insumos de la bodega',
            'description_english' => 'Obtain supplies from the warehouse',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.labormanagement.getsupplies'], [
            'name' => 'Obtener Insumos',
            'description' => 'Obtener insumos de la bodega',
            'description_english' => 'Obtain supplies from the warehouse',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.labormanagement.getsupplies'], [
            'name' => 'Obtener Insumos',
            'description' => 'Obtener insumos de la bodega',
            'description_english' => 'Obtain supplies from the warehouse',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Buscar persona
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.labormanagement.searchperson'], [
            'name' => 'Buscar Ejecutor',
            'description' => 'Obtener el ejecutor de la labor',
            'description_english' => 'Get the job executor',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.labormanagement.searchperson'], [
            'name' => 'Buscar Ejecutor',
            'description' => 'Obtener el ejecutor de la labor',
            'description_english' => 'Get the job executor',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.labormanagement.searchperson'], [
            'name' => 'Buscar Ejecutor',
            'description' => 'Obtener el ejecutor de la labor',
            'description_english' => 'Get the job executor',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Obtener precio del empleado
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.labormanagement.getpriceemploye'], [
            'name' => 'Obtener precio del ejecutor',
            'description' => 'Obtener el precio del ejecutor por hora',
            'description_english' => 'Get the performers price per hour',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.labormanagement.getpriceemploye'], [
            'name' => 'Obtener precio del ejecutor',
            'description' => 'Obtener el precio del ejecutor por hora',
            'description_english' => 'Get the performers price per hour',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.labormanagement.getpriceemploye'], [
            'name' => 'Obtener precio del ejecutor',
            'description' => 'Obtener el precio del ejecutor por hora',
            'description_english' => 'Get the performers price per hour',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Obtener informacion del cultivo
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.labormanagement.getcropinformation'], [
            'name' => 'Obtener informacion del cultivo',
            'description' => 'Obtener la informacion de cultivo',
            'description_english' => 'Get cultivation information',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.labormanagement.getcropinformation'], [
            'name' => 'Obtener informacion del cultivo',
            'description' => 'Obtener la informacion de cultivo',
            'description_english' => 'Get cultivation information',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.labormanagement.getcropinformation'], [
            'name' => 'Obtener informacion del cultivo',
            'description' => 'Obtener la informacion de cultivo',
            'description_english' => 'Get cultivation information',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Registrar labor
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.labormanagement.store'], [
            'name' => 'Registrar Labor',
            'description' => 'Realizar el registro de la labor',
            'description_english' => 'Record the work',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.labormanagement.store'], [
            'name' => 'Registrar Labor',
            'description' => 'Realizar el registro de la labor',
            'description_english' => 'Record the work',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.labormanagement.store'], [
            'name' => 'Registrar Labor',
            'description' => 'Realizar el registro de la labor',
            'description_english' => 'Record the work',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Obtener aspectos ambientales
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.labormanagement.obtenerAspectosAmbientales'], [
            'name' => 'Obtener aspectos ambientales',
            'description' => 'Obtener los aspectos ambientales segun la actividad',
            'description_english' => 'Obtain the environmental aspects according to the activity',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.labormanagement.obtenerAspectosAmbientales'], [
            'name' => 'Obtener aspectos ambientales',
            'description' => 'Obtener los aspectos ambientales segun la actividad',
            'description_english' => 'Obtain the environmental aspects according to the activity',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.labormanagement.obtenerAspectosAmbientales'], [
            'name' => 'Obtener aspectos ambientales',
            'description' => 'Obtener los aspectos ambientales segun la actividad',
            'description_english' => 'Obtain the environmental aspects according to the activity',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Mostrar aspectos ambientales
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.labormanagement.mostrarAspectosAmbientales'], [
            'name' => 'Mostrar aspectos ambientales',
            'description' => 'Mostrar los aspectos ambientales segun la actividad',
            'description_english' => 'Obtain the environmental aspects according to the activity',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.labormanagement.mostrarAspectosAmbientales'], [
            'name' => 'Mostrar aspectos ambientales',
            'description' => 'Mostrar los aspectos ambientales segun la actividad',
            'description_english' => 'Obtain the environmental aspects according to the activity',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.labormanagement.mostrarAspectosAmbientales'], [
            'name' => 'Mostrar aspectos ambientales',
            'description' => 'Mostrar los aspectos ambientales segun la actividad',
            'description_english' => 'Obtain the environmental aspects according to the activity',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.labormanagement.activityType'], [
            'name' => 'Consultar tipo de actividad',
            'description' => 'Consultar tipo de actividad',
            'description_english' => 'Check type of activity',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;
        $permissions_passant[] = $permission->id;
        $permissions_manageragricultural[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.labormanagement.warehouseUnits'], [
            'name' => 'Consultar Bodegas',
            'description' => 'Consultar bodegas segun la unidad',
            'description_english' => 'Consult warehouses according to the unit',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;
        $permissions_passant[] = $permission->id;
        $permissions_manageragricultural[] = $permission->id;




        // *********************************** REPORTES *************************************

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

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.reports.index'], [
            'name' => 'Visualizacion y Descarga de Reportes',
            'description' => 'Puede ver y descargar los diferentes reportes del sector agricola del cefa',
            'description_english' => 'You can see and download the different reports of the agricultural sector of Cefa',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;


        // || Consumos ||

        // Visualizar reporte consumo
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.reports.consumable.index'], [
            'name' => 'Visualizar vista de reporte consumo',
            'description' => 'Visualizar vista de reporte consumo para la consulta',
            'description_english' => 'View consumption report view for the query',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.reports.consumable.index'], [
            'name' => 'Visualizar vista de reporte consumo',
            'description' => 'Visualizar vista de reporte consumo para la consulta',
            'description_english' => 'View consumption report view for the query',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.reports.consumable.index'], [
            'name' => 'Visualizar vista de reporte consumo',
            'description' => 'Visualizar vista de reporte consumo para la consulta',
            'description_english' => 'View consumption report view for the query',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

         // Obtener cultivo por lote
         $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.reports.consumable.getCropsBylot'], [
            'name' => 'Obtener cultivo',
            'description' => 'Obtener cultivo segun el lote',
            'description_english' => 'Obtain crop according to the lot',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.reports.consumable.getCropsBylot'], [
            'name' => 'Obtener cultivo',
            'description' => 'Obtener cultivo segun el lote',
            'description_english' => 'Obtain crop according to the lot',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.reports.consumable.getCropsBylot'], [
            'name' => 'Obtener cultivo',
            'description' => 'Obtener cultivo segun el lote',
            'description_english' => 'Obtain crop according to the lot',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Resultados del reporte
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.reports.consumable.resultreport'], [
            'name' => 'Resultado reporte de consumo',
            'description' => 'Visualizar resultados del reporte de consumo',
            'description_english' => 'View consumption report results',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;
        
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.reports.consumable.resultreport'], [
            'name' => 'Resultado reporte de consumo',
            'description' => 'Visualizar resultados del reporte de consumo',
            'description_english' => 'View consumption report results',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.reports.consumable.resultreport'], [
            'name' => 'Resultado reporte de consumo',
            'description' => 'Visualizar resultados del reporte de consumo',
            'description_english' => 'View consumption report results',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;



        // || Labor ||

        // Visualizar reporte labor
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.reports.labor.index'], [
            'name' => 'Visualizar vista de reporte labor',
            'description' => 'Visualizar vista de reporte labor para la consulta',
            'description_english' => 'View consumption report view for the query',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.reports.labor.index'], [
            'name' => 'Visualizar vista de reporte labor',
            'description' => 'Visualizar vista de reporte labor para la consulta',
            'description_english' => 'View consumption report view for the query',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.reports.labor.index'], [
            'name' => 'Visualizar vista de reporte labor',
            'description' => 'Visualizar vista de reporte labor para la consulta',
            'description_english' => 'View consumption report view for the query',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        // Filtrar labor
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.reports.filterlabor'], [
            'name' => 'Filtrar labores',
            'description' => 'Filtrar las labores segun el cultivo',
            'description_english' => 'Filter the tasks according to the crop',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;
        $permissions_passant[] = $permission->id;
        $permissions_manageragricultural[] = $permission->id;

         // Obtener detalle de la labor
         $permission = Permission::updateOrCreate(['slug' => 'agrocefa.reports.laborDetails'], [
            'name' => 'Obtener detalles labor',
            'description' => 'Obtener detalles de la labor',
            'description_english' => 'Get job details',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;
        $permissions_passant[] = $permission->id;
        $permissions_manageragricultural[] = $permission->id;

        // Generar reporte labor
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.reports.laborpdf'], [
            'name' => 'Generar pdf reporte labor',
            'description' => 'Generar y descargar pdf de reporte labor',
            'description_english' => 'Generate and download pdf of labor report',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;
        $permissions_passant[] = $permission->id;
        $permissions_manageragricultural[] = $permission->id;


        // || Produccion ||

        // Visualizar reporte produccion
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.reports.production.index'], [
            'name' => 'Visualizar vista de reporte produccion',
            'description' => 'Visualizar vista de reporte produccion para la consulta',
            'description_english' => 'View consumption report view for the query',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.reports.production.index'], [
            'name' => 'Visualizar vista de reporte produccion',
            'description' => 'Visualizar vista de reporte produccion para la consulta',
            'description_english' => 'View consumption report view for the query',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.reports.production.index'], [
            'name' => 'Visualizar vista de reporte produccion',
            'description' => 'Visualizar vista de reporte produccion para la consulta',
            'description_english' => 'View consumption report view for the query',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.reports.filterproduction'], [
            'name' => 'Filtro Produccion',
            'description' => 'Filtrar las producciones del cultivo',
            'description_english' => 'Filter crop productions',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;
        $permissions_passant[] = $permission->id;
        $permissions_manageragricultural[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.reports.resultproduction'], [
            'name' => 'Obtener resultados produccion',
            'description' => 'Obtener los resultados de la produccion',
            'description_english' => 'Obtain production results',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;
        $permissions_passant[] = $permission->id;
        $permissions_manageragricultural[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.reports.productionpdf'], [
            'name' => 'Generar pdf produccion',
            'description' => 'Generar y descargar el pdf de producciones',
            'description_english' => 'Generate and download the pdf of productions',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;
        $permissions_passant[] = $permission->id;
        $permissions_manageragricultural[] = $permission->id;



        // || Balance ||

        // Visualizar reporte balance
        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.trainer.reports.balance.index'], [
            'name' => 'Visualizar vista de reporte balance',
            'description' => 'Visualizar vista de reporte balance para la consulta',
            'description_english' => 'View consumption report view for the query',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.passant.reports.balance.index'], [
            'name' => 'Visualizar vista de reporte balance',
            'description' => 'Visualizar vista de reporte balance para la consulta',
            'description_english' => 'View consumption report view for the query',
            'app_id' => $app->id
        ]);
        $permissions_passant[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.manageragricultural.reports.balance.index'], [
            'name' => 'Visualizar vista de reporte balance',
            'description' => 'Visualizar vista de reporte balance para la consulta',
            'description_english' => 'View consumption report view for the query',
            'app_id' => $app->id
        ]);
        $permissions_manageragricultural[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.reports.filterbalance'], [
            'name' => 'Filtro balance',
            'description' => 'Filtrar el balance del cultivo',
            'description_english' => 'Filter crop balance',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;
        $permissions_passant[] = $permission->id;
        $permissions_manageragricultural[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'agrocefa.reports.balancepdf'], [
            'name' => 'Generar pdf balance',
            'description' => 'Generar y descargar el pdf de balance',
            'description_english' => 'Generate and download the pdf of balances',
            'app_id' => $app->id
        ]);
        $permissions_trainer[] = $permission->id;
        $permissions_passant[] = $permission->id;
        $permissions_manageragricultural[] = $permission->id;


        


        
        // Consulta de ROLES
        $rol_trainer = Role::where('slug', 'agrocefa.trainer')->first();
        $rol_passant = Role::where('slug', 'agrocefa.passant')->first();
        $rol_manageragricultural = Role::where('slug', 'agrocefa.manageragricultural')->first();

        // Asignación de permisos para roles
        $rol_trainer->permissions()->syncWithoutDetaching($permissions_trainer);
        $rol_passant->permissions()->syncWithoutDetaching($permissions_passant);
        $rol_manageragricultural->permissions()->syncWithoutDetaching($permissions_manageragricultural);
    }
}
