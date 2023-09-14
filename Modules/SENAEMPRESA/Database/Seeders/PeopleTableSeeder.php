<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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

        // Consulta o registro de datos Junior Stiven Medina Hernandez
        Person::firstOrCreate(['document_number' => 1079173785], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'JUNIOR STIVEN',
            'first_last_name' => 'MEDINA',
            'second_last_name' => 'HERNANDEZ',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);
        // Consulta o registro de datos Jenifer Marin Montealegre
        Person::firstOrCreate(['document_number' => 1075791904], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'JENIFER',
            'first_last_name' => 'MARIN',
            'second_last_name' => 'MONTEALEGRE',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);
        // Consulta o registro de datos Diego Alejandro Penagos
        Person::firstOrCreate(['document_number' => 1081152391], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'DIEGO ALEJANDRO',
            'first_last_name' => 'PENAGOS',
            'second_last_name' => 'NINCO',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);
        // Consulta o registro de datos Jary Liceth Garay Fajardo
        Person::firstOrCreate(['document_number' => 1079173006], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'JARY LICETH',
            'first_last_name' => 'GARAY',
            'second_last_name' => 'FAJARDO',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);
    }
}
