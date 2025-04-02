<?php

namespace Modules\GDF\Database\Seeders;

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
        $person = Person::where('document_number', 1081398122)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Fabian'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'fabetorres3115@gmail.com',//Fato8122
        ]);
  
     
    }
}