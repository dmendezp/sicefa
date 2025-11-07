<?php

namespace Modules\CEFAMAPS\Database\Seeders;

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

    // Registrar o actualizar usuario para Lola Fernanda (MODIFICAR LOS ATRIBUTOS PARA EL USUARIO - SON PRUEBA)
    $person = Person::where('document_number', 1079172063)->first(); // Consultar Persona
    User::updateOrCreate(['nickname' => 'LolaFernanda'], [ // Actualizar o crear usuario
      'person_id' => $person->id,
      'email' => 'lolafernanda@gmail.com',
    ]);

  }
}
