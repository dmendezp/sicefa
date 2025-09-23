<?php

namespace Modules\SG\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SGDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           DB::beginTransaction(); // Iniciar transacción


         $this->call(AppTableSeeder::class);
         $this->call(PeopleTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(RolesTableSeeder::class);
         $this->call(PermissionsTableSeeder::class);

        // $this->call("OthersTableSeeder");

        
        DB::commit(); // Finalizar transación
    }
}
