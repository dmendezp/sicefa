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
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.drivers.search'], [ // Registro o actualización de permiso
            'name' => 'Buscar la persona para el registro de conductor',
            'description' => 'Realizar la busqueda de la persona para registrarla como conductor',
            'description_english' => 'Search for the person to register them as a driver',
            'app_id' => $app->id
        ]);

        // Vista formulario del conductor
        $permission = Permission::updateOrCreate(['slug' => 'hangarauto.admin.drivers.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar el conductor',
            'description' => 'Eliminacion de el conductor',
            'description_english' => 'Driver removal',
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
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
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
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
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
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
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
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
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
        

        


        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'hangarauto.admin')->first(); // Rol Administrador
        $rol_charge = Role::where('slug', 'hangarauto.charge')->first(); // Rol Operador de Cajero

        // Asignación de PERMISOS para los ROLES de la aplicación PTVENTA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()-> syncWithoutDetaching($permissions_admin);
        $rol_charge->permissions()-> syncWithoutDetaching($permissions_charge);
    }
}
