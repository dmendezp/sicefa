<?php

namespace Modules\HDC\Database\Seeders;

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

        /* Consulta o registro de datos para Mary Luz Aldana Vidarte (Administrador) */
        Person::firstOrCreate(['document_number' => 1079408547], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadania',
            'first_name' => 'MARY LUZ',
            'first_last_name' => 'ALDANA',
            'second_last_name' => 'VIDARTE',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id,


        ]);

        /* Consulta o registro de datos para Magaly Jimena Tafur Campos (lider encargada unidad productiva) */
        Person::firstOrCreate(['document_number' => 1079604482], [ // Consultar o registrar Persona
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'MAGALY JIMENA',
            'first_last_name' => 'TAFUR',
            'second_last_name' => 'CAMPOS',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id,


        ]);


    }
}
