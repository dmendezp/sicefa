<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Http\Controllers\AGROCEFAController;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Responsibility;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\WarehouseMovement;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\Role;
use App\Models\User;


class MovementController extends Controller
{
    private $selectedUnitId;
    private $pivotId;
    private $pivotReceiveId;

    public function viewmovements()
    {
        return view('agrocefa::movements.index');
    }

    public function requestentrance()
    {   
        // Instancio del controlador AGROCEFA
        $agrocefaController = new AGROCEFAController();
        // Llamar la funcion para actualizar las notificaciones de Movimientos
        $result = $agrocefaController->notificationmovement();
        // Llamar la funcion para actualizar las notificaciones de stock
        $result = $agrocefaController->notificationstock();

        // Obtén el ID de la unidad productiva seleccionada de la sesión
        $this->selectedUnitId = Session::get('selectedUnitId');

        $selectedUnit = ProductiveUnit::find($this->selectedUnitId);

        // Inicializa un array para almacenar la información de las bodegas
        $warehouseData = [];

        // Verifica si hay registros en la tabla productive_unit_warehouses para esta unidad
        if ($selectedUnit) {
            $warehouses = $selectedUnit->productive_unit_warehouses;

            // Mapea las bodegas y agrega su información al array
            $warehouseData = $warehouses->map(function ($warehouseRelation) {
                $warehouse = $warehouseRelation->warehouse;
                return [
                    'id' => $warehouse->id,
                    'name' => $warehouse->name,
                ];
            });
        }

        $warehousereceive = $warehouseData->first()['id'];

        $receiveproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id', $warehousereceive)->where('productive_unit_id', $this->selectedUnitId)->first();
        $productiveWarehousereceiveId = $receiveproductive_warehouse->id;

        Session::put('productiveunitwarehouseid',$productiveWarehousereceiveId);
    

        $warehousemovementid = WarehouseMovement::where('productive_unit_warehouse_id', $productiveWarehousereceiveId)->where('role', '=', 'Recibe')->get()->pluck('movement_id');
        
        $movements = Movement::whereIn('id', $warehousemovementid)->where('state','=','Solicitado')->with('movement_type', 'movement_responsibilities.person', 'movement_details.inventory.element', 'warehouse_movements.productive_unit_warehouse.productive_unit', 'warehouse_movements.productive_unit_warehouse.warehouse')->get()->toArray();
        $datas = [];

        

        foreach ($movements as $movement) {
            $id = $movement['id'];
            $date = $movement['registration_date'];
            $person_id = $movement['movement_responsibilities'][0]['person_id'];
            $respnsibility = $movement['movement_responsibilities'][0]['person']['first_name'];
            $productiveunit = $movement['warehouse_movements'][0]['productive_unit_warehouse']['productive_unit']['name'];
            $warehouse = $movement['warehouse_movements'][0]['productive_unit_warehouse']['warehouse']['name'];
            
            
            // Verificar si hay elementos en movement_details
            if (isset($movement['movement_details']) && is_array($movement['movement_details']) && count($movement['movement_details']) > 0) {
                // Iterar a través de los elementos en movement_details
                foreach ($movement['movement_details'] as $detail) {
                    $inventory = $detail['inventory']['element']['name'];
                    $destination = $detail['inventory']['destination'];
                    $elementid = $detail['inventory']['element_id'];
                    $inventoryId = $detail['inventory_id'];
                    $amount = $detail['amount'];
                    $price = $detail['price'];
                    $state = $movement['state'];
                    $lot = $detail['inventory']['lot_number'];

                    // Agregar información al array asociativo
                    $datas[] = [
                        'id' => $id,
                        'date' => $date,
                        'respnsibility' => $respnsibility,
                        'productiveunit' => $productiveunit,
                        'warehouse' => $warehouse,
                        'inventory' => $inventory,
                        'amount' => $amount,
                        'state' => $state,
                        'price' => $price,
                        'inventory_id' => $inventoryId,
                        'element_id' => $elementid,
                        'destination' => $destination,
                        'person_id' => $person_id,
                        'lot' => $lot,
                        // Agrega aquí otros datos que necesites
                    ];
                }
            } else {
                // Si no hay elementos en movement_details, puedes agregar un valor predeterminado o manejarlo de otra manera según tu lógica.
            }
        }
            $movementsCount = count($datas); // Contar la cantidad de movimientos

        if ($movementsCount === 0) {
            $movementsCount = 0;
            Session::put('notification', $movementsCount);
            // No hay movimientos pendientes, muestra la vista con una tabla vacía
            return view('agrocefa::movements.requestentrance', ['datas' => $datas]);
        } else {
            // Hay movimientos pendientes, establece la notificación y muestra la vista con la tabla
            Session::put('notification', $movementsCount);
            return view('agrocefa::movements.requestentrance', ['datas' => $datas, 'notification' => $movementsCount]);
        }
    }
    public function viewmovementslist()
    {
        // Instancio del controlador AGROCEFA
        $agrocefaController = new AGROCEFAController();
        // Llamar la funcion para actualizar las notificaciones de Movimientos
        $result = $agrocefaController->notificationmovement();
        // Llamar la funcion para actualizar las notificaciones de stock
        $result = $agrocefaController->notificationstock();
        // Obtén el ID de la unidad productiva seleccionada de la sesión
        $this->selectedUnitId = Session::get('selectedUnitId');

        $selectedUnit = ProductiveUnit::find($this->selectedUnitId);

        // Inicializa un array para almacenar la información de las bodegas
        $warehouseData = [];

        // Verifica si hay registros en la tabla productive_unit_warehouses para esta unidad
        if ($selectedUnit) {
            $warehouses = $selectedUnit->productive_unit_warehouses;

            // Mapea las bodegas y agrega su información al array
            $warehouseData = $warehouses->map(function ($warehouseRelation) {
                $warehouse = $warehouseRelation->warehouse;
                return [
                    'id' => $warehouse->id,
                    'name' => $warehouse->name,
                ];
            });
        }

        $warehousereceive = $warehouseData->first()['id'];

        $receiveproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id', $warehousereceive)->where('productive_unit_id', $this->selectedUnitId)->first();
        $productiveWarehousereceiveId = $receiveproductive_warehouse->id;

        Session::put('productiveunitwarehouseid',$productiveWarehousereceiveId);
    

        $warehousemovementid = WarehouseMovement::where('productive_unit_warehouse_id', $this->selectedUnitId)->get()->pluck('movement_id');
        
        $movements = Movement::whereIn('id', $warehousemovementid)->with('movement_type', 'movement_responsibilities.person', 'movement_details.inventory.element', 'warehouse_movements.productive_unit_warehouse.productive_unit', 'warehouse_movements.productive_unit_warehouse.warehouse')->get()->toArray();
        $datas = [];

        foreach ($movements as $movement) {
            $id = $movement['id'];
            $date = $movement['registration_date'];
            $person_id = $movement['movement_responsibilities'][0]['person_id'];
            $movement_type = $movement['movement_type']['name'];
            $respnsibility = $movement['movement_responsibilities'][0]['person']['first_name'];
            $productiveunit = $movement['warehouse_movements'][0]['productive_unit_warehouse']['productive_unit']['name'];
            $warehouse = $movement['warehouse_movements'][0]['productive_unit_warehouse']['warehouse']['name'];
            $pricetotal = $movement['price'];
            
            
            // Verificar si hay elementos en movement_details
            if (isset($movement['movement_details']) && is_array($movement['movement_details']) && count($movement['movement_details']) > 0) {
                // Iterar a través de los elementos en movement_details
                foreach ($movement['movement_details'] as $detail) {
                    $inventory = $detail['inventory']['element']['name'];
                    $destination = $detail['inventory']['destination'];
                    $elementid = $detail['inventory']['element_id'];
                    $inventoryId = $detail['inventory_id'];
                    $amount = $detail['amount'];
                    $price = $detail['price'];
                    $state = $movement['state'];
                    $lot = $detail['inventory']['lot_number'];

                    // Agregar información al array asociativo
                    $datas[] = [
                        'id' => $id,
                        'date' => $date,
                        'respnsibility' => $respnsibility,
                        'productiveunit' => $productiveunit,
                        'warehouse' => $warehouse,
                        'inventory' => $inventory,
                        'amount' => $amount,
                        'price' => $price,
                        'state' => $state,
                        'inventory_id' => $inventoryId,
                        'element_id' => $elementid,
                        'destination' => $destination,
                        'person_id' => $person_id,
                        'lot' => $lot,
                        'movement_type' => $movement_type,
                        'pricetotal' => $pricetotal,
                        // Agrega aquí otros datos que necesites
                    ];
                }
            } else {
                // Si no hay elementos en movement_details, puedes agregar un valor predeterminado o manejarlo de otra manera según tu lógica.
            }
        }
            $movementsCount = count($datas); // Contar la cantidad de movimientos

        if ($movementsCount === 0) {
            $movementsCount = 0;

            // No hay movimientos pendientes, muestra la vista con una tabla vacía
            return view('agrocefa::movements.movementlist', ['datas' => $datas]);
        } else {
            
            return view('agrocefa::movements.movementlist', ['datas' => $datas]);
        }
    }


