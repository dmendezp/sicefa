<?php

namespace Modules\SIGAC\Database\Seeders;

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
        // Registrar o actualizar usuario para María Antonia Gonzáles Gonzáles
        $person = Person::where('document_number', 36281368)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'mgonzalezg'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'mgonzalezg@sena.edu.co',
        ]);

        // Registrar o actualizar usuario para Diego Andrés Méndez Pastrana 
        $person = Person::where('document_number', 7713344)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'damendez'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'ing.diego.mendez@gmail.com',
        ]);

        // Registrar o actualizar usuario para Esperanza Pascuas Perdomo 
        $person = Person::where('document_number', 36161503)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'epascuasp'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'epascuasp@sena.edu.co',
        ]);

        // Registrar o actualizar usuario para Jesús David Guevara Munar
        $person = Person::where('document_number', 1004494010)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'JDGM0331'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'jdguevara01@soy.sena.edu.co',
        ]);

        // Registrar o actualizar usuario para Manuel Steven Ossa Lievano
        $person = Person::where('document_number', 1000226706)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Resmerveilons'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'manuelstevenossa@gmail.com'
        ]);
    }
}
