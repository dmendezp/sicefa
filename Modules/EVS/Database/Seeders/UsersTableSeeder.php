<?php

namespace Modules\EVS\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Person;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $person = Person::where('document_number', 1001110001)->first();
        User::updateOrCreate(['nickname' => 'evs_admin'], [
            'person_id' => $person->id,
            'email' => 'admin@evs.sena.edu.co',  //Adsi0001
        ]);

        $person = Person::where('document_number', 1002220002)->first();
        User::updateOrCreate(['nickname' => 'evs_jury'], [
            'person_id' => $person->id,
            'email' => 'jurado@evs.sena.edu.co', //Juva0002
        ]);

        $person = Person::where('document_number', 1003330003)->first();
        User::updateOrCreate(['nickname' => 'evs_voter'], [
            'person_id' => $person->id,
            'email' => 'votante@evs.sena.edu.co', ///Vous0003
        ]);
    }
}