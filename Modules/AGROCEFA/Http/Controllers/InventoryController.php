<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\WarehouseMovement;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\AGROCEFA\Http\Controllers\AGROCEFAController;



class InventoryController extends Controller
{
    private function buildDynamicRoute()
    {
        // Construir la ruta dinámicamente
        return 'agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.index';
    }

    public function inventory(Request $request)
    {
        // Instancia del controlador AGROCEFA
        $agrocefaController = new AGROCEFAController();
        // Llamar la funcion para actualizar las notificaciones de Movimientos
        $result = $agrocefaController->notificationmovement();
        // Llamar la funcion para actualizar las notificaciones de stock
        $result = $agrocefaController->notificationstock();

        // Obtener el ID de la unidad productiva seleccionada (asumiendo que lo tienes en sesión)
        $selectedUnitId = Session::get('selectedUnitId');

        // Obtener todas las categorías
        $categories = Category::all();
        $elements = Element::all();
        $measurementUnits = MeasurementUnit::all();
        $purchaseTypes = KindOfPurchase::all();

        // Obtén los registros de productive_unit_warehouse que coinciden con la unidad productiva seleccionada
        $ProductiveUnitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->get();

        // Obtener los registros de 'productive_unit_warehouses' que coinciden con la unidad productiva seleccionada
        $unitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->pluck('id');

        $datenow = Carbon::now();

        // Obtener los registros de inventario que coinciden con las bodegas relacionadas
        $inventory = Inventory::whereIn('productive_unit_warehouse_id', $unitWarehouses)->where('state','=','Disponible')->where('amount','>','0')->where('expiration_date','>', $datenow)->get();

        $productiveUnitName = ProductiveUnit::where('id', $selectedUnitId)->value('name');

        // Notificacion de bajas
        $selectedUnit = ProductiveUnit::find($selectedUnitId);

        // Obtener el nombre de la unidad a través del modelo ProductiveUnit
        $selectedUnitName = ProductiveUnit::where('id', $selectedUnitId)->value('name');

        // Inicializa un array para almacenar la información de las bodegas
        $warehouseData = [];

        // Verifica si hay registros en la tabla productive_unit_warehouses para esta unidad
        if ($selectedUnit) {
            $warehouses = $selectedUnit->productive_unit_warehouses;
            foreach ($warehouses as $warehouse) {
                $productiveInventory = $warehouse['id'];
            }
        }

        

        $inventories = Inventory::where('productive_unit_warehouse_id','=', $productiveInventory)
            ->where('expiration_date','<', $datenow)
            ->where('state','=','Disponible')
            ->where('amount','>','0')
            ->get()
            ->toArray();

        $datas = [];
        
        foreach ($inventories as $inventor) {
            $id = $inventor['id'];

    
            // Agregar información al array asociativo
            $datas[] = [
                'id' => $id,
            ];
            
        }

        // Contar el número de registros después de obtener los datos
        $lowCount = count($datas);

        Session::put('notificationlow', $lowCount);

        return view('agrocefa::inventory.inventory', [
            'inventory' => $inventory,
            'categories' => $categories,
            'productiveUnitName' => $productiveUnitName,
            'ProductiveUnitWarehouses' => $ProductiveUnitWarehouses,
            'elements' => $elements,
            'measurementUnits' => $measurementUnits,
            'purchaseTypes' => $purchaseTypes,
            'selectedUnitId' => $selectedUnitId,
            'notificationlow' => $lowCount,
        ]);
    }
    public function stockview(Request $request)
    {
        // Obtener el ID de la unidad productiva seleccionada (asumiendo que lo tienes en sesión)
        $selectedUnitId = Session::get('selectedUnitId');

        // Notificacion de bajas
        $selectedUnit = ProductiveUnit::find($selectedUnitId);

        // Inicializa un array para almacenar la información de las bodegas
        $warehouseData = [];

        // Verifica si hay registros en la tabla productive_unit_warehouses para esta unidad
        if ($selectedUnit) {
            $productiveInventory = $selectedUnit->productive_unit_warehouses->pluck('id')->toArray();
        }

        $datenow = Carbon::now();
                
        // Consulta principal en la tabla de inventarios
        $inventories = Inventory::whereIn('productive_unit_warehouse_id', $productiveInventory)
            ->where(function ($query) {
                // Aplicar el filtro por categoría y ajustar la cantidad según el factor de conversión si es necesario
                $query->whereHas('element', function ($subquery) {
                    $subquery->selectRaw('stock / measurement_units.conversion_factor as measurement_unit_adjusted_stock')
                        ->join('measurement_units', 'elements.measurement_unit_id', '=', 'measurement_units.id')
                        ->whereRaw('stock > amount / measurement_units.conversion_factor')
                        ->whereNull('elements.deleted_at');
                });
            })
            ->where('state', '=', 'Disponible')
            ->where('amount','>','0')
            ->get();

       
        

        return view('agrocefa::inventory.stockminimo', [
            'inventory' => $inventories,
        ]);
    }
    public function lowentrance(Request $request)
    {
        // Obtener el ID de la unidad productiva seleccionada (asumiendo que lo tienes en sesión)
        $selectedUnitId = Session::get('selectedUnitId');

        // Obtén los registros de productive_unit_warehouse que coinciden con la unidad productiva seleccionada
        $ProductiveUnitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->get();

        // Obtener los registros de 'productive_unit_warehouses' que coinciden con la unidad productiva seleccionada
        $unitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->pluck('id');

        $datenow = Carbon::now();

        // Obtener los registros de inventario que coinciden con las bodegas relacionadas
        $inventory = Inventory::whereIn('productive_unit_warehouse_id', $unitWarehouses)
        ->where('expiration_date','<', $datenow)
        ->where('state','=','Disponible')
        ->where('amount','>','0')
        ->get();
       


        return view('agrocefa::inventory.low', [
            'inventory' => $inventory,
        ]);
    }

