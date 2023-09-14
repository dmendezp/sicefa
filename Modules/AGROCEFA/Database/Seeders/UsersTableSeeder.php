<?php

namespace Modules\AGROCEFA\Database\Seeders;

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
        

        // Registrar o actualizar usuario para Administrador
        $person = Person::where('document_number',13706)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'William'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'adminagrocefa@gmail.com', //con: Wioc3706
        ]);


        // Registrar o actualizar usuario para Administrador
        $person = Person::where('document_number',1077721216)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'AndresFS'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'andres@gmail.com', //con: Anal1216
        ]);

        // Registrar o actualizar usuario para Pasante
        $person = Person::where('document_number', 1007531693)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Yaya'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'pasante@gmail.com', //con: Dava1693
        ]);

        // Registrar o actualizar usuario para Pasante
        $person = Person::where('document_number', 1004418487)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Yuderly'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'pasanteagrocefa@gmail.com', //con: Yusa8487
        ]);

    }
}
