<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;

class PTVENTADatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(AppTableSeeder::class); // llamar seeder de aplicación PTVENTA

    }
}
