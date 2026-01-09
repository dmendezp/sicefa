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


        // Consulta o registro de datos para Darwin Martinez Grajales (Líder de Unidad Porcina)
        Person::updateOrCreate(['document_number' => 1116914471], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'DARWIN',
            'first_last_name' => 'MARTINEZ',
            'second_last_name' => 'GRAJALES',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id,
        ]);

        // Consulta o registro de datos para Oscar Eduardo Villarraga  (LIDER DE UNIDAD GANADERA)
        Person::updateOrCreate(['document_number' => 7714668], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'OSCAR',
            'first_last_name' => 'EDUARDO',
            'second_last_name' => 'VILLARRAGA',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id,
        ]);

        // Consulta o registro de datos para Danna Lizeth Pérez Castañeda  (Aprendiz)
        Person::updateOrCreate(['document_number' => 1079604392], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'DANNA',
            'first_last_name' => 'PÉREZ',
            'second_last_name' => 'CASTAÑEDA',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id,
        ]);
    }
}
