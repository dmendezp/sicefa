<?php

namespace Modules\AGROCEFA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Sector;
use Modules\SICA\Entities\Farm;

class WarehouseEntranceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Consultar la app para realizar la creacion de roles
        $app = App::where('name','AGROCEFA')->first();

        $sector = Sector::updateOrCreate([ 
            'name' => 'Agricola',
            'description' => 'Sector agricola del cefa',
        ]);

        $farm = Farm::updateOrCreate([ 
            'name' => 'Cefa',
            'description' => 'Granja Agruindustrial la angostura (cefa)',
            'area' => '800000',
            'person_id' => '3',
            'municipality_id' => '4'
        ]);

        $warehouseentrance = Warehouse::updateOrCreate([ 
            'name' => 'Externa',
            'description' => 'Bodega para realizar movimientos de entrada',
            'app_id' => $app->id
        ]);

        $productiveentrance = ProductiveUnit::updateOrCreate([ 
            'name' => 'Almacen',
            'description' => 'Unidad para realizar movimientos de entrada',
            'person_id' => '5',
            'sector_id' => $sector->id,
            'farm_id' => $farm->id
        ]);

        $productive_unit_warehouse = ProductiveUnitWarehouse::updateOrCreate([
            'productive_unit_id' => $productiveentrance->id,
            'warehouse_id' => $warehouseentrance->id
        ]);
    }
}