    public function showWarehouseFilter(Request $request)
    {
        // Obtener los datos del formulario de solicitud AJAX
        $selectedCategoryId = $request->input('category');

       
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
                $subquery->where('category_id', $selectedCategoryId)->where('amount','>','0');
            });
        }

        // Obtener los registros de inventario aplicando todos los filtros
        $inventory = $query->get();

        // Devolver solo la vista parcial en lugar de la vista completa
        return view('agrocefa::inventory.InventoryPartial', [
            'inventory' => $inventory,
        ]);
    }

    private function getNextVoucherNumber()
    {
        // Obtén el número de consecutive de tu tipo de movimiento
        $consecutive = MovementType::where('name', 'Movimiento Interno')->value('consecutive');

        // Obtén el último número de voucher registrado en la tabla 'movements'
        $lastVoucherNumber = Movement::max('voucher_number');

        // Si no hay registros previos, comienza desde el 'consecutive' y 1
        if (is_null($lastVoucherNumber)) {
            $nextVoucherNumber = $consecutive . '1';
        } else {
            // Extrae el número de voucher sin el 'consecutive'
            $lastVoucherNumberWithoutConsecutive = substr($lastVoucherNumber, strlen($consecutive));

            // Incrementa el número sin el 'consecutive' en uno
            $nextVoucherNumberWithoutConsecutive = intval($lastVoucherNumberWithoutConsecutive) + 1;

            // Combina el 'consecutive' con el nuevo número de voucher
            $nextVoucherNumber = $consecutive . $nextVoucherNumberWithoutConsecutive;
        }
        return $nextVoucherNumber;
    }

    public function movementlow(Request $request, $id)
    {

        // Obtener el ID de la unidad productiva seleccionada (asumiendo que lo tienes en sesión)
        $selectedUnitId = Session::get('selectedUnitId');

        // Obtener para Tipo de Movimiento
        $movementType = MovementType::select('id', 'consecutive')->where('name', '=', 'Baja')->first();

        $datenow = Carbon::now();

        $user = Auth::user();
            if ($user->person) {
                $people = $user->person->id;
            }

        $observation = $request->input('observation');
        

        $elements = Inventory::with('element','productive_unit_warehouse.warehouse')->where('id',$id)->get();


        // Inicializa un arreglo para almacenar los datos de los productos
        $productsData = [];

        // Inicializa el precio total en 0
        $totalPrice = 0;

            // Inicia una transacción de base de datos
            DB::beginTransaction();

            try {
                $movementId = null;

                
                // Generar el voucher como consecutivo simple sin ceros adicionales
                $voucher = $this->getNextVoucherNumber();
                
                // Registra un solo movimiento con el precio total calculado
                $movement = new Movement([
                    'registration_date' => $datenow,
                    'movement_type_id' => $movementType->id,
                    'voucher_number' => $voucher,
                    'price' => $totalPrice,
                    'observation' => $observation,
                    'state' => 'Aprobado',
                    ]);
        
                $movement->save();
                $movementId = $movement->id;
                
                // Procesar cada elemento
                foreach ($elements as $item) {

                    $productiveWarehousereceiveId = $item->productive_unit_warehouse->id;
                    $warehouseentrance = $item->productive_unit_warehouse->warehouse_id;
                    $productElementId = $item->element_id;
                    $amount = $item->amount;
                    $convertion = $item->element->measurement_unit->conversion_factor;
                    $lot = $item->lot_number;
                    $price = $item->price;


                    // Buscar si el elemento ya existe en 'inventories' de la unidad que entrega
                    $existingInventory = Inventory::where([
                        'productive_unit_warehouse_id' => $productiveWarehousereceiveId,
                        'element_id' => $productElementId,
                        'lot_number' => $lot,
                        
                    ])->first();
                    
                    
                    $existingInventory->amount -= $amount;
                    $existingInventory->save();
                    $existingInventoryId = $existingInventory->id;
                        
                    $amountconvertion = $amount / $convertion;
                     // Calcula el precio total para este elemento y agrégalo al precio total general
                    $totalPrice += ($amountconvertion * $price);
                    
                    
                    // Registrar detalle del movimiento para cada elemento
                    $movement_details = new MovementDetail([
                        'movement_id' => $movementId, // Asociar al movimiento actual
                        'inventory_id' => $existingInventoryId, // Asociar al inventario actual
                        'amount' => $amount, // Cantidad del elemento actual
                        'price' => $price, // Precio del elemento actual
                    ]);

                    $movement_details->save();
                }


                // Actualiza el precio total en el movimiento principal
                $movement->price = $totalPrice;
                $movement->save();
                

                // Registrar las bodegas y rol del movimiento
                $warehouse_movement_entrega = new WarehouseMovement([
                    'productive_unit_warehouse_id' => $productiveWarehousereceiveId,
                    'movement_id' => $movementId,
                    'role' => 'Entrega', 
                ]);

                $warehouse_movement_entrega->save();

                // Registrar el responsable del movimiento
                $movement_responsabilities = new MovementResponsibility([
                    'person_id' => $people, // Usar la variable $person_id
                    'movement_id' => $movementId,
                    'role' => 'REGISTRO',
                    'date' => $datenow,
                ]);

                $movement_responsabilities->save();

                // Registra datos en otras tablas utilizando $inventoryIds y otros valores (si es necesario)

                // Si todo está correcto, realiza un commit de la transacción
                DB::commit();

                // Después de realizar la operación de registro con éxito
                return redirect()->route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.low')->with('success', 'Baja Registrada');

            } catch (\Exception $e) {
                // En caso de error, realiza un rollback de la transacción y maneja el error
                DB::rollBack();

                \Log::error('Error en el registro: ' . $e->getMessage());
            }

    }

    public function showWarehouseFilterStock(Request $request)
    {
        // Obtener los datos del formulario de solicitud AJAX
        $filtre = $request->input('filtre');
        // Obtener el ID de la unidad productiva seleccionada (asumiendo que lo tienes en sesión)
        $selectedUnitId = Session::get('selectedUnitId');

        // Inicializar la consulta de inventario
        $query = Inventory::query();

        // Obtener los registros de 'productive_unit_warehouses' que coinciden con la unidad productiva seleccionada
        $unitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->pluck('id');

        // Aplicar filtro por unidad productiva
        $query->whereIn('productive_unit_warehouse_id', $unitWarehouses)->where('amount','>','0');

        if ($filtre === 'Stock') {
            // Si se seleccionó una categoría, aplicar el filtro por categoría y ajustar la cantidad según el factor de conversión
            $query->whereHas('element', function ($subquery) {
                $subquery->selectRaw('stock / measurement_units.conversion_factor as measurement_unit_adjusted_stock')
                        ->join('measurement_units', 'elements.measurement_unit_id', '=', 'measurement_units.id')
                        ->whereRaw('stock > amount / measurement_units.conversion_factor')
                        ->whereNull('elements.deleted_at');
            });
        }

        // Obtener los registros de inventario aplicando todos los filtros
        $inventory = $query->get();

        // Devolver solo la vista parcial en lugar de la vista completa
        return view('agrocefa::inventory.InventoryPartial', [
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
