<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Line;
use Modules\SICA\Entities\Network;

class NetworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $number_networks = 5; // Definir la cantida Redes de conocimientos de prueba

        $line = Line::where('name','TECNOLOGÍAS DE LA INFORMACIÓN Y LAS COMUNICACIONES GESTIÓN DE LA INFORMACIÓN')->first(); // Consultar línea tecnológica
        Network::updateOrCreate(['name' => 'TECNOLOGÍAS DE LA INFORMACIÓN, DISEÑO Y DESARROLLO DE SOFTWARE'],[ // Actualizar o registrar Red de conocimiento
            'line_id' => $line->id
        ]);

        Network::factory()->count($number_networks)->create(); // Generar redes de conocimiento de prueba de acuerdo a la cantidad requerida

    }
}
