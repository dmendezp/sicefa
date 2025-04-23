<?php

namespace Modules\SIPORK\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PensionEntity;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\PopulationGroup;

class PeopleTableSeeder extends Seeder{
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


        // Consulta o registro de datos para Darwin Martinez Grajales (Líder de Unidad Porcina)
        Person::updateOrCreate(['document_number' => 1116914471], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'DARWIN',
            'first_last_name' => 'MARTINEZ',
            'second_last_name' => 'GRAJALES',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id,
        ]);

        // Consulta o registro de datos para Juan David Ricaurte Hernandez (Instructor de Unidad Porcina)
        Person::updateOrCreate(['document_number' => 1075221515], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'JUAN',
            'first_last_name' => 'RICAURTE',
            'second_last_name' => 'HERNANDEZ',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id,
        ]);

         // Consulta o registro de datos para Nicolle Andrea Ramirez Quina (Aprendiz de Unidad Porcina)
         Person::updateOrCreate(['document_number' => 1079174300], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'NICOLLE',
            'first_last_name' => 'RAMIREZ',
            'second_last_name' => 'QUINA',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id,
        ]);

         // Consulta o registro de datos para Jeifrey Camilo Castaño Soto (Aprendiz de Unidad Porcina)
         Person::updateOrCreate(['document_number' => 1117484606], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'JEIFREY',
            'first_last_name' => 'CASTAÑO',
            'second_last_name' => 'SOTO',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id,
        ]);

         // Consulta o registro de datos para Cristian Mauricio Santos Vargas (Aprendiz de Unidad Porcina)
         Person::updateOrCreate(['document_number' => 1079186237], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'CRISTIAN',
            'first_last_name' => 'SANTOS',
            'second_last_name' => 'VARGAS',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id,
        ]);
     
    }
}