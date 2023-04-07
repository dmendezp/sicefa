<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PTVENTADatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::beginTransaction(); // Iniciar transacción

        $this->call(AppTableSeeder::class); // llamar seeder de aplicación PTVENTA
        $this->call(ElementTableSeeder::class); // llamar seeder de elementos

        DB::commit(); // Finalizar transación

    }
}
