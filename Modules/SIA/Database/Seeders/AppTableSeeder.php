<?php

namespace Modules\SIA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\SIA\Entities\App;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ejemplo de inserción de datos en la tabla 'apps'
        DB::table('apps')->insert([
            [
                'name' => 'SIA',
                'color' => '#7fc722',
            'icon' => 'fas fa-flask fas fa-users',
            'description' => 'Semillero de investigación la angostura.',
            'description_english' => 'Angostura research seedbed.',
            'url' => '/sia/index'
            ],
        ]);

    }
}