<?php

namespace Modules\SSTSENA\Database\Seeders;

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
        $person = Person::where('document_number', 1004224943)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Wchilito'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'chilitowilliam502@gmail.com',//Wich4943
        ]);
    }
}



























