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

       $sector = Sector::where('name','Agricola')->first();

       $farm = Farm::where('name','CEFA')->first();

       $warehouse = Warehouse::updateOrCreate([ 
           'name' => 'General Agricola',
           'description' => 'Bodega general del sector agricola del cefa',
           'app_id' => $app->id
       ]);

       $productiveunit = ProductiveUnit::updateOrCreate([ 
           'name' => 'Piña',
           'description' => 'Unidad Productiva de piña',
           'person_id' => '5',
           'sector_id' => $sector->id,
           'farm_id' => $farm->id
       ]);

       $productive_unit_warehouse = ProductiveUnitWarehouse::updateOrCreate([
           'productive_unit_id' => $productiveunit->id,
           'warehouse_id' => $warehouse->id
       ]);

       $activity_type = ActivityType::updateOrCreate([
            'name' => 'Agricola'
       ]);

       $activity = Activity::updateOrCreate([
            'name' => 'Siembra',
            'productive_unit_id' => $productiveunit->id,
            'activity_type_id' => $activity_type->id,
            'description' => 'Actividad para realizar la siembra',
            'period' => 'Mensual'
       ]);

       $responsibilitiesadmin = Responsibility::updateOrCreate([
            'activity_id' => $activity->id,
            'role_id' => $roltrainer->id
       ]);
       
       $responsibilitiespassant = Responsibility::updateOrCreate([
        'activity_id' => $activity->id,
        'role_id' => $rolapassant->id
   ]);
    }
}
