<?php

namespace Modules\SIPORK\Database\Seeders;

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
        $person = Person::where('document_number', 1116914471)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Darwin'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'darwinmartinezgrajales@gmail.com',//Dama4471
        ]);

        $person = Person::where('document_number', 1075221515)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Juan'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'jricaurte2406@gmail.com', // Juri1515
        ]);

        $person = Person::where('document_number', 1079174300)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Nicolle'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'ramirezquinanicolandrea@gmail.com', // Nira4300
        ]);

        $person = Person::where('document_number', 1117484606)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Jeifrey'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'camilo37478@gmail.com', // Jeca4606
        ]);

        $person = Person::where('document_number', 1079186237)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Cristian'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'maurosan720@gmail.com', // Crsa6237
        ]);
    }
}