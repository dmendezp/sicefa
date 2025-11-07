<?php

namespace Modules\CPD\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CPDDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(CPDTableSeeder::class);
        $this->call(DataTableSeeder::class);
        $this->call(MetadataTableSeeder::class);

    }
}
