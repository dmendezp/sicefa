<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\ProductiveUnitWarehouse;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Ejecuta la inserción de datos en la base de datos.
     *
     * @return void
     */
    public function run()
    {
        // Crea una categoría si no existe una con el mismo nombre
        $category = Category::firstOrNew([
            'name' => 'SENAEMPRESA_EPP',
        ]);

        // Verifica si la categoría ya existe
        if (!$category->exists) {
            $category->fill([
                'kind_of_property' => 'Devolutivo', // Ajusta según tus necesidades
            ])->save();
        }
    }
}
