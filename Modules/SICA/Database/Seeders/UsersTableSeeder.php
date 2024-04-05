<?php

namespace Modules\SICA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Person;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *6754
     * @return void
     */
    public function run()
    {

        // Registrar o actualizar usuario para Diego Andrés Mendéz Pastrana (NO MODIFICAR)
        $person = Person::where('document_number',7713344)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'damendez'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'ing.diego.mendez@gmail.com',// Dime3344
        ]);

        // Registrar o actualizar usuario para Jesús David Guevara Munar
        $person = Person::where('document_number', 1004494010)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'JDGM0331'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'jdguevara01@soy.sena.edu.co',//Jeda4010
        ]);

        // Registrar o actualizar usuario para Gloria Maritza Sanchez Alarcón
        $person = Person::where('document_number', 51784954)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'gmsanchez'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'gmsanchez@sena.edu.co',
        ]);

        // Registrar o actualizar usuario para Diego Andrés Tovar Rodriguez
        $person = Person::where('document_number', 1004224747)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'DiegoT'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'datovar74@misena.edu.co',
        ]);

        // Registrar o actualizar usuario para Manuel Steven Ossa Lievano
        $person = Person::where('document_number',1000226706)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Resmerveilons'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'manuelstevenossa@gmail.com'
        ]);

    }
}
