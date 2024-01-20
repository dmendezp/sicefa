<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
        // Construir la ruta dinámicamente
        return 'agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.index';
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

        //Declaracion de estado
        $state = 'Disponible';

        // Obtener los registros de inventario que coinciden con las bodegas relacionadas
        $inventory = Inventory::where('state', $state)->whereIn('productive_unit_warehouse_id', $unitWarehouses)->get();

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
            'price' => 'required',
            'amount' => 'required',
            'stock' => 'required',
            'state' => 'required|in:Disponible,No disponible',


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
        $inventory->state = $request->input('state');


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
                ->with('success', 'Registro exitoso');
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
            'price' => 'required',
            'amount' => 'required',
            'stock' => 'required',
            'state' => 'required|in:Disponible,No disponible',
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
        $inventory->state = $request->input('state');

        $inventory->save();

        return redirect()
            ->route($this->buildDynamicRoute())
            ->with('register', 'Registro actualizado exitosamente');
    }

    //Eliminar
    public function destroy($id)
    {
        try {
            $inventory = Inventory::findOrFail($id);
            $inventory->delete();

            return redirect()
                ->route('agrocefa.inventory.inventory')
                ->with('success', 'Registro eliminado.');
        } catch (\Exception $e) {
            return redirect()
                ->route($this->buildDynamicRoute())
                ->with('error', 'Registro eliminado exitosamente');
        }
    }
}
