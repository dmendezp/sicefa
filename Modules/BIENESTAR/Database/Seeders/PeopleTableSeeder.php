<?php

namespace Modules\BIENESTAR\Database\Seeders;

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

        // Consulta o registro de datos para Lola Fernanda Herrera Hernandez (Líder de Punto de venta)
        Person::firstOrCreate(['document_number' => 1079179415], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',  
            'first_name' => 'LEANDRA',
            'first_last_name' => 'DIAZ',
            'second_last_name' => 'DIAZ',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        // Consulta o registro de datos para Vilmer Andres Mendez Murcia (Líder de agroindustria)
        Person::firstOrCreate(['document_number' => 1079178547], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'DIANA PAOLA ',
            'first_last_name' => 'FIGUEROA',
            'second_last_name' => 'POLANIA',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        // Consulta o registro de datos para Manuel Steven Ossa Lievano (Cajero de punto de venta)
        Person::firstOrCreate(['document_number' => 1079173847], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'BRAYAN DAVID',
            'first_last_name' => 'GARZON',
            'second_last_name' => 'LIZCANO',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        // Consulta o registro de datos para Jesús David Guevara Munar (Superadministrador)
        Person::firstOrCreate(['document_number' => 1076904275], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'JUAN DAVID',
            'first_last_name' => 'RICO',
            'second_last_name' => 'CERQUERA',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

         // Consulta o registro de datos para Jesús David Guevara Munar (Superadministrador)
         Person::firstOrCreate(['document_number' => 1079172278], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'SAIRA XIOMARA',
            'first_last_name' => 'GUEVARA',
            'second_last_name' => 'CERQUERA',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

    }
}
