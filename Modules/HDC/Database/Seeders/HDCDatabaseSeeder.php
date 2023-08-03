<?php

namespace Modules\HDC\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class HDCDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::beginTransaction(); // Iniciar Transaccion 
       $this->call(AppTableSeeder::class); // Ejecutar Seeder
       DB::commit(); // Finalizar Trasnsaccion 
    }
}
