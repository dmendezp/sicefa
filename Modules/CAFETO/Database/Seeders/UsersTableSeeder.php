<?php

namespace Modules\CAFETO\Database\Seeders;

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
        $person = Person::where('document_number', 52829681)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'LFHerre'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'lolafernandaherrera@gmail.com'
        ]);

        // Registrar o actualizar usuario para Manuel Steven Ossa Lievano
        $person = Person::where('document_number', 1000226706)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Resmerveilons'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'manuelstevenossa@gmail.com'
        ]);

        // Registrar o actualizar usuario para Jesús David Guevara Munar
        $person = Person::where('document_number', 1004494010)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'JDGM0331'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'jdguevara01@soy.sena.edu.co'
        ]);
    }
}
