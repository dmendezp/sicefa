<?php

namespace Modules\AGROCEFA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\PopulationGroup;
use Modules\SICA\Entities\PensionEntity;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\Person;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $population_group = PopulationGroup::firstOrCreate(['name' => 'NINGUNA']); 
        $eps = EPS::firstOrCreate(['name' => 'NO REGISTRA']); 
        $pension_entity = PensionEntity::firstOrCreate(['name' => 'NO REGISTRA']); 


        Person::firstOrCreate(['document_number' => 13706], [ 
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'WILLIAM ALEXIS',
            'first_last_name' => 'OCHOA',
            'second_last_name' => 'MEDINA',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);


        Person::firstOrCreate(['document_number' => 1077721216], [ 
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'ANDRES FELIPE',
            'first_last_name' => 'ALMARIO',
            'second_last_name' => 'NAVARRO',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        

        
        Person::firstOrCreate(['document_number' => 1007531693], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'DAYANA MARCELA',
            'first_last_name' => 'VALENZUELA',
            'second_last_name' => 'ERAZO',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        Person::firstOrCreate(['document_number' => 1004418487], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'YUDERLY',
            'first_last_name' => 'SAPUY',
            'second_last_name' => 'CHAVARRO',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        
    }
}
