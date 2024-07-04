<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Http\Controllers\AGROCEFAController;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Responsibility;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\SICA\Entities\Environment;
use Modules\AGROCEFA\Entities\CropEnvironment;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Executor;
use Modules\SICA\Entities\Equipment;
use Modules\AGROCEFA\Entities\AgriculturalLabor;
use Modules\SICA\Entities\Consumable;
use Modules\SICA\Entities\EmployeeType;
use Modules\SICA\Entities\Tool;
use Modules\AGROCEFA\Entities\Crop;
use Modules\SICA\Entities\Production;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\WarehouseMovement;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\SICA\Entities\EnvironmentalAspectLabor;
use Modules\AGROCEFA\Entities\Variety;
use App\Models\User;

class LaborManagementController extends Controller
{
    //rutas de la vista de las tarjetas y la de labores culturales
    public function index()
    {
        return view('agrocefa::labormanagement.index');
    }

    public function culturalwork()
    {

        // Instancia del controlador AGROCEFA
        $agrocefaController = new AGROCEFAController();
        // Llamar la funcion para actualizar las notificaciones de Movimientos
        $result = $agrocefaController->notificationmovement();
        // Llamar la funcion para actualizar las notificaciones de stock
        $result = $agrocefaController->notificationstock();

        // Fecha actual
        $date = Carbon::now();

        // Obtén el ID de la unidad productiva seleccionada de la sesión
        $this->selectedUnitId = Session::get('selectedUnitId');

        // ---------------- Filtro para los Lotes de esa Unidad -----------------------

        $lotData = EnvironmentProductiveUnit::where('productive_unit_id', $this->selectedUnitId)
            ->with('environment')
            ->get();

        // Inicializa un array para almacenar los nombres y IDs de los ambientes
        $environmentData = [];

        // Recorre la colección y obtén los nombres y IDs de los ambientes
        foreach ($lotData as $item) {
            $environmentId = $item->environment->id;
            $environmentName = $item->environment->name;

            // Agrega un array asociativo con el ID y el nombre del ambiente al array de datos
            $environmentData[] = [
                'id' => $environmentId,
                'name' => $environmentName,
            ];
        }

        // Intenta encontrar la unidad productiva por su ID y verifica si se encuentra
        $activity = Activity::where('productive_unit_id', $this->selectedUnitId)->first();

        // Llama a la función para obtener los aspectos ambientales
        $aspectosAmbientales = [];

       
        // ---------------- Filtro para las Actividades de esa unidad -----------------------

        // Intenta encontrar la unidad productiva por su ID y verifica si se encuentra
        $activitys = Activity::where('productive_unit_id', $this->selectedUnitId)->get();

        // Inicializa un array para almacenar la información de las bodegas
        $activitysData = [];

        // Verifica si hay registros en la tabla productive_unit_warehouses para esta unidad
        if ($activitys) {
            // Mapea las bodegas y agrega su información al array
            $activitysData = $activitys->map(function ($activity) {
                return [
                    'id' => $activity->id,
                    'name' => $activity->name,
                ];
            });
        }

        // ---------------- Filtro para las Categorias -----------------------

        $categories = Category::whereIn('name', ['Insumo', 'Fertilizante', 'Agroquimico'])->get();

        // ---------------- Filtro para los tipos de empleado -----------------------

        $employes = EmployeeType::get();

        // ---------------- Filtro para las Elementos -----------------------

        // Obtener el ID de la unidad productiva seleccionada (asumiendo que lo tienes en sesión)
        $selectedUnitId = Session::get('selectedUnitId');

        // Obtén los registros de productive_unit_warehouse que coinciden con la unidad productiva seleccionada
        $ProductiveUnitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->get();

        // Obtener los registros de 'productive_unit_warehouses' que coinciden con la unidad productiva seleccionada
        $unitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->pluck('id');

        Session::put('productiveunitwarehouseid', $ProductiveUnitWarehouses);
        // Obtener los registros de inventario que coinciden con las bodegas relacionadas
        // Herramientas
        $toolsData = Inventory::with('element.category')
            ->whereIn('productive_unit_warehouse_id', $unitWarehouses)
            ->whereHas('element.category', function ($query) {
                $query->where('name', 'Herramienta');
            })
            ->get();

        $toolOptions = [];

        foreach ($toolsData as $inventory) {
            $inventoryId = $inventory->id;
            $elementName = $inventory->element->name;
            $toolOptions[$inventoryId] = $elementName;
        }

        // Maquinaria
        $machineryData = Inventory::with('element.category')
            ->whereIn('productive_unit_warehouse_id', $unitWarehouses)
            ->whereHas('element.category', function ($query) {
                $query->where('name', ['Maquinaria', 'Equipo']);
            })
            ->get();

        $machineryOptions = [];

        foreach ($machineryData as $inventory) {
            $inventoryId = $inventory->id;
            $elementName = $inventory->element->name;
            $machineryOptions[$inventoryId] = $elementName;
        }

        $destinationOptions = [
            'Formación' => 'Formación',
            'Producción' => 'Producción',

            // Agrega más opciones según sea necesario
        ];

        // Intenta encontrar la unidad productiva por su ID y verifica si se encuentra
        $selectedUnit = ProductiveUnit::find($this->selectedUnitId);

        //Todas las unidades productivas
        $productunits = ProductiveUnit::all();

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

        $productionsData = Element::with('kind_of_purchase')
            ->whereHas('kind_of_purchase', function ($query) {
                $query->where('name', ['Producción de centro']);
            })
            ->get();

        $productionsOptions = [];

        foreach ($productionsData as $element) {
            $elementId = $element->id;
            $elementName = $element->name;
            $productionsOptions[$elementId] = $elementName;
        }
        

        // ---------------- Retorno a vista y funciones -----------------------

        return view('agrocefa::labormanagement.culturalwork', [
            'date' => $date,
            'activitysData' => $activitysData,
            'environmentData' => $environmentData,
            'toolOptions' => $toolOptions,
            'machineryOptions' => $machineryOptions,
            'categories' => $categories,
            'employes' => $employes,
            'destinationOptions' => $destinationOptions,
            'warehouseData' => $warehouseData,
            'productunits' => $productunits,
            'productionsOptions' => $productionsOptions,
            'aspectosAmbientales' => $aspectosAmbientales, // Asegúrate de incluir esto en el array
        ]);
    }

