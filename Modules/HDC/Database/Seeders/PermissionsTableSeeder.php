<?php

namespace Modules\HDC\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;

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
        $app = App::where('name', 'SIGAC')->firstOrFail();

         // ===================== Registro de todos los permisos de la aplicación SIGAC ==================
        // Panel de control de coordinación académica (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de coordinación académica (Coordinación Académica)',
            'description' => 'Panel de control de coordinación académica',
            'description_english' => "Academic coordination control panel",
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
    }
}
