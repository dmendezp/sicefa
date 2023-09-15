<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SENAEMPRESA\Entities\PositionCompany;
use Modules\SENAEMPRESA\Entities\Vacancy;
use Faker\Factory as Faker;

class VacanciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_ES');

        $positionCompanyIds = PositionCompany::pluck('id')->all();

        // Define la cantidad de registros que deseas crear
        $numVacancies = 20;

        for ($i = 0; $i < $numVacancies; $i++) {
            $positionCompanyId = $positionCompanyIds[array_rand($positionCompanyIds)];

            // Utiliza firstOrCreate para evitar duplicados
            Vacancy::firstOrCreate([
                'name' => $faker->jobTitle,
                'image' => 'imagen_' . rand(1, 10) . '.jpg',
                'description_general' => $faker->paragraph,
                'requirement' => $faker->sentence,
                'position_company_id' => $positionCompanyId,
                'start_datetime' => $faker->dateTimeBetween('-30 days', '+30 days')->format('Y-m-d H:i:s'),
                'end_datetime' => $faker->dateTimeBetween('+31 days', '+60 days')->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
