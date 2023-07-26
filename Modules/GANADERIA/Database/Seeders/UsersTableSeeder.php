<?php

namespace Modules\GANADERIA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\SICA\Entities\Person;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Registrar o actualizar usuario para Diego Andrés Mendéz Pastrana (NO MODIFICAR)
    $person = Person::where('document_number',7713344)->first(); // Consultar Persona
    User::updateOrCreate(['nickname' => 'damendez'], [ // Actualizar o crear usuario
      'person_id' => $person->id,
      'email' => 'ing.diego.mendez@gmail.com',
    ]);

    // Registrar o actualizar usuario para Anggy Lorena (MODIFICAR LOS ATRIBUTOS PARA EL USUARIO - SON PRUEBA)
    $person = Person::where('document_number', 1083840588)->first(); // Consultar Persona
    User::updateOrCreate(['nickname' => 'AnggyLo'], [ // Actualizar o crear usuario
      'person_id' => $person->id,
      'email' => 'anggy_lorena@gmail.com',
    ]);

    // Registrar o actualizar usuario para Karen Dallana (MODIFICAR LOS ATRIBUTOS PARA EL USUARIO - SON PRUEBA)
    $person = Person::where('document_number', 1079172879)->first(); // Consultar Persona
    User::updateOrCreate(['nickname' => 'Karen2005'], [ // Actualizar o crear usuario
      'person_id' => $person->id,
      'email' => 'karen_dallana@gmail.com',
    ]);

    // Registrar o actualizar usuario para Juan Felipe (MODIFICAR LOS ATRIBUTOS PARA EL USUARIO - SON PRUEBA)
    $person = Person::where('document_number', 123456789)->first(); // Consultar Persona
    User::updateOrCreate(['nickname' => 'FelipeDu'], [ // Actualizar o crear usuario
      'person_id' => $person->id,
      'email' => 'juan_felipe@gmail.com',
    ]);

    // Registrar o actualizar usuario para Santiago Hernandez (MODIFICAR LOS ATRIBUTOS PARA EL USUARIO - SON PRUEBA)
    $person = Person::where('document_number', 1004062316)->first(); // Consultar Persona
    User::updateOrCreate(['nickname' => 'Santiagod'], [ // Actualizar o crear usuario
      'person_id' => $person->id,
      'email' => 'santiago_hernandez@gmail.com',
    ]);

  }
}
