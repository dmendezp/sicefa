<?php

namespace Modules\CAFETO\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\MovementType;

class MovementTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Registrar tipo de movimiento para ventas
        MovementType::firstOrCreate(['name' => 'Venta'],[
            'consecutive' => 0
        ]);

        // Registrar tipo de movimiento para entradas de inventario
        MovementType::firstOrCreate(['name' => 'Movimiento Interno'],[
            'consecutive' => 0
        ]);

    }
}
