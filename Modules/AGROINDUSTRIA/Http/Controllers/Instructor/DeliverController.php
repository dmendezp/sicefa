<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\instructor;

use Modules\AGROINDUSTRIA\Http\Controllers\AGROINDUSTRIAController;
use Modules\SICA\Entities\ProductiveUnit;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementResponsability;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\WarehouseMovement;

class DeliverController extends Controller
{
    private $idProductiveUnitWarehouse;
    public function deliveries()
    {
        $title = 'Entregas';

        //Bodega que entrega
        $result = app(AGROINDUSTRIAController::class)->unidd();
        $warehouses = $result['warehouses'];        
        $warehouseDeliver = $warehouses->map(function ($w) use (&$warehouseId) {
            $warehouseId = $w->id;
            $warehouseName = $w->name;

            return [
                'id' => $warehouseId,
                'name' => $warehouseName,
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una Bodega'])->pluck('name', 'id');

        //Bodega que recibe
        $warehouseReceive = Warehouse::pluck('name','id');

        $ProductiveUnitWarehouse = ProductiveUnitWarehouse::where('warehouse_id', $warehouseId)
        ->get();
    
        $this->idProductiveUnitWarehouse = $ProductiveUnitWarehouse->pluck('id');

        $inventories = Inventory::with('element')
        ->whereIn('productive_unit_warehouse_id', $this->idProductiveUnitWarehouse)->get();

        $elements = $inventories->map(function ($inventory) {
            $elementId = $inventory->element->id;
            $elementName = $inventory->element->name;

            return [
                'id' => $elementId,
                'name' => $elementName
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un producto'])->pluck('name', 'id');

        $data = [
            'title' => $title,
            'warehouseDeliver' => $warehouseDeliver,
            'warehouseReceive' => $warehouseReceive,
            'elements' => $elements,
        ];

        return view('agroindustria::instructor.deliveries', $data);
    }

    public function priceInventory($id){    
        // Asegúrate de que $id sea un arreglo
        if (!is_array($id)) {
            $id = [$id];
        }
    
        $inventory = Inventory::whereIn('element_id', $id)->get(['amount', 'price']);
    
        return response()->json(['id' => $inventory]);
    }
    
    public function createMoveOut(Request $requst){

        $movementType = MovementType::find(2);

        $mo = new Movement;
        $mo->registration_date = $requst->input('date');
        $mo->movement_type_id = $movementType->id;
        $mo->voucher_number = $movementType->consecutive;
        $mo->save();

        $amounts = $request->input('amount');
        $prices = $request->input('price');

        $totalPrice = 0;
        $selectedElementId = $request->input('element')[$key];

        // Encontrar el inventario correspondiente a ese elemento
        $inventory = Inventory::where('element_id', $selectedElementId)
            ->where('productive_unit_warehouse_id', $this->idProductiveUnitWarehouse)
            ->first();


        foreach ($amounts as $key => $amount){
            $detail = new MovementDetail;

            $detail->movement_id = $mo->id;
            $detail->inventory_id = $inventory->id;
        }

    }

}
