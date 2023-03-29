<?php

namespace Modules\SICA\Database\Seeders;

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

        // Registrar o actualizar usuario para Jesús David Guevara Munar
        $person = Person::where('document_number', 1004494010)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'JDGM0331'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'jdguevara01@soy.sena.edu.co',
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

    }
}
