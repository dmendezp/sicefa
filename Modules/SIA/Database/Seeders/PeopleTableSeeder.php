<?php

namespace Modules\SIA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PensionEntity;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\PopulationGroup;

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

        // Registro de datos para Ana María López (Administradora del sistema)
        Person::firstOrCreate(['document_number' => 1029384756], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'Yoli Dayana',
            'first_last_name' => 'Moreno',
            'second_last_name' => 'GARCÍA',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

        // Registro de datos para Carlos Andrés Pérez (Instructor Investigador)
        Person::firstOrCreate(['document_number' => 1098765432], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'CARLOS ANDRÉS',
            'first_last_name' => 'PÉREZ',
            'second_last_name' => 'MARTÍNEZ',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
        ]);

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