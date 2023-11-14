<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

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
        $person = Person::where('document_number', 1079173785)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'JSM6580'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'jsmedinah5873@gmail.com',
        ]);
        $person = Person::where('document_number', 1075791904)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'JMM6580'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'jennyfermarin05@gmail.com',
        ]);
        $person = Person::where('document_number', 1081152391)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'DAP6580'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'diegopenagos955@gmail.com',
        ]);
    }
}
