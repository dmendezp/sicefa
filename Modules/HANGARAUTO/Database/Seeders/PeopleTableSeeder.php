<?php

namespace Modules\HANGARAUTO\Database\Seeders;

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
        $population_group = PopulationGroup::firstOrCreate(['name' => 'NINGUNA']); // Consulta O Registra Grupo Poblacional
        $eps = EPS::firstOrCreate(['name' => 'NO REGISTRA']); // Consultar O Registrar EPS
        $pension_entity = PensionEntity::firstOrCreate(['name' => 'NO REGISTRA']); // ConsultarO Registrar Entidad De Pensiones

        /* Consulta O Registro De Datos Para David Cumaco Rojas (Administrador) */
        Person::firstOrCreate(['document_number' => 1006524141], [ // Consultar O RegistrarPersona
            'document_type' => 'Cedula De Ciudadania',
            'first_name' => 'ANDRES DAVID',
            'first_last_name' => 'CUMACO',
            'second_last_name' => 'ROJAS',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity_id,
        ]);

    }
}
