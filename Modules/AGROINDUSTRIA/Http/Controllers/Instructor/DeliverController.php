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

use Validator, Str;


class DeliverController extends Controller
{
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
        })->prepend(['id' => null, 'name' => trans('agroindustria::menu.Select a winery')])->pluck('name', 'id');

        //Bodega que recibe
        $warehouseReceive = Warehouse::pluck('name','id');

        $ProductiveUnitWarehouse = ProductiveUnitWarehouse::where('warehouse_id', $warehouseId)
        ->get();
    
        $idProductiveUnitWarehouse = $ProductiveUnitWarehouse->pluck('id');


        $inventories = Inventory::with('element')
        ->whereIn('productive_unit_warehouse_id', $idProductiveUnitWarehouse)->get();

        $elements = $inventories->map(function ($inventory) {
            $elementId = $inventory->element->id;
            $elementName = $inventory->element->name;

            return [
                'id' => $elementId,
                'name' => $elementName
            ];
        })->prepend(['id' => null, 'name' => trans('agroindustria::menu.Select a product')])->pluck('name', 'id');

        $data = [
            'title' => $title,
            'productiveUnitWarehouse' => $idProductiveUnitWarehouse,
            'warehouseDeliver' => $warehouseDeliver,
            'warehouseReceive' => $warehouseReceive,
            'elements' => $elements,
        ];

        return view('agroindustria::instructor.movements.deliveries', $data);
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

        Validator::extend('at_least_one_element', function ($attribute, $value, $parameters, $validator) use ($request) {
            $elements = $request->input('element');
            return !empty($elements);
        });

        $rules=[
            'deliver_warehouse' => 'required',
            'receive_warehouse' => 'required',
            'element' => 'required|at_least_one_element',
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
        $available = $request->input('available');
        $totalPrice = 0;

        //Multiplicacion entre la cantidad ingresada y el precio
        foreach ($amounts as $key => $amount){   
            if($amount > $available[$key]){
                return back()->with('icon', 'error')
                ->with('message_line', trans('agroindustria::menu.Quantity entered is greater than inventory quantity'));
            }else{   
                $a = $amount;
                $p = $prices[$key];

                $priceMovement = $a*$p;
                $totalPrice += $priceMovement;   
            }   
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
        foreach ($amounts as $key => $amount) {
            if (empty($amount) || $amount <= 0) {
                return back()
                    ->withInput()
                    ->with('icon', 'error')
                    ->with('message_line', trans('agroindustria::menu.You must enter an amount'));
            } elseif ($amount > $available[$key]) {
                return back()
                    ->withInput()
                    ->with('icon', 'error')
                    ->with('message_line', trans('agroindustria::menu.Quantity entered is greater than inventory quantity'));
            } else {
                $detail = new MovementDetail;
                $detail->movement_id = $mo->id;
        
                // Verificar si $inventories[$key] existe antes de asignarlo
                if (isset($inventories[$key])) {
                    $detail->inventory_id = $inventories[$key];
                } else {
                    // Manejar el caso en el que $inventories[$key] no existe
                    // Puedes agregar una acción aquí, como mostrar un mensaje de error o realizar alguna otra lógica personalizada.
                    // Por ejemplo:
                    return back()
                        ->withInput()
                        ->with('icon', 'error')
                        ->with('message_line', trans('agroindustria::menu.You must select an item'));
                }
        
                $detail->amount = $amount;
                $detail->price = $prices[$key];
                $mo->movement_details()->save($detail);
            }
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

        if($wm->save()){
            $icon = 'success';
            $message_line = trans('agroindustria::menu.Successful check out');
        }else{
            $icon = 'error';
            $message_line = trans('agroindustria::menu.Check out error');
        }

        return redirect()->route('cefa.agroindustria.instructor.movements')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]);

    }

}
