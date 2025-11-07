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
use Modules\SICA\Entities\Department;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Municipality;
use Modules\SICA\Entities\Country;
use Modules\SICA\Entities\MovementType;

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

        $person = Person::where('document_number','12275825')->first();

        $sector = Sector::where('name','Agricola')->first();

        $farm = Farm::where('name','CEFA')->first();

        $productiveunitnew = ProductiveUnit::firstOrNew([ 
            'name' => 'Almacen',
            'description' => 'Almacen para movimientos de entrada',
            'person_id' => '5',
            'sector_id' => $sector->id,
            'farm_id' => $farm->id
            ]);

        $country = Country::updateOrCreate([ 
            'name' => 'Colombia'
        ]);

        $departament = Department::updateOrCreate([ 
            'name' => 'Huila',
            'country_id' => $country->id,
        ]);

        $municipality = Municipality::updateOrCreate([ 
            'name' => 'Campoalegre',
            'department_id' => $departament->id,
        ]);

        $warehouseentrance = Warehouse::updateOrCreate([ 
            'name' => 'Externa Agricola',
            'description' => 'Bodega para realizar movimientos de entrada',
            'app_id' => $app->id
        ]);

        $productiveentrance = ProductiveUnit::where('name', 'Almacen')->first();

        $productive_unit_warehouse = ProductiveUnitWarehouse::updateOrCreate([
            'productive_unit_id' => $productiveentrance->id,
            'warehouse_id' => $warehouseentrance->id
        ]);

        $movementype = MovementType::updateOrCreate([
            'name' => 'Movimiento Entrada',
            'consecutive' => 0
        ]);
    }
}
