<?php

namespace Modules\BIENESTAR\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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

          // Registrar o actualizar usuario para Leandra Diaz Diaz
          $person = Person::where('document_number',1079179415)->first(); // Consultar Persona
          User::updateOrCreate(['nickname' => 'LenadraDD'], [ // Actualizar o crear usuario
              'person_id' => $person->id,
              'email' => 'lediazd@sena.edu.co'
          ]);
        
    }
}