<?php

namespace Modules\SIA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SIA\Entities\EPS;
use Modules\SIA\Entities\PensionEntity;
use Modules\SIA\Entities\Person;
use Modules\SIA\Entities\PopulationGroup;

class PeopleTableSeeder extends Seeder
{
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

        // Registro de datos para Nicolas Estiven Soriano Polania (Aprendiz Investigador)
        Person::firstOrCreate(['document_number' => 1079173262], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'Nicolas Estiben',
            'first_last_name' => 'Soriano',
            'second_last_name' => 'Polania',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);
    }
}