    public function confirmation(Request $request, $id)
    {
        // Obtener el movimiento que se va a confirmar
        $movement = Movement::with('warehouse_movements')->find($id);
        

        if (!$movement) {
            // Manejar el caso en que el movimiento no se encuentre
            return redirect()->back()->with('error', 'Movimiento no encontrado');
        }

        // Actualizar el estado del movimiento a "aprobado"
        $movement->state = 'Aprobado';
        $movement->save();

        // Obtener los datos enviados desde el formulario
        $personid = $request->input('person_id');
        $lot = $request->input('lot');

        // Iterar a través de los elementos del movimiento
        foreach ($movement->movement_details as $detail) {
            $Id = $detail->inventory->element_id;
            $elementId = $detail->inventory_id;
            $destination = $detail->inventory->destination;
            $amount = $detail->amount;
            $price = $detail->price;
        
            
            // Obtener el inventario existente o crear uno nuevo
            $inventory = Inventory::where([
                'productive_unit_warehouse_id' => $movement->warehouse_movements[1]->productive_unit_warehouse_id,
                'id' => $elementId,
                'lot_number' => $lot,
            ])->first();
            if ($inventory) {
                
                // Obtener el factor de conversión
                $measurement_unit = $inventory->element->measurement_unit->conversion_factor;
                // Calcular la cantidad ajustada utilizando el factor de conversión
                $adjustedAmount = $amount * $measurement_unit;
                // Actualizar el inventario existente
                $inventory->amount += $adjustedAmount;
                $inventory->price = $price; // Puedes actualizar el precio si es necesario
                $inventory->save();
            } else {
                $elememt = Element::where([
                    'id' => $Id,
                ])->first();
                
                // Si el elemento no existe, crea un nuevo registro en 'inventories'
                $measurement_unit = $elememt->measurement_unit->conversion_factor;
                
                // Calcular la cantidad ajustada utilizando el factor de conversión
                $adjustedAmount = $amount * $measurement_unit;
                // Crear un nuevo registro de inventario
                $inventory = new Inventory([
                    'person_id' => $personid,
                    'productive_unit_warehouse_id' => $movement->warehouse_movements[1]->productive_unit_warehouse_id,
                    'element_id' => $Id,
                    'destination' => $destination,
                    'price' => $price,
                    'amount' => $adjustedAmount,
                    'stock' => 3,
                    'lot_number' => $lot,
                ]);

                $inventory->save();
            }
            $inventoryexist = Inventory::where([
                'productive_unit_warehouse_id' => $movement->warehouse_movements[0]->productive_unit_warehouse_id,
                'id' => $elementId,
                'lot_number' => $lot,
            ])->first();    

            if ($inventoryexist) {
                // Si el elemento existe, actualiza el precio y la cantidad
                // Obtener el factor de conversión
                $measurement_unit = $inventoryexist->element->measurement_unit->conversion_factor;
                // Calcular la cantidad ajustada utilizando el factor de conversión
                $adjustedAmount = $amount * $measurement_unit;
                // Actualizar el precio y la cantidad en la existencia existente
                // Actualizar el inventario existente
                $inventoryexist->amount -= $adjustedAmount;
                $inventoryexist->save();
            }

        }

        // Redirigir de nuevo a la vista con un mensaje de éxito
        return redirect()->back()->with('success', 'Movimiento Confirmado');
    }

