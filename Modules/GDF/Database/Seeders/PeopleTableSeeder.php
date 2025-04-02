<?php

namespace Modules\GDF\Database\Seeders;

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
        
        //Consulta o Registro de datos Fabian Esteban Torres Andrade
        Person::firstOrCreate(['document_number' => 1081398122], [ // Consulta o registra Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'FABIAN ESTEBAN',
            'first_last_name' => 'TORRES',
            'second_last_name' => 'ANDRADE',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id,
            'avatar'=> 'modules/gdf/images/Contacto/Mamacita.jpg'
        ]);
    }
}