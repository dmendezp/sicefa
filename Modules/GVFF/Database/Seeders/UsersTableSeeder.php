<?php

namespace Modules\GVFF\Database\Seeders;

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
        $person = Person::where('document_number', 1077224582)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Dquiza'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'davidqzr.09@gmail.com',
        ]);

    }
}