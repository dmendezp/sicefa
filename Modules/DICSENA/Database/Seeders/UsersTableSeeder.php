<?php

namespace Modules\DICSENA\Database\Seeders;

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
        $person = Person::where('document_number', 1006506716)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Instructor'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'tifrankxd@gmail.com', //Frcu6716
        ]);
    }
}
