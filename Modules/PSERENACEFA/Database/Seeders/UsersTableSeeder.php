<?php

namespace Modules\PSERENACEFA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Person;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $person = Person::where('document_number', 1012345442)->first();
        User::updateOrCreate(['nickname' => 'Chimbaco02'], [
            'person_id' => $person->id,
            'email' => 'afchimbaco04@gmail.com' //Anch5442
        ]);

        $person = Person::where('document_number', 1075508356)->first();
        User::updateOrCreate(['nickname' => 'Karen02'], [
            'person_id' => $person->id,
            'email' => 'kyulieth80@gmail.com' //Karo8356
        ]);

    }
}