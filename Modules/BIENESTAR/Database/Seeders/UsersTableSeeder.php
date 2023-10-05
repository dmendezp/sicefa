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

        // Registrar o actualizar usuario para Brayan David Lizcano
        $person = Person::where('document_number',1079173847)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'BrayanL'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'brayangarzon474@gmail.com'
        ]);

        // Registrar o actualizar usuario para Juan David Rico Cerquera
        $person = Person::where('document_number',1079904275)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Morricito'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'morricito.cerquera@gmail.com '
        ]);

         // Registrar o actualizar usuario para Diana Figueroa Polania
         $person = Person::where('document_number',1079178547)->first(); // Consultar Persona
         User::updateOrCreate(['nickname' => 'DianaFit'], [ // Actualizar o crear usuario
             'person_id' => $person->id,
             'email' => 'dpfigueroa@sena.edu.co'
         ]);

          // Registrar o actualizar usuario para Leandra Diaz Diaz
          $person = Person::where('document_number',1079179415)->first(); // Consultar Persona
          User::updateOrCreate(['nickname' => 'LenadraDD'], [ // Actualizar o crear usuario
              'person_id' => $person->id,
              'email' => 'lediazd@sena.edu.co'
          ]);

           // Registrar o actualizar usuario para Leandra Diaz Diaz
           $person = Person::where('document_number',1079172278)->first(); // Consultar Persona
           User::updateOrCreate(['nickname' => 'SairaGS'], [ // Actualizar o crear usuario
               'person_id' => $person->id,
               'email' => 'guevarax72@gmail.com '
           ]);
        
    }
}
