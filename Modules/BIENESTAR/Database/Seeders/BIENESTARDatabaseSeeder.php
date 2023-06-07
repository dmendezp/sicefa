<?php

namespace Modules\BIENESTAR\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BIENESTARDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction(); // Iniciar transacción

        $this->call(AppTableSeeder::class); // Ejecutar Seeder de aplicación
     
        DB::commit(); // Finalizar transacción
    }
}
