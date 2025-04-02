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
        $person = Person::where('document_number', 1137674196)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Kevin'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'kevinandreyramirez07@gmail.com',//Kemu4196
        ]);
}
}