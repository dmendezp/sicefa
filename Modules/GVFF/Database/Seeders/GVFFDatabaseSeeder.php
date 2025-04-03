<?php

namespace Modules\GVFF\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class GVFFDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

         $this->call(AppTableSeeder::class);
         $this->call(PeopleTableSeeder::class);
         $this->call(UsersTableSeeder::class);

         DB::commit();
        
    }
}
