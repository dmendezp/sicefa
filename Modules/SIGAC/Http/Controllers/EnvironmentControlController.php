<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\WarehouseMovement;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\SICA\Entities\Environment;
use Modules\SIGAC\Entities\EnvironmentWarehouse;
use Modules\SIGAC\Entities\EnvironmentCheck;
use Modules\SIGAC\Entities\NoveltyCheck;
use Carbon\Carbon;


class EnvironmentControlController extends Controller
{
    public function index()
    {
        $titlePage = 'Control de ambientes';
        $titleView = 'Novedades';

        $data = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
        ];
        return view('sigac::environment_control.news.index', $data);
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


    public function entrance_index()
    {
        $elements = Element::select('id', 'name')->get();

        $productive_unit_id = ProductiveUnit::where('name','=','Almacen Sena')->pluck('id');
        $warehouses = Warehouse::whereHas('productive_unit_warehouses', function ($query) use ($productive_unit_id) {
            $query->where('productive_unit_id', $productive_unit_id);
        })
        ->get()->pluck('name','id');

        $environments = Environment::get()->pluck('name','id');
        $environments = $environments->prepend('Seleccione el ambiente', '');
        
        $datenow = Carbon::now();
        $user = Auth::user();
        if ($user->person) {
                $person = [$user->person->id => $user->person->fullname];
            }
        $titlePage = 'Movimiento de Entrada - Ambiente';
        $titleView = 'Movimiento de Entrada';

        $data = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
            'elements' => $elements,
            'warehouses' => $warehouses,
            'environments' => $environments,
            'datenow' => $datenow,
            'person' => $person,
        ];
        return view('sigac::environment_control.movement.entrance', $data);
    }

    public function entrance_store(Request $request)
    {
        // Obtener para Tipo de Movimiento
        $movementType = MovementType::select('id', 'consecutive')->where('name', '=', 'Movimiento Entrada')->first();

        // Obtener los datos del formulario
        $date = $request->input('date');
        $observation = $request->input('observation');                                                                                                                                                                                                                                                                                                                                                             
        $user_id = $request->input('user_id');
        $deliverywarehouse = $request->input('deliverywarehouse');
        $receiveenvironment = $request->input('receivewarehouse');

        $receivenvironment_warehouse = EnvironmentWarehouse::where('environment_id', $receiveenvironment)->first();
        $warehouse_id = $receivenvironment_warehouse->warehouse_id;

        $receiveproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id',$warehouse_id)->first();
        $productiveWarehousereceiveId = $receiveproductive_warehouse->id;

        $productiveexterna = ProductiveUnit::where('name','=','Almacen Sena')->get()->pluck('id');
        
        $deliveryproductive_warehouse = ProductiveUnitWarehouse::where('productive_unit_id',$productiveexterna)->first();
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
        $productCodes = $request->input('product-code');


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
                    $inventory_code = $productCodes[$index];
                    
                    
                
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
                            'inventory_code' => $inventory_code ?: null,
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
                return redirect()->route('sigac.instructor.environmentcontrol.environment_inventory_movement.entrance.index')->with('success', 'Movimiento Registrado');

            } catch (\Exception $e) {
                // En caso de error, realiza un rollback de la transacción y maneja el error
                DB::rollBack();

                \Log::error('Error en el registro: ' . $e->getMessage());
            }
    }

    public function exit_index()
    {
        $elements = Element::select('id', 'name')->get();
        $environments = Environment::get()->pluck('name','id');

        $environments = $environments->prepend('Seleccione el ambiente', '');
        $datenow = Carbon::now();
        $user = Auth::user();
        if ($user->person) {
                $person = [$user->person->id => $user->person->fullname];
            }
        $titlePage = 'Movimiento de Inventario - Ambiente';
        $titleView = 'Movimiento de Inventario';

        $data = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
            'elements' => $elements,
            'environments' => $environments,
            'datenow' => $datenow,
            'person' => $person,
        ];
        return view('sigac::environment_control.movement.exit', $data);
    }

    public function exit_searchelement(Request $request) 
    {
        try {
            $environmentId = $request->input('environment');
            
            // Obtener las IDs de las bodegas relacionadas con la unidad productiva seleccionada
            $warehouseId = EnvironmentWarehouse::where('environment_id', $environmentId)->get()->pluck('warehouse_id');

            $productive_warehouse_id = ProductiveUnitWarehouse::where('warehouse_id', $warehouseId)->get()->pluck('id');

            // Registrar un mensaje de información con los IDs de las bodegas
            \Log::info('Bodega IDs:', $productive_warehouse_id->toArray());

            // Obtener los elementos de las bodegas
            $inventory = Inventory::whereIn('productive_unit_warehouse_id', $productive_warehouse_id)->where('amount','>',0)->get();

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

    public function exit_store(Request $request)
    {
        // Obtener para Tipo de Movimiento
        $movementType = MovementType::select('id', 'consecutive')->where('name', '=', 'Movimiento Interno')->first();

        // Obtener los datos del formulario
        $date = $request->input('date'); // Fecha actual del movimiento
        $observation = $request->input('observation'); // Observacion del movimiento
        $user_id = $request->input('user_id'); // Usuario del movimiento
        $deliveryenvironment = $request->input('deliverywarehouse'); // Bodega que entrega los elementos
        $product_unit = $request->input('product_unit'); // Bodega que entrega los elementos
        $receiveenvironment = $request->input('receivewarehouse'); // Bodega que recibe los elementos

        


        $receivenvironment_warehouse = EnvironmentWarehouse::where('environment_id', $receiveenvironment)->first();
        $rwarehouse_id = $receivenvironment_warehouse->warehouse_id;

        $receiveproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id',$rwarehouse_id)->first();
        $productiveWarehousereceiveId = $receiveproductive_warehouse->id;
        $productive_unit = $receiveproductive_warehouse->productive_unit_id;

        $responsibility = ProductiveUnit::with('person')->where('id', $productive_unit)->first();

        if ($responsibility) {
            $personid = $responsibility->person_id;
        }


        $receivenvironment_warehouse = EnvironmentWarehouse::where('environment_id', $deliveryenvironment)->first();
        $dwarehouse_id = $receivenvironment_warehouse->warehouse_id;

        $deliveryproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id', $dwarehouse_id)->first();
        $productiveWarehousedeliveryId = $deliveryproductive_warehouse->id;
        

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
            return redirect()->route('sigac.instructor.environmentcontrol.environment_inventory_movement.exit.index')->with('success', 'Movimiento Registrado');

        } catch (\Exception $e) {
            // En caso de error, realiza un rollback de la transacción y maneja el error
            DB::rollBack();
            \Log::error('Error en el registro: ' . $e->getMessage());
            return redirect()->route('sigac.instructor.environmentcontrol.environment_inventory_movement.exit.index')->with('error', 'Error');
            
        }
    }

    public function assign_environment_warehouse_index()
    {

        $environments = Environment::get()->pluck('name','id');
        $environments = $environments->prepend('Seleccione el ambiente', '');
        
        $warehouses = Warehouse::get()->pluck('name','id');
        $warehouses = $warehouses->prepend('Seleccione la bodega', '');

        // Obtener tanto empleados como contratistas que sean de los tipos especificados
        $getInstructor = DB::table('employees')
                        ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
                        ->join('people', 'employees.person_id', '=', 'people.id')
                        ->where('state', 'Activo')
                        ->where('employee_types.name', 'Instructor')
                        ->select('people.id','people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                        ->union(
                            DB::table('contractors')
                            ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                            ->join('people', 'contractors.person_id', '=', 'people.id')
                            ->where('state', 'Activo')
                            ->where('employee_types.name', 'Instructor')
                            ->select('people.id','people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                        )->get();
        $instructors = $getInstructor->map(function ($i) {
            $id = $i->id;
            $name = $i->first_name . ' ' . $i->first_last_name . ' ' . $i->second_last_name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('sigac::profession.SelectAnInstructor')])->pluck('name', 'id');

        $assigns = EnvironmentWarehouse::get();

        $titlePage = 'Asigancion Bodega x Amnbiente';
        $titleView = 'Asigancion Bodega x Amnbiente';

        $data = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
            'warehouses' => $warehouses,
            'instructors' => $instructors,
            'environments' => $environments,
            'assigns' => $assigns,
        ];
        return view('sigac::environment_control.assign_environment_warehouse.index', $data);
    }

    public function assign_environment_warehouse_store(Request $request){
        $rules = [
            'environment' => 'required',
            'warehouse' => 'required',
            'instructor' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }

        $environment = $request->environment;
        $warehouse = $request->warehouse;
        $instructor = $request->instructor;

        $assign = EnvironmentWarehouse::where('environment_id', $environment)->first();

        // Realizar registro
        if(!$assign){

            $environment_warehouse = new EnvironmentWarehouse;
            $environment_warehouse->environment_id = $environment;
            $environment_warehouse->warehouse_id = $warehouse;
            $environment_warehouse->person_id = $instructor;
            $environment_warehouse->save();

            return redirect(route('sigac.instructor.environmentcontrol.assign_environment_warehouse.index'))->with(['success'=> trans('sigac::profession.Successful_Aggregation')]);
        } else {
            return redirect(route('sigac.instructor.environmentcontrol.assign_environment_warehouse.index'))->with(['error'=> trans('sigac::profession.Error_Adding')]);
        }
    }

    public function assign_environment_warehouse_destroy($id){
        $professionProgram = DB::table('person_professions')->where('id', $id)->delete();

        if($professionProgram){
            return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index'))->with(['success'=> trans('sigac::profession.Successful_Removal')]);
        }else{
            return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index'))->with(['error'=> trans('sigac::profession.Delete_Error')]);
        }
    }

    public function check_index(){

        $titlePage = "Verificación de Inventario";
        $titleView = "Verificación de Inventario";

        $datenow = Carbon::now()->toDateString();
        $timenow = Carbon::now()->toTimeString();
        $environments = Environment::get()->pluck('name','id');
        $environments = $environments->prepend('Seleccione el ambiente', '');

        return view('sigac::environment_control.check.index')->with([
            'titlePage' => $titlePage,
            'titleView' => $titleView,
            'datenow' => $datenow,
            'timenow' => $timenow,
            'environments' => $environments,
        ]);
    }

    public function check_searchinventory(Request $request){

        $environment = $request->environment;
        $inventories = Inventory::with('element')->whereHas('productive_unit_warehouse.warehouse.environment_warehouses.environment', function ($query) use ($environment) {
            $query->where('id', $environment);
        })->get();

        return response()->json($inventories);
    }

    public function check_searchperson(Request $request)
    {
        $term = $request->input('q');

        $persons = Person::whereRaw("CONCAT(first_name, ' ', first_last_name, ' ', second_last_name) LIKE ?", ['%' . $term . '%'])->get();

        $results = [];
        foreach ($persons as $person) {
            $results[] = [
                'id' => $person->id,
                'text' => $person->first_name . ' ' . $person->first_last_name,
            ];
        }

        return response()->json($results);
    }

    public function check_store(Request $request)
    {
        $datenow = Carbon::now()->toDateString();
        $timenow = Carbon::now()->toTimeString();
        
        $user = Auth::user();
        $responsibility = $user->person->id;
        $security = $request->input('security');
        $environment = $request->input('environment');
        $inventories = $request->input('inventory');

            // Inicia una transacción de base de datos
            DB::beginTransaction();

            
                $checktId = null;
                 
                // Registra un solo movimiento con el precio total calculado
                $check = new EnvironmentCheck([
                    'security_id' => $security,
                    'responsability_id' => $responsibility,
                    'environment_id' => $environment,
                    'date' => $datenow,
                    'start_time' => $timenow,
                    'state' => 'Verificado Entrada',
                    ]);
        
                $check->save();
                $checktId = $check->id;

                
                
                // Procesar cada elemento
                foreach ($inventories as $inventory) {
                    $inventoryId = $inventory['id'];
                    $isChecked = $inventory['checked'];
                    $observation = $inventory['observation'];
            
                    if ($isChecked == 0 || $observation != null) {

                        $noveltycheck = new NoveltyCheck([
                            'inventory_id' => $inventoryId,
                            'environment_check_id' => $checktId,
                            'observation' => $observation,
                            ]);
                
                        $noveltycheck->save();
                    }
                }

                // Registra datos en otras tablas utilizando $inventoryIds y otros valores (si es necesario)

                // Si todo está correcto, realiza un commit de la transacción
                DB::commit();

                // Después de realizar la operación de registro con éxito
                return redirect()->route('sigac.instructor.environmentcontrol.environment_inventory_movement.check.index')->with('success', 'Ambiente Verificado');
                try {
            } catch (\Exception $e) {
                // En caso de error, realiza un rollback de la transacción y maneja el error
                DB::rollBack();
                return redirect()->route('sigac.instructor.environmentcontrol.environment_inventory_movement.check.index')->with('success', 'Hubo un inconveniente en la verificación');
                \Log::error('Error en el registro: ' . $e->getMessage());
            }
    }

    public function check_pending_index (){
        $titlePage = 'Verificar Ambiente';
        $titleView = 'Verificar Ambiente';
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sigac::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('sigac::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sigac::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
