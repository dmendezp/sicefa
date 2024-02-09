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


        Person::firstOrCreate(['document_number' => 12275825], [ 
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'WILLIAM ALEXIS',
            'first_last_name' => 'OCHOA',
            'second_last_name' => 'MEDINA',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

    }
}
