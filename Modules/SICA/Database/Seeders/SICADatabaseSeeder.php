<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SICADatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();
        $this->call(SeedConfigurationsTableSeeder::class);
        $this->call(SeedPermissionsTableSeeder::class);

    }
}
