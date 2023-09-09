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

        // Obtener los registros de inventario que coinciden con las bodegas relacionadas
        $inventory = Inventory::whereIn('productive_unit_warehouse_id', $unitWarehouses)->get();

        $productiveUnitName = ProductiveUnit::where('id', $selectedUnitId)->value('name');

        return view('agrocefa::inventory', [
            'inventory' => $inventory,
            'categories' => $categories,
            'productiveUnitName' => $productiveUnitName,
        ]);
    }

    public function showWarehouseFilter(Request $request)
    {
        // Obtener los datos del formulario de solicitud AJAX
        $selectedCategoryId = $request->input('category');

        // Obtener el ID de la unidad productiva seleccionada (asumiendo que lo tienes en sesión)
        $selectedUnitId = Session::get('selectedUnitId');

        // Inicializar la consulta de inventario
        $query = Inventory::query();

        $categories = Category::all();

        // Obtener los registros de 'productive_unit_warehouses' que coinciden con la unidad productiva seleccionada
        $unitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->pluck('id');

        // Aplicar filtro por unidad productiva
        $query->whereIn('productive_unit_warehouse_id', $unitWarehouses);

        // Si se seleccionó una categoría, aplicar el filtro por categoría
        if ($selectedCategoryId) {
            $query->whereHas('element', function ($subquery) use ($selectedCategoryId) {
                $subquery->where('category_id', $selectedCategoryId);
            });
        }

        // Obtener los registros de inventario aplicando todos los filtros
        $inventory = $query->get();

        // Devolver solo la vista parcial en lugar de la vista completa
        return view('agrocefa::inventoryPartial', [
            'inventory' => $inventory,
        ]);
    }

    //Crear
    public function store()
    {

    }

    //Actualizar
    public function update()
    {
        
    }

    //Eliminar
    public function destroy()
    {
        
    }

}
