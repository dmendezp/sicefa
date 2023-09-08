<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Intern;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DataTables;
use Illuminate\Support\Facades\DB; // Corregido el uso de 'Supoport' a 'Support'
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Element;

class WarehouseController extends Controller
{

    public $app_puw;

    public function getAppPuw()

            { 
                  if (!$this->app_puw){
                  $title='consulta';
                      $productiveUnit = ProductiveUnit::where('name','Agroindustria')->firstOrFail();
                      $Warehouses = Warehouse::where('name','agroindustria')->firstOrFail();
                      $this->app_puw= ProductiveUnitWarehouse::where('productive_unit_id', $productiveUnit->id)->where('warehouse_id' , $Warehouses->id)->firstOrFail();
                  } 
                  return $this->app_puw;
            }
            


    public function inventory()

            { //listado de inventario 
                    $title = 'inventory';
                    $inventories = Inventory::where('productive_unit_warehouse_id', $this->getAppPuw()->id)
                    ->orderBy('updated_at','DESC')
                    ->get();

                    return view('agroindustria::storer.inventory', compact('title', 'inventories'));
            }







}
       
                  
/* $title = 'BodeagUnidad';

    // Obtener el ID del almacén llamado "agroindustria"
    $warehouseId = Warehouse::where('name' ,'=', 'agroindustria')->pluck(z'id')->first();

    // Obtener una lista de IDs de unidades productivas asociadas a ese almacén
    $productiveUnitWarehouses = ProductiveUnitWarehouse::where('warehouse_id', $warehouseId)->pluck('id');


    return view('agroindustria::storer.inventory', compact('title', 'productiveUnitWarehouses'));
  */

                    
        
                               
                    
                            

                   
        


