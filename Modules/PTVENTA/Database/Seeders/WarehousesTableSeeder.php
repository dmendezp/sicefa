<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
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
