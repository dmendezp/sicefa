<?php

namespace Modules\SIA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        // Registrar o actualizar usuario para Yoli Dayana Moreno (Administradora del sistema)
        $person = Person::where('document_number', 1029384756)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'AMLAdmin'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'yolidayana.moreno@sicefa.com',
            'password' => bcrypt('password123') // Contraseña encriptada
        ]);

        // Registrar o actualizar usuario para Lola Fernanda Herrera Hernandez (Intructor Investigador)
        $person = Person::where('document_number', 1098765432)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'LFHerrera'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'lola.herrera@sicefa.com',
            'password' => bcrypt('password123') // Contraseña encriptada
        ]);

        // Registrar o actualizar usuario para Nicolas Estiven Soriano Polania (Aprendiz investigador)
        $person = Person::where('document_number', 1079173262)->first(); // Consultar Persona
        User::updateOrCreate(['nickname' => 'NESoriano'], [ // Actualizar o crear usuario
            'person_id' => $person->id,
            'email' => 'nicolas.soriano@sicefa.com',
            'password' => bcrypt('password123') // Contraseña encriptada
        ]);
    }
}