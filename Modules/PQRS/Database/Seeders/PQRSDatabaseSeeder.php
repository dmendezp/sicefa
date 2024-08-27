<?php

namespace Modules\PQRS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PQRSDatabaseSeeder extends Seeder
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
        $this->call(RolesTableSeeder::class); // Ejecutar Seeder de roles
        $this->call(PermissionsTableSeeder::class); // Ejecutar Seeder de permisos

        DB::commit(); // Finalizar transacción
    }
}
