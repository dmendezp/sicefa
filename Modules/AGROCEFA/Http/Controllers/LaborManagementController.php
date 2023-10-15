<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Responsibility;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Labor;
use Modules\AGROCEFA\Entities\Executor;
use Modules\AGROCEFA\Entities\EmployementType;
use Modules\AGROCEFA\Entities\Tool;
use Modules\AGROCEFA\Entities\Crop;
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

        $employes = EmployementType::get();

        // ---------------- Filtro para las Elementos -----------------------

        // Obtener el ID de la unidad productiva seleccionada (asumiendo que lo tienes en sesión)
        $selectedUnitId = Session::get('selectedUnitId');

        // Obtén los registros de productive_unit_warehouse que coinciden con la unidad productiva seleccionada
        $ProductiveUnitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->get();

        // Obtener los registros de 'productive_unit_warehouses' que coinciden con la unidad productiva seleccionada
        $unitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnitId)->pluck('id');

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
                $query->where('name', 'Maquinaria');
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
    
        $persons = Person::where('document_number', 'like', '%' . $term . '%')->get();
    
        $results = [];
        foreach ($persons as $person) {
            $results[] = [
                'id' => $person->id,
                'text' => $person->first_name . ' ' .  $person->first_last_name,
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
            $lots = Environment::with('crops')
                ->where('id', $lotid)
                ->first();

            $cropData = []; // Array para almacenar los datos de las personas

            if ($lots) {
                foreach ($lots->crops as $crop) {
                    // Agregar los datos de la persona al array si existe
                    if ($crop) {
                        $cropData[] = [
                            'id' => $crop->id,
                            'name' => $crop->name,
                            'sown_area' => $crop->sown_area, // Agrega el sown_area al arreglo
                        ];
                    }
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
                ->whereHas('element.category', function ($query) use ($categoryId) {
                    $query->where('id', $categoryId);
                })
                ->get();

            if ($inventory) {
                // Mapear los datos para incluir ID y nombre del elemento
                $elementsData = $inventory->map(function ($item) {
                    return [
                        'id' => $item->element->id,
                        'name' => $item->element->name,
                        'price' => $item->element->price,
                        'amount' => $item->element->amount,
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
            $employeData = EmployementType::where('id', $employee)->first();
            
            if ($employeData) {
                $price = $employeData->price;


                return response()->json([
                    'price' => $price

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
            $dataelement = Inventory::where('element_id', $elementId)->first();

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

    public function registerlabor(Request $request)
    {
        
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

        // Inicia una transacción de base de datos
        DB::beginTransaction();

        try {
            $laborId = null; 

            // Registra la labor con el precio total calculado
            $labor = new Labor([
                'activity_id' => $activity,
                'person_id' => $responsibility,
                'planning_date' => $date,
                'execution_date' => $date,
                'description' => $observation,
                'status' => 'Realizado',
                'observations' => $observation,
                'destination' => $destination,
            ]);

            // Guarda el nuevo registro en la base de datos
            $labor->save();
            $laborId = $labor->id;

            DB::table('crop_labor')->insert([
                'crop_id' => $crop,
                'labor_id' => $laborId,
                
            ]);
            

            foreach ($executorIds as $index => $executorId) {
                // Accede a los datos de cada elemento de la tabla
                $executorEmployment = $employmentIds[$index];
                $executorQuantityhours = $executorQuantities[$index];
                $executorPrice = $executorPrices[$index];

            
                // Registra la labor con el precio total calculado
                $executor = new Executor([
                    'labor_id' => $laborId,
                    'person_id' => $executorId,
                    'employement_type_id' => $executorEmployment,
                    'amount' => $executorQuantityhours,
                    'price' => $executorPrice,
                ]);

                // Guarda el nuevo registro en la base de datos
                $executor->save();
                $executorId = $executor->id;
            }

            // Si todo está correcto, realiza un commit de la transacción
            DB::commit();

            // Después de realizar la operación de registro con éxito
            return redirect()->route('agrocefa.culturalwork')->with('success', 'El registro se ha completado con éxito.');

        } catch (\Exception $e) {
            // En caso de error, realiza un rollback de la transacción y maneja el error
            DB::rollBack();

            \Log::error('Error en el registro: ' . $e->getMessage());
        }
    }


}
