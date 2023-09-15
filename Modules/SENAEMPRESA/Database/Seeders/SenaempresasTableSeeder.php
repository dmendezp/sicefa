<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SENAEMPRESA\Entities\senaempresa;
use Modules\SICA\Entities\Quarter;

class SenaempresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quarters = Quarter::pluck('id')->toArray();

        // Define la cantidad de registros que deseas crear
        $numSenaempresas = 10;

        $quarterIndex = 0;

        for ($i = 0; $i < $numSenaempresas; $i++) {
            // Asegurarse de no desbordar el índice de quarters
            if ($quarterIndex >= count($quarters)) {
                $quarterIndex = 0;
            }

            Senaempresa::firstOrCreate([
                'name' => 'Senaempresa ' . ($i + 1),
                'description' => 'Descripción de Senaempresa ' . ($i + 1),
                'quarter_id' => $quarters[$quarterIndex],
            ]);

            $quarterIndex++; // Avanzar al siguiente quarter_id
        }
    }
}
