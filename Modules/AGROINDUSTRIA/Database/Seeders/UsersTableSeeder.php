<?php

namespace Modules\AGROINDUSTRIA\Database\Seeders;

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
       // Registrar o actualizar usuario para Julian Javier Ramirez Diaz
       $person = Person::where('document_number', 1083874040)->first(); // Consultar Persona
       User::updateOrCreate(['nickname' => 'Julian'], [ // Actualizar o crear usuario
           'person_id' => $person->id,
           'email' => 'julian@gmail.com',
       ]);

       // Registrar o actualizar usuario para Juan Diego Bonilla Aroca
       $person = Person::where('document_number', 1123430216)->first(); // Consultar Persona
       User::updateOrCreate(['nickname' => 'Bonilla'], [ // Actualizar o crear usuario
           'person_id' => $person->id,
           'email' => 'bonilla@gmail.com',
       ]);

       // Registrar o actualizar usuario para David Juliam Cadena Barrera
       $person = Person::where('document_number', 1079508239)->first(); // Consultar Persona
       User::updateOrCreate(['nickname' => 'Cadena'], [ // Actualizar o crear usuario
           'person_id' => $person->id,
           'email' => 'cadena@gmail.com',
       ]);

       // Registrar o actualizar usuario para Jennifer Marin Montealegre
       $person = Person::where('document_number', 1075791904)->first(); // Consultar Persona
       User::updateOrCreate(['nickname' => 'Jennifer'], [ // Actualizar o crear usuario
           'person_id' => $person->id,
           'email' => 'jennifer@gmail.com',
       ]);
    }
}
