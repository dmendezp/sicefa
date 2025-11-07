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
use Modules\SICA\Entities\Responsibility;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\ActivityType;

class ProductiveUnitTableSeeder extends Seeder
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
        'description' => 'Unidades encargadas de realizar producciones agricolas',
    ]);

       $farm = Farm::where('name','CEFA')->first();

       $warehouse = Warehouse::updateOrCreate([ 
           'name' => 'General Agricola',
           'description' => 'Bodega general del sector agricola del cefa',
           'app_id' => $app->id
       ]);

       $productiveunitnew = ProductiveUnit::updateOrCreate([ 
        'name' => 'Almacen Agricola',
        'description' => 'Almacen para movimientos de entrada',
        'person_id' => '5',
        'sector_id' => $sector->id,
        'farm_id' => $farm->id
        ]);

    }
}
