<?php

namespace Modules\SIGAC\Database\Seeders;

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

        // Consulta o registro de datos para María Antonia Gonzáles Gonzáles (Coordinadora Académica)
        Person::firstOrCreate(['document_number' => 36281368], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'MARÍA ANTONIA',
            'first_last_name' => 'GONZALES',
            'second_last_name' => 'GONZALES',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        // Consulta o registro de datos para Rúben Dario Delgado Cruz (Instructor)
        Person::firstOrCreate(['document_number' => 4433177],[ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'RÚBEN DARIO',
            'first_last_name' => 'DELGADO',
            'second_last_name' => 'CRUZ',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        // Consulta o registro de datos para Esperanza Pascuas Perdomo (Bienestar)
        Person::firstOrCreate(['document_number' => 36161503],[ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'ESPERANZA',
            'first_last_name' => 'PASCUAS',
            'second_last_name' => 'PERDOMO',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        // Consulta o registro de datos para Jesús David Guevara Munar (Aprendiz)
        Person::firstOrCreate(['document_number' => 1004494010], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'JESÚS DAVID',
            'first_last_name' => 'GUEVARA',
            'second_last_name' => 'MUNAR',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        // Consulta o registro de datos para Manuel Steven Ossa Lievano (Superadministrador)
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
