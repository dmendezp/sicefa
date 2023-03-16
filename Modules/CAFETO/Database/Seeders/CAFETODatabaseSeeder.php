<?php

namespace Modules\CAFETO\Database\Seeders;

use Illuminate\Database\Seeder;

class CAFETODatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call("OthersTableSeeder");
        // Llama el seeder de aplicación CAFETO
        $this->call(AppTableSeeder::class);
    }
}
