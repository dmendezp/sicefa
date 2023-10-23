<?php

namespace Modules\HDC\Database\Seeders;

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
        /* Registrar o actualizar usuario para Mary Luz Aldana Vidarte */
        $person = Person::where('document_number', 1079408547)->first(); /* Consulta Persona */
        User::updateOrCreate(['nickname' => 'aldavi'], [  /* Actualizar o crear usuario */
            'person_id' => $person->id,
            'email' => 'mlaldana74@soy.sena.edu.co'
        ]);

        /* Registrar o actualizar usuario para Magaly Jimena Tafur Campos */
        $person = Person::where('document_number', 1079604482)->first(); /* Consulta Persona */
        User::updateOrCreate(['nickname' => 'jitaco'], [  /* Actualizar o crear usuario */
            'person_id' => $person->id,
            'email' => 'mtafur@sena.edu.co'
        ]);

    }
}
