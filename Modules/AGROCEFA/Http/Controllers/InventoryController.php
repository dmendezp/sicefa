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
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\kindOfPurchase;



class InventoryController extends Controller
{
    private function buildDynamicRoute()
    {
        // Almacenar el rol en la sesión
        session(['rol' => Auth::user()->rol]);

        // Construir la ruta dinámicamente
        return 'agrocefa.' . session('rol') . '.inventory.index';
    }

    public function inventory(Request $request)
    {
        // Obtener el ID de la unidad productiva seleccionada (asumiendo que lo tienes en sesión)
        $selectedUnitId = Session::get('selectedUnitId');

        // Obtener todas las categorías
        $categories = Category::all();
        $elements = Element::all();
        $measurementUnits = MeasurementUnit::all();
        $purchaseTypes = kindOfPurchase::all();

        // Obtén los registros de productive_unit_warehouse que coinciden con la unidad productiva seleccionada
        $ProductiveUnitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->get();

        // Obtener los registros de 'productive_unit_warehouses' que coinciden con la unidad productiva seleccionada
        $unitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->pluck('id');

        // Obtener los registros de inventario que coinciden con las bodegas relacionadas
        $inventory = Inventory::whereIn('productive_unit_warehouse_id', $unitWarehouses)->get();

        $productiveUnitName = ProductiveUnit::where('id', $selectedUnitId)->value('name');

        return view('agrocefa::inventory.inventory', [
            'inventory' => $inventory,
            'categories' => $categories,
            'productiveUnitName' => $productiveUnitName,
            'ProductiveUnitWarehouses' => $ProductiveUnitWarehouses,
            'elements' => $elements,
            'measurementUnits' => $measurementUnits,
            'purchaseTypes' => $purchaseTypes,
            'selectedUnitId' => $selectedUnitId,
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
        return view('agrocefa::inventory.inventoryPartial', [
            'inventory' => $inventory,
        ]);
    }

    public function addCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'kind_of_property' => 'required|in:Devolutivo,Bodega',
        ]);
        //Crear nuevo registro de categoria
        $category = new Category();
        $category->name = $request->input('name');
        $category->kind_of_property = $request->input('kind_of_property');
        $category->save();

        return redirect()->route($this->buildDynamicRoute())->with('success', 'Registro exitoso');
    }

    public function addElement(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'measurement_unit_id' => 'required',
            'description' => 'required',
            'kind_of_purchase_id' => 'required',
            'category_id' => 'required',
            'price' => 'required',
        ]);
        //Crear nuevo registro de categoria
        $element = new Element();
        $element->name = $request->input('name');
        $element->measurement_unit_id = $request->input('measurement_unit_id');
        $element->description = $request->input('description');
        $element->kind_of_purchase_id = $request->input('kind_of_purchase_id');
        $element->category_id = $request->input('category_id');
        $element->price = $request->input('price');

        $element->save();

        return redirect()->route($this->buildDynamicRoute())->with('success', 'Registro exitoso');
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
            'production_date' => 'required',
            'lot_number' => 'required',
            'expiration_date' => 'required',
            'state' => 'required|in:Disponible,No disponible',
            'mark' => 'required',
            'inventory_code' => 'required',


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
        $inventory->production_date = $request->input('production_date');
        $inventory->lot_number = $request->input('lot_number');
        $inventory->expiration_date = $request->input('expiration_date');
        $inventory->state = $request->input('state');
        $inventory->mark = $request->input('mark');
        $inventory->inventory_code = $request->input('inventory_code');


        // Guardar el nuevo registro en la base de datos
        $inventory->save();

        // Redirigir a la página de inventario o mostrar un mensaje de éxito
        try {
            return redirect()
                ->route('agrocefa.inventory.inventory')
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
            'production_date' => 'required',
            'lot_number' => 'required',
            'expiration_date' => 'required',
            'state' => 'required|in:Disponible,No disponible',
            'mark' => 'required',
            'inventory_code' => 'required',
        ]);

        // Encontrar el registro a actualizar
        $inventory = Inventory::findOrFail($id);

        $inventory->person_id = auth()->user()->id;
        $inventory->productive_unit_warehouse_id = $request->input('productive_unit_warehouse_id');
        $inventory->element_id = $request->input('element_id');
        $inventory->destination = $request->input('destination');
        $inventory->description = $request->input('description');
        $inventory->price = $request->input('price');
        $inventory->amount = $request->input('amount');
        $inventory->stock = $request->input('stock');
        $inventory->production_date = $request->input('production_date');
        $inventory->lot_number = $request->input('lot_number');
        $inventory->expiration_date = $request->input('expiration_date');
        $inventory->state = $request->input('state');
        $inventory->mark = $request->input('mark');
        $inventory->inventory_code = $request->input('inventory_code');

        $inventory->save();

        return redirect()
            ->route($this->buildDynamicRoute())
            ->with('register', 'Registro actualizado');
    }

    //Eliminar
    public function destroy($id)
    {
        try {
            $inventory = Inventory::findOrFail($id);
            $inventory->delete();

            return redirect()
                ->route('agrocefa.inventory.inventory')
                ->with('error', 'Registro eliminado.');
        } catch (\Exception $e) {
            return redirect()
                ->route($this->buildDynamicRoute())
                ->with('error', 'Error al eliminar la especie.');
        }
    }
}
