<?php

namespace Modules\CEFAMAPS\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\EPS;
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

    // Consulta o registro de datos para Diego Andrés Méndez Pastrana
    Person::firstOrCreate(['document_number' => 7713344],[ // Consultar o registrar Persona
      'document_type' => 'Cédula de ciudadanía',
      'first_name' => 'DIEGO ANDRÉS',
      'first_last_name' => 'MÉNDEZ',
      'second_last_name' => 'PASTRANA',
      'eps_id' => $eps->id,
      'population_group_id' => $population_group->id
    ]);

    // Consulta o registro de datos para Jesús David Guevara Munar
    Person::firstOrCreate(['document_number' => 1079172063],[ // Consultar o registrar Persona
      'document_type' => 'Cédula de ciudadanía',
      'first_name' => 'Neythan',
      'first_last_name' => 'Sabogal',
      'second_last_name' => 'Gaitan',
      'eps_id' => $eps->id,
      'population_group_id' => $population_group->id
    ]);
    
  }
}
