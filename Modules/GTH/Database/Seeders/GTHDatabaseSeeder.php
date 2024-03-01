<?php

namespace Modules\GTH\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GTHDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $this->call("OthersTableSeeder");
        DB::beginTransaction(); // Iniciar transacción
            $this->call(AppTableSeeder::class); // Ejecutar Seeder de aplicación
            $this->call(RolesTableSeeder::class); // Ejecutar Seeder de aplicación
            $this->call(PermissionsTableSeeder::class); // Ejecutar Seeder de aplicación
        DB::commit(); // Finalizar transacción
    }
}
