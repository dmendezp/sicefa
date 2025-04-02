<?php

namespace Modules\SIPORK\Database\Seeders;

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
  
     
    }
}