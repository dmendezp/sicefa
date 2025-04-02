<?php

namespace Modules\SIPORK\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PensionEntity;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\PopulationGroup;

class PeopleTableSeeder extends Seeder{
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


        // Consulta o registro de datos Junior Stiven Medina Hernandez
        Person::updateOrCreate(['document_number' => 1116914471], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'DARWIN',
            'first_last_name' => 'MARTINEZ',
            'second_last_name' => 'GRAJALES',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id,
           

        ]);
     
    }
}