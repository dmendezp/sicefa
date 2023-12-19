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
        // Obtiene la primera persona de la colección
        $person = Person::first();

        // Obtiene la primera unidad productiva de almacén de la colección
        $productive_unit_warehouse = ProductiveUnitWarehouse::first();

        // Verifica que $person y $productive_unit_warehouse no sean nulos
        if (!$person || !$productive_unit_warehouse) {
            // Maneja el caso en el que $person o $productive_unit_warehouse sea nulo
            // Puedes registrar un error, lanzar una excepción o tomar la acción adecuada
            return;
        }

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

        // Crea un tipo de compra si no existe uno con el mismo nombre
        $kindOfPurchase = KindOfPurchase::firstOrNew([
            'name' => 'Tipo de Compra Ejemplo',
        ]);

        // Verifica si kindOfPurchase ya existe
        if (!$kindOfPurchase->exists) {
            $kindOfPurchase->fill([
                'description' => 'Descripción del tipo de compra',
            ])->save();
        }

        // Crea una unidad de medida
        $measurementUnit = MeasurementUnit::create([
            'name' => 'Unidad de Medida Ejemplo',
            'abbreviation' => 'UME',
            'minimum_unit_measure' => 'Mínimo',
            'conversion_factor' => 1.0,
        ]);

        // Crea un elemento asociado a la categoría, tipo de compra y unidad de medida
        $element = Element::create([
            'name' => 'Elemento de Inventario',
            'measurement_unit_id' => $measurementUnit->id,
            'description' => 'Descripción del elemento',
            'kind_of_purchase_id' => $kindOfPurchase->id,
            'category_id' => $category->id,
            'price' => 100, // Ajusta según tus necesidades
            'UNSPSC_code' => 123456, // Ajusta según tus necesidades
            'image' => 'ruta/a/la/imagen.jpg', // Ajusta según tus necesidades
            'slug' => 'elemento-inventario',
        ]);

        // Verifica si $element no es nulo
        if (!$element) {
            // Maneja el caso en el que $element sea nulo
            // Puedes registrar un error, lanzar una excepción o tomar la acción adecuada
            return;
        }

        Inventory::create([
            'person_id' => $person->id,
            'productive_unit_warehouse_id' => $productive_unit_warehouse->id,
            'element_id' => $element->id,
            'destination' => 'Formación',
            'description' => 'Elementos de senaempresa',
            'price' => '1.000',
            'amount' => '70',
            'stock' => '50',
            'production_date' => '2023-12-30',
            'lot_number' => '022',
            'expiration_date' => '2024-12-30',
            'state' => 'Disponible',
            'mark' => 'senaempresa',
            'inventory_code' => '78'
        ]);
    }
}
