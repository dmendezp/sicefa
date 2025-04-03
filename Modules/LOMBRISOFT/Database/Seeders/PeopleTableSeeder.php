<?php

namespace Modules\LOMBRISOFT\Database\Seeders;

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

Person::firstOrCreate(['document_number' => '1079172956'],
[
'document_type' => 'Cedula Ciudadania',
'first_name' => 'NICOLAS',
'first_last_name' => 'ARDILA',
'second_last_name' => 'ESCOBAR',
'eps_id' => $eps->id,
'population_group_id' => $population_group->id,
'pension_entity_id' => $pension_entity->id

]);



}


}