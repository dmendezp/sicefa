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
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Validator, Str;


class DeliverController extends Controller
{
    private $receiveOptions = [
        'aprobado' => 'Aprobado',
        'devuelto' => 'Devuelto',
        // Agrega más opciones según tus necesidades
    ];

    public function deliveries()
    {
        $title = 'Entregas';

        $user = Auth::user();
        if ($user->person) {
            $idPersona = $user->person->id;
        }
        

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


        //Consulta la unidad productiva segun el id de la bodega relacionada
        $ProductiveUnitWarehouse = ProductiveUnitWarehouse::where('warehouse_id', $warehouseId)
        ->get();
        $idProductiveUnitWarehouse = $ProductiveUnitWarehouse->pluck('id');
    

        //Consulta el inventario que pertenece a la bodega de esa unidad productiva
        $inventories = Inventory::with('element')
        ->whereIn('productive_unit_warehouse_id', $idProductiveUnitWarehouse)->get();
        //Filtra los elementos de ese inventario
        $elements = $inventories->map(function ($inventory) {
            $elementId = $inventory->element->id;
            $elementName = $inventory->element->name;

            return [
                'id' => $elementId,
                'name' => $elementName
            ];
        })->prepend(['id' => null, 'name' => trans('agroindustria::menu.Select a product')])->pluck('name', 'id');

        //Consulta los lideres de las unidades productivas
        $people = User::whereNotNull('person_id')->pluck('person_id');
        $productiveUnitPeople = ProductiveUnit::with('person')->whereIn('person_id', $people)->get();
        $receive = $productiveUnitPeople->map(function ($productiveUnitPerson) {
            $personId = $productiveUnitPerson->person->id;
            $personName = $productiveUnitPerson->person->first_name . ' ' . $productiveUnitPerson->person->first_last_name . ' ' . $productiveUnitPerson->person->second_last_name;

            return [
                'id' => $personId,
                'name' => $personName
            ];
        })->prepend(['id' => null, 'name' => trans('agroindustria::menu.Select a receiver')])->pluck('name', 'id');

        //Consulta los movimientos del responsable con el rol de ENTREGA
        $idMovements = Movement::pluck('id');
        $movements = Movement::with(['movement_details.inventory.element', 'movement_responsibilities.person', 'movement_type', 'warehouse_movements'])
        ->whereHas('movement_responsibilities', function ($query) use ($idPersona) {
            $query->where('person_id', $idPersona)
                  ->where('role', 'ENTREGA');
        })->orderByRaw("
        CASE
            WHEN state = 'Solicitado' THEN 1
            ELSE 2
        END")->get();
        

        $data = [
            'title' => $title,
            'productiveUnitWarehouse' => $idProductiveUnitWarehouse,
            'warehouseDeliver' => $warehouseDeliver,
            'elements' => $elements,
            'receive' => $receive,
            'movements' => $movements,
            'receiveOptions' => $this->receiveOptions
        ];

        return view('agroindustria::instructor.movements.deliveries', $data);
    }

    public function warehouseReceive($idPerson){    
        // Asegúrate de que $id sea un arreglo
        if (!is_array($idPerson)) {
            $idPerson = [$idPerson];
        }
        

        $warehouseReceives = ProductiveUnitWarehouse::with('warehouse')
        ->whereHas('productive_unit', function($query) use ($idPerson){
            $query->where('person_id', $idPerson);
        })->get();

        $warehouse = $warehouseReceives->map(function ($w){
            $id = $w->warehouse->id;
            $name = $w->warehouse->name;

            return[
                'id' => $id,
                'name' => $name
            ];
        });
    
        return response()->json(['id' => $warehouse]);
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
            'receive' => 'required',
            'deliver_warehouse' => 'required',
            'receive_warehouse' => 'required',
            'element' => 'required|at_least_one_element',
            'amount' => 'required'
        ];

        $messages = [
            'receive.required' => trans('agroindustria::menu.You must select a receiver'),
            'deliver_warehouse.required' => trans('agroindustria::menu.You must select a delivery warehouse'),
            'receive_warehouse.required' => trans('agroindustria::menu.You must select the winery that receives'),
            'element.required' => trans('agroindustria::menu.You must select an item'),
            'amount.required' => trans('agroindustria::menu.You must enter an amount')
        ];

        $validatedData = $request->validate($rules, $messages);
 
        //Se trae el id de la persona logueada para registrar el responsable
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
                    return back()
                        ->withInput()
                        ->with('icon', 'error')
                        ->with('message_line', trans('agroindustria::menu.You must select an item'));
                }
                if($amount<=0){
                    return back()
                    ->withInput()
                    ->with('icon', 'error')
                    ->with('message_line', trans('agroindustria::menu.You must enter an amount'));
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

        $mr = new MovementResponsibility;
        $mr->person_id = $validatedData['receive'];
        $mr->movement_id = $mo->id;
        $mr->role = 'RECIBE';
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

    public function pending(){
        $title = "Pendientes";
        
        $user = Auth::user();
        if ($user->person) {
            $idPersona = $user->person->id;
        }

        $movements = Movement::with(['movement_details.inventory.element', 'movement_responsibilities.person', 'movement_type', 'warehouse_movements'])
        ->whereHas('movement_responsibilities', function ($query) use ($idPersona) {
            $query->where('person_id', $idPersona)
                  ->where('role', 'RECIBE');
        })->orderByRaw("
        CASE
            WHEN state = 'Solicitado' THEN 1
            ELSE 2
        END")->get();

        $idMovement = $movements->pluck('id');

        $dataReceive = MovementResponsibility::with('person')
        ->whereIn('movement_id', $idMovement)
        ->where('role', 'RECIBE')
        ->get();        

        $data = [
            'title' => $title,
            'movements' => $movements,
            'dataReceive' => $dataReceive,
            'receiveOptions' => $this->receiveOptions
        ];
        return view('agroindustria::instructor.movements.pending', $data);
    }

    public function stateMovement($id) {
    // Obtén el movimiento que deseas actualizar
    $movement = Movement::findOrFail($id);
    $movement->state = 'Aprobado';
    $movement->save();
    // Verifica si el estado del movimiento se establece como "aprobado"
    if ($movement->state === 'Aprobado') {
        // Recorre los detalles del movimiento
        foreach ($movement->movement_details as $detail) {
            // Actualiza la cantidad en el inventario restando la cantidad del movimiento
            $inventory = $detail->inventory;
            $inventory->amount -= $detail->amount;
            $inventory->save();
        }
    }

    // Actualiza el estado del movimiento
   

    if ($movement->save()) {
        $icon = 'success';
        $message_line = trans('agroindustria::menu.Status of the edited movement');
    } else {
        $icon = 'error';
        $message_line = trans('agroindustria::menu.Error when editing movement status');
    }

    return redirect()->route('cefa.agroindustria.instructor.movements.pending')->with(['icon' => $icon, 'message_line' => $message_line]);
}


    public function anularMovimiento(Request $request, $id){

        $rules=[
            'observation' => 'required',
        ];
        $messages = [
            'observation.required' => trans('agroindustria::menu.Required field'),
        ];

        $validatedData = $request->validate($rules, $messages);
        $movement = Movement::find($id);
        if ($movement) {
            $movement->observation = $validatedData['observation'];
            $movement->state = 'Anulado';
            $movement->save();
        }
        if($movement->save()){
            $icon = 'success';
            $message_line = trans('agroindustria::menu.Motion successfully cancelled');
        }else{
            $icon = 'error';
            $message_line = trans('agroindustria::menu.Movement Cancel Error');
        }

        return redirect()->route('cefa.agroindustria.instructor.movements')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]);
    }

    public function devolverMovimiento(Request $request, $id){

        $rules=[
            'observation' => 'required',
        ];
        $messages = [
            'observation.required' => trans('agroindustria::menu.Required field'),
        ];

        $validatedData = $request->validate($rules, $messages);
        $movement = Movement::find($id);
        if ($movement) {
            $movement->observation = $validatedData['observation'];
            $movement->state = 'Devuelto';
            $movement->save();
        }
        if($movement->save()){
            $icon = 'success';
            $message_line = trans('agroindustria::menu.Movement successfully returned');
        }else{
            $icon = 'error';
            $message_line = trans('agroindustria::menu.Error when returning the movement');
        }

        return redirect()->route('cefa.agroindustria.instructor.movements.pending')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]);
    }


}
