<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Sector;
use Modules\SICA\Entities\Warehouse;

class WarehousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* Obtener aplicación del Sistema Integrado de control administrativo */
        $app = App::where('name','SICA')->firstOrFail();

        /* Registro o actualización de la unidad productiva Complejo agroindustrial */
        $leader = Person::where('document_number', 7723876)->firstOrFail(); // Consulta de datos personales de Vilmer Andres Mendez Murcia
        $sector = Sector::where('name','Comercial')->firstOrFail(); // Consulta del sector
        $farm = Farm::where('name','CEFA')->firstOrFail(); // Consulta de la finca del Centro de Formación Agroindustrial La Angostura
        $productive_unit = ProductiveUnit::updateOrCreate(['name' => 'Complejo agroindustrial'], [
            'description' => 'Unidad del centro de formación dedicada a la fabricación de productos tipo industrial',
            'icon' => 'fas fa-dolly',
            'person_id' => $leader->id,
            'sector_id' => $sector->id,
            'farm_id' => $farm->id
        ]);

        /* Registro o actualización de bodega para Agroindustria */
        $warehouse = Warehouse::updateOrCreate(['name' => 'Agroindustria'], [
            'description' => 'Bodega general del complejo complejo agroindustrial',
            'app_id' => $app->id
        ]);

        // Asociar a bodega con unidad unidad productiva
        ProductiveUnitWarehouse::firstOrCreate([
            'productive_unit_id' => $productive_unit->id,
            'warehouse_id' => $warehouse->id
        ]);

    }
}
