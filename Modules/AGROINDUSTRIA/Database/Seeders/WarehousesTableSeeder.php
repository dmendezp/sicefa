<?php

namespace Modules\AGROINDUSTRIA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Sector;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Role;

class WarehousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productive_unit_admin = [];
        $productive_unit_vilmer = [];
        $productive_unit_chocolate = [];
        $productive_unit_cerveceria = [];
        $productive_unit_almacenista = [];

        $warehouse_units_vilmer = [];
        $warehouse_units_chocolate = [];
        $warehouse_units_cerveceria = [];

        /* Obtener aplicación del Sistema Integrado de control administrativo */
        $app = App::where('name','SICA')->firstOrFail();

        /* Registro o actualización de la unidad productiva Complejo agroindustrial */
        $leader = Person::where('document_number', 1083874040)->firstOrFail(); // Consulta de datos personales de Vilmer Andres Mendez Murcia
        $sector = Sector::where('name','Comercial')->firstOrFail(); // Consulta del sector
        $farm = Farm::where('name','CEFA')->firstOrFail(); // Consulta de la finca del Centro de Formación Agroindustrial La Angostura

        /* Traer el la bodega de Agroindustria */
        $warehouse = Warehouse::updateOrCreate([ 
            'name' => 'Agroindustria',
            'description' => 'Bodega de las unidades productivas del sector Agroindustrial',
            'app_id' => $app->id
        ]);


        $productive_unit = ProductiveUnit::updateOrCreate(['name' => 'Panadería'], [
            'description' => 'Unidad del complejo agroindustrial dedicada a la panadería',
            'icon' => 'fas fa-bread-slice',
            'person_id' => $leader->id,
            'sector_id' => $sector->id,
            'farm_id' => $farm->id
        ]);

        $productive_unit_admin[] = $productive_unit->id;
        $productive_unit_almacenista[] = $productive_unit->id;
        $productive_unit_vilmer[] = $productive_unit->id;

        // Asociar a bodega con unidad unidad productiva
        ProductiveUnitWarehouse::firstOrCreate([
            'productive_unit_id' => $productive_unit->id,
            'warehouse_id' => $warehouse->id
        ]);
        
        $productive_unit = ProductiveUnit::updateOrCreate(['name' => 'Cárnicos'], [
            'description' => 'Unidad del complejo agroindustrial dedicada a la creacion de productos cárnicos',
            'icon' => 'fas fa-bacon',
            'person_id' => $leader->id,
            'sector_id' => $sector->id,
            'farm_id' => $farm->id
        ]);

        $productive_unit_admin[] = $productive_unit->id;
        $productive_unit_almacenista[] = $productive_unit->id;
        $productive_unit_vilmer[] = $productive_unit->id;

        // Asociar a bodega con unidad unidad productiva
        ProductiveUnitWarehouse::firstOrCreate([
            'productive_unit_id' => $productive_unit->id,
            'warehouse_id' => $warehouse->id
        ]);

        $productive_unit = ProductiveUnit::updateOrCreate(['name' => 'Pastelería'], [
            'description' => 'Unidad del complejo agroindustrial dedicada a la pastelería',
            'icon' => 'fas fa-birthday-cake',
            'person_id' => $leader->id,
            'sector_id' => $sector->id,
            'farm_id' => $farm->id
        ]);

        $productive_unit_admin[] = $productive_unit->id;
        $productive_unit_almacenista[] = $productive_unit->id;
        $productive_unit_vilmer[] = $productive_unit->id;

        // Asociar a bodega con unidad unidad productiva
        ProductiveUnitWarehouse::firstOrCreate([
            'productive_unit_id' => $productive_unit->id,
            'warehouse_id' => $warehouse->id
        ]);

        $productive_unit = ProductiveUnit::updateOrCreate(['name' => 'Frutas'], [
            'description' => 'Unidad del complejo agroindustrial dedicada al procesamiento de frutas',
            'icon' => 'fas fa-apple-alt',
            'person_id' => $leader->id,
            'sector_id' => $sector->id,
            'farm_id' => $farm->id
        ]);

        $productive_unit_admin[] = $productive_unit->id;
        $productive_unit_almacenista[] = $productive_unit->id;
        $productive_unit_vilmer[] = $productive_unit->id;

        // Asociar a bodega con unidad unidad productiva
        ProductiveUnitWarehouse::firstOrCreate([
            'productive_unit_id' => $productive_unit->id,
            'warehouse_id' => $warehouse->id
        ]);

        $productive_unit = ProductiveUnit::updateOrCreate(['name' => 'Chocolatería'], [
            'description' => 'Unidad del complejo agroindustrial dedicada a la chocolatería',
            'icon' => 'fas fa-mug-hot',
            'person_id' => $leader->id,
            'sector_id' => $sector->id,
            'farm_id' => $farm->id
        ]);

        $productive_unit_admin[] = $productive_unit->id;
        $productive_unit_almacenista[] = $productive_unit->id;
        $productive_unit_chocolate[] = $productive_unit->id;

        // Asociar a bodega con unidad unidad productiva
        ProductiveUnitWarehouse::firstOrCreate([
            'productive_unit_id' => $productive_unit->id,
            'warehouse_id' => $warehouse->id
        ]);

        $productive_unit = ProductiveUnit::updateOrCreate(['name' => 'Cervecería'], [
            'description' => 'Unidad del complejo agroindustrial dedicada a la cervecería',
            'icon' => 'fas fa-beer',
            'person_id' => $leader->id,
            'sector_id' => $sector->id,
            'farm_id' => $farm->id
        ]);

        $productive_unit_admin[] = $productive_unit->id;
        $productive_unit_almacenista[] = $productive_unit->id;
        $productive_unit_cerveceria[] = $productive_unit->id;

        // Asociar a bodega con unidad unidad productiva
        ProductiveUnitWarehouse::firstOrCreate([
            'productive_unit_id' => $productive_unit->id,
            'warehouse_id' => $warehouse->id
        ]);
        
        $rol_super_admin = Role::where('slug', 'superadmin')->first(); // Rol SuperAdministrador
        $rol_admin = Role::where('slug', 'agroindustria.admin')->first(); // Rol Administrador
        $rol_instructor_vilmer = Role::where('slug', 'agroindustria.instructor.vilmer')->first(); // Rol Coordinado Académico
        $rol_instructor_chocolate = Role::where('slug', 'agroindustria.instructor.chocolate')->first(); // Rol Coordinado Académico
        $rol_instructor_cerveceria = Role::where('slug', 'agroindustria.instructor.cerveceria')->first(); // Rol Coordinado Académico
        $rol_almacenista = Role::where('slug', 'agroindustria.almacenista')->first(); // Rol Coordinado Académico

        

        // Asignación de Unidades Productivas para los ROLES de la aplicación AGROINDUSTRIA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_super_admin->productive_units()-> syncWithoutDetaching($productive_unit_admin);
        $rol_admin->productive_units()-> syncWithoutDetaching($productive_unit_admin);
        $rol_instructor_vilmer->productive_units()->syncWithoutDetaching($productive_unit_vilmer);
        $rol_almacenista->productive_units()->syncWithoutDetaching($productive_unit_almacenista);

    }
}