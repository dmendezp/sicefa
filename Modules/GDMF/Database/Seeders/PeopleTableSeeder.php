<?php

namespace Modules\GDMF\Database\Seeders;

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
        Person::firstOrCreate(['document_number' => 1003896364], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'JESUS DAVID1',
            'first_last_name' => 'AYALA',
            'second_last_name' => '',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);
        // Consulta o registro de datos para María Antonia Gonzáles Gonzáles (Coordinadora Académica)
        Person::firstOrCreate(['document_number' => 2003896364], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'JESUS DAVID2',
            'first_last_name' => 'AYALA',
            'second_last_name' => '',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);
    }
}
