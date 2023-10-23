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
        // Panel de control de coordinación académica (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.index'], [ // Registro o actualización de permiso
            'name' => 'Panel de control del administrador(Administrador)',
            'description' => 'Panel de control del administrador de HDC',
            'description_english' => "HDC Administrator Control Panel",
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Panel de control de Encargado (Encargado)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.index'], [ // Registro o actualización de permiso
            'name' => 'Panel de control del Encargado (Encargado)',
            'description' => 'Panel de control del encargado',
            'description_english' => "Manager's control panel",
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol
        // Panel de control de user de calcula tu huella (userHDC)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.UserHDC.index'], [ // Registro o actualización de permiso
            'name' => 'Panel de control del usuario de calcula tu huella (userHDC)',
            'description' => 'Panel de control del usuario de calcula tu huella',
            'description_english' => "Calculate your footprint user control panel",
            'app_id' => $app->id
        ]);
        $permissions_userHDC[] = $permission->id; // Almacenar permiso para rol

        $rol_admin = Role::where('slug', 'hdc.admin')->first();
        $rol_charge = Role::where('slug', 'hdc.charge')->first();

        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        $rol_admin->permissions()->syncWithoutDetaching($permissions_userHDC);
        $rol_charge->permissions()->syncWithoutDetaching($permissions_charge);
        $rol_charge->permissions()->syncWithoutDetaching($permissions_userHDC);
    }
}
