<?php

namespace Modules\RADIOCEFA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;
use Modules\SICA\Entities\Person;


class RADIOCEFADatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{

    $person = Person::firstOrCreate(['document_number'=> 1125276647], [
        'document_type' => 'Tarjeta de identidad',
        'first_name' => 'MARIA DEL CARMEN',
        'first_last_name' => 'ROSELL',
        'second_last_name' => 'PEREZ'
    ]);

    $usuario = new User();
    $usuario->nickname = 'Maria Rosell';
    $usuario->person_id = $person->id;
    $usuario->email = 'MariaRosell@example.com';
    $usuario->password = bcrypt('contraseña');
    $usuario->save();
}

}
