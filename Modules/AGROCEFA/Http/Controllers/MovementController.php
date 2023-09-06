<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
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

    public function formentrance()
    {
        // Fecha actual
        $date = Carbon::now();


        // Obtén el ID de la unidad productiva seleccionada de la sesión
         $this->selectedUnitId= Session::get('selectedUnitId');
        

        // ---------------- Filtro para responsable -----------------------
        
        // Verifica si hay un ID de unidad seleccionada en la sesión
        if ($this->selectedUnitId) {
            // Obtiene todas las actividades asociadas a la unidad productiva seleccionada
            $activities = Activity::where('productive_unit_id', $this->selectedUnitId)->pluck('id');

            // Obtiene el rol de las responsabilidades relacionadas con la actividades
            $responsibilities = Responsibility::whereIn('activity_id', $activities)->pluck('role_id');

            // Obtén los ids de usuarios relacionados con los roles de responsabilidades
            $userIds = Role::whereIn('id', $responsibilities)
                ->with('users:id')
                ->get()
                ->pluck('users')
                ->flatten()
                ->pluck('id')
                ->unique()
                ->toArray();

            $people = User::whereIn('id', $userIds)
                ->with('person:id,first_name,first_last_name')
                ->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'first_name' => $user->person->first_name,
                        'person_id' => $user->person->id,
                        'first_last_name' => $user->person->first_last_name,
                    ];
                });

            Session::put('person_id', $people->first()['person_id']);
            // ---------------- Filtro para Bodega de Entrega -----------------------

            $wer = 'Almacen';

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

            $this->pivotReceiveId = $warehouseData->first()['id'];
            Session::put('pivotReceiveId', $this->pivotReceiveId);


            
            // ---------------- Filtro para Elementos -----------------------
            // Obtén los elementos con sus IDs
            $elements = Element::select('id', 'name')->get();



        }   


        // ---------------- Retorno a vista y funciones -----------------------

        return view('agrocefa::movements.formentrance', [
            'people' => $people,
            'date' => $date,
            'werhousentrance' => $werhousentrance,
            'warehouseData' => $warehouseData,
            'elements' => $elements,
        ]);
    }



    public function registerentrance(Request $request)
    {
    // Obtener para Tipo de Movimiento
    $movementType = MovementType::select('id', 'consecutive')->where('name', '=', 'Movimiento Interno')->first();

    // Obtener los datos del formulario
    $date = $request->input('date');
    $observation = $request->input('observation');
    $user_id = $request->input('user_id');
    $deliverywarehouse = $request->input('deliverywarehouse');
    $receivewarehouse = $request->input('receivewarehouse');
    $products = json_decode($request->input('products'), true);
    $identrance = Session::get('pivotId');
    $idreceive = Session::get('pivotReceiveId');
    $person_id = Session::get('person_id');
    


    // Verificar si $products no es null y es un array
    if (!is_null($products) && is_array($products)) {
        // Inicializa un arreglo para almacenar los datos de los productos
        $productsData = [];

        // Inicializa el precio total en 0
        $totalPrice = 0;

        // Inicia una transacción de base de datos
        DB::beginTransaction();

        try {
            // Procesar cada producto
            foreach ($products as $product) {
                // Obtén los datos necesarios para cada producto
                $productElementId = $product['id'];
                $quantity = $product['product-quantity'];
                $price = $product['product-price'];
                $destination = $product['product-destination'];

                // Suma el precio del producto al precio total
                $totalPrice += $price * $quantity;

                // Buscar si el elemento ya existe en 'inventories' para la ubicación y elemento específicos
                $existingInventory = Inventory::where([
                    'productive_unit_warehouse_id' => $deliverywarehouse,
                    'element_id' => $productElementId,
                    'destination' => $destination,
                ])->first();

                if ($existingInventory) {
                    // Si el elemento existe, actualiza el precio y la cantidad
                    $existingInventory->price = $price;
                    $existingInventory->amount += $quantity;
                    $existingInventory->save();
                } else {
                    // Si el elemento no existe, crea un nuevo registro en 'inventories'
                    $stock = 3; // Este valor puede cambiar según tus requisitos

                    $inventory = new Inventory([
                        'person_id' => $person_id,
                        'productive_unit_warehouse_id' => $idreceive,
                        'element_id' => $productElementId,
                        'destination' => $destination,
                        'price' => $price,
                        'amount' => $quantity,
                        'stock' => $stock,
                    ]);

                    $inventory->save();
                    $inventoryIds[] = $inventory->id;
                }


                // Agrega los datos del producto al arreglo
                $productsData[] = [
                    'element_id' => $productElementId,
                    'quantity' => $quantity,
                    'price' => $price,
                    'destination' => $destination,
                ];
            

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
            $movementIds[] = $movement->id;

            
            // Registrar las bodegas y rol del movimiento
            $warehouse_movement_entrega = new WarehouseMovement([
                'productive_unit_warehouse_id' => $identrance,
                'movement_id' => end($movementIds),
                'role' => 'Entrega', 
            ]);
            
            $warehouse_movement_recibe = new WarehouseMovement([
                'productive_unit_warehouse_id' => $idreceive,
                'movement_id' => end($movementIds),
                'role' => 'Recibe', 
            ]);
            
            $warehouse_movement_entrega->save();
            $warehouse_movement_recibe->save();


            // Registrar el responsable del movimiento
            $movement_responsabilities = new MovementResponsibility([
                'person_id' => $person_id,
                'movement_id' => end($movementIds),
                'role' => 'REGISTRO',
                'date' => $date,
            ]);

            $movement_responsabilities->save();

            // Registrar detalle del movimiento
            $movement_details = new MovementDetail([
                'movement_id' => end($movementIds),
                'inventory_id' => end($inventoryIds),
                'amount' => $quantity,
                'price' => $price,
            ]);

            $movement_details->save();

        }

            // Registra datos en otras tablas utilizando $inventoryIds y otros valores (si es necesario)

            // Si todo está correcto, realiza un commit de la transacción
            DB::commit();

            // Después de realizar la operación de registro con éxito
            return redirect()->route('agrocefa.formentrance')->with('success', 'El registro se ha completado con éxito.');

        } catch (\Exception $e) {
            // En caso de error, realiza un rollback de la transacción y maneja el error
            DB::rollBack();

            \Log::error('Error en el registro: ' . $e->getMessage());
        }
    } else {
        // Manejo de caso en el que $products es null o no es un array
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





    public function obtenerUnidadDeMedida(Request $request) 
    {
        try {
            $element = $request->input('element');
            
            // Realiza la lógica para obtener la unidad de medida del elemento
            $unidadMedida = Element::with('measurement_unit')
                ->where('id', $element) // Filtra por el nombre del elemento específico
                ->first(); // Obtén el primer resultado
            
            if ($unidadMedida) {
                $unidadMedidaNombre = $unidadMedida->measurement_unit->name;
                return response()->json(['unidad_medida' => $unidadMedidaNombre]);
            } else {
                return response()->json(['error' => 'Elemento no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }


    public function obtenercategotria(Request $request) 
    {
        try {
            $element = $request->input('element');
            
            // Realiza la lógica para obtener la unidad de medida del elemento
            $category = Element::with('category')
                ->where('id', $element) // Filtra por el nombre del elemento específico
                ->first(); // Obtén el primer resultado
            
            if ($category) {
                $categoria = $category->category->name;
                return response()->json(['categoria' => $categoria]);
            } else {
                return response()->json(['error' => 'Elemento no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function formexit()
    {
               // Fecha actual
        $date = Carbon::now();


        // Obtén el ID de la unidad productiva seleccionada de la sesión
         $this->selectedUnitId= Session::get('selectedUnitId');

        // ---------------- Filtro para responsable -----------------------

        // Verifica si hay un ID de unidad seleccionada en la sesión
        if ($this->selectedUnitId) {
            // Obtiene todas las actividades asociadas a la unidad productiva seleccionada
            $activities = Activity::where('productive_unit_id', $this->selectedUnitId)->pluck('id');

            // Obtiene el rol de las responsabilidades relacionadas con la actividades
            $responsibilities = Responsibility::whereIn('activity_id', $activities)->pluck('role_id');

            // Obtén los ids de usuarios relacionados con los roles de responsabilidades
            $userIds = Role::whereIn('id', $responsibilities)
                ->with('users:id')
                ->get()
                ->pluck('users')
                ->flatten()
                ->pluck('id')
                ->unique()
                ->toArray();

            $people = User::whereIn('id', $userIds)
                ->with('person:id,first_name,first_last_name')
                ->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'first_name' => $user->person->first_name,
                        'first_last_name' => $user->person->first_last_name,
                    ];
                });


            // ---------------- Filtro para Bodega de Entrega -----------------------

            $wer = 'Almacen';
            // Realiza una consulta para obtener las unidades productivas relacionadas con 'Almacen'
            $units = ProductiveUnit::whereHas('productive_unit_warehouses', function ($query) use ($wer) {
                $query->where('name', $wer);
            })->get();
            
            // Ahora, puedes obtener los IDs y nombres de las bodegas relacionadas con las unidades productivas
            $werhousentrance = $units->flatMap(function ($unit) {
                return $unit->productive_unit_warehouses->map(function ($relation) {
                    return [
                        'id' => $relation->warehouse_id,
                        'name' => $relation->warehouse->name,
                    ];
                });
            });

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
            $elements = Element::with('measurement_unit')
            ->get()
            ->map(function ($element) {
                return [
                    'id' => $element->id,
                    'measurement_unit' => $element->measurement_unit->name
                ];
            })
            ->groupBy('measurement_unit')
            ->toArray();

            var_dump($elements);
        }   


        // ---------------- Retorno a vista y funciones -----------------------

        return view('agrocefa::movements.formexit', [
            'people' => $people,
            'date' => $date,
            'werhousentrance' => $werhousentrance,
            'warehouseData' => $warehouseData,
            'elements' => $elements,
        ]);
        
    }

    public function registerexit (Request $request)
    {
        
    }
}
