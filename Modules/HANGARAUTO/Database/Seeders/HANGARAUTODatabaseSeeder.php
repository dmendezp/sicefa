<?php

namespace Modules\HANGARAUTO\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HANGARAUTODatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction(); // Iniciar Transacción
        $this->call(AppTableSeeder::class); // Ejecutar Seeder De La Aplicación
        $this->call(UserTableSeeder::class); // Ejecutar Seeder De La Aplicación
        $this->call(RoleTableSeeder::class); // Ejecutar Seeder De La Aplicación
        $this->call(PermissionTableSeeder::class); // Ejecutar Seeder De La Aplicación
       

        DB::commit(); // Finalizar Transacción
    }
}
