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
        $person = Person::where('document_number',36281368)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'mgonzalezg'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'mgonzalezg@sena.edu.co',
        ]);

    }
}
