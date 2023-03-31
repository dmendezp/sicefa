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
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9e522343459ee925d0b5f3facbe07726bbe7eda3
>>>>>>> 38c7f0aef500bd787694266d92d1596b42416e45
        
        $this->call(SeedConfigurationsTableSeeder::class);
        $this->call(SeedPermissionsTableSeeder::class);
        

        // $this->call("OthersTableSeeder");
=======
        $this->call(SeedPermissionsTableSeeder::class);
>>>>>>> ecf44174427f6326b1453a36d931e98cfb747e27
    }
}
