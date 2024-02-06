<?php

namespace Modules\AGROCEFA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\Element;

class InventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Consultar la app para realizar la creacion de roles
        $app = App::where('name', 'AGROCEFA')->first();

        $categories = [
            [
                'name' => 'Fertilizante',
                'kind_of_property' => 'Bodega',
            ],
            [
                'name' => 'Herramienta',
                'kind_of_property' => 'Devolutivo',
            ],
            [
                'name' => 'Agroquimico',
                'kind_of_property' => 'Bodega',
            ],
            [
                'name' => 'Maquinaria',
                'kind_of_property' => 'Devolutivo',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate(['name' => $categoryData['name']], $categoryData);
        }

        
    }
}
