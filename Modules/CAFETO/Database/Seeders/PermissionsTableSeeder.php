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

        // Vista del inventario actual (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.inventory.index'], [ // Registro o actualización de permiso
            'name' => 'Vista del inventario actual (Administrador) ',
            'description' => 'Puede ver el inventario actual de productos (elementos) en bodega',
            'description_english' => 'You can see the current inventory of products (elements) in warehouse',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista del inventario actual (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.inventory.index'], [ // Registro o actualización de permiso
            'name' => 'Vista del inventario actual (Cajero) ',
            'description' => 'Puede ver el inventario actual de productos (elementos) en bodega',
            'description_english' => 'You can see the current inventory of products (elements) in warehouse',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de entrada de inventario (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.inventory.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de entrada de inventario (Administrador)',
            'description' => 'Formulario de registro de entrada de inventario',
            'description_english' => 'Inventory entry registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de entrada de inventario (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.inventory.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de entrada de inventario (Cajero)',
            'description' => 'Formulario de registro de entrada de inventario',
            'description_english' => 'Inventory entry registration form',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Registro de entrada de inventario (Administrador y/o Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin-cashier.inventory.store'], [ // Registro o actualización de permiso
            'name' => 'Registro de entrada de inventario (Administrador y/o Cajero)',
            'description' => 'Registro de entrada de inventario',
            'description_english' => 'Inventory entry record',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Ver productos vencidos y por vencer (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.inventory.status'], [ // Registro o actualización de permiso
            'name' => 'Ver productos vencidos y por vencer (Administrador)',
            'description' => 'Ver productos vencidos y por vencer',
            'description_english' => 'View expired and expiring products',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Ver productos vencidos y por vencer (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.inventory.status'], [ // Registro o actualización de permiso
            'name' => 'Ver productos vencidos y por vencer (Cajero)',
            'description' => 'Ver productos vencidos y por vencer',
            'description_english' => 'View expired and expiring products',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de bajas de inventario (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.inventory.low'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de bajas de inventario (Administrador)',
            'description' => 'Formulario de registro de bajas de inventario',
            'description_english' => 'Inventory removal registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de bajas de inventario (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.inventory.low'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de bajas de inventario (Cajero)',
            'description' => 'Formulario de registro de bajas de inventario',
            'description_english' => 'Inventory removal registration form',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de ventas realizadas en sesión de caja (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.sale.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de ventas realizadas en sesión de caja (Administrador)',
            'description' => 'Vista principal de ventas realizadas en sesión de caja',
            'description_english' => 'Main view of sales made in the cash session',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de ventas realizadas en sesión de caja (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.sale.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de ventas realizadas en sesión de caja (Cashier)',
            'description' => 'Vista principal de ventas realizadas en sesión de caja',
            'description_english' => 'Main view of sales made in the cash session',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de venta (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.sale.register'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de venta (Administrador)',
            'description' => 'Formulario de registro de venta',
            'description_english' => 'Sale registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de venta (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.sale.register'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de venta (Cajero)',
            'description' => 'Formulario de registro de venta',
            'description_english' => 'Sale registration form',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Registro de venta (Administrador y/o Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin-cashier.generate.sale'], [ // Registro o actualización de permiso
            'name' => 'Registro de venta (Administrador y/o Cajero)',
            'description' => 'Registro de venta',
            'description_english' => 'Sale record',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'cafeto.admin')->first(); // Rol Administrador
        $rol_cashier = Role::where('slug', 'cafeto.cashier')->first(); // Rol Operador de Cajero

        // Asignación de PERMISOS para los ROLES de la aplicación CAFETO (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        $rol_cashier->permissions()->syncWithoutDetaching($permissions_cashier);
    }
}
