<?php

namespace Modules\SENAAPICOLA\Database\Seeders;

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
        $population_group = PopulationGroup::firstOrcreate(['name' => 'NINGUNA']);
        $eps = EPS::firstOrcreate(['name' => 'NO REGISTRA']);
        $pension_entity = PensionEntity::firstOrcreate(['name' => 'NO REGISTRA']);

        Person::firstOrCreate(['document_number' => 1079176666], [
            'document_type' => 'Cedula de Ciudadania',
            'first_name' => 'Aldemar',
            'first_last_name' => 'Montenegro',
            'second_last_name' => 'Yara',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id,
        ]);
    }
}