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
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\Environment;
use Modules\SIGAC\Entities\EnvironmentWarehouse;
use Modules\SIGAC\Entities\EnvironmentCheck;
use Modules\SIGAC\Entities\NoveltyCheck;
use Modules\SIGAC\Entities\UploadedFile;
use Carbon\Carbon;
use App\Models\Product;
use App\Imports\ProductsImport;
use Modules\SIGAC\Imports\InventoryImport;
use Excel, Exception;
use Modules\SIGAC\Entities\EnvironmentActivityProgram;
use Modules\SIGAC\Entities\EnvironmentInstructorProgram;

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

        $productive_units = ProductiveUnit::pluck('name', 'id');

        $productive_unit_id = ProductiveUnit::where('name', '=', 'Almacen Sena')->pluck('id');
        $warehouses = Warehouse::whereHas('productive_unit_warehouses', function ($query) use ($productive_unit_id) {
            $query->where('productive_unit_id', $productive_unit_id);
        })
            ->get()->pluck('name', 'id');

        $environments = Environment::get()->pluck('name', 'id');
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
            'productive_units' => $productive_units,
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

        $receiveproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id', $warehouse_id)->first();
        $productiveWarehousereceiveId = $receiveproductive_warehouse->id;

        $productiveexterna = ProductiveUnit::where('name', '=', 'Almacen Sena')->get()->pluck('id');

        $deliveryproductive_warehouse = ProductiveUnitWarehouse::where('productive_unit_id', $productiveexterna)->first();
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
            return redirect()->route('sigac.academic_coordination.environmentcontrol.environment_inventory_movement.entrance.index')->with('success', 'Movimiento Registrado');
        } catch (\Exception $e) {
            // En caso de error, realiza un rollback de la transacción y maneja el error
            DB::rollBack();

            \Log::error('Error en el registro: ' . $e->getMessage());
        }
    }

    public function exit_index()
    {
        $elements = Element::select('id', 'name')->get();
        $environments = Environment::get()->pluck('name', 'id');

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
            $inventory = Inventory::whereIn('productive_unit_warehouse_id', $productive_warehouse_id)->where('amount', '>', 0)->get();

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

        $receiveproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id', $rwarehouse_id)->first();
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
            return redirect()->route('sigac.academic_coordination.environmentcontrol.environment_inventory_movement.exit.index')->with('success', 'Movimiento Registrado');
        } catch (\Exception $e) {
            // En caso de error, realiza un rollback de la transacción y maneja el error
            DB::rollBack();
            \Log::error('Error en el registro: ' . $e->getMessage());
            return redirect()->route('sigac.academic_coordination.environmentcontrol.environment_inventory_movement.exit.index')->with('error', 'Error');
        }
    }

    public function assign_environment_warehouse_index()
    {

        $environments = Environment::get()->pluck('name', 'id');
        $environments = $environments->prepend('Seleccione el ambiente', '');

        $productive_units = ProductiveUnit::get()->pluck('name', 'id');
        $productive_units = $productive_units->prepend('Seleccione la unidad productiva', '');

        // Obtener tanto empleados como contratistas que sean de los tipos especificados
        $getInstructor = DB::table('employees')
            ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
            ->join('people', 'employees.person_id', '=', 'people.id')
            ->where('state', 'Activo')
            ->where('employee_types.name', 'Instructor')
            ->select('people.id', 'people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
            ->union(
                DB::table('contractors')
                    ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                    ->join('people', 'contractors.person_id', '=', 'people.id')
                    ->where('state', 'Activo')
                    ->where('employee_types.name', 'Instructor')
                    ->select('people.id', 'people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
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

        $titlePage = 'Asigancion Bodega x Ambiente';
        $titleView = 'Asigancion Bodega x Ambiente';

        $data = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
            'productive_units' => $productive_units,
            'instructors' => $instructors,
            'environments' => $environments,
            'assigns' => $assigns,
        ];
        return view('sigac::environment_control.assign_environment_warehouse.index', $data);
    }

    public function assign_environment_warehouse_searchwarehouses(Request $request)
    {
        $productive_unit_id = $request->input('productive_unit_id');

        $warehouses = Warehouse::whereHas('productive_unit_warehouses', function ($query) use ($productive_unit_id) {
            $query->where('productive_unit_id', $productive_unit_id);
        })->pluck('name', 'id');

        return response()->json(['warehouses' => $warehouses->toArray()]);
    }

    public function assign_environment_warehouse_store(Request $request)
    {
        $rules = [
            'environment' => 'required',
            'warehouse' => 'required',
            'instructor' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message' => 'Ocurrió un error con el formulario.', 'typealert' => 'danger']);
        }

        $environment = $request->environment;
        $warehouse = $request->warehouse;
        $instructor = $request->instructor;

        $assign = EnvironmentWarehouse::where('environment_id', $environment)->first();

        // Realizar registro
        if (!$assign) {

            $environment_warehouse = new EnvironmentWarehouse;
            $environment_warehouse->environment_id = $environment;
            $environment_warehouse->warehouse_id = $warehouse;
            $environment_warehouse->person_id = $instructor;
            $environment_warehouse->save();

            return redirect(route('sigac.academic_coordination.environmentcontrol.assign_environment_warehouse.index'))->with(['success' => trans('sigac::profession.Successful_Aggregation')]);
        } else {
            return redirect(route('sigac.academic_coordination.environmentcontrol.assign_environment_warehouse.index'))->with(['error' => trans('El ambiente ya contiene una bodega')]);
        }
    }

    public function assign_environment_warehouse_destroy($id)
    {
        $professionProgram = DB::table('person_professions')->where('id', $id)->delete();

        if ($professionProgram) {
            return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index'))->with(['success' => trans('sigac::profession.Successful_Removal')]);
        } else {
            return redirect(route('sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index'))->with(['error' => trans('sigac::profession.Delete_Error')]);
        }
    }

    public function authorized_index()
    {
        // Definición de títulos para la página y la vista
        $titlePage = trans('sigac::environment.Environ_Control');
        $titleView = trans('sigac::environment.Personnel_Authorization');

        // Obtención de personal autorizado y roles
        $authorizedPersonnels = DB::table('authorized_personnels')->get();
        $roles = DB::table('roles')->pluck('name', 'id');

        // Preparación de datos para la vista
        $data = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
            'authorizedPersonnels' => $authorizedPersonnels,
            'roles' => $roles,
        ];

        // Retorno de la vista con los datos
        return view('sigac::environment_control.authorized_personnels.index', $data);
    }

    // Almacena un nuevo registro de personal autorizado
    public function authorized_store(Request $request)
    {
        // Valida los datos recibidos del formulario
        $request->validate([
            'person_id' => 'required|integer|exists:people,id',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        // Inserta un nuevo registro en la tabla de personal autorizado
        DB::table('authorized_personnels')->insert([
            'person_id' => $request->person_id,
            'role_id' => $request->role_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirige de vuelta a la vista de personal autorizado con un mensaje de éxito
        return redirect()->route('sigac.academic_coordination.environment_control.authorized_personnels.authorized_index')
            ->with('success', 'Registro agregado exitosamente');
    }

    // Elimina un registro de personal autorizado por su ID
    public function authorized_destroy($id)
    {
        // Busca el registro de personal autorizado por su ID
        $authorizedPersonnel = DB::table('authorized_personnels')->where('id', $id)->first();

        // Verifica si el registro existe
        if (!$authorizedPersonnel) {
            return redirect()->route('sigac.academic_coordination.environment_control.authorized_personnels.authorized_index')
                ->with('error', 'Registro no encontrado');
        }

        // Elimina el registro de la base de datos
        DB::table('authorized_personnels')->where('id', $id)->delete();

        // Redirige de vuelta a la vista de personal autorizado con un mensaje de éxito
        return redirect()->route('sigac.academic_coordination.environment_control.authorized_personnels.authorized_index')
            ->with('success', 'Registro eliminado exitosamente');
    }

    // CHEQUEO
    public function check_index()
    {

        $titlePage = "Verificación de Inventario";
        $titleView = "Verificación de Inventario";

        $datenow = Carbon::now()->toDateString();
        $timenow = Carbon::now()->toTimeString();
        $environments = Environment::get()->pluck('name', 'id');
        $environments = $environments->prepend('Seleccione el ambiente', '');
        // Obtener tanto empleados como contratistas que sean de los tipos especificados
        $getInstructor = DB::table('employees')
            ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
            ->join('people', 'employees.person_id', '=', 'people.id')
            ->where('state', 'Activo')
            ->where('employee_types.name', 'Instructor')
            ->select('people.id', 'people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
            ->union(
                DB::table('contractors')
                    ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                    ->join('people', 'contractors.person_id', '=', 'people.id')
                    ->where('state', 'Activo')
                    ->where('employee_types.name', 'Instructor')
                    ->select('people.id', 'people.first_name', 'people.first_last_name', 'people.second_last_name', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
            )->get();
        $instructors = $getInstructor->map(function ($i) {
            $id = $i->id;
            $name = $i->first_name . ' ' . $i->first_last_name . ' ' . $i->second_last_name;

            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => trans('Seleccione el instructor')])->pluck('name', 'id');

        return view('sigac::environment_control.check.index')->with([
            'titlePage' => $titlePage,
            'titleView' => $titleView,
            'datenow' => $datenow,
            'timenow' => $timenow,
            'environments' => $environments,
            'instructors' => $instructors,
        ]);
    }

    public function check_searchinventory(Request $request)
    {
        $environment = $request->environment;
        $date = $request->date;

        $existingCheck = EnvironmentCheck::where('environment_id', $environment)
            ->where('date', $date)
            ->where('state', 'Verificado Entrada')
            ->first();

        // Si existe, asignar 1, de lo contrario 0
        $verificationStatus = $existingCheck ? 1 : 0;

        $inventories = Inventory::with('element')
            ->whereHas('productive_unit_warehouse.warehouse.environment_warehouses.environment', function ($query) use ($environment) {
                $query->where('id', $environment);
            })
            ->get()
            ->map(function ($inventory) {
                // Obtener la última novedad
                $latestNoveltyCheck = NoveltyCheck::where('inventory_id', $inventory->id)
                    ->orderBy('created_at', 'desc')
                    ->first();

                if ($latestNoveltyCheck) {
                    if ($latestNoveltyCheck->solution) {
                        // Tiene solución => marcado y sin observación
                        $inventory->is_checked = true;
                        $inventory->observation = '';
                    } elseif ($latestNoveltyCheck->state === 'No') {
                        // No tiene solución y es 'No' => desmarcado y con observación
                        $inventory->is_checked = false;
                        $inventory->observation = $latestNoveltyCheck->observation ?? 'Sin observación';
                    } else {
                        // Tiene novedad pero state no es 'No' => marcado
                        $inventory->is_checked = true;
                        $inventory->observation = ''; // Opcional: podrías usar la observación si la quieres conservar
                    }
                } else {
                    // Sin novedad => marcado y sin observación
                    $inventory->is_checked = true;
                    $inventory->observation = '';
                }

                return $inventory;
            });


        return response()->json($inventories)->withHeaders([
            'Verification-Status' => $verificationStatus,
        ]);
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

        $security_id = $request->input('security');
        $instructor  = $request->input('instructor');
        $environment = $request->input('environment');
        $inventory   = $request->input('inventory', []);

        try {
            DB::beginTransaction();

            // Buscar si ya hay una verificación abierta para este ambiente
            $existingOpenCheck = EnvironmentCheck::where('environment_id', $environment)
                ->where('date', $datenow)
                ->where('state', 'Verificado Entrada')
                ->first();

            if ($existingOpenCheck) {
                // Si ya existe entrada, registrar salida
                $existingOpenCheck->state = 'Verificado Salida';
                $existingOpenCheck->save();

                $environment_check_id = $existingOpenCheck->id;
                $successMessage = 'Salida registrada correctamente.';
            } else {
                // Crear nueva entrada con hora fin desde el formulario
                $environment_check = new EnvironmentCheck();
                $environment_check->date              = $datenow;
                $environment_check->start_time        = $timenow;
                $environment_check->end_time          = $request->input('end_time'); // Hora fin definida en la vista
                $environment_check->security_id       = $security_id;
                $environment_check->responsability_id = $instructor;
                $environment_check->environment_id    = $environment;
                $environment_check->state             = 'Verificado Entrada';
                $environment_check->save();

                $environment_check_id = $environment_check->id;
                $successMessage = 'Entrada registrada correctamente.';
            }

            // Guardar novedades / chequeo de inventario
            foreach ($inventory as $itemId => $data) {
                $isChecked      = isset($data['checked']) && $data['checked'] == '1';
                $hasObservation = !empty($data['observation']);

                $existnovelty = NoveltyCheck::where('state', 'No')
                    ->where('inventory_id', $itemId)
                    ->orderBy('created_at', 'desc')
                    ->first();

                if ($existnovelty && $isChecked) {
                    // Si existía novedad y ahora está OK → cerrar novedad
                    NoveltyCheck::create([
                        'inventory_id'         => $itemId,
                        'observation'          => $hasObservation ? $data['observation'] : null,
                        'environment_check_id' => $environment_check_id,
                        'state'                => 'Si',
                    ]);
                } elseif (!$existnovelty && (!$isChecked || $hasObservation)) {
                    // Si no había novedad y ahora falla o tiene observación → abrir novedad
                    NoveltyCheck::create([
                        'inventory_id'         => $itemId,
                        'observation'          => $hasObservation ? $data['observation'] : null,
                        'environment_check_id' => $environment_check_id,
                        'state'                => 'No',
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', $successMessage);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error en check_store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al registrar el chequeo.');
        }
    }


    // Carga las bodegas basadas en la unidad productiva seleccionada
    public function getWarehousesByUnit(Request $request)
    {
        $productiveUnitId = $request->productive_unit_id;
        // Obtén las bodegas relacionadas con la unidad productiva
        $warehouses = Warehouse::where('productive_unit_id', $productiveUnitId)->pluck('name', 'id');
        return response()->json(['warehouses' => $warehouses]);
    }

    // Carga los ambientes basados en la bodega seleccionada
    public function getEnvironmentsByWarehouse(Request $request)
    {
        $warehouseId = $request->warehouse_id;
        // Obtén los ambientes relacionados con la bodega
        $environments = Environment::where('warehouse_id', $warehouseId)->pluck('name', 'id');
        return response()->json(['environments' => $environments]);
    }

    // Busca personas por nombre completo
    public function searchPerson(Request $request)
    {
        $term = $request->input('q');

        // Busca personas cuyo nombre completo coincida con el término de búsqueda
        $persons = Person::whereRaw("CONCAT(first_name, ' ', first_last_name, ' ', second_last_name) LIKE ?", ['%' . $term . '%'])->get();

        // Prepara los resultados para retornarlos en formato JSON
        $results = [];
        foreach ($persons as $person) {
            $results[] = [
                'id' => $person->id,
                'text' => $person->first_name . ' ' . $person->first_last_name . ' ' . $person->second_last_name,
            ];
        }

        // Retorna los resultados en formato JSON
        return response()->json($results);
    }

    public function check_report()
    {
        $titlePage = trans('Reporte de Chequeo');
        $titleView = trans('Reporte de Chequeo');

        $environments = Environment::get()->pluck('name', 'id');
        $environments = $environments->prepend('Seleccione el ambiente', '');

        return view('sigac::environment_control.reports.environmentcheck')->with([
            'environments' => $environments,
            'titlePage' => $titlePage,
            'titleView' => $titleView,
        ]);
    }

    public function check_report_result(Request $request)
    {
        $environmentId = $request->environment_id;

        $environmentchecks = EnvironmentCheck::where('environment_id', $environmentId)
            ->orderBy('date', 'desc')
            ->get();

        $environmentchecks->map(function ($check) {
            $check->inventories = Inventory::with(['element', 'productive_unit_warehouse.warehouse.environment_warehouses.environment'])
                ->whereHas('productive_unit_warehouse.warehouse.environment_warehouses.environment', function ($query) use ($check) {
                    $query->where('id', $check->environment_id);
                })
                ->get()
                ->map(function ($inventory) use ($check) {
                    // Novedad de este chequeo actual
                    $noveltyCheck = NoveltyCheck::where('inventory_id', $inventory->id)
                        ->where('environment_check_id', $check->id)
                        ->latest()
                        ->first();

                    // Buscar si hay una pendiente en cualquier chequeo anterior
                    $pendingNoveltyExists = NoveltyCheck::where('inventory_id', $inventory->id)
                        ->where('state', 'No')
                        ->whereNull('solution')
                        ->exists();

                    if ($pendingNoveltyExists) {
                        // Si hay pendiente sin solución => No verificado
                        $inventory->is_checked = false;
                        $inventory->observation = 'Novedad pendiente sin solución';
                    } elseif ($noveltyCheck) {
                        if ($noveltyCheck->solution) {
                            // Si esta novedad tiene solución => No verificado pero mostrar solución
                            $inventory->is_checked = false;
                            $inventory->observation = 'Solución: ' . $noveltyCheck->solution;
                        } else {
                            // Caso normal: usa state
                            $inventory->is_checked = $noveltyCheck->state !== 'No';
                            $inventory->observation = $noveltyCheck->observation ?? 'Sin observación';
                        }
                    } else {
                        // No hay novedad ni pendiente => Verificado
                        $inventory->is_checked = true;
                        $inventory->observation = '';
                    }

                    return $inventory;
                });

            return $check;
        });

        return view('sigac::environment_control.reports.resultcheck', [
            'environmentchecks' => $environmentchecks
        ])->render();
    }

    public function novelty_index(Request $request)
    {
        $titlePage = trans('Gestion de Novedades');
        $titleView = trans('Gestion de Novedades');

        $query = NoveltyCheck::with(['inventory.element', 'environment_check.environment'])
            ->orderBy('created_at', 'desc');

        // Filtro por ambiente
        if ($request->filled('environment_id')) {
            $query->whereHas('environment_check.environment', function ($q) use ($request) {
                $q->where('id', $request->environment_id);
            });
        }

        // Filtro por estado 
        if ($request->filled('state')) {
            if ($request->state === 'pendiente') {
                $query->where('state', 'No'); // En tu modelo 'No' = Pendiente
            } elseif ($request->state === 'solucionada') {
                $query->where('state', 'Si'); // 'Si' = Solucionada
            }
        }

        // Buscador
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('observation', 'LIKE', "%{$search}%")
                ->orWhereHas('inventory.element', function ($q2) use ($search) {
                    $q2->where('name', 'LIKE', "%{$search}%");
                });
            });
        }

        // Paginación con parámetros de filtros
        $novelties = $query->paginate(15)->appends($request->all());

        // Ambientes para el filtro
        $environments = \Modules\SICA\Entities\Environment::orderBy('name')->pluck('name', 'id');

        return view('sigac::environment_control.check.novelty', compact(
            'novelties',
            'titlePage',
            'titleView',
            'environments'
        ));
    }

    public function novelty_resolve(Request $request, $id)
    {
        $request->validate([
            'solution' => 'required|string',
        ]);

        $novelty = NoveltyCheck::findOrFail($id);
        $novelty->solution = $request->solution;
        $novelty->state = 'Si'; 
        $novelty->save();

        $environment_check = EnvironmentCheck::where('id', $novelty->environment_check_id)->first();
        $environment_check->state = 'Verificado Salida';
        $environment_check->approved = true;
        $environment_check->save();

        return redirect()->back()->with('success', 'Novedad marcada como solucionada.');
    }

    public function inventory_load_create()
    {
        return view('sigac::environment_control.movement.load')->with([
            'titlePage' => 'Cargar Inventario',
            'titleView' => 'Cargar Inventario',
        ]);
    }

    public function inventory_load_store(Request $request)
    {
        try {
            DB::beginTransaction();

            ini_set('max_execution_time', 3000);

            $validator = Validator::make($request->all(), [
                'archivo' => 'required|file',
            ], [
                'archivo.required' => 'El archivo es requerido.',
                'archivo.file' => 'Debe proporcionar un archivo válido.',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput()
                    ->with(['message' => 'Ocurrió un error con el formulario.', 'typealert' => 'danger']);
            }

            $file = $request->file('archivo');
            $fileHash = hash_file('sha256', $file->getRealPath());

            // Validar si el archivo ya fue procesado
            $existingFile = DB::table('uploaded_files')->where('hash', $fileHash)->first();

            if ($existingFile) {
                return back()->with('error', 'El archivo ya fue procesado anteriormente.');
            }

            // Usar el importador personalizado para obtener los datos
            $import = new InventoryImport();
            $array = Excel::toArray($import, $file);
            $datos = $array[0]; // Obtener la primera hoja

            foreach ($datos as $index => $row) {
                if ($index === 0) continue; // Saltar la fila de encabezados

                $placa = $row[0] ?? null;
                $dueno = $row[1] ?? null;
                $ubicacion = $row[2] ?? null;
                $elemento = $row[3] ?? null;
                $descripcion = $row[4] ?? null;
                $categoria = $row[5] ?? null;
                $cantidad = $row[6] ?? 1;

                $productUnitWarehouseId = ProductiveUnitWarehouse::whereHas('warehouse.environment_warehouses.environment', function ($query) use ($ubicacion) {
                    $query->where('name', $ubicacion);
                })->pluck('id')->first();

                if (!$productUnitWarehouseId) {
                    return redirect()->route('sigac.academic_coordination.environmentcontrol.assign_environment_warehouse.index')
                        ->with('error', 'El ' . $ubicacion . ' no cuenta con una bodega asociada');
                }

                $elementId = Element::where('name', $elemento)->pluck('id')->first();

                $personId = Person::whereRaw("CONCAT(first_name, ' ', first_last_name, ' ', second_last_name) LIKE ?", ['%' . $dueno . '%'])->pluck('id')->first();

                if (!$elementId) {
                    $categoriaId = Category::where('name', $categoria)->pluck('id')->first();

                    if (!$categoriaId) {
                        $category = new Category;
                        $category->name = $categoria;
                        $category->kind_of_property = 'Devolutivo';
                        $category->save();
                        $categoriaId = $category->id;
                    }

                    $measurementUnitId = MeasurementUnit::where('name', 'Unidad')->pluck('id')->first();
                    $kindOfPurchaseId = KindOfPurchase::where('name', 'Producción de centro')->pluck('id')->first();

                    $element = new Element;
                    $element->name = $elemento;
                    $element->measurement_unit_id = $measurementUnitId;
                    $element->description = $descripcion;
                    $element->kind_of_purchase_id = $kindOfPurchaseId;
                    $element->category_id = $categoriaId;
                    $element->slug = strtolower($elemento);
                    $element->save();
                    $elementId = $element->id;
                }

                // Verificar si el elemento ya existe en el inventario
                $existingInventory = Inventory::where('productive_unit_warehouse_id', $productUnitWarehouseId)
                    ->where('element_id', $elementId)
                    ->first();

                if ($existingInventory) {
                    // Actualizar cantidad del inventario existente
                    $existingInventory->amount += $cantidad;
                    $existingInventory->save();
                } else {
                    // Crear nuevo inventario si no existe
                    $newInventory = new Inventory([
                        'person_id' => $personId, // Puedes asignar el ID de la persona aquí si aplica
                        'productive_unit_warehouse_id' => $productUnitWarehouseId,
                        'element_id' => $elementId,
                        'price' => '100',
                        'amount' => $cantidad,
                        'stock' => '0',
                    ]);

                    $newInventory->save();
                }
            }

            // Registrar el hash del archivo en la base de datos
            DB::table('uploaded_files')->insert([
                'hash' => $fileHash,
                'uploaded_at' => now(),
            ]);

            DB::commit();
            return back()->with('success', 'Excel importado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error en el registro: ' . $e->getMessage() . ' en la línea ' . $e->getLine() . ' del archivo ' . $e->getFile());
            return back()->with('error', 'Ocurrió un error');
        }
    }

    public function environment_report(Request $request)
    {
        // Si no envía fecha, usa la actual
        $date = $request->date ?? now()->toDateString();

        // Ambientes disponibles = Estado Disponible Y que NO tengan programación de formación NI actividad
        $availableEnvironments = Environment::where('status', 'Disponible')
            ->whereDoesntHave('environment_instructor_programs.instructor_program', function ($query) use ($date) {
                $query->where('date', $date)
                    ->where('state', 'Programado');
            })
            ->whereDoesntHave('environment_activity_programs', function ($query) use ($date) {
                $query->where('date', $date);
            })
            ->get();

        return view('sigac::environment_control.reports.available_environment', [
            'availableEnvironments' => $availableEnvironments,
            'selectedDate' => $date,
            'titlePage' => 'Reporte de Ambientes Disponibles',
            'titleView' => 'Reporte de Ambientes Disponibles',
        ]);
    }

    public function activity_create(Request $request)
    {
        $environment = Environment::findOrFail($request->environment_id);

        return view('sigac::environment_control.activity.create', [
            'environment' => $environment,
            'titlePage' => 'Programar Actividad',
            'titleView' => 'Programar Actividad',
        ]);
    }

    public function activity_store(Request $request)
    {
        // Validaciones básicas
        $request->validate([
            'environment_id' => 'required|exists:environments,id',
            'activity_name' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], [
            'date.after_or_equal' => 'La fecha debe ser hoy o posterior.',
            'end_time.after' => 'La hora de finalización debe ser posterior a la hora de inicio.',
            'start_time.date_format' => 'El formato de hora de inicio debe ser HH:MM (ej: 08:30).',
            'end_time.date_format' => 'El formato de hora de finalización debe ser HH:MM (ej: 10:30).',
            'date.required' => 'El campo fecha es obligatorio.',
            'start_time.required' => 'El campo hora de inicio es obligatorio.',
            'end_time.required' => 'El campo hora de finalización es obligatorio.',
            'activity_name.required' => 'El nombre de la actividad es obligatorio.',
            'environment_id.required' => 'Debe seleccionar un ambiente.',
        ], [
            'date' => 'fecha',
            'start_time' => 'hora de inicio',
            'end_time' => 'hora de finalización',
            'activity_name' => 'nombre de la actividad',
            'environment_id' => 'ambiente',
        ]);

        // Validaciones adicionales de horarios
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $date = $request->date;

        // Validar horarios de trabajo (6:00 AM - 10:00 PM)
        if ($startTime < '06:00' || $endTime > '22:00') {
            return back()->with('error', 'Los horarios deben estar entre las 6:00 AM y las 10:00 PM.')
                ->withInput();
        }

        // Validar que la duración no sea excesiva (máximo 8 horas)
        $start = \Carbon\Carbon::createFromFormat('H:i', $startTime);
        $end = \Carbon\Carbon::createFromFormat('H:i', $endTime);
        $duration = $end->diffInHours($start);
        
        if ($duration > 8) {
            return back()->with('error', 'La duración de la actividad no puede ser mayor a 8 horas.')
                ->withInput();
        }

        // Validar que no sea domingo (opcional - descomenta si es necesario)
        // $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeek;
        // if ($dayOfWeek == 0) { // 0 = Domingo
        //     return back()->with('error', 'No se pueden programar actividades los domingos.')
        //         ->withInput();
        // }

        // Validar días festivos (opcional - descomenta si tienes tabla de holidays)
        // $isHoliday = \Modules\SICA\Entities\Holiday::where('date', $date)->exists();
        // if ($isHoliday) {
        //     return back()->with('error', 'No se pueden programar actividades en días festivos.')
        //         ->withInput();
        // }

        $environmentId = $request->environment_id;
        $date = $request->date;
        $startTime = $request->start_time;
        $endTime = $request->end_time;

        // Validar conflictos con actividades extraordinarias existentes
        $conflictActivity = EnvironmentActivityProgram::where('environment_id', $environmentId)
            ->where('date', $date)
            ->where(function ($query) use ($startTime, $endTime) {
                // Verificar si hay solapamiento de horarios
                $query->where(function ($q) use ($startTime, $endTime) {
                    // Caso 1: La nueva actividad empieza dentro de una existente
                    $q->where('start_time', '<=', $startTime)
                      ->where('end_time', '>', $startTime);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    // Caso 2: La nueva actividad termina dentro de una existente
                    $q->where('start_time', '<', $endTime)
                      ->where('end_time', '>=', $endTime);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    // Caso 3: La nueva actividad contiene completamente una existente
                    $q->where('start_time', '>=', $startTime)
                      ->where('end_time', '<=', $endTime);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    // Caso 4: Una actividad existente contiene completamente la nueva
                    $q->where('start_time', '<=', $startTime)
                      ->where('end_time', '>=', $endTime);
                });
            })
            ->first();

        // Validar conflictos con programación de formación
        $conflictFormation = EnvironmentInstructorProgram::where('environment_id', $environmentId)
            ->whereHas('instructor_program', function ($q) use ($date, $startTime, $endTime) {
                $q->where('date', $date)
                    ->where('state', 'Programado')
                    ->where(function ($query) use ($startTime, $endTime) {
                        // Verificar si hay solapamiento de horarios
                        $query->where(function ($q2) use ($startTime, $endTime) {
                            // Caso 1: La nueva actividad empieza dentro de una formación existente
                            $q2->where('start_time', '<=', $startTime)
                               ->where('end_time', '>', $startTime);
                        })->orWhere(function ($q2) use ($startTime, $endTime) {
                            // Caso 2: La nueva actividad termina dentro de una formación existente
                            $q2->where('start_time', '<', $endTime)
                               ->where('end_time', '>=', $endTime);
                        })->orWhere(function ($q2) use ($startTime, $endTime) {
                            // Caso 3: La nueva actividad contiene completamente una formación existente
                            $q2->where('start_time', '>=', $startTime)
                               ->where('end_time', '<=', $endTime);
                        })->orWhere(function ($q2) use ($startTime, $endTime) {
                            // Caso 4: Una formación existente contiene completamente la nueva actividad
                            $q2->where('start_time', '<=', $startTime)
                               ->where('end_time', '>=', $endTime);
                        });
                    });
            })
            ->first();

        // Generar mensajes de error específicos
        if ($conflictActivity) {
            $conflictStart = $conflictActivity->start_time;
            $conflictEnd = $conflictActivity->end_time;
            $conflictName = $conflictActivity->activity_name;
            
            return back()->with('error', "El ambiente ya tiene programada la actividad '{$conflictName}' de {$conflictStart} a {$conflictEnd} en esta fecha.")
                ->withInput();
        }

        if ($conflictFormation) {
            $formation = $conflictFormation->instructor_program;
            $conflictStart = $formation->start_time;
            $conflictEnd = $formation->end_time;
            
            return back()->with('error', "El ambiente ya tiene programada una formación de {$conflictStart} a {$conflictEnd} en esta fecha.")
                ->withInput();
        }

        EnvironmentActivityProgram::create([
            'environment_id' => $environmentId,
            'activity_name' => $request->activity_name,
            'activity_description' => $request->activity_description,
            'date' => $date,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'person_id' => $request->person_id,
        ]);

        return redirect()->back()
            ->with('success', 'Actividad programada correctamente.');
    }


    public function inventory_index()
    {
        $titlePage = trans('Gestión de Inventario');
        $titleView = trans('Gestión de Inventario');

        $environments = Environment::pluck('name', 'id');
        $environments = $environments->prepend('Seleccione el ambiente', '');

        return view('sigac::environment_control.inventory.index', compact('environments', 'titlePage', 'titleView'));
    }

    public function showInventory(Request $request)
    {
        $request->validate([
            'environment_id' => 'required|exists:environments,id',
        ]);

        $inventories = Inventory::with('element')
            ->whereHas('productive_unit_warehouse.warehouse.environment_warehouses', function ($query) use ($request) {
                $query->where('environment_id', $request->environment_id);
            })
            ->get();

        return response()->json($inventories);
    }

    public function approveCheck(Request $request)
    {
        $check = EnvironmentCheck::findOrFail($request->environment_check_id);
        $check->approved = true;
        $check->save();

        return back()->with('success', 'Chequeo aprobado correctamente.');
    }

    public function reportNovelty(Request $request)
    {
        $request->validate([
            'environment_check_id' => 'required|exists:environment_checks,id',
            'inventories' => 'required|array',
        ]);

        foreach ($request->inventories as $inventoryId) {
            NoveltyCheck::create([
                'inventory_id' => $inventoryId,
                'environment_check_id' => $request->environment_check_id,
                'observation' => $request->observations[$inventoryId] ?? null,
                'state' => 'No',
            ]);
        }

        $environmentCheck = EnvironmentCheck::findOrFail($request->environment_check_id);
        $environmentCheck->approved = false;
        $environmentCheck->state = 'Novedad';
        $environmentCheck->save();

        return back()->with('success', 'Novedad(es) reportadas correctamente.');
    }
}
