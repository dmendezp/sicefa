<?php

namespace Modules\SENAAPICOLA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Person;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $person = Person::where('document_number', 1079176666)->first();
        User::updateOrCreate(['nickname' => 'Aaldemar'], [
            'person_id' => $person->id,
            'email' => 'montenegroaldemar1@gmail.com'                   // Password:ALmo6666
        ]);

        $person = Person::where('document_number', 36347022)->first();
        User::updateOrCreate(['nickname' => 'Yiselayara'], [
            'person_id' => $person->id,
            'email' => 'leidayara7022@gmail.com'                   // Password:Leya7022
        ]);
    }
}
