<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\PopulationGroup;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $population_group = PopulationGroup::firstOrCreate(['name' => 'NINGUNA']); // Consultar o registrar Grupo Poblacional
        $eps = EPS::firstOrCreate(['name' => 'NO REGISTRA']); // Consultar o registrar EPS

        // Consulta o registro de datos para Lola Fernanda Herrera Hernandez
        Person::firstOrCreate(['document_number' => 52829681], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'LOLA FERNANDA',
            'first_last_name' => 'HERRERA',
            'second_last_name' => 'HERNANDEZ',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id
        ]);

    }
}
