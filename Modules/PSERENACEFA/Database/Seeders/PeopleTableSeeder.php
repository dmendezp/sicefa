<?php

namespace Modules\PSERENACEFA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PensionEntity;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\PopulationGroup;

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        $population_group = PopulationGroup::firstOrCreate(['name' => 'NINGUNA']);
        $eps = EPS::firstOrCreate(['name' => 'NO REGISTRA']);
        $pension_entity = PensionEntity::firstOrCreate(['name' => 'NO REGISTRA']);

        Person::firstOrCreate(['document_number' => 1012345442], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'ANDRES',
            'first_last_name' => 'CHIMBACO',
            'second_last_name' => 'MENDEZ',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        $population_group = PopulationGroup::firstOrCreate(['name' => 'NINGUNA']);
        $eps = EPS::firstOrCreate(['name' => 'NO REGISTRA']);
        $pension_entity = PensionEntity::firstOrCreate(['name' => 'NO REGISTRA']);

        Person::firstOrCreate(['document_number' => 1075508356], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'KAREN',
            'first_last_name' => 'ROJAS',
            'second_last_name' => 'CANACUE',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);
    }
    
    

}