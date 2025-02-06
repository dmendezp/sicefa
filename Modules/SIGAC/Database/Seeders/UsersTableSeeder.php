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

        // Registrar o actualizar usuario para Ruben Dario Delgado Cruz
        $person = Person::where('document_number', 4433177)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'rudelgadoc'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'rudelgadoc@sena.edu.co',//Rude3177
        ]);

        // Registrar o actualizar usuario para Esperanza Pascuas Perdomo
        $person = Person::where('document_number', 36161503)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'epascuasp'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'epascuasp@sena.edu.co',//Espa1503
        ]);

        // Registrar o actualizar usuario para Jesús David Guevara Munar
        $person = Person::where('document_number', 1004494010)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'JDGM0331'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'jdguevara01@soy.sena.edu.co',//Jegu4010
        ]);


        // Registrar o actualizar usuario para Manuel Steven Ossa Lievano
        $person = Person::where('document_number', 1000226706)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Resmerveilons'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'manuelstevenossa@gmail.com'//Maos6706
        ]);



    }
}
