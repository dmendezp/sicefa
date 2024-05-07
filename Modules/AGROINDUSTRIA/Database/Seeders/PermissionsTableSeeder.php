<?php

namespace Modules\AGROINDUSTRIA\Database\Seeders;

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
        $permission_admin = []; // Permisos para Administrador
        $permission_storer = []; // Permisos para Almacenista
        $permission_instructor = []; // Permisos para Instrucor

        $app = App::where('name','AGROINDUSTRIA')->first();
        
        // Registro de todos los permisos para la aplicacion de AGROINDUSTRIA //
        // Unidades productivas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units'], [
            'name' => 'Ver unidades productivas',
            'description' => 'Puede ver las unidades productivas (Administrador)',
            'description_english' => 'You can see the productive units',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ver vista de bajas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.remove.view'], [
            'name' => 'Vista de bajas',
            'description' => 'Puede ver las bajas de insumos.',
            'description_english' => 'You can see the decreases in inputs.',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Dar baja a un producto (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.remove.create'], [
            'name' => 'Dar baja a un insumo',
            'description' => 'Puede dar de baja a insumos de la bodega de AGROINDUSTRIA',
            'description_english' => 'You can cancel inputs from the AGROINDUSTRIA warehouse',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

         //Ver actividades (Administrador)
         $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.activity'], [
            'name' => 'Ver actividades',
            'description' => 'Puede ver las actividades de cada unidad productiva de agroindustria (Administrador)',
            'description_english' => 'You can see the activities of each productive unit of agroindustrys',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Abrir la vista de Labor (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor'], [
           'name' => 'Abrir la vista de Labor',
           'description' => 'Puede abrir la vista Labor (Administrador)',
           'description_english' => 'You can open the job view',
           'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Formulario para registrar la labor (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.form'], [
            'name' => 'Formulario para registrar la labor',
            'description' => 'Puede abrir el formulario para registrar todos los elementos y personal involucrado en la labor (Administrador)',
            'description_english' => 'You can open the form to register all the elements and personnel involved in the work',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Buscar el elemento a crear por el nombre (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.form.elements'], [
            'name' => 'Buscar elemento a crear por el nombre',
            'description' => 'Puede buscar el elemento a crear por el nombre (Administrador)',
            'description_english' => 'You can search for the item to be created by name',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

         //Buscar el responsable de la actividad (Administrador)
         $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.responsibilities'], [
            'name' => 'Buscar el responsable de la actividad',
            'description' => 'Puede buscar el responsable de la actividad (Administrador)',
            'description_english' => 'You can search for the person responsible for the activity',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Buscar el tipo de actividad (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.type'], [
            'name' => 'Buscar el tipo de actividad',
            'description' => 'Puede buscar el tipo de actividad (Administrador)',
            'description_english' => 'You can search the type of activity',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Buscar el valor del tipo de empleado (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.price'], [
            'name' => 'Buscar el valor del tipo de empleado',
            'description' => 'Puede buscar el valor del tipo de empleado (Administrador)',
            'description_english' => 'You can search the value of the employee type',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Buscar el precio de la herramienta (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.tools.price'], [
            'name' => 'Buscar el precio de la herramienta',
            'description' => 'Puede buscar el precio de la herramienta (Administrador)',
            'description_english' => 'You can search the price of the tool',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Buscar la formulación del producto a desarrollar en la labor (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.consumables'], [
            'name' => 'Buscar la formulación del producto a desarrollar en la labor',
            'description' => 'Puede buscar el producto a desarrollar en la labor (Administrador)',
            'description_english' => 'You can search for the product to be developed in the job',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Buscar la cantidad del consumible seleccionado en el inventario (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.consumables.amount'], [
            'name' => 'Buscar la cantidad del consumible seleccionado en el inventario',
            'description' => 'Puede buscar la cantidad del consumible seleccionado en el inventario (Administrador)',
            'description_english' => 'You can search the quantity of the selected consumable in the inventory',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Buscar la cantidad del consumible seleccionado en el inventario (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.equipments.amounteq'], [
            'name' => 'Buscar la cantidad del equipo seleccionado en el inventario',
            'description' => 'Puede buscar la cantidad del equipo seleccionado en el inventario (Administrador)',
            'description_english' => 'You can search the quantity of the selected equipment in the inventory',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Buscar el elemento por su nombre (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.elements'], [
            'name' => 'Buscar el elemento por su nombre',
            'description' => 'Puede buscar el elemento por su nombre (Administrador)',
            'description_english' => 'You can search for the item by name',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Buscar los colaboradores (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.executors'], [
            'name' => 'Buscar los colaboradores',
            'description' => 'Puede buscar los colaboradores por su número de documento (Administrador)',
            'description_english' => 'You can search for collaborators by their document number',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Buscar los aspectos ambientales (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.resource'], [
            'name' => 'Buscar los aspectos ambientales',
            'description' => 'Puede buscar los los aspectos ambientales de la actividad seleccionada (Administrador)',
            'description_english' => 'You can search for the environmental aspects of the selected activity',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Registrar labor (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.register'], [
            'name' => 'Registrar labor',
            'description' => 'Puede registrar la labor (Administrador)',
            'description_english' => 'You can record the work',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Registrar labor (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.update'], [
            'name' => 'Actualizar labor',
            'description' => 'Puede actualizar la labor (Administrador)',
            'description_english' => 'You can update the work',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Excel solicitud de bienes para la labor (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.excel'], [
            'name' => 'Excel solicitud de bienes para la labor',
            'description' => 'Puede generar el formato de solicitud de bienes para la labor (Administrador)',
            'description_english' => 'You can generate the goods request form for the work',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Formulario para editar la labor (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.edit'], [
            'name' => 'Formulario para editar la labor',
            'description' => 'Puede editar la labor (Administrador)',
            'description_english' => 'You can edit the job',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Cancelar la labor (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.cancel'], [
            'name' => 'Cancelar la labor',
            'description' => 'Puede cancelar la labor (Administrador)',
            'description_english' => 'You can cancel the job',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Vista de Movimientos (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.movements.table'], [
            'name' => 'Abrir vista de movimientos',
            'description' => 'Puede ver la vista de movimientos (Administrador)',
            'description_english' => 'You can see the movement view',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        
        //Formulario de Movimientos (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.movements.form'], [
            'name' => 'Abrir formulario de movimientos',
            'description' => 'Puede ver el formulario de movimientos (Administrador)',
            'description_english' => 'You can see the movement form',
            'app_id' => $app->id
        ]);
        
        $permission_admin[] = $permission->id;
        
        //Vista de Movimientos Pendientes (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.movements.pending'], [
            'name' => 'Abrir vista de movimientos pendientes',
            'description' => 'Puede ver la vista de movimientos pendientes (Administrador)',
            'description_english' => 'You can see the pending movement view',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Aprobar movimiento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.movements.pending.state'], [
            'name' => 'Aprobar movimiento',
            'description' => 'Puede aprobar el movimiento (Administrador)',
            'description_english' => 'Can approve the movement',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Cancelar movimiento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.movements.cancelled'], [
            'name' => 'Cancelar movimiento',
            'description' => 'Puede cancelar el movimiento (Administrador)',
            'description_english' => 'Can cancel the movement',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

         //Devolver movimiento (Administrador)
         $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.movements.return'], [
            'name' => 'Devolver movimiento',
            'description' => 'Puede devolver el movimiento (Administrador)',
            'description_english' => 'Can return the movement',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Buscar la cantidad disponible del elemento en el inventario (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.movements.id'], [
            'name' => 'Buscar la cantidad disponible del elemento en el inventario',
            'description' => 'Puede buscar la cantidad disponible del elemento en el inventario (Administrador)',
            'description_english' => 'You can search the available quantity of the item in the inventory',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Buscar la bodega que recibe (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.movements.warehouse'], [
            'name' => 'Buscar la bodega que recibe ',
            'description' => 'Puede buscar la bodega que recibe (Administrador)',
            'description_english' => 'You can search for the warehouse you receive',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Crear movimiento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.movements.out'], [
            'name' => 'Crear movimiento',
            'description' => 'Puede crear el movimiento (Administrador)',
            'description_english' => 'Can create movement',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Ver de produccion (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.production'], [
            'name' => 'Visualizar produccion',
            'description' => 'Puede ver la produccion de la labor realizada (Administrador)',
            'description_english' => 'You can see the production of the work done',
            'app_id' => $app->id
        ]);
        
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Ver inventario(Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.inventory'], [
            'name' => 'Abrir vista de inventario',
            'description' => 'Puede ver el inventario',
            'description_english' => 'You can see the inventory',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Ver inventario de la bodega seleccionada(Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.inventory.elements'], [
            'name' => 'Ver inventario de la bodega seleccionada',
            'description' => 'Puede ver el inventario de la bodega seleccionada (Administrador)',
            'description_english' => 'You can see the inventory of the selected warehouse',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Vista de solicitudes externas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.view.request'], [
            'name' => 'Visualizar la vista de solicitud de insumos.',
            'description' => 'Puede visualizar el la vista de solicitudes externas.',
            'description_english' => 'You can view the external requests view.',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Aprobar solicitud externa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.request.pending.state'], [
            'name' => 'Aprobar solicitud externa',
            'description' => 'Puede aprobar las solicitudes pendientes',
            'description_english' => 'You can approve pending requests',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Generar excel de la solicitud (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.request.excel'], [
            'name' => 'Generar excel de la solicitud',
            'description' => 'Puede generar excel de la solicitud (Administrador)',
            'description_english' => 'Can generate excel of the request',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Generar excel unificado de las solicitudes (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.request.excel.unified'], [
            'name' => 'Generar excel unificado de las solicitudes',
            'description' => 'Puede generar excel unificado de las solicitudes (Administrador)',
            'description_english' => 'Can generate unified excel of requests',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Cancelar solicitud (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.request.pending.cancelled'], [
            'name' => 'Cancelar solicitud',
            'description' => 'Puede cancelar la solicitud (Administrador)',
            'description_english' => 'You can cancel the request',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Ver inventario de insumos prontos a agotarse(Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.inventory.spent'], [
            'name' => 'Abrir vista de inventario de insumos prontos a agotarse',
            'description' => 'Puede ver el inventario de los insumos prontos a agotarse.',
            'description_english' => 'You can see the inventory of supplies that are soon to be sold out.',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Ver inventario de insumos prontos a caducar(Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.inventory.expire'], [
            'name' => 'Abrir vista de inventario de insumos prontos a caducar',
            'description' => 'Puede ver el inventario de los insumos prontos a caducar.',
            'description_english' => 'You can view the inventory of supplies that are about to expire.',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        // Unidades productivas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units'], [
            'name' => 'Ver unidades productivas',
            'description' => 'Puede ver las unidades productivas (Instructor)',
            'description_english' => 'You can see the productive units',
            'app_id' => $app->id
        ]);
        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Solicitud de insumos al almacenistas
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.request'], [
            'name' => 'Solicitar insumos al almacenista',
            'description' => 'Puede solicitar insumos al almacenista',
            'description_english' => 'You can request supplies from the storekeeper',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Abrir la vista de Labor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor'], [
            'name' => 'Abre la vista de Labor',
            'description' => 'Puede abrir la vista de labor (Instructor)',
            'description_english' => 'You can open the job view',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Formulario para registrar la labor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.form'], [
            'name' => 'Formulario para registrar la labor',
            'description' => 'Puede abrir el formulario para registrar todos los elementos y personal involucrado en la labor (Instructor)',
            'description_english' => 'You can open the form to register all the elements and personnel involved in the work',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Buscar el elemento a crear por el nombre (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.form.elements'], [
            'name' => 'Buscar elemento a crear por el nombre',
            'description' => 'Puede buscar el elemento a crear por el nombre (Instructor)',
            'description_english' => 'You can search for the item to be created by name',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Buscar el responsable de la actividad (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.responsibilities'], [
            'name' => 'Buscar el responsable de la actividad',
            'description' => 'Puede buscar el responsable de la actividad (Instructor)',
            'description_english' => 'You can search for the person responsible for the activity',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Buscar el tipo de actividad (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.type'], [
            'name' => 'Buscar el tipo de actividad',
            'description' => 'Puede buscar el tipo de actividad (Instructor)',
            'description_english' => 'You can search the type of activity',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Buscar el valor del tipo de empleado (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.price'], [
            'name' => 'Buscar el valor del tipo de empleado',
            'description' => 'Puede buscar el valor del tipo de empleado (Instructor)',
            'description_english' => 'You can search the value of the employee type',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Buscar el precio de la herramienta (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.tools.price'], [
            'name' => 'Buscar el precio de la herramienta',
            'description' => 'Puede buscar el precio de la herramienta (Instructor)',
            'description_english' => 'You can search the price of the tool',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Buscar la formulación del producto a desarrollar en la labor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.consumables'], [
            'name' => 'Buscar la formulación del producto a desarrollar en la labor',
            'description' => 'Puede buscar el producto a desarrollar en la labor (Instructor)',
            'description_english' => 'You can search for the product to be developed in the job',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Buscar la cantidad del consumible seleccionado en el inventario (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.consumables.amount'], [
            'name' => 'Buscar la cantidad del consumible seleccionado en el inventario',
            'description' => 'Puede buscar la cantidad del consumible seleccionado en el inventario (Instructor)',
            'description_english' => 'You can search the quantity of the selected consumable in the inventory',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Buscar la cantidad del consumible seleccionado en el inventario (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.equipments.amounteq'], [
            'name' => 'Buscar la cantidad del equipo seleccionado en el inventario',
            'description' => 'Puede buscar la cantidad del equipo seleccionado en el inventario (Instructor)',
            'description_english' => 'You can search the quantity of the selected equipment in the inventory',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Buscar el elemento por su nombre (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.elements'], [
            'name' => 'Buscar el elemento por su nombre',
            'description' => 'Puede buscar el elemento por su nombre (Instructor)',
            'description_english' => 'You can search for the item by name',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Buscar los colaboradores (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.executors'], [
            'name' => 'Buscar los colaboradores',
            'description' => 'Puede buscar los colaboradores por su número de documento (Instructor)',
            'description_english' => 'You can search for collaborators by their document number',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Buscar los aspectos ambientales (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.resource'], [
            'name' => 'Buscar los aspectos ambientales',
            'description' => 'Puede buscar los los aspectos ambientales de la actividad seleccionada (Instructor)',
            'description_english' => 'You can search for the environmental aspects of the selected activity',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Registrar labor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.register'], [
            'name' => 'Registrar labor',
            'description' => 'Puede registrar la labor (Instructor)',
            'description_english' => 'You can record the work',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Registrar labor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.update'], [
            'name' => 'Actualizar labor',
            'description' => 'Puede actualizar la labor (Instructor)',
            'description_english' => 'You can update the work',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Excel solicitud de bienes para la labor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.excel'], [
            'name' => 'Excel solicitud de bienes para la labor',
            'description' => 'Puede generar el formato de solicitud de bienes para la labor (Instructor)',
            'description_english' => 'You can generate the goods request form for the work',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Formulario para editar la labor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.edit'], [
            'name' => 'Formulario para editar la labor',
            'description' => 'Puede editar la labor (Instructor)',
            'description_english' => 'You can edit the job',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Cancelar la labor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor.cancel'], [
           'name' => 'Cancelar la labor',
           'description' => 'Puede cancelar la labor (Instructor)',
           'description_english' => 'You can cancel the job',
           'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Ver de produccion (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.production'], [
            'name' => 'Visualizar produccion',
            'description' => 'Puede ver la produccion de la labor realizada (Instructor)',
            'description_english' => 'You can see the production of the work done',
            'app_id' => $app->id
        ]);
        
        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Vista de Movimientos (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.movements.table'], [
            'name' => 'Abrir vista de movimientos',
            'description' => 'Puede ver la vista de movimientos (Instructor)',
            'description_english' => 'You can see the movement view',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;  

        //Formulario de Movimientos (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.movements.form'], [
            'name' => 'Abrir formulario de movimientos',
            'description' => 'Puede ver el formulario de movimientos (Instructor)',
            'description_english' => 'You can see the movement form',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;  

        //Vista de Movimientos Pendientes (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.movements.pending'], [
            'name' => 'Abrir vista de movimientos pendientes',
            'description' => 'Puede ver la vista de movimientos pendientes (Instructor)',
            'description_english' => 'You can see the pending movement view',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Aprobar movimiento (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.movements.pending.state'], [
            'name' => 'Aprobar movimiento',
            'description' => 'Puede aprobar el movimiento (Instructor)',
            'description_english' => 'Can approve the movement',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Cancelar movimiento (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.movements.cancelled'], [
            'name' => 'Cancelar movimiento',
            'description' => 'Puede cancelar el movimiento (Instructor)',
            'description_english' => 'Can cancel the movement',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Devolver movimiento (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.movements.return'], [
            'name' => 'Devolver movimiento',
            'description' => 'Puede devolver el movimiento (Instructor)',
            'description_english' => 'Can return the movement',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Buscar la cantidad disponible del elemento en el inventario (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.movements.id'], [
            'name' => 'Buscar la cantidad disponible del elemento en el inventario',
            'description' => 'Puede buscar la cantidad disponible del elemento en el inventario (Instructor)',
            'description_english' => 'You can search the available quantity of the item in the inventory',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Buscar la bodega que recibe (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.movements.warehouse'], [
            'name' => 'Buscar la bodega que recibe',
            'description' => 'Puede buscar la bodega que recibe (Instructor)',
            'description_english' => 'You can search for the warehouse you receive',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Crear movimiento (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.movements.out'], [
            'name' => 'Crear movimiento',
            'description' => 'Puede crear el movimiento (Instructor)',
            'description_english' => 'Can create movement',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Visualizar actividades.
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.activity'], [
            'name' => 'Ver actividades',
            'description' => 'Puede ver las actividades de cada unidad productiva de agroindustria (Instructor)',
            'description_english' => 'You can see the activities of each productive unit of agroindustrys',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Visualizar Movimientos de produccion y/o movimientos de bodegas.
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.deliveries'], [
            'name' => 'Visualizar la vista de Entregas.',
            'description' => 'Puede visualizar y/o registrar movimientos de produccion y/o de bodega.',
            'description_english' => 'You can visualize and/or register production and/or warehouse movements.',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Visualizar formulario de registro de formulaciones
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.formulations'], [
            'name' => 'Visualizar la vista de formulacion.',
            'description' => 'Puede visualizar el formulario de formulacion y hacer uso de el para crear una formulacion.',
            'description_english' => 'You can display the formulation form and use it to create a formulation.',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Buscar el elemento a crear por el nombre (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.formulations.elements'], [
            'name' => 'Buscar elemento a crear por el nombre',
            'description' => 'Puede buscar el elemento a crear por el nombre (Instructor)',
            'description_english' => 'You can search for the item to be created by name',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol
        

        //Detalles formulacion
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.formulations.details'], [
            'name' => 'Detalles de la formula o receta',
            'description' => 'Puede ver los detalles de las formulas o recetas',
            'description_english' => 'You can see the details of the formulas or recipes',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;  

        //Formulario para crear la formulacion
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.formulario'], [
            'name' => 'Formulario para crear la formulacion',
            'description' => 'Puede ver el formulario para crear la formulacion',
            'description_english' => 'You can see the form to create the formulation',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; 
        
        //Formulario para editar la formulacion
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.form.edit'], [
            'name' => 'Formulario para editar la formulacion',
            'description' => 'Puede ver el formulario para editar la formulacion',
            'description_english' => 'You can see the form to edit the formulation',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;
        
        //Guardar la formulacion
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.formulations.create'], [
            'name' => 'Guardar la formulacion',
            'description' => 'Puede guardar la formulacion',
            'description_english' => 'You can save the formulation',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; 

        //Editar la formulacion
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.formulations.update'], [
            'name' => 'Editar la formulacion',
            'description' => 'Puede editar la formulacion',
            'description_english' => 'You can update the formulation',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; 

        //Eliminar la formulacion
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.formulations.delete'], [
            'name' => 'Eliminar la formulacion',
            'description' => 'Puede eliminar la formulacion',
            'description_english' => 'You can delete the formulation',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; 

        //Vista de solicitudes externas (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.view.request'], [
            'name' => 'Visualizar la vista de solicitud de insumos.',
            'description' => 'Puede visualizar la vista de solicitudes externas.',
            'description_english' => 'You can view the external requests view.',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Formulario de solicitudes externas (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.request.form'], [
            'name' => 'Formulario de solicitudes externas.',
            'description' => 'Puede visualizar el formulario de solicitudes externas.',
            'description_english' => 'You can view the external requests view.',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Registrar solicitud externa (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.request.create'], [
            'name' => 'Registrar solicitud externa',
            'description' => 'Puede registrar la solicitud externa',
            'description_english' => 'You can register the external request',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Generar excel de la solicitud (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.request.excel'], [
            'name' => 'Generar excel de la solicitud',
            'description' => 'Puede generar excel de la solicitud (Instructor)',
            'description_english' => 'Can generate excel of the request',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Generar excel de la solicitud (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.request.excel'], [
            'name' => 'Generar excel de la solicitud',
            'description' => 'Puede generar excel de la solicitud (Instructor)',
            'description_english' => 'Can generate excel of the request',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Buscar insumo por el nombre (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.element.name'], [
            'name' => 'Buscar insumo por el nombre',
            'description' => 'Puede buscar el insumo por el nombre (Instructor)',
            'description_english' => 'You can search for the input by name',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

         //Cancelar solicitud (Instructor)
         $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.request.pending.cancelled'], [
            'name' => 'Cancelar solicitud',
            'description' => 'Puede cancelar la solicitud (Instructor)',
            'description_english' => 'You can cancel the request',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Ver inventario(Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.inventory'], [
            'name' => 'Abrir vista de inventario',
            'description' => 'Puede ver el inventario',
            'description_english' => 'You can see the inventory',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Ver inventario de la bodega seleccionada(Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.inventory.elements'], [
            'name' => 'Ver inventario de la bodega seleccionada',
            'description' => 'Puede ver el inventario de la bodega seleccionada (Instructor)',
            'description_english' => 'You can see the inventory of the selected warehouse',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Ver inventario de insumos prontos a agotarse(Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.inventory.spent'], [
            'name' => 'Abrir vista de inventario de insumos prontos a agotarse',
            'description' => 'Puede ver el inventario de los insumos prontos a agotarse.',
            'description_english' => 'You can see the inventory of supplies that are soon to be sold out.',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Ver inventario de insumos prontos a caducar(Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.inventory.expire'], [
            'name' => 'Abrir vista de inventario de insumos prontos a caducar',
            'description' => 'Puede ver el inventario de los insumos prontos a caducar.',
            'description_english' => 'You can view the inventory of supplies that are about to expire.',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Ver unidades productivas (Almacenista)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.storer.units'], [
            'name' => 'Ver unidades productivas',
            'description' => 'Puede ver las unidades productivas (Almacenista)',
            'description_english' => 'You can see the productive units',
            'app_id' => $app->id
        ]);

        $permission_storer[] = $permission->id; // Almacenar permiso para rol
        
        //Visualizar solicitudes
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.storer.units.view.request'], [
            'name' => 'Visualizar solicitudes',
            'description' => 'Puede ver las solicitudes hechas por los instructores',
            'description_english' => 'You can see the requests made by the instructors',
            'app_id' => $app->id
        ]);

        $permission_storer[] = $permission->id;

        //Ver inventario(Almacenista)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.storer.units.inventory'], [
            'name' => 'Abrir vista de inventario',
            'description' => 'Puede ver el inventario',
            'description_english' => 'You can see the inventory',
            'app_id' => $app->id
        ]);

        $permission_storer[] = $permission->id;
        
        //Ver inventario de la bodega seleccionada(Almacenista)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.storer.units.inventory.elements'], [
            'name' => 'Ver inventario de la bodega seleccionada',
            'description' => 'Puede ver el inventario con los elementos de la bodega seleccionada',
            'description_english' => 'You can see the inventory with the items from the selected warehouse',
            'app_id' => $app->id
        ]);

        $permission_storer[] = $permission->id;

        //Ver inventario de insumos prontos a agotarse(Almacenista)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.storer.units.inventory.spent'], [
            'name' => 'Abrir vista de inventario de insumos prontos a agotarse',
            'description' => 'Puede ver el inventario de los insumos prontos a agotarse.',
            'description_english' => 'You can see the inventory of supplies that are soon to be sold out.',
            'app_id' => $app->id
        ]);

        $permission_storer[] = $permission->id;

        //Ver inventario de insumos prontos a caducar(Almacenista)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.storer.units.inventory.expire'], [
            'name' => 'Abrir vista de inventario de insumos prontos a caducar',
            'description' => 'Puede ver el inventario de los insumos prontos a caducar.',
            'description_english' => 'You can view the inventory of supplies that are about to expire.',
            'app_id' => $app->id
        ]);

        $permission_storer[] = $permission->id;

        //Aprobar solicitud (Almacenista)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.storer.units.request.approve'], [
            'name' => 'Aprobar solicitud',
            'description' => 'Puede aprobar la solicitud de los insumos solicitados en la labor',
            'description_english' => 'Can approve the request for the inputs requested in the work',
            'app_id' => $app->id
        ]);

        $permission_storer[] = $permission->id;

        //Cancelar solicitud (Almacenista)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.storer.units.request.cancelled'], [
            'name' => 'Cancelar solicitud',
            'description' => 'Puede cancelar la solicitud de los insumos solicitados en la labor',
            'description_english' => 'Can cancel the request for the inputs requested in the work',
            'app_id' => $app->id
        ]);

        $permission_storer[] = $permission->id;

        $rol_admin = Role::where('slug', 'agroindustria.admin')->first(); // Rol Administrador
        $rol_instructor_vilmer = Role::where('slug', 'agroindustria.instructor.vilmer')->first(); // Rol Coordinado Académico
        $rol_instructor_chocolate = Role::where('slug', 'agroindustria.instructor.chocolate')->first(); // Rol Coordinado Académico
        $rol_instructor_cerveceria = Role::where('slug', 'agroindustria.instructor.cerveceria')->first(); // Rol Coordinado Académico
        $rol_storer = Role::where('slug', 'agroindustria.almacenista')->first(); // Rol Registro Asistencia

        // Asignación de PERMISOS para los ROLES de la aplicación AGROINDUSTRIA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()-> syncWithoutDetaching($permission_admin);
        $rol_instructor_vilmer->permissions()->syncWithoutDetaching($permission_instructor);
        $rol_instructor_chocolate->permissions()->syncWithoutDetaching($permission_instructor);
        $rol_instructor_cerveceria->permissions()->syncWithoutDetaching($permission_instructor);
        $rol_storer->permissions()->syncWithoutDetaching($permission_storer);
    }
}
