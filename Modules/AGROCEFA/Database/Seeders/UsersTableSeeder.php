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
        $person = Person::where('document_number',7720811)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'admin_agrocefa'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'adminagrocefa@gmail.com',
        ]);

        // Registrar o actualizar usuario para Pasante
        $person = Person::where('document_number', 27102233)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'pasante_agrocefa'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'pasante@gmail.com',
        ]);

    }
}
