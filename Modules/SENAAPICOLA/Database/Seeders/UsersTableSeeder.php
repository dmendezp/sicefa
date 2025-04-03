<?php

namespace Modules\SENAAPICOLA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Person;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $person = Person::where('document_number', '1079176666')->first();
        User::updateOrCreate(['nickname' => 'Aaldemar'], [
            'person_id' => $person->id,
            'email' => 'montenegroaldemar1@gmail.com'                   // Password:ALmo6666
        ]);
    }
}