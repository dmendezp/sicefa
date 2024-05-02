<?php

namespace Modules\HANGARAUTO\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Person;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $person = Person::where('document_number',1006524141)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'DCumaco'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'davidrojasjr16@gmail.com',
        ]);
    }
}
