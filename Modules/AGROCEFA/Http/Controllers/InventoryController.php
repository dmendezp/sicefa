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
    public function inventory(Request $request)
    {
        // Obtener el ID de la unidad productiva seleccionada (asumiendo que lo tienes en sesión)
        $selectedUnitId = Session::get('selectedUnitId');

        // Obtener todas las categorías
        $categories = Category::all();

        // Obtener los registros de 'productive_unit_warehouses' que coinciden con la unidad productiva seleccionada
        $unitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->pluck('id');
        // Obtener los IDs de las bodegas relacionadas con la unidad productiva
        // Obtener los registros de inventario que coinciden con las bodegas relacionadas
        $inventory = Inventory::whereIn('productive_unit_warehouse_id', $unitWarehouses)->get();


        return view('agrocefa::inventory', [
            'inventory' => $inventory,
            'categories' => $categories,
        ]);
    }

        public function showWarehouseFilter(Request $request)
    {
        // Obtener todas las categorías
        $categories = Category::all();

        // Obtener el ID de la categoría seleccionada desde el formulario
        $categoryId = $request->input('category');

        // Inicializar el query builder para la tabla 'inventory'
        $query = Inventory::query();

        // Filtrar por categoría si se selecciona una
        if ($categoryId) {
            $query->whereHas('element', function ($subquery) use ($categoryId) {
                $subquery->where('category_id', $categoryId);
            });
        }

        // Obtener los elementos filtrados
        $filteredInventory = $query->get();

        return view('agrocefa::inventory', [
            'filteredInventory' => $filteredInventory,
            'categories' => $categories,
        ]);
    }



}