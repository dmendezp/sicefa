<?php

namespace Modules\ACOPI\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;


class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $app = App::updateOrCreate(['name' => 'ACOPI'], [
            'url' => '/acopi/index',
            'color' => '#76250C',
            'icon' => 'fas fa-recycle',
            'description' => 'Registro de entrada y salida de materiales',
            'description_english' => 'Entry and exit of materials',

        ]);
    }
}
