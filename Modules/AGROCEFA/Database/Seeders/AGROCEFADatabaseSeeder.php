<?php

namespace Modules\AGROCEFA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AGROCEFADatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction(); // Iniciar transacción

        $this->call(AppTableSeeder::class); //Ejecutar seeder de la app

        DB::commit(); //Finalizar transaccion


    }
}
