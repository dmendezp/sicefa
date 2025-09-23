<?php

namespace Modules\GDMF\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GDMFDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction(); // Iniciar transacción

        // Sección de lanzamiento para producción
        $this->call(AppTableSeeder::class); // Ejecutar Seeder de aplicación
        $this->call(PeopleTableSeeder::class); // Ejecutar Seeder de personas
        $this->call(UsersTableSeeder::class); // Ejecutar Seeder de usuarios
        $this->call(RolesTableSeeder::class); // Ejecutar Seeder de roles para usuarios
        /* $this->call(PermissionsTableSeeder::class); // Ejecutar Seeder de permisos para roles */

        DB::commit(); // Finalizar transación
    }
}
