<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SENAEMPRESA\Entities\Senaempresa;
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
        // Obtener todos los trimestres ordenados por fecha de inicio y fecha de fin
        $quarters = Quarter::orderBy('start_date')->orderBy('end_date')->get();

        foreach ($quarters as $quarter) {
            // Crear una única Senaempresa por trimestre
            Senaempresa::updateOrCreate([
                'name' => 'Senaempresa ' . $quarter->name,
                'description' => 'Descripción de Senaempresa ' . $quarter->name,
                'quarter_id' => $quarter->id,
            ]);
        }
    }
}
