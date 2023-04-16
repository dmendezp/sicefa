<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();

        // $this->call("OthersTableSeeder");
        Category::create([
            'name' => 'Lácteos',
            'kind_of_property' => 'Bodega'
        ]);

        Category::create([
            'name' => 'Cárnicos',
            'kind_of_property' => 'Bodega'
        ]);

        Category::create([
            'name' => 'Frutas',
            'kind_of_property' => 'Bodega'
        ]);

        Category::create([
            'name' => 'Vegetales',
            'kind_of_property' => 'Bodega'
        ]);

        Category::create([
            'name' => 'Cereales',
            'kind_of_property' => 'Bodega'
        ]);

        Category::create([
            'name' => 'Legumbres',
            'kind_of_property' => 'Bodega'
        ]);

        Category::create([
            'name' => 'Utensilios',
            'kind_of_property' => 'Devolutivo'
        ]);

        Category::create([
            'name' => 'Repostería',
            'kind_of_property' => 'Bodega'
        ]);
    }
}
