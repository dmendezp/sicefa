<?php

namespace Modules\LOMBRISOFT\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Person;



class UsersTableSeeder extends Seeder 
{
 public function run()
    {
        $person = Person::where('document_number', '1079172956')->first();
        User::updateOrCreate(['nickname' => 'Nardila'], [
            'person_id' => $person->id,
            'email' => 'ardilanicolas71@gmail.com'            //Password: Niar2956
        ]);

        

    }


}