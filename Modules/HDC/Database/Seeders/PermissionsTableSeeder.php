<?php

namespace Modules\HDC\Database\Seeders;

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
        // Definir arreglos de PERMISOS que van ser asignados a los ROLES
        $permissions_admin = []; // Permisos para Administrador
        $permissions_charge = []; // Permisos para el Encargado
        $permissions_userHDC = []; // Permisos para Calcula tu huella


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'HDC')->firstOrFail();

         // ===================== Registro de todos los permisos de la aplicación SIGAC ==================
        // PANEL DE CONTROL DEL ADMINISTRADOR (Aministrador)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.index'], [ // Registro o actualización de permiso
            'name' => 'Panel de control del administrador(Administrador)',
            'description' => 'Panel de control del administrador de HDC',
            'description_english' => "HDC Administrator Control Panel",
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        //Vista donde se almacenan los datos del registro de consumo (ADMINISTRADOR)
         $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.table'], [ // Registro o actualización de permiso
            'name' => 'Registro de Consumo(Administrador)',
            'description' => 'Registro de consumo de los aspectos ambientales generados en el centro de formación',
            'description_english' => "HDC Administrator Control Panel",
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Agregar valor del aspecto ambiental (ADMINISTRADOR)//
         $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.formulario'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede acceder a formulario registro de aspectos ambientales',
            'description_english' => 'You can access the environmental aspects register form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol


        // PANEL DE CONTROL DEL ENCARGADO (Encargado)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.index'], [ // Registro o actualización de permiso
            'name' => 'Panel de control del Encargado (Encargado)',
            'description' => 'Panel de control del encargado',
            'description_english' => "Manager's control panel",
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

           //Vista donde se almacenan los datos del registro de consumo (ENCARGADO)
           $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.table'], [ // Registro o actualización de permiso
            'name' => 'Registro de Consumo(Encargado)',
            'description' => 'Registro de consumo de los aspectos ambientales generados en el centro de formación',
            'description_english' => "HDC Consumption register of environmental aspects generated in the training center.",
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

         // Ruta Fromulario Agregar valor del aspecto ambiental (ENCARGADO)//
         $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.formulario'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede acceder a formulario registro de aspectos ambientales',
            'description_english' => 'You can access the environmental aspects register form',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        $rol_admin = Role::where('slug', 'hdc.admin')->first();
        $rol_charge = Role::where('slug', 'hdc.charge')->first();

        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        $rol_admin->permissions()->syncWithoutDetaching($permissions_userHDC);
        $rol_charge->permissions()->syncWithoutDetaching($permissions_charge);
        $rol_charge->permissions()->syncWithoutDetaching($permissions_userHDC);
    }
}
