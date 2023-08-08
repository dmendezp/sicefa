<?php

namespace Modules\PTVENTA\Database\Seeders;

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

        // Definir arreglos de PERMISOS que van ser asignados a los ROLES
        $permissions_admin = []; // Permisos para Administrador
        $permissions_cashier = []; // Permisos para Cajero


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name','PTVENTA')->first();


        // ===================== Registro de todos los permisos de la aplicación PTVENTA ==================
        // Vista principal del administrador
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal del administrador',
            'description' => 'Pueder ver la vista principal del administrador',
            'description_english' => 'You can see the main view of the administrator',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal del cajero
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal del cajero',
            'description' => 'Pueder ver la vista principal del cajero',
            'description_english' => 'You can see the main view of the cashier',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Vista de configuración (administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.configuration.index'], [ // Registro o actualización de permiso
            'name' => 'Vista de configuración (administrador)',
            'description' => 'Configuración de parametros generales y testeo de impresión pos',
            'description_english' => 'Configuration of general parameters and post printing test',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de configuración (cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.configuration.index'], [ // Registro o actualización de permiso
            'name' => 'Vista de configuración (cajero)',
            'description' => 'Configuración de parametros generales y testeo de impresión pos',
            'description_english' => 'Configuration of general parameters and post printing test',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Vista del inventario actual (administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.inventory.index'], [ // Registro o actualización de permiso
            'name' => 'Vista del inventario actual (administrador) ',
            'description' => 'Puede ver el inventario actual de productos (elementos) en bodega',
            'description_english' => 'You can see the current inventory of products (elements) in warehouse',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista del inventario actual (cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.inventory.index'], [ // Registro o actualización de permiso
            'name' => 'Vista del inventario actual (cajero) ',
            'description' => 'Puede ver el inventario actual de productos (elementos) en bodega',
            'description_english' => 'You can see the current inventory of products (elements) in warehouse',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de entrada de inventario (administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.inventory.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de entrada de inventario (administrador)',
            'description' => 'Formulario de registro de entrada de inventario',
            'description_english' => 'Inventory entry registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de entrada de inventario (cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.inventory.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de entrada de inventario (cajero)',
            'description' => 'Formulario de registro de entrada de inventario',
            'description_english' => 'Inventory entry registration form',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Registro de entrada de inventario (Administrador y/o Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.inventory.store'], [ // Registro o actualización de permiso
            'name' => 'Registro de entrada de inventario (Administrador y/o Cajero)',
            'description' => 'Registro de entrada de inventario',
            'description_english' => 'Inventory entry record',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Ver productos vencidos y por vencer (administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.inventory.status'], [ // Registro o actualización de permiso
            'name' => 'Ver productos vencidos y por vencer (administrador)',
            'description' => 'Ver productos vencidos y por vencer',
            'description_english' => 'View expired and expiring products',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Ver productos vencidos y por vencer (cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.inventory.status'], [ // Registro o actualización de permiso
            'name' => 'Ver productos vencidos y por vencer (cajero)',
            'description' => 'Ver productos vencidos y por vencer',
            'description_english' => 'View expired and expiring products',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de la sección de reportes (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.reports.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de la sección de reportes (Administrador)',
            'description' => 'Vista principal de la sección de reportes',
            'description_english' => 'Main view of the reports section',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de la sección de reportes (cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.reports.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de la sección de reportes (Administrador)',
            'description' => 'Vista principal de la sección de reportes',
            'description_english' => 'Main view of the reports section',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Generar PDF del inventario actual (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.reports.inventory.generatePDF'], [ // Registro o actualización de permiso
            'name' => 'Generar PDF del inventario actual (Administrador)',
            'description' => 'Generar PDF del inventario actual',
            'description_english' => 'Generate PDF of current inventory',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Generar PDF del inventario actual (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.reports.inventory.generatePDF'], [ // Registro o actualización de permiso
            'name' => 'Generar PDF del inventario actual (Cajero)',
            'description' => 'Generar PDF del inventario actual',
            'description_english' => 'Generate PDF of current inventory',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Vista de consulta de entradas de inventario por fecha (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.reports.inventory.entries'], [ // Registro o actualización de permiso
            'name' => 'Vista de consulta de entradas de inventario por fecha (Administrador)',
            'description' => 'Vista de consulta de entradas de inventario por fecha',
            'description_english' => 'Consult view of inventory entries by date',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de consulta de entradas de inventario por fecha (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.reports.inventory.entries'], [ // Registro o actualización de permiso
            'name' => 'Vista de consulta de entradas de inventario por fecha (Cajero)',
            'description' => 'Vista de consulta de entradas de inventario por fecha',
            'description_english' => 'Consult view of inventory entries by date',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Realizar consulta de entradas de inventario por fechas recibidas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.reports.generate.inventory.entries'], [ // Registro o actualización de permiso
            'name' => 'Realizar consulta de entradas de inventario por fechas recibidas (Administrador)',
            'description' => 'Realizar consulta de entradas de inventario por fechas recibidas',
            'description_english' => 'Perform inventory entries query by received dates',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Realizar consulta de entradas de inventario por fechas recibidas (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.reports.generate.inventory.entries'], [ // Registro o actualización de permiso
            'name' => 'Realizar consulta de entradas de inventario por fechas recibidas (Cajero)',
            'description' => 'Realizar consulta de entradas de inventario por fechas recibidas',
            'description_english' => 'Perform inventory entries query by received dates',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Generar PDF de entradas de inventario (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.reports.generate.entries.pdf'], [ // Registro o actualización de permiso
            'name' => 'Generar PDF de entradas de inventario (Administrador)',
            'description' => 'Generar PDF de entradas de inventario',
            'description_english' => 'Generate PDF of inventory entries',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Generar PDF de entradas de inventario (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.reports.generate.entries.pdf'], [ // Registro o actualización de permiso
            'name' => 'Generar PDF de entradas de inventario (Cajero)',
            'description' => 'Generar PDF de entradas de inventario',
            'description_english' => 'Generate PDF of inventory entries',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Vista de consulta de ventas realizadas por fechas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.reports.sales'], [ // Registro o actualización de permiso
            'name' => 'Vista de consulta de ventas realizadas por fechas (Administrador)',
            'description' => 'Vista de consulta de ventas realizadas por fechas',
            'description_english' => 'Consult view of sales made by dates',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de consulta de ventas realizadas por fechas (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.reports.sales'], [ // Registro o actualización de permiso
            'name' => 'Vista de consulta de ventas realizadas por fechas (Cajero)',
            'description' => 'Vista de consulta de ventas realizadas por fechas',
            'description_english' => 'Consult view of sales made by dates',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Realizar consulta de ventas realizadas por fechas recibidas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.reports.generate.sales'], [ // Registro o actualización de permiso
            'name' => 'Realizar consulta de ventas realizadas por fechas recibidas (Administrador)',
            'description' => 'Realizar consulta de ventas realizadas por fechas recibidas',
            'description_english' => 'Perform sales made query by received dates',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Realizar consulta de ventas realizadas por fechas recibidas (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.reports.generate.sales'], [ // Registro o actualización de permiso
            'name' => 'Realizar consulta de ventas realizadas por fechas recibidas (Cajero)',
            'description' => 'Realizar consulta de ventas realizadas por fechas recibidas',
            'description_english' => 'Perform sales made query by received dates',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Generar PDF de ventas realizadas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.reports.generate.sales.pdf'], [ // Registro o actualización de permiso
            'name' => 'Generar PDF de ventas realizadas (Administrador)',
            'description' => 'Generar PDF de ventas realizadas',
            'description_english' => 'Generate PDF of sales made',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Generar PDF de ventas realizadas (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.reports.generate.sales.pdf'], [ // Registro o actualización de permiso
            'name' => 'Generar PDF de ventas realizadas (Cajero)',
            'description' => 'Generar PDF de ventas realizadas',
            'description_english' => 'Generate PDF of sales made',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de ventas realizadas en sesión de caja (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.sale.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de ventas realizadas en sesión de caja (Administrador)',
            'description' => 'Vista principal de ventas realizadas en sesión de caja',
            'description_english' => 'Main view of sales made in the cash session',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de ventas realizadas en sesión de caja (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.sale.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de ventas realizadas en sesión de caja (Cashier)',
            'description' => 'Vista principal de ventas realizadas en sesión de caja',
            'description_english' => 'Main view of sales made in the cash session',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de venta (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.sale.register'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de venta (Administrador)',
            'description' => 'Formulario de registro de venta',
            'description_english' => 'Sale registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de venta (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.cashier.sale.register'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de venta (Cajero)',
            'description' => 'Formulario de registro de venta',
            'description_english' => 'Sale registration form',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Registro de venta (Administrador y/o Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.generate.sale'], [ // Registro o actualización de permiso
            'name' => 'Registro de venta (Administrador y/o Cajero)',
            'description' => 'Registro de venta',
            'description_english' => 'Sale record',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        $permissions_cashier[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de productos (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.element.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de productos (Administrador)',
            'description' => 'Vista principal de productos',
            'description_english' => 'Products main view',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario para acutalizar producto (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.element.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario para acutalizar producto (Administrador)',
            'description' => 'Formulario para acutalizar producto',
            'description_english' => 'Products main view',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar producto (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'ptventa.admin.element.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar producto (Administrador)',
            'description' => 'Actualizar producto',
            'description_english' => 'Update product',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol





        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'ptventa.admin')->first(); // Rol Administrador
        $rol_cashier = Role::where('slug', 'ptventa.cashier')->first(); // Rol Operador de Cajero

        // Asignación de PERMISOS para los ROLES de la aplicación PTVENTA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()-> syncWithoutDetaching($permissions_admin);
        $rol_cashier->permissions()-> syncWithoutDetaching($permissions_cashier);
    }
}
