<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\Line;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\Network;
use Modules\SICA\Entities\Program;

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
        Category::factory()->count(4)->create(); // Crear registros de categorias
        MeasurementUnit::factory()->count(4)->create(); // Crear registros de unidades de medida
        KindOfPurchase::factory()->count(2)->create(); // Crear registros de tipos de compra
        $this->call(PeopleTableSeeder::class); // Ejecutar Seeder de personas
        $this->call(UsersTableSeeder::class); // Ejecutar Seeder de usuarios
        $this->call(RolesTableSeeder::class); // Ejecutar Seeder de roles para usuarios
        $this->call(PermissionsTableSeeder::class); // Ejecutar Seeder de permisos para roles
        Line::factory()->count(3)->create(); // Crear registros de líneas tecnológicas
        Network::factory()->count(6)->create(); // Crear registros de redes de conocimiento
        Program::factory()->count(12)->create(); // Crear registros de programas de formación
        Course::factory()->count(24)->create(); // Crear registros de cursos formativos
        $this->call(ApprenticesTableSeeder::class); // Ejecutar Seeder de aprendices
        $this->call(MovementTypesTableSeeder::class); // Ejecutar Seeder de tipos de movimientos

        DB::commit(); // Finalizar transacción

    }
}
