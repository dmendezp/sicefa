<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Element;

class SICADatabaseSeeder extends Seeder
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
        $this->call(CategoriesTableSeeder::class); // Ejecutar Seeder de categorías
        $this->call(MeasurementUnitsTableSeeder::class); // Ejecutar Seeder de unidades de medida
        $this->call(KindOfPurchasesTableSeeder::class); // Ejecutar Seeder de tipos de campra
        $this->call(PeopleTableSeeder::class); // Ejecutar Seeder de personas
        $this->call(UsersTableSeeder::class); // Ejecutar Seeder de usuarios
        $this->call(RolesTableSeeder::class); // Ejecutar Seeder de roles para usuarios
        $this->call(PermissionsTableSeeder::class); // Ejecutar Seeder de permisos para roles
        $this->call(LinesTableSeeder::class); // Ejecutar Seeder de líneas tecnológicas
        $this->call(NetworksTableSeeder::class); // Ejecutar Seeder de redes de conocimiento
        $this->call(ProgramsTableSeeder::class); // Ejecutar Seeder de programas de formación
        $this->call(CoursesTableSeeder::class); // Ejecutar Seeder de cursos de formación

        DB::commit(); // Finalizar transacción

    }
}
