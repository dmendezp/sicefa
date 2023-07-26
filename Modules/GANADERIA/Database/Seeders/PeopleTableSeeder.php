<?php

namespace Modules\GANADERIA\Database\Seeders;

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
    $number_people = 120; // Definir la cantidad de personas

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

    //crear usuario veterinario
    // Consulta o registro de datos para Anggy lorena Cortes
    Person::firstOrCreate(['document_number' => 1083840588],[ // Consultar o registrar Persona
      'document_type' => 'Cédula de ciudadanía',
      'first_name' => 'ANGGY',
      'first_last_name' => 'LORENA',
      'second_last_name' => 'CORTES',
      'eps_id' => $eps->id,
      'population_group_id' => $population_group->id
    ]);

    //crear usuario aprendiz lider
    // Consulta o registro de datos para Karen Dallana Murcia Martinez
    Person::firstOrCreate(['document_number' => 1079172879],[ // Consultar o registrar Persona
      'document_type' => 'Cédula de ciudadanía',
      'first_name' => 'KAREN DALLANA',
      'first_last_name' => 'MURCIA',
      'second_last_name' => 'MARTINEZ',
      'eps_id' => $eps->id,
      'population_group_id' => $population_group->id
    ]);

    //crear usuario produccion
    // Consulta o registro de datos para Juan Felipe Duque
    Person::firstOrCreate(['document_number' => 123456789],[ // Consultar o registrar Persona
      'document_type' => 'Cédula de ciudadanía',
      'first_name' => 'JUAN',
      'first_last_name' => 'FELIPE',
      'second_last_name' => 'DUQUE',
      'eps_id' => $eps->id,
      'population_group_id' => $population_group->id
    ]);

    //crear usuario Aprendiz
    // Consulta o registro de datos para santiago Hernandez Martinez
    Person::firstOrCreate(['document_number' => 1004062316],[ // Consultar o registrar Persona
      'document_type' => 'Cédula de ciudadanía',
      'first_name' => 'SANTIAGO',
      'first_last_name' => 'HERNANDEZ',
      'second_last_name' => 'MARTINEZ',
      'eps_id' => $eps->id,
      'population_group_id' => $population_group->id
    ]);

    print_r("Generando " . $number_people . " personas.\n");
    Person::factory()->count($number_people)->create(); // Generar personas de prueba de acuerdo a la cantidad definida
  }
}