<?php

namespace Modules\SENAAPICOLA\Database\Seeders;

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
        Model::unguard();

        // $this->call("OthersTableSeeder");

    $app = App::updateOrcreate([
            'name' => 'SENAAPICOLA'],[
            'url' => '/senaapicola/index',
            'color' => '#FF0000',
            'icon' => 'fa-solid fa-bee',
            'description' => 'Sistema de Gestion Apícola del SENA',
            'description_english' => 'SENAApicola management system',
        ]);
    }
}