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
        $this->call(PeopleTableSeeder::class); // Ejecutar Seeder De Personas
        $this->call(UsersTableSeeder::class); // Ejecutar Seeder De Usuarios
        $this->call(RolesTableSeeder::class); // Ejecutar Seeder De Roles De Usuario
        $this->call(PermissionsTableSeeder::class); // Ejecutar Seeder De Permisos Para Roles

        DB::commit(); // Finalizar Transacción
    }
}
