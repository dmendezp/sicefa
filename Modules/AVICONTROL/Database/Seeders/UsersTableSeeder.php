<?php
namespace Modules\AVICONTROL\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Sica\Entities\Person;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Buscar la persona por document_number
        $person = Person::where('document_number', '1075793788')->first();

            User::updateOrCreate(
                ['nickname' => 'Yisus'], // Condición para buscar
                [
                    'person_id' => $person->id,
                    'email' => 'yeisonalbeiromarinduran@gmail.com',
                    'password' => Hash::make('Yema3788'), // Hash de la contraseña
                ]
            );
        
    }
}