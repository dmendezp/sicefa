<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Movement;

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

        // Sección de lanzamiento para producción
        $this->call(PeopleTableSeeder::class); // Ejecutar Seeder de personas
        $this->call(AppTableSeeder::class); // Ejecutar Seeder de aplicación PTVENTA
        $this->call(UsersTableSeeder::class); // Ejecutar Seeder de usuarios
        $this->call(RolesTableSeeder::class); // Ejecutar Seeder de roles para usuarios
        $this->call(PermissionsTableSeeder::class); // Ejecutar Seeder de permisos para roles

        // Sección para pruebas de desarrollo
        /* Category::factory()->count(5)->create(); //  Generar categorias de pruebas
        $this->call(ElementsTableSeeder::class); // Ejecutar Seeder de elementos
        $this->call(InventoriesTableSeeder::class);// Ejecutar el seeder de inventarios
        $this->call(WarehousesTableSeeder::class); // Ejecutar Seeder de bodegas
        Movement::factory()->count(500)->create(); //  Generar Movimientos de pruebas */

        DB::commit(); // Finalizar transación

    }
}