    public function returnMovement(Request $request, $id)
    {
        // Obtener el movimiento que se va a devolver
        $movement = Movement::find($id);

        if (!$movement) {
            // Manejar el caso en que el movimiento no se encuentre
            return redirect()->back()->with('error', 'Movimiento no encontrado');
        }

        // Verificar que se ha proporcionado una descripción de la devolución
        $request->validate([
            'return_description' => 'required',
        ]);

        // Cambiar el estado del movimiento a "Devuelto" y agregar la descripción
        $movement->state = 'Devuelto';
        $movement->observation = $request->input('return_description');
        $movement->save();

        // Redirigir de nuevo a la vista con un mensaje de éxito
        return redirect()->back()->with('error', 'Movimiento Devuelto');
    }

    
    public function formentrance()
    {

        // Instancio del controlador AGROCEFA
        $agrocefaController = new AGROCEFAController();
        // Llamar la funcion para actualizar las notificaciones de Movimientos
        $result = $agrocefaController->notificationmovement();
        // Llamar la funcion para actualizar las notificaciones de stock
        $result = $agrocefaController->notificationstock();
        // Fecha actual
        $date = Carbon::now();


        // Obtén el ID de la unidad productiva seleccionada de la sesión
         $this->selectedUnitId= Session::get('selectedUnitId');
        

        // ---------------- Filtro para responsable -----------------------
        
            $user = Auth::user();
            if ($user->person) {
                $people = [$user->person->id => $user->person->first_name];
            }
            // ---------------- Filtro para Bodega de Entrega -----------------------
            $wer = 'Almacen Sena';

            // Realiza una consulta para obtener las unidades productivas relacionadas con 'Almacen' y sus IDs en la tabla pivote
            $units = ProductiveUnit::whereHas('productive_unit_warehouses', function ($query) use ($wer) {
                $query->where('name', $wer);
            })->with(['productive_unit_warehouses:id,productive_unit_id,warehouse_id'])->get();

            
            // Ahora, puedes obtener los IDs y nombres de las bodegas relacionadas con las unidades productivas
            $werhousentrance = $units->flatMap(function ($unit) {
                return $unit->productive_unit_warehouses->map(function ($relation) {
                    return [
                        'id' => $relation->warehouse_id,
                        'name' => $relation->warehouse->name,
                    ];
                });
            });
            
            if (!$werhousentrance->isEmpty()) {
                // Obtén el primer ID de la tabla pivote, o cualquier otro que desees enviar
                    $this->pivotId = $werhousentrance->first()['id'];

                    Session::put('pivotId', $this->pivotId);
                    

                    // ---------------- Filtro para Bodega de Recibe -----------------------
                    // Intenta encontrar la unidad productiva por su ID y verifica si se encuentra
                    $selectedUnit = ProductiveUnit::find($this->selectedUnitId);


                    // Inicializa un array para almacenar la información de las bodegas
                    $warehouseData = [];

                    // Verifica si hay registros en la tabla productive_unit_warehouses para esta unidad
                    if ($selectedUnit) {
                        $warehouses = $selectedUnit->productive_unit_warehouses;

                        // Mapea las bodegas y agrega su información al array
                        $warehouseData = $warehouses->map(function ($warehouseRelation) {
                            $warehouse = $warehouseRelation->warehouse;
                            return [
                                'id' => $warehouse->id,
                                'name' => $warehouse->name,
                            ];
                        }); 
                    }


                    
                    // ---------------- Filtro para Elementos -----------------------
                    // Obtén los elementos con sus IDs
                    $elements = Element::select('id', 'name')->get();

                // ---------------- Retorno a vista y funciones -----------------------

                return view('agrocefa::movements.formentrance', [
                    'people' => $people,
                    'date' => $date,
                    'werhousentrance' => $werhousentrance,
                    'warehouseData' => $warehouseData,
                    'elements' => $elements,
                ]);
            } else {
                return redirect()->back()->withInput()->with('error', 'No se encuentra la unidad de almacen con su bodega asociada');
            }

            
    }


