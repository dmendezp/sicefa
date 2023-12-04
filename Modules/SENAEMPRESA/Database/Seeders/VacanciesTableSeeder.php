<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SENAEMPRESA\Entities\PositionCompany;
use Modules\SENAEMPRESA\Entities\Vacancy;
use Faker\Factory as Faker;
use Modules\SENAEMPRESA\Entities\senaempresa;

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

        // Filter only active positions
        $positionCompanyIds = PositionCompany::where('state', 'activo')->pluck('id')->all();
        $senaempresaIds = senaempresa::pluck('id')->all();

        if (empty($positionCompanyIds) || empty($senaempresaIds)) {
            // Handle the case where one or both arrays are empty, e.g., by creating some default records
        } else {
            // Your existing code for seeding
            $numVacancies = 20;

            for ($i = 0; $i < $numVacancies; $i++) {
                $positionCompanyId = $positionCompanyIds[array_rand($positionCompanyIds)];
                $senaempresaId = $senaempresaIds[array_rand($senaempresaIds)];

                // Utiliza firstOrCreate para evitar duplicados
                Vacancy::firstOrCreate([
                    'name' => $faker->jobTitle,
                    'image' => 'imagen_' . rand(1, 10) . '.jpg',
                    'description_general' => $faker->paragraph,
                    'requirement' => $faker->sentence,
                    'senaempresa_id' => $senaempresaId,
                    'position_company_id' => $positionCompanyId,
                    'start_datetime' => $faker->dateTimeBetween('-30 days', '+30 days')->format('Y-m-d H:i:s'),
                    'end_datetime' => $faker->dateTimeBetween('+31 days', '+60 days')->format('Y-m-d H:i:s'),
                    'state' => 'Disponible',
                ]);
            }
        }
    }
}
