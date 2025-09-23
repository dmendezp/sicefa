<?php

namespace Modules\GDMF\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Sector;
use Modules\SICA\Entities\Warehouse;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* Registro o actualización de la nueva aplicación Sistema Integrado de Gestión de Materiales de Formación  */
        App::updateOrCreate(['name' => 'GDMF'], [
            'url' => '/gdmf/index',
            'color' => '#007bff',
            'icon' => 'fas fa-book-open',
            'description' => 'Sistema Integrado de Gestión de Materiales de Formación',
            'description_english' => 'System for the Integrated Management of Formative Materials'
        ]);

    }
}