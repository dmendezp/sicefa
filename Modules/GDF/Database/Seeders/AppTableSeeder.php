<?php

namespace Modules\GDF\Database\Seeders;

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
        $app = App::updateOrCreate(
            ['name'=>'GDF'],
            [
            'url'=> '/gdf/index',
            'color'=> '#FF5733',
            'icon' => 'fa fa-piggy-bank',
            'description' => 'Gestion de Desplazamiento de Funcionarios',
            'description_english'=> 'Management of civil servant travel',
            ],
        );
    }
}
