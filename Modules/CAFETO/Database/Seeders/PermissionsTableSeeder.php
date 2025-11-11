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
        $permissions_instructor = []; // Permisos para Instructor
        // Consultar aplicación SICA para registrar los permisos
        $app = App::where('name', 'CAFETO')->firstOrFail();
        // ===================== Registro de todos los permisos de la aplicación CAFETO ==================
        // Vista principal del administrador
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.index'], [
            'name' => 'Vista principal del administrador',
            'description' => 'Permite ver la vista principal del administrador',
            'description_english' => 'Allows viewing the main administrator dashboard',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista principal del cajero
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.index'], [
            'name' => 'Vista principal del cajero',
            'description' => 'Permite ver la vista principal del cajero',
            'description_english' => 'Allows viewing the main cashier dashboard',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista principal del instructor
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.instructor.index'], [
            'name' => 'Vista principal del instructor',
            'description' => 'Permite ver la vista principal del instructor',
            'description_english' => 'Allows viewing the main instructor dashboard',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id;
        // Vista de configuración (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.configuration.index'], [
            'name' => 'Vista de configuración (Administrador)',
            'description' => 'Permite configurar parámetros generales y realizar pruebas de impresión POS',
            'description_english' => 'Allows configuring general parameters and performing POS printing tests',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista de configuración (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.configuration.index'], [
            'name' => 'Vista de configuración (Cajero)',
            'description' => 'Permite configurar parámetros generales y realizar pruebas de impresión POS',
            'description_english' => 'Allows configuring general parameters and performing POS printing tests',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Generar impresión POS de prueba (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.configuration.postprinting'], [
            'name' => 'Generar impresión POS de prueba (Administrador)',
            'description' => 'Permite generar una impresión POS de prueba',
            'description_english' => 'Allows generating a test POS print',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Generar impresión POS de prueba (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.configuration.postprinting'], [
            'name' => 'Generar impresión POS de prueba (Cajero)',
            'description' => 'Permite generar una impresión POS de prueba',
            'description_english' => 'Allows generating a test POS print',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista del inventario actual (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.inventory.index'], [
            'name' => 'Vista del inventario actual (Administrador)',
            'description' => 'Permite ver el inventario actual de productos en bodega',
            'description_english' => 'Allows viewing the current inventory of products in the warehouse',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista del inventario actual (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.inventory.index'], [
            'name' => 'Vista del inventario actual (Cajero)',
            'description' => 'Permite ver el inventario actual de productos en bodega',
            'description_english' => 'Allows viewing the current inventory of products in the warehouse',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Formulario de registro de entrada de inventario (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.inventory.create'], [
            'name' => 'Formulario de registro de entrada de inventario (Administrador)',
            'description' => 'Permite acceder al formulario para registrar entradas de inventario',
            'description_english' => 'Allows accessing the form to register inventory entries',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Formulario de registro de entrada de inventario (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.inventory.create'], [
            'name' => 'Formulario de registro de entrada de inventario (Cajero)',
            'description' => 'Permite acceder al formulario para registrar entradas de inventario',
            'description_english' => 'Allows accessing the form to register inventory entries',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Registro de entrada de inventario (Administrador y/o Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin-cashier.inventory.store'], [
            'name' => 'Registro de entrada de inventario (Administrador y/o Cajero)',
            'description' => 'Permite registrar entradas de inventario',
            'description_english' => 'Allows registering inventory entries',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        $permissions_cashier[] = $permission->id;
        // Ver productos vencidos y por vencer (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.inventory.status'], [
            'name' => 'Ver productos vencidos y por vencer (Administrador)',
            'description' => 'Permite ver productos vencidos y por vencer',
            'description_english' => 'Allows viewing expired and expiring products',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Ver productos vencidos y por vencer (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.inventory.status'], [
            'name' => 'Ver productos vencidos y por vencer (Cajero)',
            'description' => 'Permite ver productos vencidos y por vencer',
            'description_english' => 'Allows viewing expired and expiring products',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Formulario de registro de bajas de inventario (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.inventory.low'], [
            'name' => 'Formulario de registro de bajas de inventario (Administrador)',
            'description' => 'Permite acceder al formulario para registrar bajas de inventario',
            'description_english' => 'Allows accessing the form to register inventory removals',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Formulario de registro de bajas de inventario (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.inventory.low'], [
            'name' => 'Formulario de registro de bajas de inventario (Cajero)',
            'description' => 'Permite acceder al formulario para registrar bajas de inventario',
            'description_english' => 'Allows accessing the form to register inventory removals',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista principal de la sección de reportes (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.reports.index'], [
            'name' => 'Vista principal de la sección de reportes (Administrador)',
            'description' => 'Permite ver la vista principal de la sección de reportes',
            'description_english' => 'Allows viewing the main reports section',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista principal de la sección de reportes (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.reports.index'], [
            'name' => 'Vista principal de la sección de reportes (Cajero)',
            'description' => 'Permite ver la vista principal de la sección de reportes',
            'description_english' => 'Allows viewing the main reports section',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Generar PDF del inventario actual (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.reports.inventory.generate.pdf'], [
            'name' => 'Generar PDF del inventario actual (Administrador)',
            'description' => 'Permite generar un PDF del inventario actual',
            'description_english' => 'Allows generating a PDF of the current inventory',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Generar PDF del inventario actual (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.reports.inventory.generate.pdf'], [
            'name' => 'Generar PDF del inventario actual (Cajero)',
            'description' => 'Permite generar un PDF del inventario actual',
            'description_english' => 'Allows generating a PDF of the current inventory',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista de consulta de entradas de inventario por fecha (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.reports.inventory.entries'], [
            'name' => 'Vista de consulta de entradas de inventario por fecha (Administrador)',
            'description' => 'Permite ver la vista de consulta de entradas de inventario por fecha',
            'description_english' => 'Allows viewing the inventory entries consultation by date',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista de consulta de entradas de inventario por fecha (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.reports.inventory.entries'], [
            'name' => 'Vista de consulta de entradas de inventario por fecha (Cajero)',
            'description' => 'Permite ver la vista de consulta de entradas de inventario por fecha',
            'description_english' => 'Allows viewing the inventory entries consultation by date',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Realizar consulta de entradas de inventario por fechas recibidas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.reports.generate.inventory.entries'], [
            'name' => 'Consulta de entradas de inventario por fechas (Administrador)',
            'description' => 'Permite realizar consultas de entradas de inventario por fechas recibidas',
            'description_english' => 'Allows performing inventory entries queries by received dates',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Realizar consulta de entradas de inventario por fechas recibidas (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.reports.generate.inventory.entries'], [
            'name' => 'Consulta de entradas de inventario por fechas (Cajero)',
            'description' => 'Permite realizar consultas de entradas de inventario por fechas recibidas',
            'description_english' => 'Allows performing inventory entries queries by received dates',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Generar PDF de entradas de inventario (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.reports.generate.entries.pdf'], [
            'name' => 'Generar PDF de entradas de inventario (Administrador)',
            'description' => 'Permite generar un PDF de entradas de inventario',
            'description_english' => 'Allows generating a PDF of inventory entries',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Generar PDF de entradas de inventario (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.reports.generate.entries.pdf'], [
            'name' => 'Generar PDF de entradas de inventario (Cajero)',
            'description' => 'Permite generar un PDF de entradas de inventario',
            'description_english' => 'Allows generating a PDF of inventory entries',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista de consulta de ventas realizadas por fechas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.reports.sales'], [
            'name' => 'Vista de consulta de ventas por fechas (Administrador)',
            'description' => 'Permite ver la vista de consulta de ventas realizadas por fechas',
            'description_english' => 'Allows viewing the sales consultation by dates',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista de consulta de ventas realizadas por fechas (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.reports.sales'], [
            'name' => 'Vista de consulta de ventas por fechas (Cajero)',
            'description' => 'Permite ver la vista de consulta de ventas realizadas por fechas',
            'description_english' => 'Allows viewing the sales consultation by dates',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Realizar consulta de ventas realizadas por fechas recibidas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.reports.generate.sales'], [
            'name' => 'Consulta de ventas por fechas (Administrador)',
            'description' => 'Permite realizar consultas de ventas realizadas por fechas recibidas',
            'description_english' => 'Allows performing sales queries by received dates',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Realizar consulta de ventas realizadas por fechas recibidas (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.reports.generate.sales'], [
            'name' => 'Consulta de ventas por fechas (Cajero)',
            'description' => 'Permite realizar consultas de ventas realizadas por fechas recibidas',
            'description_english' => 'Allows performing sales queries by received dates',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Generar PDF de ventas realizadas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.reports.generate.sales.pdf'], [
            'name' => 'Generar PDF de ventas realizadas (Administrador)',
            'description' => 'Permite generar un PDF de ventas realizadas',
            'description_english' => 'Allows generating a PDF of sales made',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Generar PDF de ventas realizadas (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.reports.generate.sales.pdf'], [
            'name' => 'Generar PDF de ventas realizadas (Cajero)',
            'description' => 'Permite generar un PDF de ventas realizadas',
            'description_english' => 'Allows generating a PDF of sales made',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Ver detalle de movimiento interno (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.movements.entries.show'], [
            'name' => 'Ver detalle de movimiento interno (Administrador)',
            'description' => 'Permite ver los detalles de un movimiento interno',
            'description_english' => 'Allows viewing internal movement details',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Ver detalle de movimiento interno (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.movements.entries.show'], [
            'name' => 'Ver detalle de movimiento interno (Cajero)',
            'description' => 'Permite ver los detalles de un movimiento interno',
            'description_english' => 'Allows viewing internal movement details',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Ver detalle de baja (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.movements.low.show'], [
            'name' => 'Ver detalle de baja (Administrador)',
            'description' => 'Permite ver los detalles de una baja de inventario',
            'description_english' => 'Allows viewing inventory removal details',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Ver detalle de baja (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.movements.low.show'], [
            'name' => 'Ver detalle de baja (Cajero)',
            'description' => 'Permite ver los detalles de una baja de inventario',
            'description_english' => 'Allows viewing inventory removal details',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista principal de ventas realizadas en sesión de caja (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.sale.index'], [
            'name' => 'Vista principal de ventas en sesión de caja (Administrador)',
            'description' => 'Permite ver la vista principal de ventas realizadas en la sesión de caja',
            'description_english' => 'Allows viewing the main view of sales made in the cash session',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista principal de ventas realizadas en sesión de caja (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.sale.index'], [
            'name' => 'Vista principal de ventas en sesión de caja (Cajero)',
            'description' => 'Permite ver la vista principal de ventas realizadas en la sesión de caja',
            'description_english' => 'Allows viewing the main view of sales made in the cash session',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Formulario de registro de venta (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.sale.register'], [
            'name' => 'Formulario de registro de venta (Administrador)',
            'description' => 'Permite acceder al formulario para registrar una venta',
            'description_english' => 'Allows accessing the form to register a sale',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Formulario de registro de venta (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.sale.register'], [
            'name' => 'Formulario de registro de venta (Cajero)',
            'description' => 'Permite acceder al formulario para registrar una venta',
            'description_english' => 'Allows accessing the form to register a sale',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Registro de venta (Administrador y/o Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin-cashier.generate.sale'], [
            'name' => 'Registro de venta (Administrador y/o Cajero)',
            'description' => 'Permite registrar una venta',
            'description_english' => 'Allows registering a sale',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        $permissions_cashier[] = $permission->id;
        // Ver detalle de venta (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.movements.sale.show'], [
            'name' => 'Ver detalle de venta (Administrador)',
            'description' => 'Permite ver los detalles de una venta',
            'description_english' => 'Allows viewing sale details',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Ver detalle de venta (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.movements.sale.show'], [
            'name' => 'Ver detalle de venta (Cajero)',
            'description' => 'Permite ver los detalles de una venta',
            'description_english' => 'Allows viewing sale details',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista principal de productos (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.element.index'], [
            'name' => 'Vista principal de productos (Administrador)',
            'description' => 'Permite ver la vista principal de productos',
            'description_english' => 'Allows viewing the main products view',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Formulario para actualizar producto (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.element.edit'], [
            'name' => 'Formulario para actualizar producto (Administrador)',
            'description' => 'Permite acceder al formulario para actualizar un producto',
            'description_english' => 'Allows accessing the form to update a product',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Actualizar producto (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.element.update'], [
            'name' => 'Actualizar producto (Administrador)',
            'description' => 'Permite actualizar un producto',
            'description_english' => 'Allows updating a product',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Formulario de registro de producto (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.element.create'], [
            'name' => 'Formulario de registro de producto (Administrador)',
            'description' => 'Permite acceder al formulario para registrar un producto',
            'description_english' => 'Allows accessing the form to register a product',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Registrar producto (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.element.store'], [
            'name' => 'Registrar producto (Administrador)',
            'description' => 'Permite registrar un producto',
            'description_english' => 'Allows registering a product',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista principal de sesión de caja activa e historico de sesiones de caja (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.cash.index'], [
            'name' => 'Vista principal de sesiones de caja (Administrador)',
            'description' => 'Permite ver la sesión de caja activa y el historial de sesiones de caja',
            'description_english' => 'Allows viewing the active cash session and cash session history',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista principal de sesión de caja activa e historico de sesiones de caja (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.cash.index'], [
            'name' => 'Vista principal de sesiones de caja (Cajero)',
            'description' => 'Permite ver la sesión de caja activa y el historial de sesiones de caja',
            'description_english' => 'Allows viewing the active cash session and cash session history',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Registrar caja cuando no hay ninguna activa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.cash.store'], [
            'name' => 'Registrar caja (Administrador)',
            'description' => 'Permite registrar una caja cuando no hay ninguna activa',
            'description_english' => 'Allows registering a cash session when none is active',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Registrar caja cuando no hay ninguna activa (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.cash.store'], [
            'name' => 'Registrar caja (Cajero)',
            'description' => 'Permite registrar una caja cuando no hay ninguna activa',
            'description_english' => 'Allows registering a cash session when none is active',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Cerrar sesión de caja (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.cash.close'], [
            'name' => 'Cerrar sesión de caja (Administrador)',
            'description' => 'Permite cerrar una sesión de caja',
            'description_english' => 'Allows closing a cash session',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Cerrar sesión de caja (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.cash.close'], [
            'name' => 'Cerrar sesión de caja (Cajero)',
            'description' => 'Permite cerrar una sesión de caja',
            'description_english' => 'Allows closing a cash session',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista principal de historico de movimientos (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.movements.index'], [
            'name' => 'Vista principal de movimientos (Administrador)',
            'description' => 'Permite ver la vista principal del historial de movimientos',
            'description_english' => 'Allows viewing the main movement history view',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista principal de historico de movimientos (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.movements.index'], [
            'name' => 'Vista principal de movimientos (Cajero)',
            'description' => 'Permite ver la vista principal del historial de movimientos',
            'description_english' => 'Allows viewing the main movement history view',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Consultar movimientos por fecha y actor (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.movements.consult'], [
            'name' => 'Consultar movimientos (Administrador)',
            'description' => 'Permite consultar movimientos por fecha y actor',
            'description_english' => 'Allows consulting movements by date and actor',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Consultar movimientos por fecha y actor (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.movements.consult'], [
            'name' => 'Consultar movimientos (Cajero)',
            'description' => 'Permite consultar movimientos por fecha y actor',
            'description_english' => 'Allows consulting movements by date and actor',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista principal de recetas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.recipes.index'], [
            'name' => 'Vista principal de recetas (Administrador)',
            'description' => 'Permite ver la vista principal de recetas',
            'description_english' => 'Allows viewing the main recipes view',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista principal de recetas (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.recipes.index'], [
            'name' => 'Vista principal de recetas (Cajero)',
            'description' => 'Permite ver la vista principal de recetas',
            'description_english' => 'Allows viewing the main recipes view',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista de creación de recetas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.recipes.create'], [
            'name' => 'Vista de creación de recetas (Administrador)',
            'description' => 'Permite acceder a la vista para crear recetas',
            'description_english' => 'Allows accessing the recipe creation view',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista de creación de recetas (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.recipes.create'], [
            'name' => 'Vista de creación de recetas (Cajero)',
            'description' => 'Permite acceder a la vista para crear recetas',
            'description_english' => 'Allows accessing the recipe creation view',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista detalles de una receta (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.recipes.details'], [
            'name' => 'Vista detalles de una receta (Administrador)',
            'description' => 'Permite ver los detalles de una receta',
            'description_english' => 'Allows viewing the details of a recipe',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista detalles de una receta (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.recipes.details'], [
            'name' => 'Vista detalles de una receta (Cajero)',
            'description' => 'Permite ver los detalles de una receta',
            'description_english' => 'Allows viewing the details of a recipe',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista principal de formulaciones (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.formulations.index'], [
            'name' => 'Vista principal de formulaciones (Administrador)',
            'description' => 'Permite ver la vista principal de formulaciones',
            'description_english' => 'Allows viewing the main formulations view',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista de creación de formulaciones (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.formulations.create'], [
            'name' => 'Vista de creación de formulaciones (Administrador)',
            'description' => 'Permite acceder a la vista para crear formulaciones',
            'description_english' => 'Allows accessing the formulation creation view',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Guardar formulaciones (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.formulations.store'], [
            'name' => 'Guardar formulaciones (Administrador)',
            'description' => 'Permite guardar nuevas formulaciones',
            'description_english' => 'Allows saving new formulations',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Vista de edición de formulaciones (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.formulations.edit'], [
            'name' => 'Editar formulaciones (Administrador)',
            'description' => 'Permite editar formulaciones',
            'description_english' => 'Allows editing formulations',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Actualizar formulaciones (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.formulations.update'], [
            'name' => 'Actualizar formulaciones (Administrador)',
            'description' => 'Permite actualizar formulaciones',
            'description_english' => 'Allows updating formulations',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Aprobar formulaciones (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.formulations.approve'], [
            'name' => 'Aprobar formulaciones (Administrador)',
            'description' => 'Permite aprobar formulaciones',
            'description_english' => 'Allows approving formulations',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Eliminar formulaciones (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.formulations.destroy'], [
            'name' => 'Eliminar formulaciones (Administrador)',
            'description' => 'Permite eliminar formulaciones',
            'description_english' => 'Allows deleting formulations',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Ver detalles de formulaciones (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.formulations.show'], [
            'name' => 'Ver detalles de formulaciones (Administrador)',
            'description' => 'Permite consultar detalles de formulaciones',
            'description_english' => 'Allows viewing details of formulations',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Gestión de formulaciones (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.admin.formulations'], [
            'name' => 'Gestión de formulaciones (Administrador)',
            'description' => 'Permite crear, editar, actualizar, aprobar, eliminar y consultar detalles de formulaciones',
            'description_english' => 'Allows creating, editing, updating, approving, deleting, and viewing details of formulations',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        // Gestión de formulaciones (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.instructor.formulations'], [
            'name' => 'Gestión de formulaciones (Instructor)',
            'description' => 'Permite ver, crear, editar, actualizar, aprobar, eliminar y consultar detalles de formulaciones',
            'description_english' => 'Allows viewing, creating, editing, updating, approving, deleting, and viewing details of formulations',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id;
        // Vista principal de formulaciones (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.instructor.formulations.index'], [
            'name' => 'Vista principal de formulaciones (Instructor)',
            'description' => 'Permite ver la vista principal de formulaciones',
            'description_english' => 'Allows viewing the main formulations view',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id;
        // Vista de creación de formulaciones (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.instructor.formulations.create'], [
            'name' => 'Vista de creación de formulaciones (Instructor)',
            'description' => 'Permite acceder a la vista para crear formulaciones',
            'description_english' => 'Allows accessing the formulation creation view',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id;
        // Guardar formulaciones (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.instructor.formulations.store'], [
            'name' => 'Guardar formulaciones (Instructor)',
            'description' => 'Permite guardar nuevas formulaciones',
            'description_english' => 'Allows saving new formulations',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id;
        // Editar formulaciones (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.instructor.formulations.edit'], [
            'name' => 'Editar formulaciones (Instructor)',
            'description' => 'Permite editar formulaciones',
            'description_english' => 'Allows editing formulations',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id;
        // Actualizar formulaciones (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.instructor.formulations.update'], [
            'name' => 'Actualizar formulaciones (Instructor)',
            'description' => 'Permite actualizar formulaciones',
            'description_english' => 'Allows updating formulations',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id;
        // Aprobar formulaciones (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.instructor.formulations.approve'], [
            'name' => 'Aprobar formulaciones (Instructor)',
            'description' => 'Permite aprobar formulaciones',
            'description_english' => 'Allows approving formulations',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id;
        // Eliminar formulaciones (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.instructor.formulations.destroy'], [
            'name' => 'Eliminar formulaciones (Instructor)',
            'description' => 'Permite eliminar formulaciones',
            'description_english' => 'Allows deleting formulations',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id;
        // Ver detalles de formulaciones (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.instructor.formulations.show'], [
            'name' => 'Ver detalles de formulaciones (Instructor)',
            'description' => 'Permite consultar detalles de formulaciones',
            'description_english' => 'Allows viewing details of formulations',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id;
        // Gestión de formulaciones (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.formulations'], [
            'name' => 'Gestión de formulaciones (Cajero)',
            'description' => 'Permite ver, crear y consultar detalles de formulaciones propias',
            'description_english' => 'Allows viewing, creating, and viewing details of own formulations',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista principal de formulaciones (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.formulations.index'], [
            'name' => 'Vista principal de formulaciones (Cajero)',
            'description' => 'Permite ver la vista principal de formulaciones propias',
            'description_english' => 'Allows viewing the main view of own formulations',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Vista de creación de formulaciones (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.formulations.create'], [
            'name' => 'Vista de creación de formulaciones (Cajero)',
            'description' => 'Permite acceder a la vista para crear formulaciones',
            'description_english' => 'Allows accessing the formulation creation view',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Guardar formulaciones (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.formulations.store'], [
            'name' => 'Guardar formulaciones (Cajero)',
            'description' => 'Permite guardar nuevas formulaciones',
            'description_english' => 'Allows saving new formulations',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Ver detalles de formulaciones (Cajero)
        $permission = Permission::updateOrCreate(['slug' => 'cafeto.cashier.formulations.show'], [
            'name' => 'Ver detalles de formulaciones (Cajero)',
            'description' => 'Permite consultar detalles de formulaciones propias',
            'description_english' => 'Allows viewing details of own formulations',
            'app_id' => $app->id
        ]);
        $permissions_cashier[] = $permission->id;
        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'cafeto.admin')->firstOrFail();
        $rol_cashier = Role::where('slug', 'cafeto.cashier')->firstOrFail();
        $rol_instructor = Role::where('slug', 'cafeto.instructor')->firstOrFail();
        // Asignación de PERMISOS para los ROLES de la aplicación CAFETO
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        $rol_cashier->permissions()->syncWithoutDetaching($permissions_cashier);
        $rol_instructor->permissions()->syncWithoutDetaching($permissions_instructor);
    }
}