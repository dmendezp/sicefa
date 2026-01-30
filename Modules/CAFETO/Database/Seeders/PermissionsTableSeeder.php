<?php

namespace Modules\CAFETO\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Role;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions_admin = [];
        $permissions_cashier = [];
        $permissions_instructor = [];

        $app = App::where('name', 'CAFETO')->firstOrFail();

        // Helper: registra/actualiza permiso y retorna el ID
        $reg = function (string $slug, string $name, string $desc_es, string $desc_en) use ($app) {
            $permission = Permission::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'description' => $desc_es,
                    'description_english' => $desc_en,
                    'app_id' => $app->id
                ]
            );
            return $permission->id;
        };

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        // Dashboard / configuración (Admin)
        $permissions_admin[] = $reg('cafeto.admin.index', 'Vista principal del administrador', 'Permite ver la vista principal del administrador', 'Allows viewing the main administrator dashboard');
        $permissions_admin[] = $reg('cafeto.admin.configuration.index', 'Vista de configuración (Administrador)', 'Permite ver la configuración del módulo', 'Allows viewing module configuration');

        // Caja (Admin)
        $permissions_admin[] = $reg('cafeto.admin.cash.index', 'Sesiones de caja (Administrador)', 'Permite ver la sesión de caja e histórico', 'Allows viewing cash session and history');
        $permissions_admin[] = $reg('cafeto.admin.cash.store', 'Registrar caja (Administrador)', 'Permite registrar una sesión de caja', 'Allows creating a cash session');
        $permissions_admin[] = $reg('cafeto.admin.cash.close', 'Cerrar caja (Administrador)', 'Permite cerrar una sesión de caja', 'Allows closing a cash session');

        // Productos / Elementos (Admin)
        $permissions_admin[] = $reg('cafeto.admin.element.index', 'Listado de productos (Administrador)', 'Permite ver el listado de productos', 'Allows viewing products list');
        $permissions_admin[] = $reg('cafeto.admin.element.create', 'Crear producto (Administrador)', 'Permite acceder al formulario de creación', 'Allows accessing create form');
        $permissions_admin[] = $reg('cafeto.admin.element.store', 'Guardar producto (Administrador)', 'Permite registrar un producto', 'Allows storing a product');
        $permissions_admin[] = $reg('cafeto.admin.element.edit', 'Editar producto (Administrador)', 'Permite acceder al formulario de edición', 'Allows accessing edit form');
        $permissions_admin[] = $reg('cafeto.admin.element.update', 'Actualizar producto (Administrador)', 'Permite actualizar un producto', 'Allows updating a product');

        // Inventario (Admin)
        $permissions_admin[] = $reg('cafeto.admin.inventory.index', 'Inventario (Administrador)', 'Permite ver el inventario', 'Allows viewing inventory');
        $permissions_admin[] = $reg('cafeto.admin.inventory.create', 'Entrada de inventario (Administrador)', 'Permite acceder al formulario de entradas', 'Allows accessing inventory entry form');
        $permissions_admin[] = $reg('cafeto.admin.inventory.store', 'Registrar entrada de inventario (Administrador)', 'Permite registrar entradas de inventario', 'Allows storing inventory entries');
        $permissions_admin[] = $reg('cafeto.admin.inventory.low', 'Baja de inventario (Administrador)', 'Permite acceder al formulario de bajas', 'Allows accessing inventory removal form');
        $permissions_admin[] = $reg('cafeto.admin.inventory.status', 'Estado de productos (Administrador)', 'Permite ver vencidos y por vencer', 'Allows viewing expired and expiring products');
        $permissions_admin[] = $reg('cafeto.admin.inventory.popular.toggle', 'Producto popular (Administrador)', 'Permite marcar/desmarcar producto como popular', 'Allows toggling product as popular');

        // Movimientos (Admin)
        $permissions_admin[] = $reg('cafeto.admin.movements.index', 'Histórico de movimientos (Administrador)', 'Permite ver el histórico de movimientos', 'Allows viewing movement history');
        $permissions_admin[] = $reg('cafeto.admin.movements.consult', 'Consultar movimientos (Administrador)', 'Permite consultar movimientos por fecha y actor', 'Allows consulting movements by date and actor');
        $permissions_admin[] = $reg('cafeto.admin.movements.entries.show', 'Detalle de entrada (Administrador)', 'Permite ver detalle de movimiento de entrada', 'Allows viewing entry movement details');
        $permissions_admin[] = $reg('cafeto.admin.movements.low.show', 'Detalle de baja (Administrador)', 'Permite ver detalle de baja', 'Allows viewing removal details');

        // Reportes (Admin)
        $permissions_admin[] = $reg('cafeto.admin.reports.index', 'Reportes (Administrador)', 'Permite ver la sección de reportes', 'Allows viewing reports section');
        $permissions_admin[] = $reg('cafeto.admin.reports.inventory.entries', 'Entradas por fecha (Administrador)', 'Permite ver formulario de entradas por fecha', 'Allows viewing entries-by-date form');
        $permissions_admin[] = $reg('cafeto.admin.reports.generate.inventory.entries', 'Consultar entradas por fecha (Administrador)', 'Permite consultar entradas por fechas', 'Allows generating entries queries by dates');
        $permissions_admin[] = $reg('cafeto.admin.reports.generate.entries.pdf', 'PDF entradas (Administrador)', 'Permite generar PDF de entradas', 'Allows generating entries PDF');
        $permissions_admin[] = $reg('cafeto.admin.reports.inventory.generate.pdf', 'PDF inventario (Administrador)', 'Permite generar PDF del inventario', 'Allows generating inventory PDF');
        $permissions_admin[] = $reg('cafeto.admin.reports.sales', 'Ventas por fecha (Administrador)', 'Permite ver formulario de ventas por fecha', 'Allows viewing sales-by-date form');
        $permissions_admin[] = $reg('cafeto.admin.reports.generate.sales', 'Consultar ventas por fecha (Administrador)', 'Permite consultar ventas por fechas', 'Allows generating sales queries by dates');
        $permissions_admin[] = $reg('cafeto.admin.reports.generate.sales.pdf', 'PDF ventas (Administrador)', 'Permite generar PDF de ventas', 'Allows generating sales PDF');
        $permissions_admin[] = $reg('cafeto.admin.reports.generate.sales.products.pdf', 'PDF ventas por producto (Administrador)', 'Permite generar PDF de ventas por productos', 'Allows generating sales-by-products PDF');

        // Ventas (Admin)
        $permissions_admin[] = $reg('cafeto.admin.sale.index', 'Ventas en sesión (Administrador)', 'Permite ver ventas de la sesión', 'Allows viewing session sales');
        $permissions_admin[] = $reg('cafeto.admin.sale.register', 'Registrar venta (Administrador)', 'Permite acceder al formulario de venta', 'Allows accessing sale form');
        $permissions_admin[] = $reg('cafeto.admin.sale.store', 'Guardar venta (Administrador)', 'Permite registrar una venta', 'Allows storing a sale');
        $permissions_admin[] = $reg('cafeto.admin.movements.sale.show', 'Detalle de venta (Administrador)', 'Permite ver el detalle de una venta', 'Allows viewing sale details');

        // Formulaciones (Admin CRUD + approve)
        $permissions_admin[] = $reg('cafeto.admin.formulations.index', 'Formulaciones (Administrador)', 'Permite ver el listado de formulaciones', 'Allows viewing formulations list');
        $permissions_admin[] = $reg('cafeto.admin.formulations.create', 'Crear formulación (Administrador)', 'Permite acceder al formulario de creación', 'Allows accessing create form');
        $permissions_admin[] = $reg('cafeto.admin.formulations.store', 'Guardar formulación (Administrador)', 'Permite registrar una formulación', 'Allows storing a formulation');
        $permissions_admin[] = $reg('cafeto.admin.formulations.show', 'Ver formulación (Administrador)', 'Permite ver el detalle de una formulación', 'Allows viewing formulation details');
        $permissions_admin[] = $reg('cafeto.admin.formulations.edit', 'Editar formulación (Administrador)', 'Permite acceder al formulario de edición', 'Allows accessing edit form');
        $permissions_admin[] = $reg('cafeto.admin.formulations.update', 'Actualizar formulación (Administrador)', 'Permite actualizar una formulación', 'Allows updating a formulation');
        $permissions_admin[] = $reg('cafeto.admin.formulations.destroy', 'Eliminar formulación (Administrador)', 'Permite eliminar una formulación', 'Allows deleting a formulation');
        $permissions_admin[] = $reg('cafeto.admin.formulations.approve', 'Aprobar formulación (GET) - Administrador', 'Permite acceder a la vista de aprobación', 'Allows accessing approval view');
        $permissions_admin[] = $reg('cafeto.admin.formulations.approve.store', 'Aprobar formulación (POST) - Administrador', 'Permite aprobar y registrar en inventario', 'Allows approving and registering to inventory');

        /*
        |--------------------------------------------------------------------------
        | CASHIER
        |--------------------------------------------------------------------------
        */

        // Dashboard / configuración (Cashier)
        $permissions_cashier[] = $reg('cafeto.cashier.index', 'Vista principal del cajero', 'Permite ver la vista principal del cajero', 'Allows viewing the main cashier dashboard');
        $permissions_cashier[] = $reg('cafeto.cashier.configuration.index', 'Vista de configuración (Cajero)', 'Permite ver la configuración del módulo', 'Allows viewing module configuration');

        // Caja (Cashier)
        $permissions_cashier[] = $reg('cafeto.cashier.cash.index', 'Sesiones de caja (Cajero)', 'Permite ver la sesión de caja e histórico', 'Allows viewing cash session and history');
        $permissions_cashier[] = $reg('cafeto.cashier.cash.store', 'Registrar caja (Cajero)', 'Permite registrar una sesión de caja', 'Allows creating a cash session');
        $permissions_cashier[] = $reg('cafeto.cashier.cash.close', 'Cerrar caja (Cajero)', 'Permite cerrar una sesión de caja', 'Allows closing a cash session');

        // Inventario (Cashier)
        $permissions_cashier[] = $reg('cafeto.cashier.inventory.index', 'Inventario (Cajero)', 'Permite ver el inventario', 'Allows viewing inventory');
        $permissions_cashier[] = $reg('cafeto.cashier.inventory.create', 'Entrada de inventario (Cajero)', 'Permite acceder al formulario de entradas', 'Allows accessing inventory entry form');
        $permissions_cashier[] = $reg('cafeto.cashier.inventory.store', 'Registrar entrada de inventario (Cajero)', 'Permite registrar entradas de inventario', 'Allows storing inventory entries');
        $permissions_cashier[] = $reg('cafeto.cashier.inventory.low', 'Baja de inventario (Cajero)', 'Permite acceder al formulario de bajas', 'Allows accessing inventory removal form');
        $permissions_cashier[] = $reg('cafeto.cashier.inventory.status', 'Estado de productos (Cajero)', 'Permite ver vencidos y por vencer', 'Allows viewing expired and expiring products');
        $permissions_cashier[] = $reg('cafeto.cashier.inventory.popular.toggle', 'Producto popular (Cajero)', 'Permite marcar/desmarcar producto como popular', 'Allows toggling product as popular');

        // Movimientos (Cashier)
        $permissions_cashier[] = $reg('cafeto.cashier.movements.index', 'Histórico de movimientos (Cajero)', 'Permite ver el histórico de movimientos', 'Allows viewing movement history');
        $permissions_cashier[] = $reg('cafeto.cashier.movements.consult', 'Consultar movimientos (Cajero)', 'Permite consultar movimientos por fecha y actor', 'Allows consulting movements by date and actor');
        $permissions_cashier[] = $reg('cafeto.cashier.movements.entries.show', 'Detalle de entrada (Cajero)', 'Permite ver detalle de movimiento de entrada', 'Allows viewing entry movement details');
        $permissions_cashier[] = $reg('cafeto.cashier.movements.low.show', 'Detalle de baja (Cajero)', 'Permite ver detalle de baja', 'Allows viewing removal details');

        // Reportes (Cashier)
        $permissions_cashier[] = $reg('cafeto.cashier.reports.index', 'Reportes (Cajero)', 'Permite ver la sección de reportes', 'Allows viewing reports section');
        $permissions_cashier[] = $reg('cafeto.cashier.reports.inventory.entries', 'Entradas por fecha (Cajero)', 'Permite ver formulario de entradas por fecha', 'Allows viewing entries-by-date form');
        $permissions_cashier[] = $reg('cafeto.cashier.reports.generate.inventory.entries', 'Consultar entradas por fecha (Cajero)', 'Permite consultar entradas por fechas', 'Allows generating entries queries by dates');
        $permissions_cashier[] = $reg('cafeto.cashier.reports.generate.entries.pdf', 'PDF entradas (Cajero)', 'Permite generar PDF de entradas', 'Allows generating entries PDF');
        $permissions_cashier[] = $reg('cafeto.cashier.reports.inventory.generate.pdf', 'PDF inventario (Cajero)', 'Permite generar PDF del inventario', 'Allows generating inventory PDF');
        $permissions_cashier[] = $reg('cafeto.cashier.reports.sales', 'Ventas por fecha (Cajero)', 'Permite ver formulario de ventas por fecha', 'Allows viewing sales-by-date form');
        $permissions_cashier[] = $reg('cafeto.cashier.reports.generate.sales', 'Consultar ventas por fecha (Cajero)', 'Permite consultar ventas por fechas', 'Allows generating sales queries by dates');
        $permissions_cashier[] = $reg('cafeto.cashier.reports.generate.sales.pdf', 'PDF ventas (Cajero)', 'Permite generar PDF de ventas', 'Allows generating sales PDF');
        $permissions_cashier[] = $reg('cafeto.cashier.reports.generate.sales.products.pdf', 'PDF ventas por producto (Cajero)', 'Permite generar PDF de ventas por productos', 'Allows generating sales-by-products PDF');

        // Ventas (Cashier)
        $permissions_cashier[] = $reg('cafeto.cashier.sale.index', 'Ventas en sesión (Cajero)', 'Permite ver ventas de la sesión', 'Allows viewing session sales');
        $permissions_cashier[] = $reg('cafeto.cashier.sale.register', 'Registrar venta (Cajero)', 'Permite acceder al formulario de venta', 'Allows accessing sale form');
        $permissions_cashier[] = $reg('cafeto.cashier.sale.store', 'Guardar venta (Cajero)', 'Permite registrar una venta', 'Allows storing a sale');
        $permissions_cashier[] = $reg('cafeto.cashier.movements.sale.show', 'Detalle de venta (Cajero)', 'Permite ver el detalle de una venta', 'Allows viewing sale details');

        // Formulaciones (Cashier: index/create/store/show)
        // Formulaciones (Cashier)
