<?php

namespace Modules\HANGARAUTO\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $permissions_admin = []; 
        $permissions_charge = []; 
        $permissions_driver = []; 


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name','HANGARAUTO')->first();

        // Vista principal de Conductores
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.index'], [ // Registro o actualización de permiso
            'name' => 'Ingresar al rol Administrador',
            'description' => 'Acceder al rol Administrador',
            'description_english' => 'Access the Administrator role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de Conductores
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.index'], [ // Registro o actualización de permiso
            'name' => 'Ingresar al rol Encargado',
            'description' => 'Acceder al rol Encargado',
            'description_english' => 'Access the Charge role',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol
        
        // Vista principal de Conductores
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.drivers'], [ // Registro o actualización de permiso
            'name' => 'Vista principal del Conductores',
            'description' => 'Ver la vista principal de Conductores',
            'description_english' => 'See the main view of Drivers',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista formulario del conductor
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.drivers.create'], [ // Registro o actualización de permiso
            'name' => 'Vista de formulario de registro del conductor',
            'description' => 'Acceder al formulario de registro del conductor',
            'description_english' => 'Access the driver registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista formulario del conductor
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.drivers.edit'], [ // Registro o actualización de permiso
            'name' => 'Editar el conductor',
            'description' => 'Editar la informacion del conductor',
            'description_english' => 'Edit driver information',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista formulario del conductor
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.drivers.search'], [ // Registro o actualización de permiso
            'name' => 'Buscar la persona para el registro de conductor',
            'description' => 'Realizar la busqueda de la persona para registrarla como conductor',
            'description_english' => 'Search for the person to register them as a driver',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista formulario del conductor
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.drivers.searchedit'], [ // Registro o actualización de permiso
            'name' => 'Buscar la persona para la actualizacion del conductor',
            'description' => 'Realizar la busqueda de la persona para actualizarla como conductor',
            'description_english' => 'Search for the person to update them as a driver',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista formulario del conductor
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.drivers.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar Conductor',
            'description' => 'Accion de actualizar el conductor',
            'description_english' => 'Driver update action',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        
        // Vista formulario del conductor
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.drivers.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar el conductor',
            'description' => 'Eliminacion de el conductor',
            'description_english' => 'Driver removal',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista formulario del conductor
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.drivervehicles'], [ // Registro o actualización de permiso
            'name' => 'Vista Conductores Vehiculos',
            'description' => 'Acceder a la vista conductores vehiculos',
            'description_english' => 'Access the vehicle driver view',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.drivervehicles.add'], [ // Registro o actualización de permiso
            'name' => 'Agregar Conductores Vehiculos',
            'description' => 'Agregar conductores vehiculos',
            'description_english' => 'Add Driver Vehicle',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.drivervehicles.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Conductores Vehiculos',
            'description' => 'Eliminar conductores vehiculos',
            'description_english' => 'Delete Driver Vehicle',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol


        // Vista principal de Vehiculos
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.vehicles'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Vehiculos',
            'description' => 'Ver la vista principal de Vehiculos',
            'description_english' => 'See the main view of Vehicles',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.vehicles.store'], [ // Registro o actualización de permiso
            'name' => 'Registro del Vehiculo',
            'description' => 'Registro del vehiculo',
            'description_english' => 'Vehicle registration',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.vehicles.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de editar',
            'description' => 'Acceder al formulario de edicion',
            'description_english' => 'Access the editing form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.vehicles.update'], [ // Registro o actualización de permiso
            'name' => 'Edicion del Vehiculo',
            'description' => 'Editar del vehiculo',
            'description_english' => 'Vehicle edit',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.vehicles.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar el vehiculo',
            'description' => 'Eliminacion del vehiculo',
            'description_english' => 'Vehicle removal',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        
        // Vista principal de Tecnomecanica
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.tecnomecanica'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Tecnomecanica',
            'description' => 'Ver la vista principal de tecnomecanica',
            'description_english' => 'See the main view of tecnomechanic',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.tecnomecanica'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Tecnomecanica',
            'description' => 'Ver la vista principal de tecnomecanica',
            'description_english' => 'See the main view of tecnomechanic',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.tecnomecanica.add'], [ // Registro o actualización de permiso
            'name' => 'Registro de Tecnomecanica',
            'description' => 'Registro de tecnomecanica',
            'description_english' => 'tecnomechanic regitration',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.tecnomecanica.add'], [ // Registro o actualización de permiso
            'name' => 'Registro de Tecnomecanica',
            'description' => 'Registro de tecnomecanica',
            'description_english' => 'tecnomechanic regitration',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.tecnomecanica.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de Editar de Tecnomecanica',
            'description' => 'Formulario de Editar tecnomecanica',
            'description_english' => 'tecnomechanic edit form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.tecnomecanica.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de Editar Tecnomecanica',
            'description' => 'Formulario de Editar tecnomecanica',
            'description_english' => 'tecnomechanic edit form',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.tecnomecanica.update'], [ // Registro o actualización de permiso
            'name' => 'Edicion de Tecnomecanica',
            'description' => 'Editar tecnomecanica',
            'description_english' => 'tecnomechanic edit',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.tecnomecanica.update'], [ // Registro o actualización de permiso
            'name' => 'Edicion de Tecnomecanica',
            'description' => 'Editar tecnomecanica',
            'description_english' => 'tecnomechanic edit',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.tecnomecanica.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Tecnomecanica',
            'description' => 'Eliminacion de tecnomecanica',
            'description_english' => 'tecnomechanic removal',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.tecnomecanica.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Tecnomecanica',
            'description' => 'Eliminacion de tecnomecanica',
            'description_english' => 'tecnomechanic removal',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.tecnomecanica.notification'], [ // Registro o actualización de permiso
            'name' => 'Notificacion Vencimiento de Tecnomecanica',
            'description' => 'Mostrar vencimiento de tecnomecanicas',
            'description_english' => 'Show expiration of technomechanics',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.tecnomecanica.notification'], [ // Registro o actualización de permiso
            'name' => 'Notificacion Vencimiento de Tecnomecanica',
            'description' => 'Mostrar vencimiento de tecnomecanicas',
            'description_english' => 'Show expiration of technomechanics',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de Soat
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.soat'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Soat',
            'description' => 'Ver la vista principal del soat',
            'description_english' => 'See the main view of soat',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.soat'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Soat',
            'description' => 'Ver la vista principal del soat',
            'description_english' => 'See the main view of soat',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.soat.add'], [ // Registro o actualización de permiso
            'name' => 'Registro de Soat',
            'description' => 'Registro de soat',
            'description_english' => 'soat regitration',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.soat.add'], [ // Registro o actualización de permiso
            'name' => 'Registro de Soat',
            'description' => 'Registro de soat',
            'description_english' => 'soat regitration',
            'app_id' => $app->id
        ]);

        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.soat.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de Editar de Soat',
            'description' => 'Formulario de Editar soat',
            'description_english' => 'soat edit form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.soat.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de Editar Soat',
            'description' => 'Formulario de Editar soat',
            'description_english' => 'soat edit form',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.soat.update'], [ // Registro o actualización de permiso
            'name' => 'Edicion del Soat',
            'description' => 'Editar soat',
            'description_english' => 'soat edit',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.soat.update'], [ // Registro o actualización de permiso
            'name' => 'Edicion del Soat',
            'description' => 'Editar soat',
            'description_english' => 'soat edit',
            'app_id' => $app->id
        ]);

        $permissions_charge[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.soat.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar el Soat',
            'description' => 'Eliminacion de soat',
            'description_english' => 'soat removal',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.soat.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar el Soat',
            'description' => 'Eliminacion de soat',
            'description_english' => 'soat removal',
            'app_id' => $app->id
        ]);

        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.soat.notification'], [ // Registro o actualización de permiso
            'name' => 'Notificacion Vencimiento de Soat',
            'description' => 'Mostrar vencimiento de soats',
            'description_english' => 'Show expiration of soats',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.soat.notification'], [ // Registro o actualización de permiso
            'name' => 'Notificacion Vencimiento de Soat',
            'description' => 'Mostrar vencimiento de soats',
            'description_english' => 'Show expiration of soats',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de Consumo
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.consumo'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Consumo',
            'description' => 'Ver la vista principal del consumo',
            'description_english' => 'See the main view of consumption',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        
        

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.consumo'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Consumo',
            'description' => 'Ver la vista principal del consumo',
            'description_english' => 'See the main view of consumption',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.consumo'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Consumo',
            'description' => 'Ver la vista principal del consumo',
            'description_english' => 'See the main view of consumption',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.consumo.add'], [ // Registro o actualización de permiso
            'name' => 'Registro de Consumo',
            'description' => 'Registro de consumo',
            'description_english' => 'consumption regitration',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.consumo.add'], [ // Registro o actualización de permiso
            'name' => 'Registro de Consumo',
            'description' => 'Registro de consumo',
            'description_english' => 'consumption regitration',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.consumo.add'], [ // Registro o actualización de permiso
            'name' => 'Registro de Consumo',
            'description' => 'Registro de consumo',
            'description_english' => 'consumption regitration',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.consumo.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de Editar de Consumo',
            'description' => 'Formulario de Editar consumo',
            'description_english' => 'consumo edit form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.consumo.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de Editar Consumo',
            'description' => 'Formulario de Editar consumo',
            'description_english' => 'consumo edit form',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.consumo.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de Editar Consumo',
            'description' => 'Formulario de Editar consumo',
            'description_english' => 'consumo edit form',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.consumo.update'], [ // Registro o actualización de permiso
            'name' => 'Edicion del Consumo',
            'description' => 'Editar consumo',
            'description_english' => 'consumo edit',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.consumo.update'], [ // Registro o actualización de permiso
            'name' => 'Edicion del Consumo',
            'description' => 'Editar consumo',
            'description_english' => 'consumo edit',
            'app_id' => $app->id
        ]);

        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.consumo.update'], [ // Registro o actualización de permiso
            'name' => 'Edicion del Consumo',
            'description' => 'Editar consumo',
            'description_english' => 'consumo edit',
            'app_id' => $app->id
        ]);

        $permissions_driver[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.consumo.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar el consumo',
            'description' => 'Eliminacion de Consumo',
            'description_english' => 'consumption removal',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.consumo.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar el consumo',
            'description' => 'Eliminacion de Consumo',
            'description_english' => 'consumption removal',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.consumo.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar el consumo',
            'description' => 'Eliminacion de Consumo',
            'description_english' => 'consumption removal',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.vehicles.report.index'], [ // Registro o actualización de permiso
            'name' => 'Vista Reporte de Vehiculo',
            'description' => 'Acceso a la vista para observar el reporte del vehiculo',
            'description_english' => 'Access to view to observe the vehicle report',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.vehicles.report.index'], [ // Registro o actualización de permiso
            'name' => 'Vista Reporte de Vehiculo',
            'description' => 'Acceso a la vista para observar el reporte del vehiculo',
            'description_english' => 'Access to view to observe the vehicle report',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.vehicles.report.index'], [ // Registro o actualización de permiso
            'name' => 'Vista Reporte de Vehiculo',
            'description' => 'Acceso a la vista para observar el reporte del vehiculo',
            'description_english' => 'Access to view to observe the vehicle report',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.vehicles.report.search'], [ // Registro o actualización de permiso
            'name' => 'Buscar Reporte de Vehiculo',
            'description' => 'Acceso a la vista para observar el reporte del vehiculo',
            'description_english' => 'Access to view to observe the vehicle report',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.vehicles.report.search'], [ // Registro o actualización de permiso
            'name' => 'Buscar Reporte de Vehiculo',
            'description' => 'Acceso a la vista para observar el reporte del vehiculo',
            'description_english' => 'Access to view to observe the vehicle report',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.vehicles.report.search'], [ // Registro o actualización de permiso
            'name' => 'Buscar Reporte de Vehiculo',
            'description' => 'Acceso a la vista para observar el reporte del vehiculo',
            'description_english' => 'Access to view to observe the vehicle report',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.petitions'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Peticiones',
            'description' => 'Ver la vista principal de peticiones',
            'description_english' => 'See the main view of petitions',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.petitions'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Peticiones',
            'description' => 'Ver la vista principal de peticiones',
            'description_english' => 'See the main view of petitions',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.petitions'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Peticiones',
            'description' => 'Ver la vista principal de peticiones',
            'description_english' => 'See the main view of petitions',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol
        
    
        
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.petitions.deny'], [ // Registro o actualización de permiso
            'name' => 'Denegar Solicitud',
            'description' => 'Aprobar la solicitud de prestamo de vehiculo',
            'description_english' => 'Deny the vehicle loan application',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.petitions.deny'], [ // Registro o actualización de permiso
            'name' => 'Denegar Solicitud',
            'description' => 'Aprobar la solicitud de prestamo de vehiculo',
            'description_english' => 'Deny the vehicle loan application',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.petitions.deny'], [ // Registro o actualización de permiso
            'name' => 'Denegar Solicitud',
            'description' => 'Aprobar la solicitud de prestamo de vehiculo',
            'description_english' => 'Deny the vehicle loan application',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol
        
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.petitions.assign'], [ // Registro o actualización de permiso
            'name' => 'Botones de asignacion',
            'description' => 'Mostrar botones de asignacion',
            'description_english' => 'Show assignment buttons',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.petitions.assign.index'], [ // Registro o actualización de permiso
            'name' => 'Formulario para asignar vehiculo y conductor',
            'description' => 'Acceder al formulario de asignacion',
            'description_english' => 'Access the assignment form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.petitions.assign.add'], [ // Registro o actualización de permiso
            'name' => 'Accion de asignar vehiculo y conductor',
            'description' => 'Asignar vehiculo y conductar a la peticion o ruta',
            'description_english' => 'Assign vehicle and drive to the request or route',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.petitions.assign'], [ // Registro o actualización de permiso
            'name' => 'Botones de asignacion',
            'description' => 'Mostrar botones de asignacion',
            'description_english' => 'Show assignment buttons',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.petitions.assign.index'], [ // Registro o actualización de permiso
            'name' => 'Formulario para asignar vehiculo y conductor',
            'description' => 'Acceder al formulario de asignacion',
            'description_english' => 'Access the assignment form',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol
        
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.petitions.assign.add'], [ // Registro o actualización de permiso
            'name' => 'Accion de asignar vehiculo y conductor',
            'description' => 'Asignar vehiculo y conductar a la peticion o ruta',
            'description_english' => 'Assign vehicle and drive to the request or route',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.petitions.assign'], [ // Registro o actualización de permiso
            'name' => 'Botones de asignacion',
            'description' => 'Mostrar botones de asignacion',
            'description_english' => 'Show assignment buttons',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.petitions.confirmation'], [ // Registro o actualización de permiso
            'name' => 'Confirmar la ruta',
            'description' => 'Accion de confirmar la ruta',
            'description_english' => 'Action to confirm the route',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.check'], [ // Registro o actualización de permiso
            'name' => 'Vista de Chequeo',
            'description' => 'Acceder a la vista de chequeo',
            'description_english' => 'Access the checkup view',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.check.add.index'], [ // Registro o actualización de permiso
            'name' => 'Boton Agregar',
            'description' => 'Acceder al formulario de agregar chequeo',
            'description_english' => 'Access the add check form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.check.add'], [ // Registro o actualización de permiso
            'name' => 'Agregar Chequeo',
            'description' => 'Agregar Chequeo',
            'description_english' => 'Add Check',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.check.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar Chequeo',
            'description' => 'Actualizar Chequeo',
            'description_english' => 'Update Check',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.check.edit'], [ // Registro o actualización de permiso
            'name' => 'Boton de Editar',
            'description' => 'Mostrar el boton de editar',
            'description_english' => 'Show the edit button',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.check.delete'], [ // Registro o actualización de permiso
            'name' => 'Boton de Eliminar',
            'description' => 'Mostrar el boton de eliminar',
            'description_english' => 'Show the delete button',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.check'], [ // Registro o actualización de permiso
            'name' => 'Vista de Chequeo',
            'description' => 'Acceder a la vista de chequeo',
            'description_english' => 'Access the checkup view',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol
        
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.check.add.index'], [ // Registro o actualización de permiso
            'name' => 'Boton Agregar',
            'description' => 'Acceder al formulario de agregar chequeo',
            'description_english' => 'Access the add check form',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.check.add'], [ // Registro o actualización de permiso
            'name' => 'Agregar Chequeo',
            'description' => 'Agregar Chequeo',
            'description_english' => 'Add Check',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol
        
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.check.edit'], [ // Registro o actualización de permiso
            'name' => 'Boton de Editar',
            'description' => 'Mostrar el boton de editar',
            'description_english' => 'Show the edit button',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.check.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar Chequeo',
            'description' => 'Actualizar Chequeo',
            'description_english' => 'Update Check',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol
        
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.check.delete'], [ // Registro o actualización de permiso
            'name' => 'Boton de Eliminar',
            'description' => 'Mostrar el boton de eliminar',
            'description_english' => 'Show the delete button',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.check'], [ // Registro o actualización de permiso
            'name' => 'Vista de Chequeo',
            'description' => 'Acceder a la vista de chequeo',
            'description_english' => 'Access the checkup view',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.check.add.index'], [ // Registro o actualización de permiso
            'name' => 'Boton Agregar',
            'description' => 'Acceder al formulario de agregar chequeo',
            'description_english' => 'Access the add check form',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.check.add'], [ // Registro o actualización de permiso
            'name' => 'Agregar Chequeo',
            'description' => 'Agregar Chequeo',
            'description_english' => 'Add Check',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol
        
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.check.edit'], [ // Registro o actualización de permiso
            'name' => 'Boton de Editar',
            'description' => 'Mostrar el boton de editar',
            'description_english' => 'Show the edit button',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.check.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar Chequeo',
            'description' => 'Actualizar Chequeo',
            'description_english' => 'Update Check',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol
        
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.check.delete'], [ // Registro o actualización de permiso
            'name' => 'Boton de Eliminar',
            'description' => 'Mostrar el boton de eliminar',
            'description_english' => 'Show the delete button',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.driver.index'], [ // Registro o actualización de permiso
            'name' => 'Rol conductor',
            'description' => 'Acceder al rol conductor',
            'description_english' => 'Access the driving role',
            'app_id' => $app->id
        ]);
        $permissions_driver[] = $permission->id; // Almacenar permiso para rol

        
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.petitions.add.index'], [ // Registro o actualización de permiso
            'name' => 'Boton Solicitar',
            'description' => 'Acceder al formulario de solicitar',
            'description_english' => 'Access the request form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.petitions.add'], [ // Registro o actualización de permiso
            'name' => 'Accion Solicitar',
            'description' => 'Solicitar vehiculo',
            'description_english' => 'Request vehicle',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.petitions.add.index'], [ // Registro o actualización de permiso
            'name' => 'Boton Solicitar',
            'description' => 'Acceder al formulario de solicitar',
            'description_english' => 'Access the request form',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.petitions.add'], [ // Registro o actualización de permiso
            'name' => 'Accion Solicitar',
            'description' => 'Solicitar vehiculo',
            'description_english' => 'Request vehicle',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.fueltype'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Tipo de Combustible',
            'description' => 'Ver la vista principal del tipo de combustible',
            'description_english' => 'See the main view of fueltype',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.fueltype'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Tipo de Combustible',
            'description' => 'Ver la vista principal del tipo de combustible',
            'description_english' => 'See the main view of fueltype',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.fueltype.add'], [ // Registro o actualización de permiso
            'name' => 'Registro de Tipo de Combustible',
            'description' => 'Registro de tipo de combustible',
            'description_english' => 'fueltype regitration',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.fueltype.add'], [ // Registro o actualización de permiso
            'name' => 'Registro de Tipo de Combustible',
            'description' => 'Registro de tipo de combustible',
            'description_english' => 'fueltype regitration',
            'app_id' => $app->id
        ]);

        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.fueltype.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de Edicion del Tipo de Combustible',
            'description' => 'Formulario de Editar tipo de combustible',
            'description_english' => 'fueltype edit form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.fueltype.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de Edicion del Tipo de Combustible',
            'description' => 'Formulario de Editar tipo de combustible',
            'description_english' => 'fueltype edit form',
            'app_id' => $app->id
        ]);

        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.fueltype.update'], [ // Registro o actualización de permiso
            'name' => 'Edicion del Tipo de Combustible',
            'description' => 'Editar tipo de combustible',
            'description_english' => 'fueltype edit',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.fueltype.update'], [ // Registro o actualización de permiso
            'name' => 'Edicion del Tipo de Combustible',
            'description' => 'Editar tipo de combustible',
            'description_english' => 'fueltype edit',
            'app_id' => $app->id
        ]);

        $permissions_charge[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.fueltype.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar el Tipo de Combustible',
            'description' => 'Eliminacion de tipo de combustible',
            'description_english' => 'fueltype removal',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.fueltype.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar el Tipo de Combustible',
            'description' => 'Eliminacion de tipo de combustible',
            'description_english' => 'fueltype removal',
            'app_id' => $app->id
        ]);

        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.vehicletype'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Tipo de Vehiculo',
            'description' => 'Ver la vista principal del tipo de vehiculo',
            'description_english' => 'See the main view of vehicletype',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.vehicletype'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de Tipo de Vehiculo',
            'description' => 'Ver la vista principal del tipo de vehiculo',
            'description_english' => 'See the main view of vehicletype',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.vehicletype.add'], [ // Registro o actualización de permiso
            'name' => 'Registro de Tipo de Vehiculo',
            'description' => 'Registro de tipo de vehiculo',
            'description_english' => 'vehicletype regitration',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.vehicletype.add'], [ // Registro o actualización de permiso
            'name' => 'Registro de Tipo de Vehiculo',
            'description' => 'Registro de tipo de vehiculo',
            'description_english' => 'vehicletype regitration',
            'app_id' => $app->id
        ]);

        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.vehicletype.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de Edicion del Tipo de Vehiculo',
            'description' => 'Formulario de Editar tipo de vehiculo',
            'description_english' => 'vehicletype edit form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.vehicletype.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de Edicion del Tipo de Vehiculo',
            'description' => 'Formulario de Editar tipo de vehiculo',
            'description_english' => 'vehicletype edit form',
            'app_id' => $app->id
        ]);

        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.vehicletype.update'], [ // Registro o actualización de permiso
            'name' => 'Edicion del Tipo de Vehiculo',
            'description' => 'Editar tipo de vehiculo',
            'description_english' => 'vehicletype edit',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.vehicletype.update'], [ // Registro o actualización de permiso
            'name' => 'Edicion del Tipo de Vehiculo',
            'description' => 'Editar tipo de vehiculo',
            'description_english' => 'vehicletype edit',
            'app_id' => $app->id
        ]);

        $permissions_charge[] = $permission->id; // Almacenar permiso para rol


        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.vehicletype.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar el Tipo de Vehiculo',
            'description' => 'Eliminacion de tipo de vehiculo',
            'description_english' => 'vehicletype removal',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.charge.vehicletype.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar el Tipo de Vehiculo',
            'description' => 'Eliminacion de tipo de vehiculo',
            'description_english' => 'vehicletype removal',
            'app_id' => $app->id
        ]);

        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        


        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'hangarauto.admin')->first(); // Rol Administrador
        $rol_charge = Role::where('slug', 'hangarauto.charge')->first(); // Rol Operador de Cajero
        $rol_driver = Role::where('slug', 'hangarauto.driver')->first(); // Rol Operador de Cajero

        // Asignación de PERMISOS para los ROLES de la aplicación PTVENTA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()-> syncWithoutDetaching($permissions_admin);
        $rol_charge->permissions()-> syncWithoutDetaching($permissions_charge);
        $rol_driver->permissions()-> syncWithoutDetaching($permissions_driver);
    }
}
