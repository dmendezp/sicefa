<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\MeasurementUnit;

class MeasurementUnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $number_measurement_units = 12; // Definir la cantidad de categorías de prueba

        MeasurementUnit::updateOrCreate(['name' => 'Unidad'],[  // Actualizar o registrar Unidad de medida
            'minimum_unit_measure' => 'Unidad',
            'conversion_factor' => 1
        ]);

        MeasurementUnit::factory()->count($number_measurement_units)->create(); // Generar unidades de medida de prueba de acuerdo a la cantidad requerida

    }
}
