<?php
namespace Modules\AVICONTROL\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Sica\Entities\PopulationGroup;
use Modules\Sica\Entities\EPS;
use Modules\Sica\Entities\PensionEntity;
use Modules\Sica\Entities\Person;

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        $population_group = PopulationGroup::firstOrCreate(['name' => 'Ninguna']);
        $eps = EPS::firstOrCreate(['name' => 'No registrada']);
        $pension_entity = PensionEntity::firstOrCreate(['name' => 'Ninguna']);

        Person::firstOrCreate(
            ['document_number' => '1075793788'], // Condición para buscar
            [                                   // Valores a crear si no existe
                'document_type' => 'Cedula Ciudadania',
                'first_name' => 'Yeison',
                'first_last_name' => 'Marin',
                'second_name' => 'Duran',
                'eps_id' => $eps->id,
                'population_group_id' => $population_group->id,
                'pension_entity_id' => $pension_entity->id,
            ]
        );
    }
}