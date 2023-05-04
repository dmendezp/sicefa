<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Network;
use Modules\SICA\Entities\Program;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $number_programs = 24; // Definir la cantidad de programas de prueba

        $network = Network::where('name','TECNOLOGÍAS DE LA INFORMACIÓN, DISEÑO Y DESARROLLO DE SOFTWARE')->first(); // Consultar o registrar red de conocimiento
        Program::updateOrCreate(['sofia_code' => 822106],[ // Actualizar o registrar Programa de formación
            'name' => 'ANÁLISIS Y DESARROLLO DE SISTEMAS DE INFORMACIÓN',
            'network_id' => $network->id,
            'program_type' => 'Tecnólogo',
            'sofia_code' => 822106
        ]);

        Program::factory()->count($number_programs)->create(); // Generar cursos de formación de prueba de acuerdo a la cantidad requerida

    }
}
