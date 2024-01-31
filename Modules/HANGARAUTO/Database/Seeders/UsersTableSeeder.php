<?php

namespace Modules\HANGARAUTO\Database\Seeders;

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
        /* Registrar O Actualizar Usuario Para David Cumaco Rojas */
        $person = Person::where('document_number', 1006524141)->first(); /* Consulta Persona */
        User::updateOrCreate(['nickname' => 'Davidrojas'], [ /* Actualizar O Crear Usuario */
            'person_id' => $person->id,
            'email' => 'davidrojasjr16@gmail.com'
        ]);
    }
}
