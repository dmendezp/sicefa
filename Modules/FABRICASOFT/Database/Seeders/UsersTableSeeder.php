<?php
namespace Modules\FABRICASOFT\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Sica\Entities\Person;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Buscar la persona por document_number
        $person = Person::where('document_number', '1079174159')->first();

            User::updateOrCreate(
                ['nickname' => 'Argudelo'], // Condición para buscar
                [
                    'person_id' => $person->id,
                    'email' => 'dt2345160@gmail.com',
                    'password' => Hash::make('Arag4159'), // Hash de la contraseña
                ]
            );
        
    }
}