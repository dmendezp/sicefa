<?php

namespace Modules\EVS\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PensionEntity;
use Modules\SICA\Entities\PopulationGroup;

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        $group = PopulationGroup::firstOrCreate(['name' => 'NINGUNA']);
        $eps = EPS::firstOrCreate(['name' => 'NO REGISTRA']);
        $pension = PensionEntity::firstOrCreate(['name' => 'NO REGISTRA']);

        Person::firstOrCreate(['document_number' => 1001110001], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'ADMIN EVS',
            'first_last_name' => 'SISTEMA',
            'second_last_name' => 'ELECCIONES',  
            'eps_id' => $eps->id,
            'population_group_id' => $group->id,
            'pension_entity_id' => $pension->id,
        ]);

        Person::firstOrCreate(['document_number' => 1002220002], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'JURADO EVS',
            'first_last_name' => 'VALIDACION', 
            'second_last_name' => 'ELECCIONES',
            'eps_id' => $eps->id,
            'population_group_id' => $group->id,
            'pension_entity_id' => $pension->id,
        ]);

        Person::firstOrCreate(['document_number' => 1003330003], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'VOTANTE EVS',
            'first_last_name' => 'USUARIO',
            'second_last_name' => 'ELECCIONES',
            'eps_id' => $eps->id,
            'population_group_id' => $group->id,
            'pension_entity_id' => $pension->id,
            
        ]);
    }
}