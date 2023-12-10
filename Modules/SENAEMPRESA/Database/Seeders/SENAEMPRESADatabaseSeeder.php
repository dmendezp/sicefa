<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Facades\DB;
use Modules\SENAEMPRESA\Database\Seeders\PeopleTableSeeder;

class SENAEMPRESADatabaseSeeder extends Seeder
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
        $this->call(PeopleTableSeeder::class); // Ejecutar Seeder de personas
        $this->call(UsersTableSeeder::class); // Ejecutar Seeder de usuarios
        $this->call(RolesTableSeeder::class); // Ejecutar Seeder de roles para usuarios
        $this->call(PermissionsTableSeeder::class); // Ejecutar Seeder de permisos para roles
        $this->call(PositionCompaniesTableSeeder::class); // Ejecutar Seeder de cargos
        $this->call(StaffSenaempresasTableSeeder::class); // Ejecutar Seeder de personal
        $this->call(QuartersTableSeeder::class); // Ejecutar Seeder de trimestres
        $this->call(SenaempresasTableSeeder::class); // Ejecutar Seeder de senaempresa estrategias
        $this->call(VacanciesTableSeeder::class); // Ejecutar Seeder de vacantes
        $this->call(InventoriesTableSeeder::class); // Ejecutar Seeder de vacantes
        DB::commit(); // Finalizar transacción
    }
}
