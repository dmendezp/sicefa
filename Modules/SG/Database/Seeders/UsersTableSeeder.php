<?php

namespace Modules\SG\Database\Seeders;

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
        $person = Person::where('document_number', 1116914471)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Darwin'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'darwinmartinezgrajales@gmail.com',//Dama4471
        ]);

        $person = Person::where('document_number', 1079604392)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Danna'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'dannalizethperezcastaneda@gmail.com',//Dape4392
        ]);

        $person = Person::where('document_number', 7714668)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Oscar'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'oecordobac@sena.edu.co',//Osed4668
        ]);
    }
}
