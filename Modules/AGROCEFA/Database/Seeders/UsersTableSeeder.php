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
        $person = Person::where('document_number',12275825)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'William'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'wochoam@sena.edu.co', //con: Wioc3706
        ]);


       

    }
}
