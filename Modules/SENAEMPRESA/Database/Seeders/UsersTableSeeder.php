<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

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
        $person = Person::where('document_number', 52829681)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Lola'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'lherrerah@sena.edu.co',//Lohe9681
        ]);

    }
}
