<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Category;


class InventoryController extends Controller

{

    public function inventory()
    {
        // Paso 1: Consultar todas las bodegas disponibles
        $warehouses = Warehouse::all();

        // Puedes cargar las categorías aquí o desde donde las obtengas
        $categories = Category::all(); // Aquí debes cargar las categorías

        $categoryName = 'Nombre de la Categoría'; // Nombre de la categoría deseada

        // Paso 2: Obtener la bodega deseada (puedes cambiar 'agrocefa' por lo que necesites)
        $warehouseName = 'agrocefa'; // Nombre de la bodega deseada

        $elementsInCategory = Inventory::whereHas('element.category', function ($query) use ($categoryName) {
            $query->where('name', $categoryName);
        })->get();

        // Paso 3: Consultar los elementos en esa bodega
        $elementsInWarehouse = Inventory::whereHas('productive_unit_warehouse.warehouse', function ($query) use ($warehouseName) {
            $query->where('name', $warehouseName);
        })->get();

        // Paso 4: Puedes pasar las variables a la vista
        return view('agrocefa::inventory', [
            'elementsInWarehouse' => $elementsInWarehouse,
            'elementsInCategory' => $elementsInCategory,
            'warehouses' => $warehouses,
            'categories' => $categories, // Asegúrate de cargar las categorías aquí
        ]);
    }

    public function showWarehouseFilter(Request $request)
    {
        // Obtener todas las bodegas
        $warehouses = Warehouse::all();

        // Obtener el ID de la bodega seleccionada desde el formulario
        $warehouseId = $request->input('warehouse');
        $categoryId = $request->input('category');

        // Obtener la bodega deseada
        $warehouse = Warehouse::find($warehouseId);

        // Inicializar el query builder para la tabla 'elements'
        $query = Element::query();

        // Filtrar por categoría si se selecciona una
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // Filtrar por bodega si se selecciona una
        if ($warehouse) {
            $query->whereHas('inventories.productive_unit_warehouse', function ($query) use ($warehouseId) {
                $query->where('warehouse_id', $warehouseId);
            });
        }

        // Obtener los elementos filtrados
        $filteredElements = $query->get();

        // Pasar los elementos filtrados a la vista
        return view('agrocefa::inventory', [
            'filteredElements' => $filteredElements,
            'warehouses' => $warehouses,
            'categories' => Category::all(),
        ]);
    }







}