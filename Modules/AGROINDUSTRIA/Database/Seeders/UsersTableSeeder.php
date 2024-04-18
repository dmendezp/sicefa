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
       // Registrar o actualizar
       $person = Person::where('document_number', 7723876)->first(); // Consultar Persona
       User::updateOrCreate(['nickname' => 'Vilmer'], [ // Actualizar o crear usuario
           'person_id' => $person->id,
           'email' => 'vmendez@sena.edu.co',
       ]);

    }
    
}
