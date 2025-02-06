<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SENAEMPRESA\Entities\PositionCompany;

class PositionCompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numPositions = 10; // cantidad de cargos 

        for ($i = 0; $i < $numPositions; $i++) {
            $name = 'Cargo #' . ($i + 2) . ' - ' . uniqid();
            $description = 'Descripción del cargo #' . ($i + 1);

            PositionCompany::updateOrCreate(
                ['name' => $name],
                ['description' => $description, 'state' => rand(0, 1) ? 'activo' : 'inactivo']
            );
        }
    }
}