    public function obteneresponsability(Request $request)
    {
        try {
            // Obtén el ID de la unidad productiva seleccionada de la sesión
            $this->selectedUnitId = Session::get('selectedUnitId');

            $activityid = $request->input('activity');

            // Carga la unidad productiva con las relaciones necesarias
            $activities = Activity::with('responsibilities.role.users.person')
                ->where('productive_unit_id', $this->selectedUnitId)
                ->where('id', $activityid)
                ->first();

            $peopleData = []; // Array para almacenar los datos de las personas

            if ($activities) {
                foreach ($activities->responsibilities as $responsibility) {
                    foreach ($responsibility->role->users as $user) {
                        $person = $user->person;

                        // Agregar los datos de la persona al array si existe
                        if ($person) {
                            $peopleData[] = [
                                'id' => $person->id,
                                'first_name' => $person->first_name,
                            ];
                        }
                    }
                }
            }

            // Combinar la información de los IDs y first_name de las personas en un solo arreglo
            $response = [
                'people_data' => $peopleData,
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            \Log::error('Error en la solicitud AJAX: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function searchperson(Request $request)
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

    public function obtenerecrop(Request $request)
    {
        try {
            // Obtén el ID de la unidad productiva seleccionada de la sesión
            $this->selectedUnitId = Session::get('selectedUnitId');

            $lotid = $request->input('lot');

            // Carga la unidad productiva con las relaciones necesarias
            $lots = CropEnvironment::with('crop')
                ->where('environment_id', $lotid)
                ->first();

            $cropData = []; // Array para almacenar los datos de las personas

            if ($lots) {
                foreach ($lots->crop as $cro) {
                    $cropData[] = [
                        'id' => $cro->id,
                        'name' => $cro->name,
                        'sown_area' => $cro->sown_area, // Agrega el sown_area al arreglo
                    ];
                }
            }

            // Combinar la información de los IDs y first_name de las personas en un solo arreglo
            $response = [
                'crop_data' => $cropData,
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            \Log::error('Error en la solicitud AJAX: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function getsupplies(Request $request)
    {
        try {
            $categoryId = $request->input('category');

            // Obtener las IDs de las bodegas relacionadas con la unidad productiva seleccionada
            $warehouseIds = ProductiveUnitWarehouse::where('productive_unit_id', Session::get('selectedUnitId'))->pluck('id');

            // Registrar un mensaje de información con los IDs de las bodegas
            \Log::info('Bodega IDs:', $warehouseIds->toArray());

            // Obtener los elementos de las bodegas
            $inventory = Inventory::whereIn('productive_unit_warehouse_id', $warehouseIds)
                ->where('amount','>',0)
                ->whereHas('element.category', function ($query) use ($categoryId) {
                    $query->where('name', $categoryId);
                })
                ->get();

            if ($inventory) {
                // Mapear los datos para incluir ID y nombre del elemento
                $elementsData = $inventory->map(function ($item) {
                    return [
                        'id' => $item->element->id,
                        'inventory_id' => $item->id,
                        'name' => $item->element->name,
                        'price' => $item->price,
                        'production_date' => $item->production_date,
                        'amount' => $item->amount,
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

    public function obtenerDatosElemento(Request $request)
    {
        try {
            $elementId = $request->input('element');

            // Realiza la lógica para obtener los datos del elemento en una sola consulta
            $elementData = Element::whereHas('inventories', function ($query) use ($elementId) {
                $query->where('id', $elementId);
            })->first();

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

    public function getcropinformation(Request $request)
    {
        try {
            $cropId = $request->input('id');

            // Realiza la lógica para obtener los datos del elemento en una sola consulta
            $cropData = Crop::where('id', $cropId)->first();

            if ($cropData) {
                $name = $cropData->name;
                $sown_area = $cropData->sown_area;
                $seed_time = $cropData->seed_time;
                $density = $cropData->density;

                return response()->json([
                    'name' => $name,
                    'sown_area' => $sown_area,
                    'seed_time' => $seed_time,
                    'density' => $density,
                ]);
            } else {
                return response()->json(['error' => 'Cultivo no encontrado'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function getpriceemploye(Request $request)
    {
        try {
            $employee = $request->input('employee');

            // Realiza la lógica para obtener los datos del elemento en una sola consulta
            $employeData = EmployeeType::where('id', $employee)->first();

            if ($employeData) {
                $price = $employeData->price;

                return response()->json([
                    'price' => $price,
                ]);
            } else {
                return response()->json(['error' => 'Precio no encontrado'], 404);
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
                $amount = $dataelement->amount / $measurement_unit . ' ' . $dataelement->element->measurement_unit->abbreviation;
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

    public function registerlabor(Request $request)
    {
        // Obtén el ID de la unidad productiva seleccionada de la sesión
        $this->selectedUnitId = Session::get('selectedUnitId');

        // Obtener para Tipo de Movimiento
        $movementType = MovementType::select('id', 'consecutive')->where('name', '=', 'Movimiento Interno')->first();

        $ProductiveUnitWarehouses = Session::get('productiveunitwarehouseid');
        
        foreach ($ProductiveUnitWarehouses as $ProductiveUnitWarehouse) {
            $ProductiveUnitWarehousesId = $ProductiveUnitWarehouse->id;
        }
        
        // Obten los datos generales de la labor
        $lot = $request->input('lot');
        $date = $request->input('date');
        $productiveUnit = $request->input('productive_unit');
        $observation = $request->input('observation');
        $crop = $request->input('crop');
        $activity = $request->input('activity');
        $responsibility = $request->input('responsability');
        $sownArea = $request->input('sown_area');
        $destination = $request->input('destination');

        // Datos de ejecutores
        $executorIds = $request->input('executor-id');
        $employmentIds = $request->input('executor_employement-id');
        $executorQuantities = $request->input('executor_quantityhours');
        $executorPrices = $request->input('executor_priceemploye');

        // Datos de Herramientas
        $toolIds = $request->input('tool-id');
        $toolQuantities = $request->input('tool_quantity');
        $toolPrices = $request->input('tool_price');

        // Datos de Insumos
        $suppliesIds = $request->input('supplies-id');
        $suppliesQuantities = $request->input('supplies_quantity');
        $suppliesPrices = $request->input('supplies_price');
        $suppliesAplications = $request->input('application-method');
        $suppliesObjectives = $request->input('objective');

        // Datos de Maquinaria o Equipos
        $machineryIds = $request->input('machinery-id');
        $machineryWages = $request->input('machinery_wage');
        $machineryPrices = $request->input('machinery_price');

        // Datos Apecto ambiental
        $aspectoambiental = $request->input('aspectQuantities');
        
       
        

        // Datos de Produccion
        $unitreceive = $request->input('unit');
        $receivewarehouse = $request->input('warehouse');
        $deliverywarehouse = $request->input('deliverywarehouse');
        $productionIds = $request->input('production-id');
        $productionamounts = $request->input('production_amount');
        $productionexpirations = $request->input('production_expiration');
        $productionlots = $request->input('production_lot');

        

        // Inicializa el precio total en 0
        $totalPrice = 0;
        
        // Inicia una transacción de base de datos
        DB::beginTransaction();

        try {
            $laborId = null;
            $pricemanual = 0;
            // Registra la labor con el precio total calculado
            $labor = new Labor([
                'activity_id' => $activity,
                'person_id' => $responsibility,
                'planning_date' => $date,
                'execution_date' => $date,
                'description' => $observation,
                'price' => $pricemanual,
                'status' => 'Realizado',
                'observations' => $observation,
                'destination' => $destination,
            ]);

            // Guarda el nuevo registro en la base de datos
            $labor->save();
            $laborId = $labor->id;

            DB::table('crop_labors')->insert([
                'crop_id' => $crop,
                'labor_id' => $laborId,
            ]);


            if (!empty($aspectoambiental) && is_array($aspectoambiental) && count(array_filter($aspectoambiental)) > 0) {
                foreach ($aspectoambiental as $id => $amount) {
                    $price = 0;
                    $environmentalaspect = new EnvironmentalAspectLabor([
                        'environmental_aspect_id' => $id,
                        'labor_id' => $laborId,
                        'amount' => $amount,
                        'price' => $price,
                    ]);

                    // Guarda el nuevo registro en la base de datos
                    $environmentalaspect->save();
                    $environmentalaspectId = $environmentalaspect->id;
                }
                
            }

            if (!empty($productionIds) && is_array($productionIds) && count(array_filter($productionIds)) > 0) {

                $deliveryproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id', $deliverywarehouse)->where('productive_unit_id', $this->selectedUnitId)->first();
                $productiveWarehousedeliveryId = $deliveryproductive_warehouse->id;

                $receiveproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id', $receivewarehouse)->where('productive_unit_id', $unitreceive)->first();
                $productiveWarehousereceiveId = $receiveproductive_warehouse->id;

                $responsibilitys = ProductiveUnit::with('person')->where('id', $unitreceive)->first();

                if ($responsibilitys) {
                    $personid = $responsibilitys->person_id;
                    $people = $responsibilitys->person->first_name;
                    
                }

                //Registrar movimiento de produccion

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


                foreach ($productionIds as $index => $productionId) {
                    // Accede a los datos de cada elemento de la tabla
                    $productionamount = $productionamounts[$index];
                    $productionexpiration = $productionexpirations[$index];
                    $productionlot = $productionlots[$index];
                    
                    // Registra la labor con el precio total calculado
                    $production = new Production([
                        'labor_id' => $laborId,
                        'lot_number' => $productionlot,
                        'element_id' => $productionId,
                        'amount' => $productionamount,
                        'expiration_date' => $productionexpiration,
                        
                    ]);

                    // Guarda el nuevo registro en la base de datos
                    $production->save();
                    $productionsId = $production->id;
                    
                    $stock = 3;

                    $price = Element::where('id', $productionId)->value('price');
                    
                    
                    $newInventory = new Inventory([
                        'person_id' => $responsibility,
                        'productive_unit_warehouse_id' => $productiveWarehousedeliveryId,
                        'element_id' => $productionId,
                        'price' => $price,
                        'amount' => $productionamount,
                        'stock' => $stock,
                        'lot_number' => $productionlot ?: null,
                    ]);
            
                    $newInventory->save();
            
                    $InventoryId = $newInventory->id;

                    // Calcula el precio total para este elemento y agrégalo al precio total general
                    $totalPrice += ($productionamount * $price);
                
                    // Registrar detalle del movimiento para cada elemento
                    $movementDetails = new MovementDetail([
                        'movement_id' => $movementId, // Asociar al movimiento actual
                        'inventory_id' => $InventoryId, // Asociar al inventario actual
                        'amount' => $productionamount, // Cantidad del elemento actual
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
                        'person_id' => $responsibility,
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
            }
            

            if (!empty($executorIds) && is_array($executorIds) && count(array_filter($executorIds)) > 0) {
                foreach ($executorIds as $index => $executorId) {
                    // Accede a los datos de cada elemento de la tabla
                    $executorEmployment = $employmentIds[$index];
                    $executorQuantityhours = $executorQuantities[$index];
                    $executorPrice = $executorPrices[$index];

                    // Registra la labor con el precio total calculado
                    $executor = new Executor([
                        'labor_id' => $laborId,
                        'person_id' => $executorId,
                        'employee_type_id' => $executorEmployment,
                        'amount' => $executorQuantityhours,
                        'price' => $executorPrice,
                    ]);

                    // Guarda el nuevo registro en la base de datos
                    $executor->save();
                    $executorId = $executor->id;
                    // Sumar el precio de este ejecutor al precio total
                    $pricemanual += $executorPrice;
                }
            }

            if (!empty($toolIds) && is_array($toolIds) && count(array_filter($toolIds)) > 0) {
                foreach ($toolIds as $index => $toolId) {
                    // Accede a los datos de cada elemento de la tabla
                    $toolQuantitie = $toolQuantities[$index];
                    $toolPrice = $toolPrices[$index];

                    // Buscar si el elemento ya existe en 'inventories' de la unidad que entrega
                    $existingInventory = Inventory::where([
                        'id' => $toolId,
                    ])->first();

                    // Registra la labor con el precio total calculado
                    $tool = new Tool([
                        'labor_id' => $laborId,
                        'inventory_id' => $existingInventory->id,
                        'amount' => $toolQuantitie,
                        'price' => $toolPrice,
                    ]);

                    // Guarda el nuevo registro en la base de datos
                    $tool->save();
                    $toolId = $tool->id;
                    // Sumar el precio de esta herramienta al precio total
                    $pricemanual += $toolPrice;
                }
            }

            if (!empty($suppliesIds) && is_array($suppliesIds) && count(array_filter($suppliesIds)) > 0) {
                foreach ($suppliesIds as $index => $suppliesId) {
                    // Accede a los datos de cada elemento de la tabla
                    $suppliesQuantitie = $suppliesQuantities[$index];
                    $suppliesPrice = $suppliesPrices[$index];
                    $suppliesPrice = str_replace('.', '', $suppliesPrice);
                    $suppliesAplication = $suppliesAplications[$index];
                    $suppliesObjective = $suppliesObjectives[$index];

                    $existingInventory = Inventory::where([
                        'productive_unit_warehouse_id' => $ProductiveUnitWarehousesId,
                        'id' => $suppliesId,
                    ])->first();

                    if (!empty($suppliesAplications) && !empty($suppliesObjectives) && is_array($suppliesAplications) && is_array($suppliesObjectives) && count(array_filter($suppliesAplications)) > 0 && count(array_filter($suppliesObjectives)) > 0) {
                        // Registra la labor con el precio total calculado
                        $supplies = new Consumable([
                            'labor_id' => $laborId,
                            'inventory_id' => $existingInventory->id,
                            'amount' => $suppliesQuantitie,
                            'price' => $suppliesPrice,
                        ]);

                        // Guarda el nuevo registro en la base de datos
                        $supplies->save();
                        $supplieId = $supplies->id;
                        // Sumar el precio de este insumo al precio total
                        $pricemanual += $suppliesPrice;

                        $aplicationsupplies = new AgriculturalLabor([
                            'labor_id' => $laborId,
                            'application_method' => $suppliesAplication,
                            'objective' => $suppliesObjective,
                        ]);

                        // Guarda el nuevo registro en la base de datos
                        $aplicationsupplies->save();
                        $aplicationsuppliesId = $aplicationsupplies->id;

                        foreach ($existingInventory as $Inventory) {
                            $factor = $existingInventory->element->measurement_unit->conversion_factor;
                        }
                        $amountentero = $suppliesQuantitie * (int) $factor;
                        // Restar la cantidad solicitada del inventario existente
                        $existingInventory->amount -= $amountentero;
                        $existingInventory->save();
                        $existingInventoryId = $existingInventory->id;
                    } else {
                        // Registra la labor con el precio total calculado
                        $supplies = new Consumable([
                            'labor_id' => $laborId,
                            'inventory_id' => $existingInventory->id,
                            'amount' => $suppliesQuantitie,
                            'price' => $suppliesPrice,
                        ]);

                        // Guarda el nuevo registro en la base de datos
                        $supplies->save();
                        $supplieId = $supplies->id;
                        // Sumar el precio de este insumo al precio total
                        $pricemanual += $suppliesPrice;
                    }
                }
            }

            if (!empty($machineryIds) && is_array($machineryIds) && count(array_filter($machineryIds)) > 0) {
                foreach ($machineryIds as $index => $machineryId) {
                    // Accede a los datos de cada elemento de la tabla
                    $machineryWage = $machineryWages[$index];
                    $machineryPrice = $machineryPrices[$index];

                    
                    // Registra la labor con el precio total calculado
                    $machinery = new Equipment([
                        'labor_id' => $laborId,
                        'inventory_id' => $machineryId,
                        'amount' => $machineryWage,
                        'price' => $machineryPrice,
                    ]);

                    // Guarda el nuevo registro en la base de datos
                    $machinery->save();
                    $machineryId = $machinery->id;
                    // Sumar el precio de esta maquinaria o equipo al precio total
                    $pricemanual += $machineryPrice;
                }
            }

            // Después de calcular el precio total, asignarlo al campo 'price' de la labor
            $labor->price = $pricemanual;
            $labor->save();

            // Si todo está correcto, realiza un commit de la transacción
            DB::commit();

            // Después de realizar la operación de registro con éxito
            return redirect()
                ->route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.labormanagement.index')
                ->with('success', 'Labor Registrada');
        } catch (\Exception $e) {
            // En caso de error, realiza un rollback de la transacción y maneja el error
            DB::rollBack();
        
            \Log::error('Error en el registro: ' . $e->getMessage());
            \Log::error('Error en el registro: ' . $e->getTraceAsString());
        
            // O puedes redirigir a una página de error con un mensaje específico
            return redirect()
                ->route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.labormanagement.index')
                ->with('error', 'Error en el registro: ' . $e->getMessage());
        }
    }

    public function activityproduct(Request $request)
    {
        // Realizar la consulta para obtener la actividad seleccionada
        $selectedActivity = Activity::find($request->input('activity'));

        // Verificar si el tipo de actividad es "Produccion"
        if ($selectedActivity && $selectedActivity->activity_type->name == 'Producción') {
            // La condición se cumple
            $resultado = 'La actividad es de tipo Produccion';
        } else {
            // La condición no se cumple
            $resultado = 'La actividad no es de tipo Produccion';
        }

        // Devolver el resultado en formato JSON
        return response()->json($resultado);
    }

    public function getWarehouses(Request $request)
    {
        // Obtén el ID de la unidad productiva seleccionada desde la solicitud AJAX
        $selectedUnitId = $request->input('unit');

        // Inicializa la variable para las bodegas filtradas
        $filteredWarehouses = null;

        // Verifica si se ha seleccionado una unidad productiva
        if ($selectedUnitId) {
            // Realiza una consulta para obtener todas las bodegas relacionadas con la unidad productiva seleccionada
            $filteredWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)
                ->with('warehouse') // Cargar la relación 'warehouse' para evitar consultas adicionales
                ->get();

            // Mapea los resultados a un formato adecuado
            $filteredWarehouses = $filteredWarehouses->map(function ($warehouseRelation) {
                $warehouse = $warehouseRelation->warehouse;
                return [
                    'id' => $warehouse->id,
                    'name' => $warehouse->name,
                ];
            });
        }

        return response()->json([
            'filteredWarehouses' => $filteredWarehouses
        ]);
    }   

    public function obtenerAspectosAmbientales(Activity $activity)
    {
        $aspectosAmbientales = $activity->environmental_aspects()->pluck('environmental_aspects.name', 'environmental_aspects.id');

        return response()->json($aspectosAmbientales);
    }

    public function mostrarAspectosAmbientales()
    {
        return view('agrocefa::labormanagement.component.aspectosambientales');
    }

    
}
