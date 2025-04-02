<?php

namespace Modules\SIA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SIADatabaseSeeder extends Seeder
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
        $this->call(AppTableSeeder::class); // Ejecutar Seeder de aplicación SIA
        $this->call(UsersTableSeeder::class); // Ejecutar Seeder de usuarios
        $this->call(RolesTableSeeder::class); // Ejecutar Seeder de roles para usuarios
        $this->call(PermissionsTableSeeder::class); // Ejecutar Seeder de permisos para roles

        // Sección para pruebas de desarrollo
        /* $this->call(ProjectsTableSeeder::class); // Ejecutar Seeder de proyectos
        $this->call(EventsTableSeeder::class); // Ejecutar Seeder de eventos
        $this->call(ResourcesTableSeeder::class); // Ejecutar Seeder de recursos */

        DB::commit(); // Finalizar transacción
    }
}
