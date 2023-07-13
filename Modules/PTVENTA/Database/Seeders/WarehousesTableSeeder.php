<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CEFAMAPS\Entities\App;
use Modules\SICA\Entities\Sector;
use Modules\SICA\Entities\Country;
use Modules\SICA\Entities\Department;
use Modules\SICA\Entities\Municipality;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\ProductiveUnit;
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

        /* Registro o actualización de bodega para Agroindustria */
        Warehouse::updateOrCreate(['name' => 'Agroindustria'], [
            'description' => 'Bodega general del complejo complejo agroindustrial',
            'app_id' => $app->id
        ]);

    }
}
