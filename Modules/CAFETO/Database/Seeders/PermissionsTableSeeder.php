<?php

namespace Modules\CAFETO\Database\Seeders;

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
        $permissions_cashier = []; // Permisos para Cajero

        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'CAFETO')->first();

        // ===================== Registro de todos los permisos de la aplicación CAFETO ==================
        // Vista principal del administrador
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal del administrador',
            'description' => 'Pueder ver la vista principal del administrador',
            'description_english' => 'You can see the main view of the administrator',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal del cajero
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal del cajero',
            'description' => 'Pueder ver la vista principal del cajero',
            'description_english' => 'You can see the main view of the cashier',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'cafeto.admin')->first(); // Rol Administrador
        $rol_cashier = Role::where('slug', 'cafeto.cashier')->first(); // Rol Operador de Cajero

        // Asignación de PERMISOS para los ROLES de la aplicación CAFETO (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        $rol_cashier->permissions()->syncWithoutDetaching($permissions_cashier);
    }
}
