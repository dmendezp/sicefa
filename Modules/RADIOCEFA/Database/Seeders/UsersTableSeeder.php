<?php

namespace Modules\RADIOCEFA\Database\Seeders;

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
        $person = Person::where('document_number',1125276647)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'MariaK'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'mariarosellperez20@gmail.com',
        ]);
    }
}
