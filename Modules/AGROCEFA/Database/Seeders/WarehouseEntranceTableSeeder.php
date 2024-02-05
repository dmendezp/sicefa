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

        $person = Person::where('document_number','13706')->first();

        $sector = Sector::updateOrCreate([ 
            'name' => 'Agricola',
            'description' => 'Sector agricola del cefa',
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

        $farm = Farm::updateOrCreate([ 
            'name' => 'Cefa',
            'description' => 'Granja Agruindustrial la angostura (cefa)',
            'area' => '800000',
            'person_id' => $person->id,
            'municipality_id' => $municipality->id
        ]);

        $warehouseentrance = Warehouse::updateOrCreate([ 
            'name' => 'Externa Agricola',
            'description' => 'Bodega para realizar movimientos de entrada',
            'app_id' => $app->id
        ]);

        $productiveentrance = ProductiveUnit::updateOrCreate([ 
            'name' => 'Almacen',
            'description' => 'Unidad para realizar movimientos de entrada',
            'person_id' => $person->id,
            'sector_id' => $sector->id,
            'farm_id' => $farm->id
        ]);

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
