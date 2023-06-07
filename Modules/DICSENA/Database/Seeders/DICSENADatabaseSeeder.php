<?php

namespace Modules\DICSENA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DICSENADatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::beginTransaction();
        $thi->call(ApptableSeeder::class);
        DB::commit();


        // $this->call("OthersTableSeeder");
    }
}
