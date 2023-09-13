<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PensionEntity;
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
        $pension_entity = PensionEntity::firstOrCreate(['name' => 'NO REGISTRA']); // Consultar o registrar Entidad de pensiones

        // Consulta o registro de datos para Diego Andrés Méndez Pastrana
        Person::firstOrCreate(['document_number' => 7713344],[ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'DIEGO ANDRÉS',
            'first_last_name' => 'MÉNDEZ',
            'second_last_name' => 'PASTRANA',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        // Consulta o registro de datos para Gloria Maritza Sanchez Alarcón
        Person::firstOrCreate(['document_number' => 51784954],[ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'GLORIA MARITZA',
            'first_last_name' => 'SANCHEZ',
            'second_last_name' => 'ALARCON',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        // Consulta o registro de datos para Diego Andrés Tovar Rodriguez
        Person::firstOrCreate(['document_number' => 1004224747],[ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'DIEGO ANDRÉS',
            'first_last_name' => 'TOVAR',
            'second_last_name' => 'RODRIGUEZ',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        // Consulta o registro de datos para Jesús David Guevara Munar
        Person::firstOrCreate(['document_number' => 1004494010],[ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'JESÚS DAVID',
            'first_last_name' => 'GUEVARA',
            'second_last_name' => 'MUNAR',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        // Consulta o registro de datos para Manuel Steven Ossa Lievano
        Person::firstOrCreate(['document_number' => 1000226706], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'MANUEL STEVEN',
            'first_last_name' => 'OSSA',
            'second_last_name' => 'LIEVANO',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

    }
}
