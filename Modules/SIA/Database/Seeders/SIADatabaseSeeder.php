<?php

namespace Modules\SIA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\SIA\Database\Seeders\PeopleTableSeeder;

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
        $this->call(PeopleTableSeeder::class); 
        $this->call(AppTableSeeder::class); 
        $this->call(UsersTableSeeder::class); 
        $this->call(RolesTableSeeder::class); 
        $this->call(PermissionsTableSeeder::class); 
        $this->call(GroupsTableSeeder::class); 

        DB::commit(); // Finalizar transacción
    }
}
