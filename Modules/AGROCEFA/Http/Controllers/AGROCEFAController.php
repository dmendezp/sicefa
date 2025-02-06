<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Activity;
use Spatie\Permission\Models\Role;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\WarehouseMovement;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Inventory;
class AGROCEFAController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        return view('agrocefa::home');
    }
    
    // Verifica si el usuario está autenticado
    public function trainer_passant()
    {
        // Limpiar la variable 'selectedUnitName'
        Session::forget('selectedUnitName');

        // Limpiar la variable 'notification'
        Session::forget('notification');

        // Limpiar la variable 'notificationstock'
        Session::forget('notificationstock');

        // Limpiar la variable 'selectedRole'
        Session::forget('selectedRole');

        $unitIds = [];

        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            // Obtiene el usuario autenticado
            $user = Auth::user();

            // Obtén el ID del rol del usuario
            $productive_units_role = $user
                ->roles()
                ->with('productive_units')
                ->get();

            // Recorre la colección de roles
            foreach ($productive_units_role as $role) {
                // Accede a la relación "productive_units" en cada rol
                $productiveUnits = $role->productive_units;

                // Recorre las unidades productivas y agrega sus IDs al array
                foreach ($productiveUnits as $unit) {
                    $unitIds[] = $unit->id;
                }
            }

            // Variable para verificar el acceso completo
            $hasFullAccess = false;

            // Recorre la colección de roles
            foreach ($productive_units_role as $role) {
                // Verifica si el rol tiene el atributo 'full_access'
                if ($role->full_access === 'Si' || $role->slug === 'agrocefa.manageragricultural') {
                   
                    $hasFullAccess = true;
                    break; // Rompe el bucle si se encuentra un rol con acceso completo
                }

            }
            
            if($hasFullAccess === true )
            {
                $productiveUnits = ProductiveUnit::get();
            }
            else {
                $productiveUnits = ProductiveUnit::whereIn('id', $unitIds)->get();
            }

            

            return view('agrocefa::homeproductive_units', [
                'units' => $productiveUnits,
            ]);
        }

        // Si el usuario no está autenticado, muestra la vista 'homeproductive_units' sin datos especiales
        return view('agrocefa::usuario.index');
    }

    public function selectUnit($id)
    {
        // Actualiza la variable de sesión con el nuevo ID de unidad seleccionado
        Session::put('selectedUnitId', $id);

        $units = ProductiveUnit::with('roles')
            ->where('id', $id)
            ->get();

        // Recorre la colección de roles
        foreach ($units as $unit) {
            // Accede a la relación "productive_units" en cada rol
            $roles = $unit->roles;
            $unitName = $unit->name;
            $unitId = $unit->id;
        }

            // Obtiene el usuario autenticado
        $user = Auth::user();

        if ($user) {
            // Obtiene los roles del usuario
            $roles = $user->roles;

            // Puedes recorrer los roles si un usuario puede tener varios roles
            foreach ($roles as $role) {
                $roleName = $role->name;

                // Hacer lo que necesites con el nombre del rol
            }
        }

        // Verifica si se encontró la unidad
        if (!$unitId) {
            // Maneja la situación en la que no se encuentra la unidad
            return redirect()
                ->route('agrocefa:home')
                ->with('error', 'La unidad productiva no se encontró');
        }

        Session::put('selectedUnitName', $unitName);

        Session::put('selectedRole', $roleName);


        // Consulta de stock minimo
        $this->notificationmovement();

        // Consulta de stock minimo
        $this->notificationstock();

        $this->selectedUnitId = Session::get('selectedUnitId');

        $selectedUnit = ProductiveUnit::find($this->selectedUnitId);

        // Obtener el nombre de la unidad a través del modelo ProductiveUnit
        $selectedUnitName = ProductiveUnit::where('id', $this->selectedUnitId)->value('name');
        // Retornar la vista deseada
        return view('agrocefa::home', [
            'selectedUnitName' => $selectedUnitName,
        ]);

        // Redirige a la vista de inicio con el ID de unidad seleccionado
        return redirect()->route('cefa.agrocefa.home');
    }

    public function movements()
    {
        return view('agrocefa::movements');
    }
    public function notificationmovement()
    {
        $this->selectedUnitId = Session::get('selectedUnitId');

        $selectedUnit = ProductiveUnit::find($this->selectedUnitId);

        // Obtener el nombre de la unidad a través del modelo ProductiveUnit
        $selectedUnitName = ProductiveUnit::where('id', $this->selectedUnitId)->value('name');

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

        $receiveproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id', $warehousereceive)
            ->where('productive_unit_id', $this->selectedUnitId)
            ->first();
        $productiveWarehousereceiveId = $receiveproductive_warehouse->id;

        $warehousemovementid = WarehouseMovement::where('productive_unit_warehouse_id', $productiveWarehousereceiveId)
            ->where('role', '=', 'Recibe')
            ->get()
            ->pluck('movement_id');

        $movements = Movement::whereIn('id', $warehousemovementid)
            ->where('state', '=', 'Solicitado')
            ->with('movement_type', 'movement_responsibilities.person', 'movement_details.inventory.element', 'warehouse_movements.productive_unit_warehouse.productive_unit', 'warehouse_movements.productive_unit_warehouse.warehouse')
            ->get()
            ->toArray();
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
                            'price' => $price,
                            'state' => $state,
                            'inventory_id' => $inventoryId,
                            'element_id' => $elementid,
                            'destination' => $destination,
                            'person_id' => $person_id,
                            'lot' => $lot,
                            // Agrega aquí otros datos que necesites
                        ];
                }
                
            }
        }

        // Contar el número de registros después de obtener los datos
        $movementsCount = count($datas);

        Session::put('notification', $movementsCount);
    }
    public function notificationstock()
    {
        $this->selectedUnitId = Session::get('selectedUnitId');
        // Notificacion de bajas
        $selectedUnit = ProductiveUnit::find($this->selectedUnitId);

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
        $stockCount = count($datas);


        Session::put('notificationstock', $stockCount);
    }

    public function bodega()
    {
        return view('agrocefa::formulariocultivo');
    }

    public function vistauser()
    {
        return view('agrocefa::index');
    }

    public function Manual()
    {
        $rutaPdf = public_path('modules\agrocefa\Manual de usuario - AGROCEFA.pdf');

        $nombreArchivo = 'Manual de usuario - AGROCEFA.pdf';

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return Response::download($rutaPdf, $nombreArchivo, $headers);

    }
}
