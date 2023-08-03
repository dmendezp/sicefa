<?php

namespace Modules\SIGAC\Database\Seeders;

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

        // Consulta o registro de datos para María Antonia Gonzáles Gonzáles
        Person::firstOrCreate(['document_number' => 36281368], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'MARÍA ANTONIA',
            'first_last_name' => 'GONZALES',
            'second_last_name' => 'GONZALES',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id
        ]);

    }
}
