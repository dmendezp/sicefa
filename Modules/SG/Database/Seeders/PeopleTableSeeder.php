<?php

namespace Modules\SG\Database\Seeders;

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

        Person::firstOrCreate(['document_number' => 1137674196], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'KEVIN',
            'first_last_name' => 'MURCIA',
            'second_last_name' => 'RAMIREZ',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id 
        ]);
    }
}