    public function registerentrance(Request $request)
    {
        // Obtener para Tipo de Movimiento
        $movementType = MovementType::select('id', 'consecutive')->where('name', '=', 'Movimiento Entrada')->first();

        // Obtener los datos del formulario
        $date = $request->input('date');
        $observation = $request->input('observation');                                                                                                                                                                                                                                                                                                                                                             
        $user_id = $request->input('user_id');
        $deliverywarehouse = $request->input('deliverywarehouse');
        $receivewarehouse = $request->input('receivewarehouse');

        $receiveproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id', $receivewarehouse)->first();
        $productiveWarehousereceiveId = $receiveproductive_warehouse->id;

        $productiveexterna = ProductiveUnit::where('name','=','Almacen Sena')->get()->pluck('id');
        
        $deliveryproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id', $deliverywarehouse)->where('productive_unit_id',$productiveexterna)->first();
        $productiveWarehousedeliveryId = $deliveryproductive_warehouse->id;
        
        // Obtén los datos de los campos de la tabla con llaves [ ]
        $productElementIds = $request->input('product-id');
        $productNames = $request->input('product-name');
        $productQuantities = $request->input('product-quantity');
        $productPrices = $request->input('product-price');
        $productDestinations = $request->input('product-destination');
        $productEntries = $request->input('product-entry');
        $productExpirations = $request->input('product-expiration');
        $productLots = $request->input('product-lot');
        $productStocks = $request->input('product-stock');


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
                    'registration_date' => $date,
                    'movement_type_id' => $movementType->id,
                    'voucher_number' => $voucher,
                    'price' => $totalPrice,
                    'observation' => $observation,
                    'state' => 'Aprobado',
                    ]);
        
                $movement->save();
                $movementId = $movement->id;

                
                
                // Procesar cada elemento
                foreach ($productElementIds as $index => $productElementId) {
                    // Accede a los datos de cada elemento de la tabla
                    
                    $quantity = $productQuantities[$index];
                    $price = $productPrices[$index];
                    $destination = $productDestinations[$index];
                    $expiration_date = $productExpirations[$index];
                    $production_date = $productEntries[$index];
                    $lot = $productLots[$index];
                    $stock = $productStocks[$index];
                    
                    
                
                    // Buscar si el elemento ya existe en 'inventories' de la unidad que entrega
                    $existingInventory = Inventory::where([
                        'productive_unit_warehouse_id' => $productiveWarehousereceiveId,
                        'element_id' => $productElementId,
                        'lot_number' => $lot,
                        
                    ])->first();
                    
     

                    if ($existingInventory) {
                        
                        // Si el elemento existe, actualiza el precio y la cantidad
                        // Obtener el factor de conversión
                        $measurement_unit = $existingInventory->element->measurement_unit->conversion_factor;
                        // Calcular la cantidad ajustada utilizando el factor de conversión
                        $adjustedAmount = $quantity * $measurement_unit;
                        // Actualizar el precio y la cantidad en la existencia existente
                        $existingInventory->amount += $adjustedAmount;
                        $existingInventory->price = $price;
                        $existingInventory->save();
                        $existingInventoryId = $existingInventory->id;
                        
                    } else {
                        $elememt = Element::where([
                            'id' => $productElementId,
                        ])->first();
                        
                        // Si el elemento no existe, crea un nuevo registro en 'inventories'
                        $measurement_unit = $elememt->measurement_unit->conversion_factor;
                        
                        // Calcular la cantidad ajustada utilizando el factor de conversión
                        $adjustedAmount = $quantity * $measurement_unit;

                        $newInventory = new Inventory([
                            'person_id' => $user_id,
                            'productive_unit_warehouse_id' => $productiveWarehousereceiveId,
                            'element_id' => $productElementId,
                            'destination' => $destination,
                            'price' => $price,
                            'amount' => $adjustedAmount,
                            'stock' => $stock,
                            'lot_number' => $lot ?: null,
                            'expiration_date' => $expiration_date ?: null,
                            'production_date' => $production_date ?: null,
                        ]);

                        $newInventory->save();
                        $existingInventoryId = $newInventory->id;
                        
                    }

                     // Calcula el precio total para este elemento y agrégalo al precio total general
                    $totalPrice += ($quantity * $price);
                    
                    
                    // Registrar detalle del movimiento para cada elemento
                    $movement_details = new MovementDetail([
                        'movement_id' => $movementId, // Asociar al movimiento actual
                        'inventory_id' => $existingInventoryId, // Asociar al inventario actual
                        'amount' => $adjustedAmount, // Cantidad del elemento actual
                        'price' => $price, // Precio del elemento actual
                    ]);

                    $movement_details->save();
                }

                // Actualiza el precio total en el movimiento principal
                $movement->price = $totalPrice;
                $movement->save();
                

                // Registrar las bodegas y rol del movimiento
                $warehouse_movement_entrega = new WarehouseMovement([
                    'productive_unit_warehouse_id' => $productiveWarehousedeliveryId,
                    'movement_id' => $movementId,
                    'role' => 'Entrega', 
                ]);

                $warehouse_movement_recibe = new WarehouseMovement([
                    'productive_unit_warehouse_id' => $productiveWarehousereceiveId,
                    'movement_id' => $movementId,
                    'role' => 'Recibe', 
                ]);

                $warehouse_movement_entrega->save();
                $warehouse_movement_recibe->save();

                // Registrar el responsable del movimiento
                $movement_responsabilities = new MovementResponsibility([
                    'person_id' => $user_id, // Usar la variable $person_id
                    'movement_id' => $movementId,
                    'role' => 'REGISTRO',
                    'date' => $date,
                ]);

                $movement_responsabilities->save();

                // Registra datos en otras tablas utilizando $inventoryIds y otros valores (si es necesario)

                // Si todo está correcto, realiza un commit de la transacción
                DB::commit();

                // Después de realizar la operación de registro con éxito
                return redirect()->route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.movements.entry.index')->with('success', 'Movimiento Registrado');

            } catch (\Exception $e) {
                // En caso de error, realiza un rollback de la transacción y maneja el error
                DB::rollBack();

                \Log::error('Error en el registro: ' . $e->getMessage());
            }

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


    public function obtenerDatosElemento(Request $request)
    {
        try {
            $elementId = $request->input('element');
            
            // Realiza la lógica para obtener los datos del elemento en una sola consulta
            $elementData = Element::whereHas('inventories', function ($query) use ($elementId) {
                    $query->where('id', $elementId);
                })->with(['measurement_unit', 'category'])
                ->first();
            
            if ($elementData) {
                $unidadMedida = $elementData->measurement_unit->name;
                $categoria = $elementData->category->name;
                $name = $elementData->name;


                return response()->json([
                    'unidad_medida' => $unidadMedida,
                    'categoria' => $categoria,
                    'name' => $name,

                ]);
            } else {
                return response()->json(['error' => 'Elemento no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }


    public function getprice(Request $request)
    {
        try {
            $elementId = $request->input('element');
            
            // Realiza la lógica para obtener los datos del elemento en una sola consulta
            $dataelement = Inventory::where('id', $elementId)->where('amount','>',0)->first();
            
            if ($dataelement) {
                $measurement_unit = $dataelement->element->measurement_unit->conversion_factor;
                $destination = $dataelement->destination;
                $price = $dataelement->price;
                $amount = $dataelement->amount / $measurement_unit;
                $lote = $dataelement->lot_number;
                $stock = $dataelement->stock;

                return response()->json([
                    'price' => $price,
                    'amount' => $amount,
                    'destination' => $destination,
                    'lote' => $lote,
                    'stock' => $stock,

                ]);
            } else {
                return response()->json(['error' => 'Precio no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }


    public function obtenerwarehouse(Request $request)
    {
        try {
            $productUnitId = $request->input('unit');

            $responsibility = ProductiveUnit::with('person')->where('id', $productUnitId)->first();

            if ($responsibility) {
                $people = [
                    'person_id' => $responsibility->person_id,
                    'first_name' => $responsibility->person->first_name,
                ];

                // Guarda el responsable en la sesión
                Session::put('responsibilityreceive', $people);
            }

            // Obtener las IDs de las bodegas relacionadas con la unidad productiva seleccionada
            $warehouseIds = ProductiveUnitWarehouse::where('productive_unit_id', $productUnitId)->pluck('warehouse_id');

            // Consulta las bodegas correspondientes a las IDs obtenidas
            $warehouses = Warehouse::whereIn('id', $warehouseIds)->pluck('name', 'id');

            // Combinar la información del responsable y las bodegas en un solo arreglo
            $response = [
                'responsibility' => $people ?? null,
                'warehouses' => $warehouses->toArray(),
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }


    public function obtenerelement(Request $request) 
    {
        try {
            $warehouseId = $request->input('warehouse');
            
            // Obtener las IDs de las bodegas relacionadas con la unidad productiva seleccionada
            $warehouseIds = ProductiveUnitWarehouse::where('warehouse_id', $warehouseId)->where('productive_unit_id', Session::get('selectedUnitId'))->pluck('id');

            // Registrar un mensaje de información con los IDs de las bodegas
            \Log::info('Bodega IDs:', $warehouseIds->toArray());

            // Obtener los elementos de las bodegas
            $inventory = Inventory::whereIn('productive_unit_warehouse_id', $warehouseIds)->where('amount','>',0)->get();

            if ($inventory) {
                // Mapear los datos para incluir ID y nombre del elemento
                $elementsData = $inventory->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'element_id' => $item->element->id,
                        'name' => $item->element->name,
                        'price' => $item->price,
                        'amount' => $item->amount,
                        'stock' => $item->stock,
                        // Agrega otros atributos relacionados con el elemento si es necesario
                    ];
                });

                // Devuelve la respuesta JSON con los IDs y nombres de los elementos
                return response()->json($elementsData);
            } else {
                // Registra un mensaje de error
                \Log::error('Elemento no encontrado');

                return response()->json(['error' => 'Elemento no encontrado'], 404);
            }
        } catch (\Exception $e) {
            // Registra un mensaje de error interno del servidor
            \Log::error('Error interno del servidor: ' . $e->getMessage());

            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }



    public function formexit()
    {

        // Instancio del controlador AGROCEFA
        $agrocefaController = new AGROCEFAController();
        // Llamar la funcion para actualizar las notificaciones de Movimientos
        $result = $agrocefaController->notificationmovement();
        // Llamar la funcion para actualizar las notificaciones de stock
        $result = $agrocefaController->notificationstock();

        // Fecha actual
        $date = Carbon::now();


        // Obtén el ID de la unidad productiva seleccionada de la sesión
         $this->selectedUnitId= Session::get('selectedUnitId');
        

        // ---------------- Filtro para Bodega de Entrega -----------------------

        // Intenta encontrar la unidad productiva por su ID y verifica si se encuentra
        $selectedUnit = ProductiveUnit::find($this->selectedUnitId);


        // Inicializa un array para almacenar la información de las bodegas
        $warehouseData = [];

        // Verifica si hay registros en la tabla productive_unit_warehouses para esta unidad
        if ($selectedUnit) {
            $warehouses = $selectedUnit->productive_unit_warehouses;

            // Mapea las bodegas y agrega su información al array
            $warehouseData = $warehouses->map(function ($warehouseRelation) {
                $warehouse = $warehouseRelation->warehouse;
                return [
                    'id' => $warehouse->id,
                    'name' => $warehouse->name,
                ];
            }); 
        }

        $this->pivotId = $warehouseData->first()['id'];
        Session::put('pivotId', $this->pivotId);



        // ---------------- Filtro para unidades -----------------------
        $productunits = ProductiveUnit::all();
    

        // ---------------- Filtro para Elementos -----------------------
        $elements = Element::select('id', 'name')->get();


        // ---------------- Retorno a vista y funciones -----------------------

        return view('agrocefa::movements.formexit', [
            'date' => $date,
            'warehouseData' => $warehouseData,
            'elements' => $elements,
            'productunits' => $productunits,

        ]);
        
    }

    
    public function registerexit(Request $request)
    {
        // Obtén el ID de la unidad productiva seleccionada de la sesión
        $this->selectedUnitId = Session::get('selectedUnitId');

        // Obtener para Tipo de Movimiento
        $movementType = MovementType::select('id', 'consecutive')->where('name', '=', 'Movimiento Interno')->first();

        // Obtener los datos del formulario
        $date = $request->input('date'); // Fecha actual del movimiento
        $observation = $request->input('observation'); // Observacion del movimiento
        $user_id = $request->input('user_id'); // Usuario del movimiento
        $deliverywarehouse = $request->input('deliverywarehouse'); // Bodega que entrega los elementos
        $product_unit = $request->input('product_unit'); // Bodega que entrega los elementos
        $receivewarehouse = $request->input('receivewarehouse'); // Bodega que recibe los elementos

        $responsibility = ProductiveUnit::with('person')->where('id', $product_unit)->first();

        if ($responsibility) {
            $personid = $responsibility->person_id;
            $people = $responsibility->person->first_name;
            $email = $responsibility->person->misena_email;
        }

        $deliveryproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id', $deliverywarehouse)->where('productive_unit_id', $this->selectedUnitId)->first();
        $productiveWarehousedeliveryId = $deliveryproductive_warehouse->id;

        $receiveproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id', $receivewarehouse)->where('productive_unit_id', $product_unit)->first();
        $productiveWarehousereceiveId = $receiveproductive_warehouse->id;
        

        // Obtén los datos de los campos de la tabla con llaves [ ]
        $productIds = $request->input('product-element');
        $productElementIds = $request->input('product-id');
        $productNames = $request->input('product-name');
        $productQuantities = $request->input('product-quantity');
        $productPrices = $request->input('product-price');
        $productDestinations = $request->input('product-destination');
        $productLots = $request->input('product-lot');
        $productStocks = $request->input('product-stock');

        // Inicializa el precio total en 0
        $totalPrice = 0;

        // Inicia una transacción de base de datos
        DB::beginTransaction();

        try {
            $movementId = null; // Declara $movementId antes del bucle

            // Generar el voucher como consecutivo simple sin ceros adicionales
            $voucher = $this->getNextVoucherNumber();

            // Registra un solo movimiento con el precio total calculado
            $movement = new Movement([
                'registration_date' => $date,
                'movement_type_id' => $movementType->id,
                'voucher_number' => $voucher,
                'price' => $totalPrice,
                'observation' => $observation,
                'state' => 'Solicitado',
            ]);

            // Guarda el nuevo registro en la base de datos
            $movement->save();
            $movementId = $movement->id;

            foreach ($productElementIds as $index => $productElementId) {
                // Accede a los datos de cada elemento de la tabla
                $productId = $productIds[$index];
                $name = $productNames[$index];
                $quantity = $productQuantities[$index];
                $price = $productPrices[$index];
                $destination = $productDestinations[$index];
                $lot = $productLots[$index];
                $stock = $productStocks[$index];
               
            
                // Buscar si el elemento ya existe en 'inventories' de la unidad que entrega
                $existingInventory = Inventory::where([
                    'productive_unit_warehouse_id' => $productiveWarehousedeliveryId,
                    'id' => $productElementId,
                    'lot_number' => $lot,
                ])->first();
            
                if ($existingInventory) {
                    if ($quantity > $existingInventory->amount) {
                        // Mostrar un mensaje de error que incluye el nombre del elemento
                        $elementName = $existingInventory->element->name;
                        return redirect()->back()->withInput()->with('error', 'La cantidad solicitada del elemento ' . $elementName . ' es mayor que la cantidad disponible (' . $existingInventory->amount . ').');
                    }
            
                    $existingInventory->save();
                    $existingInventoryId = $existingInventory->id;
                } else {
                    // Si el elemento no existe en el inventario, crea un nuevo registro en 'inventories'
                    $newInventory = new Inventory([
                        'person_id' => $user_id,
                        'productive_unit_warehouse_id' => $productiveWarehousedeliveryId,
                        'element_id' => $productId,
                        'price' => $price,
                        'amount' => $quantity,
                        'stock' => $stock,
                        'lot_number' => $lot ?: null,
                    ]);
            
                    $newInventory->save();
            
                    $existingInventoryId = $newInventory->id;
                }
            
                // Calcula el precio total para este elemento y agrégalo al precio total general
                $totalPrice += ($quantity * $price);
            
                // Registrar detalle del movimiento para cada elemento
                $movementDetails = new MovementDetail([
                    'movement_id' => $movementId, // Asociar al movimiento actual
                    'inventory_id' => $existingInventoryId, // Asociar al inventario actual
                    'amount' => $quantity, // Cantidad del elemento actual
                    'price' => $price, // Precio del elemento actual
                ]);
            
                $movementDetails->save();
            }

            // Actualiza el precio total en el movimiento principal
            $movement->price = $totalPrice;
            $movement->save();

            // Registrar las bodegas y rol del movimiento
            $warehouse_movement_entrega = new WarehouseMovement([
                'productive_unit_warehouse_id' => $productiveWarehousedeliveryId,
                'movement_id' => $movementId, // Usar $movementId en lugar de end($movementIds)
                'role' => 'Entrega',
            ]);

            $warehouse_movement_recibe = new WarehouseMovement([
                'productive_unit_warehouse_id' => $productiveWarehousereceiveId,
                'movement_id' => $movementId, // Usar $movementId en lugar de end($movementIds)
                'role' => 'Recibe',
            ]);

            $warehouse_movement_entrega->save();
            $warehouse_movement_recibe->save();

            // Crear un array con los registros de responsabilidades
            $responsibilitiesData = [
                [
                    'person_id' => $user_id,
                    'movement_id' => $movementId, // Usar $movementId en lugar de end($movementIds)
                    'role' => 'REGISTRO',
                    'date' => $date,
                ],
                [
                    'person_id' => $personid, // Usar la variable $personid
                    'movement_id' => $movementId, // Usar $movementId en lugar de end($movementIds)
                    'role' => 'RECIBE',
                    'date' => $date,
                ],
            ];

            // Insertar los registros en la tabla movement_responsibilities
            MovementResponsibility::insert($responsibilitiesData);
            // Registra datos en otras tablas utilizando $inventoryIds y otros valores (si es necesario)

            // Si todo está correcto, realiza un commit de la transacción
            DB::commit();

            // Después de realizar la operación de registro con éxito
            return redirect()->route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.movements.exit.index')->with('success', 'Movimiento Registrado');

        } catch (\Exception $e) {
            // En caso de error, realiza un rollback de la transacción y maneja el error
            DB::rollBack();
            \Log::error('Error en el registro: ' . $e->getMessage());
            return redirect()->route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.movements.exit.index')->with('error', 'Error');
            
        }
    }

}
