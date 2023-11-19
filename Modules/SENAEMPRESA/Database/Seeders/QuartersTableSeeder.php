<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Quarter;
use Faker\Factory as Faker;

class QuartersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_ES');

        // Define el año para el que deseas crear los trimestres
        $year = date('Y');

        for ($i = 0; $i < 4; $i++) {
            $name = 'Trimestre ' . ($i + 1);

            // Calcula las fechas de inicio y fin del trimestre
            $startMonth = ($i * 3) + 1;
            $endMonth = $startMonth + 2;
            $startDate = $year . '-' . str_pad($startMonth, 2, '0', STR_PAD_LEFT) . '-01';
            $endDate = $year . '-' . str_pad($endMonth, 2, '0', STR_PAD_LEFT) . '-01';

            Quarter::updateOrCreate(
                ['name' => $name], // Verifica si ya existe un trimestre con el mismo nombre
                [
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ]
            );
        }
    }
}
