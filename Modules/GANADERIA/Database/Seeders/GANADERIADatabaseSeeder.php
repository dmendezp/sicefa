<?php

namespace Modules\GANADERIA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GANADERIADatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();
<<<<<<< HEAD
        
        $this->call(SeedConfigurationsTableSeeder::class);
        $this->call(SeedPermissionsTableSeeder::class);
        

        // $this->call("OthersTableSeeder");
=======
        $this->call(SeedPermissionsTableSeeder::class);
>>>>>>> ecf44174427f6326b1453a36d931e98cfb747e27
    }
}
