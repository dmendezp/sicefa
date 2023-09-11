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
use Modules\SICA\Entities\Person;

class InventoryController extends Controller
{
    public function inventory(Request $request)
    {
        // Obtener el ID de la unidad productiva seleccionada (asumiendo que lo tienes en sesión)
        $selectedUnitId = Session::get('selectedUnitId');

        // Obtener todas las categorías
        $categories = Category::all();
        $ProductiveUnitWarehouses = ProductiveUnitWarehouse::all();
        $elements = Element::all();

        // Obtener los registros de 'productive_unit_warehouses' que coinciden con la unidad productiva seleccionada
        $unitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->pluck('id');

        // Obtener los registros de inventario que coinciden con las bodegas relacionadas
        $inventory = Inventory::whereIn('productive_unit_warehouse_id', $unitWarehouses)->get();

        $productiveUnitName = ProductiveUnit::where('id', $selectedUnitId)->value('name');

        return view('agrocefa::inventory', [
            'inventory' => $inventory,
            'categories' => $categories,
            'productiveUnitName' => $productiveUnitName,
            'ProductiveUnitWarehouses' => $ProductiveUnitWarehouses,
            'elements' => $elements,
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

    public function store(Request $request)
    {
        // Validar los datos del formulario (ajusta las reglas de validación según tus necesidades)
        $validatedData = $request->validate([
            'productive_unit_warehouse_id' => 'required',
            'element_id' => 'required',
            'destination' => 'required|in:Producción,Formación',
            'description' => 'required|string',
            'price' => 'required',
            'amount' => 'required',
            'stock' => 'required',

            // Agrega más reglas de validación según tus campos
        ]);

        // Crear un nuevo registro de inventario
        $inventory = new Inventory();
        $inventory->person_id = auth()->user()->id;
        $inventory->productive_unit_warehouse_id = $request->input('productive_unit_warehouse_id');
        $inventory->element_id = $request->input('element_id');
        $inventory->destination = $request->input('destination');
        $inventory->description = $request->input('description');
        $inventory->price = $request->input('price');
        $inventory->amount = $request->input('amount');
        $inventory->stock = $request->input('stock');

        // Guardar el nuevo registro en la base de datos
        $inventory->save();

        // Redirigir a la página de inventario o mostrar un mensaje de éxito
        try {
            return redirect()
                ->route('agrocefa.inventory')
                ->with('success', 'Registro exitoso.');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Error al crear el registro. Por favor, inténtalo de nuevo.');
        }
    }

    //Actualizar
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario (ajusta las reglas de validación según tus necesidades)
        $validatedData = $request->validate([
            'productive_unit_warehouse_id' => 'required',
            'element_id' => 'required',
            'destination' => 'required|in:Producción,Formación',
            'description' => 'required|string',
            'price' => 'required',
            'amount' => 'required',
            'stock' => 'required',

        ]);

        // Encontrar el registro a actualizar
        $inventory = Inventory::findOrFail($id);

        $inventory = new Inventory();
        $inventory->person_id = auth()->user()->id;
        $inventory->productive_unit_warehouse_id = $request->input('productive_unit_warehouse_id');
        $inventory->element_id = $request->input('element_id');
        $inventory->destination = $request->input('destination');
        $inventory->description = $request->input('description');
        $inventory->price = $request->input('price');
        $inventory->amount = $request->input('amount');
        $inventory->stock = $request->input('stock');
        $inventory->save();

        return redirect()->route('agrocefa.inventory');
    }

    //Eliminar
    public function destroy($id)
    {
        try {
            $inventory = Inventory::findOrFail($id);
            $inventory->delete();

            return redirect()->route('agrocefa.inventory')->with('error', 'Registro eliminado.');
        } catch (\Exception $e) {
            return redirect()->route('agrocefa.inventory')->with('error', 'Error al eliminar la especie.');
        }
    }
}