$permissions_cashier[] = $reg('cafeto.cashier.formulations.index', 'Formulaciones (Cajero)', 'Permite ver el listado de formulaciones', 'Allows viewing formulations list');
$permissions_cashier[] = $reg('cafeto.cashier.formulations.create', 'Crear formulación (Cajero)', 'Permite acceder al formulario de creación', 'Allows accessing create form');
$permissions_cashier[] = $reg('cafeto.cashier.formulations.store', 'Guardar formulación (Cajero)', 'Permite registrar una formulación', 'Allows storing a formulation');
$permissions_cashier[] = $reg('cafeto.cashier.formulations.show', 'Ver formulación (Cajero)', 'Permite ver el detalle de una formulación', 'Allows viewing formulation details');
$permissions_cashier[] = $reg('cafeto.cashier.formulations.edit', 'Editar formulación (Cajero)', 'Permite acceder a edición de formulación', 'Allows accessing formulation edit');
$permissions_cashier[] = $reg('cafeto.cashier.formulations.update', 'Actualizar formulación (Cajero)', 'Permite actualizar una formulación', 'Allows updating a formulation');

        
        /*
        |--------------------------------------------------------------------------
        | INSTRUCTOR
        |--------------------------------------------------------------------------
        */

        // Dashboard / configuración (Instructor)
        $permissions_instructor[] = $reg('cafeto.instructor.index', 'Vista principal del instructor', 'Permite ver la vista principal del instructor', 'Allows viewing the main instructor dashboard');
        $permissions_instructor[] = $reg('cafeto.instructor.configuration.index', 'Vista de configuración (Instructor)', 'Permite ver la configuración del módulo', 'Allows viewing module configuration');

        // Caja (Instructor)
        $permissions_instructor[] = $reg('cafeto.instructor.cash.index', 'Sesiones de caja (Instructor)', 'Permite ver la sesión de caja e histórico', 'Allows viewing cash session and history');
        $permissions_instructor[] = $reg('cafeto.instructor.cash.store', 'Registrar caja (Instructor)', 'Permite registrar una sesión de caja', 'Allows creating a cash session');
        $permissions_instructor[] = $reg('cafeto.instructor.cash.close', 'Cerrar caja (Instructor)', 'Permite cerrar una sesión de caja', 'Allows closing a cash session');

        // Inventario (Instructor)
        $permissions_instructor[] = $reg('cafeto.instructor.inventory.index', 'Inventario (Instructor)', 'Permite ver el inventario', 'Allows viewing inventory');
        $permissions_instructor[] = $reg('cafeto.instructor.inventory.create', 'Entrada de inventario (Instructor)', 'Permite acceder al formulario de entradas', 'Allows accessing inventory entry form');
        $permissions_instructor[] = $reg('cafeto.instructor.inventory.store', 'Registrar entrada de inventario (Instructor)', 'Permite registrar entradas de inventario', 'Allows storing inventory entries');
        $permissions_instructor[] = $reg('cafeto.instructor.inventory.low', 'Baja de inventario (Instructor)', 'Permite acceder al formulario de bajas', 'Allows accessing inventory removal form');
        $permissions_instructor[] = $reg('cafeto.instructor.inventory.status', 'Estado de productos (Instructor)', 'Permite ver vencidos y por vencer', 'Allows viewing expired and expiring products');
        $permissions_instructor[] = $reg('cafeto.instructor.inventory.popular.toggle', 'Producto popular (Instructor)', 'Permite marcar/desmarcar producto como popular', 'Allows toggling product as popular');

        // Movimientos (Instructor)
        $permissions_instructor[] = $reg('cafeto.instructor.movements.index', 'Histórico de movimientos (Instructor)', 'Permite ver el histórico de movimientos', 'Allows viewing movement history');
        $permissions_instructor[] = $reg('cafeto.instructor.movements.consult', 'Consultar movimientos (Instructor)', 'Permite consultar movimientos por fecha y actor', 'Allows consulting movements by date and actor');
        $permissions_instructor[] = $reg('cafeto.instructor.movements.entries.show', 'Detalle de entrada (Instructor)', 'Permite ver detalle de movimiento de entrada', 'Allows viewing entry movement details');
        $permissions_instructor[] = $reg('cafeto.instructor.movements.low.show', 'Detalle de baja (Instructor)', 'Permite ver detalle de baja', 'Allows viewing removal details');

        // Reportes (Instructor)
        $permissions_instructor[] = $reg('cafeto.instructor.reports.index', 'Reportes (Instructor)', 'Permite ver la sección de reportes', 'Allows viewing reports section');
        $permissions_instructor[] = $reg('cafeto.instructor.reports.inventory.entries', 'Entradas por fecha (Instructor)', 'Permite ver formulario de entradas por fecha', 'Allows viewing entries-by-date form');
        $permissions_instructor[] = $reg('cafeto.instructor.reports.generate.inventory.entries', 'Consultar entradas por fecha (Instructor)', 'Permite consultar entradas por fechas', 'Allows generating entries queries by dates');
        $permissions_instructor[] = $reg('cafeto.instructor.reports.generate.entries.pdf', 'PDF entradas (Instructor)', 'Permite generar PDF de entradas', 'Allows generating entries PDF');
        $permissions_instructor[] = $reg('cafeto.instructor.reports.inventory.generate.pdf', 'PDF inventario (Instructor)', 'Permite generar PDF del inventario', 'Allows generating inventory PDF');
        $permissions_instructor[] = $reg('cafeto.instructor.reports.sales', 'Ventas por fecha (Instructor)', 'Permite ver formulario de ventas por fecha', 'Allows viewing sales-by-date form');
        $permissions_instructor[] = $reg('cafeto.instructor.reports.generate.sales', 'Consultar ventas por fecha (Instructor)', 'Permite consultar ventas por fechas', 'Allows generating sales queries by dates');
        $permissions_instructor[] = $reg('cafeto.instructor.reports.generate.sales.pdf', 'PDF ventas (Instructor)', 'Permite generar PDF de ventas', 'Allows generating sales PDF');
        $permissions_instructor[] = $reg('cafeto.instructor.reports.generate.sales.products.pdf', 'PDF ventas por producto (Instructor)', 'Permite generar PDF de ventas por productos', 'Allows generating sales-by-products PDF');

        // Ventas (Instructor)
        $permissions_instructor[] = $reg('cafeto.instructor.sale.index', 'Ventas en sesión (Instructor)', 'Permite ver ventas de la sesión', 'Allows viewing session sales');
        $permissions_instructor[] = $reg('cafeto.instructor.sale.register', 'Registrar venta (Instructor)', 'Permite acceder al formulario de venta', 'Allows accessing sale form');
        $permissions_instructor[] = $reg('cafeto.instructor.sale.store', 'Guardar venta (Instructor)', 'Permite registrar una venta', 'Allows storing a sale');
        $permissions_instructor[] = $reg('cafeto.instructor.movements.sale.show', 'Detalle de venta (Instructor)', 'Permite ver el detalle de una venta', 'Allows viewing sale details');

        // Formulaciones (Instructor CRUD + approve)
        $permissions_instructor[] = $reg('cafeto.instructor.formulations.index', 'Formulaciones (Instructor)', 'Permite ver el listado de formulaciones', 'Allows viewing formulations list');
        $permissions_instructor[] = $reg('cafeto.instructor.formulations.create', 'Crear formulación (Instructor)', 'Permite acceder al formulario de creación', 'Allows accessing create form');
        $permissions_instructor[] = $reg('cafeto.instructor.formulations.store', 'Guardar formulación (Instructor)', 'Permite registrar una formulación', 'Allows storing a formulation');
        $permissions_instructor[] = $reg('cafeto.instructor.formulations.show', 'Ver formulación (Instructor)', 'Permite ver el detalle de una formulación', 'Allows viewing formulation details');
        $permissions_instructor[] = $reg('cafeto.instructor.formulations.edit', 'Editar formulación (Instructor)', 'Permite acceder al formulario de edición', 'Allows accessing edit form');
        $permissions_instructor[] = $reg('cafeto.instructor.formulations.update', 'Actualizar formulación (Instructor)', 'Permite actualizar una formulación', 'Allows updating a formulation');
        $permissions_instructor[] = $reg('cafeto.instructor.formulations.destroy', 'Eliminar formulación (Instructor)', 'Permite eliminar una formulación', 'Allows deleting a formulation');
        $permissions_instructor[] = $reg('cafeto.instructor.formulations.approve', 'Aprobar formulación (GET) - Instructor', 'Permite acceder a la vista de aprobación', 'Allows accessing approval view');
        $permissions_instructor[] = $reg('cafeto.instructor.formulations.approve.store', 'Aprobar formulación (POST) - Instructor', 'Permite aprobar y registrar en inventario', 'Allows approving and registering to inventory');

        /*
        |--------------------------------------------------------------------------
        | ASIGNACIÓN A ROLES
        |--------------------------------------------------------------------------
        */
        $rol_admin      = Role::where('slug', 'cafeto.admin')->firstOrFail();
        $rol_cashier    = Role::where('slug', 'cafeto.cashier')->firstOrFail();
        $rol_instructor = Role::where('slug', 'cafeto.instructor')->firstOrFail();

        // Admin: TODO (si quieres que el “super admin” sea admin con todo)
        $rol_admin->permissions()->syncWithoutDetaching(array_unique($permissions_admin));

        // Cashier / Instructor: solo sus permisos
        $rol_cashier->permissions()->syncWithoutDetaching(array_unique($permissions_cashier));
        $rol_instructor->permissions()->syncWithoutDetaching(array_unique($permissions_instructor));
    }
}
