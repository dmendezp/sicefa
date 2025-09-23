<?php

namespace Modules\SG\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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
        $person = Person::where('document_number', 1116914471)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'Darwin123'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'darwin123@gmail.com'
        ]); // Dama4471
    }
}
