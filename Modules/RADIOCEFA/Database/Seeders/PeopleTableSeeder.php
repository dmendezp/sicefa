<?php

namespace Modules\RADIOCEFA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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

        // Consulta o registro de datos 
        Person::firstOrCreate(['document_number' => 1125276647],[ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'MARIA DEL CARMEN',
            'first_last_name' => 'ROSELL',
            'second_last_name' => 'PEREZ',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id
        ]);
    }
}
