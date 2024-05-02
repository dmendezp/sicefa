<?php

namespace Modules\AGROINDUSTRIA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::updateOrCreate(['name' => 'Abarrotes'], [
            'kind_of_property' => 'Bodega'
        ]);

        $categories = Category::updateOrCreate(['name' => 'Aditivos'], [
            'kind_of_property' => 'Bodega'
        ]);

        $categories = Category::updateOrCreate(['name' => 'Empaques'], [
            'kind_of_property' => 'Bodega'
        ]);

        $categories = Category::updateOrCreate(['name' => 'Higiene'], [
            'kind_of_property' => 'Bodega'
        ]);

        $categories = Category::updateOrCreate(['name' => 'Utensilios'], [
            'kind_of_property' => 'Devolutivo'
        ]);

        $categories = Category::updateOrCreate(['name' => 'Productos'], [
            'kind_of_property' => 'Bodega'
        ]);

        $categories = Category::updateOrCreate(['name' => 'Maquinaria'], [
            'kind_of_property' => 'Devolutivo'
        ]);

    }
}
