<?php

namespace Modules\AGROINDUSTRIA\Database\Seeders;

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
       // Registrar o actualizar usuario para Jesús David Guevara Munar
       $person = Person::where('document_number', 1123430216)->first(); // Consultar Persona
       User::updateOrCreate(['nickname' => 'Bonilla'], [ // Actualizar o crear usuario
           'person_id' => $person->id,
           'email' => 'bonilla@gmail.com',
       ]);
    }
}
