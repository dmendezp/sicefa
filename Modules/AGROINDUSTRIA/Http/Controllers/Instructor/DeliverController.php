<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\instructor;

use Modules\AGROINDUSTRIA\Http\Controllers\AGROINDUSTRIAController;
use Modules\SICA\Entities\ProductiveUnit;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\WarehouseMovement;
use Illuminate\Support\Facades\Auth;


class DeliverController extends Controller
{
    private $title;
    private $idProductiveUnitWarehouse;
    private $warehouseDeliver;
    private $warehouseReceive;
    private $elements;

    public function deliveries()
    {
        $this->title = 'Entregas';

        //Bodega que entrega
        $result = app(AGROINDUSTRIAController::class)->unidd();
        $warehouses = $result['warehouses'];        
        $this->warehouseDeliver = $warehouses->map(function ($w) use (&$warehouseId) {
            $warehouseId = $w->id;
            $warehouseName = $w->name;

            return [
                'id' => $warehouseId,
                'name' => $warehouseName,
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una Bodega'])->pluck('name', 'id');

        //Bodega que recibe
        $this->warehouseReceive = Warehouse::pluck('name','id');

        $ProductiveUnitWarehouse = ProductiveUnitWarehouse::where('warehouse_id', $warehouseId)
        ->get();
    
        $this->idProductiveUnitWarehouse = $ProductiveUnitWarehouse->pluck('id');


        $inventories = Inventory::with('element')
        ->whereIn('productive_unit_warehouse_id', $this->idProductiveUnitWarehouse)->get();

        $this->elements = $inventories->map(function ($inventory) {
            $elementId = $inventory->element->id;
            $elementName = $inventory->element->name;

            return [
                'id' => $elementId,
                'name' => $elementName
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un producto'])->pluck('name', 'id');

        $data = [
            'title' => $this->title,
            'productiveUnitWarehouse' => $this->idProductiveUnitWarehouse,
            'warehouseDeliver' => $this->warehouseDeliver,
            'warehouseReceive' => $this->warehouseReceive,
            'elements' => $this->elements,
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
    
    public function createMoveOut(Request $request){

        $rules=[
            'deliver_warehouse' => 'required',
            'receive_warehouse' => 'required',
            'element' => 'required',
            'amount' => 'required'
        ];

        $messages = [
            'deliver_warehouse.required' => trans('agroindustria::menu.You must select a delivery warehouse'),
            'receive_warehouse.required' => trans('agroindustria::menu.You must select the winery that receives'),
            'element.required' => trans('agroindustria::menu.You must select an item'),
            'amount.required' => trans('agroindustria::menu.You must enter an amount')
        ];

        $validatedData = $request->validate($rules, $messages);
 
        //Se trae el id de la persona logueada para registrar el responsable
        $idPersona = null;
         $user = Auth::user();
         if ($user->person) {
             $idPersona = $user->person->id;
         }

        //Consulta el tipo de movimiento con el id 2 que es Movimiento Interno
        $movementType = MovementType::find(2);

        //Trae la cantidad ingresada y el precio del inventario
        $amounts = $validatedData['amount'];
        $prices = $request->input('price');
        $totalPrice = 0;

        //Multiplicacion entre la cantidad ingresada y el precio
        foreach ($amounts as $key => $amount){
            
            $a = $amount;
            $p = $prices[$key];

            $priceMovement = $a*$p;
            $totalPrice += $priceMovement;
        }

        //Registra el movimiento
        $mo = new Movement;
        $mo->registration_date = $request->input('date');
        $mo->movement_type_id = $movementType->id;
        $mo->voucher_number = $movementType->consecutive;
        $mo->price = $totalPrice;
        $mo->observation = $request->input('observation');
        $mo->state = 'Solicitado';

        $mo->save();
        
        //Consulta el elemento seleccionado
        $selectedElementId = $validatedData['element'];


        $puw = json_decode($request->input('productiveUnitWarehouse'));
        
        // Encontrar el inventario correspondiente a ese elemento
        $inventories = Inventory::whereIn('element_id', $selectedElementId)
        ->whereIn('productive_unit_warehouse_id', $puw)
        ->pluck('id');
    
        //Registra Detalles del Movimiento
        foreach ($amounts as $key => $amount){
            $detail = new MovementDetail;
            $detail->movement_id = $mo->id;
            $detail->inventory_id = $inventories[$key];
            $detail->amount = $amount;
            $detail->price = $prices[$key];


            $mo->movement_details()->save($detail);
        }

        //Registra Responsable del Movimiento
        $mr = new MovementResponsibility;
        $mr->person_id = $idPersona;
        $mr->movement_id = $mo->id;
        $mr->role = 'ENTREGA';
        $mr->date = $request->input('date');
        $mr->save();

        //Registro del WarehouseMovement (entrega)
        $wm = new WarehouseMovement;
        $wm->warehouse_id = $validatedData['deliver_warehouse'];
        $wm->movement_id = $mo->id;
        $wm->role = 'Entrega';
        $wm->save();

        $wm = new WarehouseMovement;
        $wm->warehouse_id = $validatedData['receive_warehouse'];
        $wm->movement_id = $mo->id;
        $wm->role = 'Recibe';

        $wm->save();

        $data = [
            'title' => $this->title,
            'productiveUnitWarehouse' => $this->idProductiveUnitWarehouse,
            'warehouseDeliver' => $this->warehouseDeliver,
            'warehouseReceive' => $this->warehouseReceive,
            'elements' => $this->elements,
        ];

        return redirect()->route('cefa.agroindustria.instructor.movements');

    }

}
