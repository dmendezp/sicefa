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

        // Define la cantidad de registros que deseas crear
        $numQuarters = 10;

        for ($i = 0; $i < $numQuarters; $i++) {
            $name = 'Trimestre ' . ($i + 1);
            $startDate = $faker->dateTimeBetween('-60 days', '+60 days')->format('Y-m-d');
            $endDate = $faker->dateTimeBetween($startDate, '+90 days')->format('Y-m-d');

            Quarter::firstOrCreate(
                ['name' => $name], // Verifica si ya existe un trimestre con el mismo nombre
                [
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ]
            );
        }
    }
}
