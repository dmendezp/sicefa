<?php

namespace Modules\PTVENTA\Database\Seeders;

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
        $person = Person::where('document_number',52829681)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'LFHerre'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'lolafernandaherrera@gmail.com',
        ]);

    }
}
