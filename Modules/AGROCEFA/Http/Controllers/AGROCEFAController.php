<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
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
class AGROCEFAController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    // Verifica si el usuario está autenticado
    public function index()
    {
        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            // Obtiene el usuario autenticado
            $user = Auth::user();

            // Verifica si el usuario tiene roles de "Administrador" o "Pasante"
            if ($user->roles->contains('name', 'Administrador') || $user->roles->contains('name', 'Pasante')) {
                // Obtiene las responsabilidades relacionadas con los roles del usuario
                $responsibilities = $user->roles->flatMap(function ($role) {
                    return $role->responsibilities->pluck('activity_id');
                });
                
                // Obtiene los IDs de las unidades productivas basadas en las actividades
                $units = Activity::whereIn('id', $responsibilities)
                                ->pluck('productive_unit_id');

                // Obtiene las unidades productivas a partir de los IDs obtenidos
                $productiveUnits = ProductiveUnit::whereIn('id', $units)
                                                ->get();

                // Obtiene el ID de la unidad seleccionada desde la sesión
                $selectedUnitId = Session::get('selectedUnitId');

                // Retorna la vista 'homeproductive_units' con datos de unidades y la unidad seleccionada
                return view('agrocefa::homeproductive_units', [
                    'units' => $productiveUnits,
                    'selectedUnitId' => $selectedUnitId, // Pasar el ID de unidad seleccionado a la vista
                ]);
            }
        } else {
            // Si el usuario no está autenticado, muestra la vista 'homeproductive_units' sin datos especiales
            return view('agrocefa::home');
        }
    }


    public function selectUnit($id)
    {


        // Actualiza la variable de sesión con el nuevo ID de unidad seleccionado
        Session::put('selectedUnitId', $id);
        $unit = ProductiveUnit::find($id);

        // Verifica si se encontró la unidad
        if (!$unit) {
            // Maneja la situación en la que no se encuentra la unidad
            return redirect()->route('agrocefa.home')->with('error', 'La unidad productiva no se encontró');
        }
    
        // Obtén el nombre de la unidad
        $unitName = $unit->name;
    
        Session::put('selectedUnitName', $unitName);

        // Redirige a la vista de inicio con el ID de unidad seleccionado
        return redirect()->route('agrocefa.home');
    }


    public function home()
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
 
         $receiveproductive_warehouse = ProductiveUnitWarehouse::where('warehouse_id', $warehousereceive)->where('productive_unit_id', $this->selectedUnitId)->first();
         $productiveWarehousereceiveId = $receiveproductive_warehouse->id;
 
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
        // Retornar la vista deseada
        return view('agrocefa::home', [
            'selectedUnitName' => $selectedUnitName,
            'notification' => $movementsCount,
        ]);
    }


    public function movements()
    {   
        return view('agrocefa::movements');
    }


    public function insumos()
    {
        return view('agrocefa::insumos');
    }


    public function bodega()
    {
        return view('agrocefa::formulariocultivo');
    }


    public function inventory()
    {
        return view('agrocefa::inventory');
    }


    public function parameters()
    {
        return view('agrocefa::parameters');
    }


    public function vistaaprendiz()
    {
        return view('agrocefa::index');
    }

    
    public function vistauser()
    {
        return view('agrocefa::index');
    }

    public function crop()
    {
        return view('agrocefa::crop');
    }




}
