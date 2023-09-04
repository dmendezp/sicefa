<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Responsibility;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Role;
use App\Models\User;


class MovementController extends Controller
{
    private $selectedUnitId ;
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
            $elements = Element::with('measurement_unit')
            ->get()
            ->map(function ($element) {
                return [
                    'name' => $element->name,
                    'measurement_unit' => $element->measurement_unit->name
                ];
            })
            ->unique('name') // Asegura que los nombres de los elementos sean únicos
            ->pluck('measurement_unit', 'name');


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

    public function registerentrance (Request $request)
    {
        // Obtener los datos del formulario
        $date = $request->input('date');
        $user_id = $request->input('user_id');
        $deliverywarehouse = $request->input('deliverywarehouse');
        $receivewarehouse = $request->input('receivewarehouse');

        // Obtener los datos de la tabla dinámica
        $products = $request->input('products'); // Cambia 'products' al nombre correcto

        // Verificar si $products no es null y es un array
        if (!is_null($products) && is_array($products)) {
            // Ahora puedes recorrer los productos y procesar cada uno
            foreach ($products as $product) {
                $productName = $product['product-name'];
                $measurementUnit = $product['product-measurement-unit'];
                $quantity = $product['product-quantity'];
                $price = $product['product-price'];
                $category = $product['product-category'];


                // Construye un arreglo asociativo con los datos que deseas mostrar
                $responseData = [
                    'date' => $date,
                    'user_id' => $user_id,
                    'deliverywarehouse' => $deliverywarehouse,
                    'receivewarehouse' => $receivewarehouse,
                    'products' => $products, // Esto incluye todos los productos
                ];

        // Devuelve los datos en formato JSON
        return view('agrocefa::movements.prueba', ['responseData' => $datosJSON]);
                // Realiza aquí la lógica para guardar estos datos en la base de datos
                // Por ejemplo, puedes crear un nuevo registro en una tabla de productos
                // con los datos obtenidos.
            }

            // Si llegas a este punto, significa que se procesaron todos los productos correctamente.
            // Puedes realizar cualquier otra acción necesaria aquí.
        } else {
            // Manejo de caso en el que $products es null o no es un array
            
            // Puedes agregar un mensaje de error o realizar las acciones apropiadas.
        }

        
    }
    public function obtenerUnidadDeMedida(Request $request) 
    {
        try {
            $element = $request->input('element');
            
            // Realiza la lógica para obtener la unidad de medida del elemento
            $unidadMedida = Element::with('measurement_unit')
                ->where('name', $element) // Filtra por el nombre del elemento específico
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
                ->where('name', $element) // Filtra por el nombre del elemento específico
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
            $elements = Element::with('measurement_unit')
            ->get()
            ->map(function ($element) {
                return [
                    'name' => $element->name,
                    'measurement_unit' => $element->measurement_unit->name
                ];
            })
            ->unique('name') // Asegura que los nombres de los elementos sean únicos
            ->pluck('measurement_unit', 'name');


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
