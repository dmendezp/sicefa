<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Line;

class LinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $number_lines = 6; // Definir la cantidad de líneas tecnológicas de prueba

        Line::updateOrCreate([ // Actualizar o registrar línea tecnológica
            'name' => 'TECNOLOGÍAS DE LA INFORMACIÓN Y LAS COMUNICACIONES GESTIÓN DE LA INFORMACIÓN'
        ]);

        Line::factory()->count($number_lines)->create(); // Generar líneas tecnológicas de prueba de acuerdo a la cantidad requerida

    }
}
