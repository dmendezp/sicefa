<?php

namespace Modules\SIA\Database\Seeders;

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
        // Registrar o actualizar usuario para Nicolas Estiven Soriano Polania (Aprendiz investigador)
        $person = Person::where('document_number', 1079173262)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Nicolas Soriano', //Crear usuario
            'person_id' => $person->id,
            'email' => 'nicolassoriano1404@gmail.com', // Correo electrónico
        ]);
    }
}