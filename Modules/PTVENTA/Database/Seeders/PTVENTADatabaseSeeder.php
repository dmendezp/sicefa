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

        $this->call(PeopleTableSeeder::class); // Ejecutar Seeder de personas
        $this->call(AppTableSeeder::class); // Ejecutar Seeder de aplicación PTVENTA
        $this->call(PeopleTableSeeder::class); // Ejecutar Seeder de personas
        $this->call(UsersTableSeeder::class); // Ejecutar Seeder de usuarios
        $this->call(RolesTableSeeder::class); // Ejecutar Seeder de roles para usuarios
        $this->call(PermissionsTableSeeder::class); // Ejecutar Seeder de permisos para roles
        $this->call(ElementsTableSeeder::class); // Ejecutar Seeder de elementos
        $this->call(InventoriesTableSeeder::class);// Ejecutar el seeder de inventarios

        DB::commit(); // Finalizar transación

    }
}
