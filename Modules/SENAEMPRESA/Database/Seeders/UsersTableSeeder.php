<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
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
        Model::unguard();

        $usersenaempresaadmin = User::where('nickname', 'JSM6580')->first();
        if (!$usersenaempresaadmin) {

            $person = Person::where('document_number', '123456')->first();

            $usersenaempresaadmin = User::create([
                "nickname" => "JSM6580",
                "person_id" => $person->id,
                "email" => "jsmedinah5873@gmail.com",
                "password" => Hash::make("123456789")
            ]);
        }
    }
}
