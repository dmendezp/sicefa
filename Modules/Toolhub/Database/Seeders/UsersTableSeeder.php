<?php

namespace Modules\Toolhub\Database\Seeders;

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
        // Registrar o actualizar usuario para Lola Fernanda Herrera Hernandez
        $person = Person::where('document_number', 1080292306)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'PEDRO'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'pedro@gmail.com' //Pelo2306
        ]);
          // Registrar o actualizar usuario para Lola Fernanda Herrera Hernandez
          $person = Person::where('document_number', 1039683816)->first(); // Consultar Persona
          User::updateOrCreate(['nickname' => 'Marlon'], [ // Actualizar o crear usuario
              'person_id' => $person->id,
              'email' => 'marlon@gmail.com' //Mape3816
          ]);

    
    }
}
