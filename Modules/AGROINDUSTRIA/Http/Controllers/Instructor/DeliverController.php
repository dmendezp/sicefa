<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Instructor;

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
use Modules\SICA\Entities\MeasurementUnit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Modules\AGROINDUSTRIA\Emails\MovementApproved;
use Validator, Str;


class DeliverController extends Controller
{

    public function table(){
        $title = 'Entregas';
        $selectedUnit = session('viewing_unit');

        $user = Auth::user();
        if ($user->person) {
            $idPersona = $user->person->id;
        }

        //Bodega que entrega
        $warehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->get();
        foreach ($warehouses as $row){
            $id = $row->id;
        }

        $movements = Movement::with(['movement_details.inventory.element', 'movement_responsibilities.person', 'movement_type', 'warehouse_movements'])
        ->whereHas('movement_responsibilities', function ($query) use ($idPersona) {
            $query->where('person_id', $idPersona)
                  ->where('role', 'ENTREGA');
        })->whereHas('warehouse_movements', function ($query) use ($id) {
            $query->where('productive_unit_warehouse_id', $id)
                  ->where('role', 'ENTREGA');
        })->orderByRaw("
        CASE
            WHEN state = 'Solicitado' THEN 1
            ELSE 2
        END")->get();

        // Cuenta los movimientos con estado "solicitado"
        $pendingMovementsCount = Movement::whereHas('warehouse_movements', function ($query) use ($id) {
            $query->where('productive_unit_warehouse_id', $id)
                  ->where('role', 'RECIBE');
        })->whereHas('movement_responsibilities', function ($r) use ($idPersona){
            $r->where('person_id', $idPersona)
            ->where('role', 'RECIBE');
        })->where('state', 'Solicitado')->where('movement_type_id', 2)->count();
        

        $data = [
            'title' => $title,
            'movements' => $movements,
            'pedingMovements' => $pendingMovementsCount,
        ];

        return view('agroindustria::instructor.movements.table', $data);
    }

    public function deliveries()
    {
        $title = 'Entregas';
        $selectedUnit = session('viewing_unit');
        $unitName = ProductiveUnit::findOrFail($selectedUnit);

        $user = Auth::user();
        if ($user->person) {
            $idPersona = $user->person->id;
        }
        

        //Bodega que entrega
        $warehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->get();
        foreach ($warehouses as $row){
            $id = $row->id;
        }

        $warehouseDeliver = $warehouses->map(function ($w) {
            $warehouseId = $w->warehouse->id;
            $warehouseName = $w->warehouse->name;

            return [
                'id' => $warehouseId,
                'name' => $warehouseName,
            ];
        })->prepend(['id' => null, 'name' => trans('agroindustria::deliveries.Select a winery')])->pluck('name', 'id');


        //Consulta el inventario que pertenece a la bodega de esa unidad productiva
        $inventories = Inventory::with('element.measurement_unit')
        ->where('productive_unit_warehouse_id', $id)->get();
        //Filtra los elementos de ese inventario
        $elements = $inventories->map(function ($inventory) {
            $elementId = $inventory->element->id;
            $elementName = $inventory->element->name;
            $unitName = $inventory->element->measurement_unit->name;
            $elementWithUnit = $elementName . ' (' . $unitName . ')';

            return [
                'id' => $elementId,
                'name' => $elementWithUnit
            ];
        })->prepend(['id' => null, 'name' => trans('agroindustria::deliveries.Select a product')])->pluck('name', 'id');


        //Consulta las unidades productivas
        $productiveUnit = ProductiveUnit::with('person')->whereNotIn('id', [$selectedUnit])->get();
        $receiveUnit = $productiveUnit->map(function ($p) {
            $unitId = $p->id;
            $unitName = $p->name;

            return [
                'id' => $unitId,
                'name' => $unitName
            ];
        })->prepend(['id' => null, 'name' => trans('agroindustria::deliveries.Select a productive unit')])->pluck('name', 'id');

        //Consulta los movimientos del responsable con el rol de ENTREGA
        $idMovements = Movement::pluck('id');
      
        $data = [
            'title' => $title,
            'unitName' => $unitName,
            'productiveUnitWarehouse' => $id,
            'warehouseDeliver' => $warehouseDeliver,
            'elements' => $elements,
            'receiveUnit' => $receiveUnit,
        ];

        return view('agroindustria::instructor.movements.deliveries', $data);
    }

    public function warehouseReceive($id){    
        // Asegúrate de que $id sea un arreglo
        if (!is_array($id)) {
            $id = [$id];
        }
       
        $warehouseReceives = ProductiveUnitWarehouse::with('productive_unit.person', 'warehouse')
        ->where('productive_unit_id', $id)->get();

        $warehouse = $warehouseReceives->map(function ($w){
            $id = $w->warehouse->id;
            $name = $w->warehouse->name;
            $idPerson = $w->productive_unit->person->id;
            $personName = $w->productive_unit->person->first_name . ' ' . $w->productive_unit->person->first_last_name . ' ' . $w->productive_unit->person->second_last_name;


            return[
                'id' => $id,
                'name' => $name,
                'idPerson' => $idPerson,
                'personName' => $personName,
            ];
        });
    
        return response()->json(['id' => $warehouse]);
    }

    public function priceInventory($id){    
        // Asegúrate de que $id sea un arreglo
        if (!is_array($id)) {
            $id = [$id];
        }

        $selectedUnit = session('viewing_unit');

        $warehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->get();
        foreach ($warehouses as $row){
            $pwId = $row->id;
        }
    
        $inventory = Inventory::with('element.measurement_unit')->where('element_id', $id)->where('productive_unit_warehouse_id', $pwId)->groupBy('element_id')->select('element_id', \DB::raw('SUM(amount) as totalAmount'), \DB::raw('GROUP_CONCAT(price) as prices'))->get();
        $amountPrice = $inventory->map(function ($e){
            $measurement_unit = $e->element->measurement_unit->conversion_factor;
            $conversion = $e->totalAmount/$measurement_unit;
            $amount = $conversion;
            $price = $e->prices;
            
            return [
                'amount' => $amount,
                'price' => $price
            ];
        });
        return response()->json(['id' => $amountPrice]);
    }
    
    public function createMoveOut(Request $request){     
            $rules=[
                'receive' => 'required',
                'deliver_warehouse' => 'required',
                'receive_warehouse' => 'required',
                'element' => 'required',
                'amount' => 'required'
            ];

            $messages = [
                'receive.required' => trans('agroindustria::deliveries.You must select a receiver'),
                'deliver_warehouse.required' => trans('agroindustria::deliveries.You must select a delivery warehouse'),
                'receive_warehouse.required' => trans('agroindustria::deliveries.You must select the winery that receives'),
                'element.required' => trans('agroindustria::deliveries.You must select an item'),
                'amount.required' => trans('agroindustria::deliveries.You must enter an amount')
            ];

            $validatedData = $request->validate($rules, $messages);
        
            try {
                // Inicia una transacción de base de datos
                DB::beginTransaction();
            //Se trae el id de la persona logueada para registrar el responsable
            $user = Auth::user();
            if ($user->person) {
                $idPersona = $user->person->id;
            }

            //Consulta el tipo de movimiento con el id 2 que es Movimiento Interno
            $movementType = MovementType::find(2);

            //Trae la cantidad ingresada y el precio del inventario
            $selectedElementId = $validatedData['element'];
            $amounts = $validatedData['amount'];
            $prices = $request->input('price');
            $totalPrice = 0;

            
            //Registra el movimiento
            $mo = new Movement;
            $mo->registration_date = $request->input('date');
            $mo->movement_type_id = $movementType->id;
            $mo->voucher_number = $movementType->consecutive;
            $mo->price = 0;
            $mo->observation = $request->input('observation');
            $mo->state = 'Solicitado';
            $mo->save();
            
            $puw = json_decode($request->input('productiveUnitWarehouse'));
            
            // Realiza una consulta para obtener los lotes correspondientes al elemento y ordénalos por lote
            $selectedUnit = session('viewing_unit');
            $warehouse = Warehouse::where('name', 'Agroindustria')->pluck('id');
            $productiveUnit = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->whereIn('warehouse_id', $warehouse)->pluck('id');
            $element = Element::whereIn('id', $selectedElementId)->pluck('measurement_unit_id');
            //Registra Detalles del Movimiento
            $totalPrice = 0;
            foreach ($selectedElementId as $key => $e) {
                $requiredAmount = $amounts[$key]; // Cantidad requerida para el elemento
                
                $inventories = Inventory::where('element_id', $e)
                ->where('productive_unit_warehouse_id', $productiveUnit)
                ->get();
                
                $consumedAmount = 0;
                $elementTotalPrice = 0;
                foreach ($inventories as $inventory) {
                    // Obtén la cantidad disponible y el precio del inventario
                    $availableAmount = $inventory->amount;
                    $priceInventory = $inventory->price;
                    $eleId = $inventory->element_id;
                    $measurement_unit_id = Element::where('id', $eleId)->pluck('measurement_unit_id')->first();
                    $conversion_factor = MeasurementUnit::where('id', $measurement_unit_id)->pluck('conversion_factor')->first();                
                    $conversion = $requiredAmount * $conversion_factor;
                    
                    // Calcula cuánto se puede consumir de este lote
                    $consumeFromThisLot = min($availableAmount, max(0, $conversion - $consumedAmount));
                    $intAmount = $consumeFromThisLot/$conversion_factor;
                    $price = $intAmount*$priceInventory;
                    if ($consumeFromThisLot > 0) {
                        // Registra el consumo para este lote
                        $detail = new MovementDetail;
                        $detail->movement_id = $mo->id;
                        $detail->inventory_id = $inventory->id;
                        $detail->amount = $consumeFromThisLot;
                        $detail->price = $price;
                        $detail->save();

                        $elementTotalPrice += $price;
                        // Actualiza la cantidad consumida
                        $consumedAmount += $intAmount * $conversion_factor;
                        // Si se ha consumido la cantidad requerida, sal del bucle
                        if ($consumedAmount >= $conversion) {
                            break;
                        }
                    }
                }
                $totalPrice += $elementTotalPrice;
            }
            $mo->price = $totalPrice;
            $mo->save();

            //Registra Responsable del Movimiento
            $mr = new MovementResponsibility;
            $mr->person_id = $idPersona;
            $mr->movement_id = $mo->id;
            $mr->role = 'ENTREGA';
            $mr->date = $request->input('date');
            $mr->save();

            $mr = new MovementResponsibility;
            $mr->person_id = $request->input('receive_id');
            $mr->movement_id = $mo->id;
            $mr->role = 'RECIBE';
            $mr->date = $request->input('date');
            $mr->save();

            //Registro del WarehouseMovement (entrega)
            $selectedUnit = session('viewing_unit');
            $ProductiveUnitWarehouseDeliver = ProductiveUnitWarehouse::where('warehouse_id', $validatedData['deliver_warehouse'])
            ->where('productive_unit_id', $selectedUnit)->get();
            foreach($ProductiveUnitWarehouseDeliver as $pd){
                $idD = $pd->id;
            }

            $wm = new WarehouseMovement;
            $wm->productive_unit_warehouse_id = $idD;
            $wm->movement_id = $mo->id;
            $wm->role = 'Entrega';
            $wm->save();

            $ProductiveUnitWarehouse = ProductiveUnitWarehouse::where('warehouse_id', $validatedData['receive_warehouse'])
            ->where('productive_unit_id', $request->input('receiveUnit'))
            ->get();
            foreach($ProductiveUnitWarehouse as $p){
                $id = $p->id;
            }


            $wm = new WarehouseMovement;
            $wm->productive_unit_warehouse_id = $id;
            $wm->movement_id = $mo->id;
            $wm->role = 'Recibe';
            $wm->save();
            

            DB::commit();

            return redirect()->route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.movements.table')->with([
                'icon' => 'success',
                'message_line' => trans('agroindustria::deliveries.Successful check out'),
            ]);
        } catch (\Exception $e) {
            // Si ocurre algún error durante la transacción, se revierten todas las operaciones
            DB::rollBack();

            // Redirige de vuelta con un mensaje de error
            return redirect()->route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.movements.table')->with([
                'icon' => 'error',
                'message_line' => trans('agroindustria::deliveries.Check out error'),
            ]);
        }
    }

    public function pending(){
        $title = "Pendientes";
        
        $selectedUnit = session('viewing_unit');

        //Bodega que entrega

        $warehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->get();
        foreach ($warehouses as $row){
            $id = $row->id;
        }

        $user = Auth::user();
        if ($user->person) {
            $idPersona = $user->person->id;
        }

        $movements = Movement::with(['movement_details.inventory.element', 'movement_responsibilities.person', 'movement_type', 'warehouse_movements'])
        ->where('movement_type_id', 2)
        ->whereHas('movement_responsibilities', function ($query) use ($idPersona) {
            $query->where('person_id', $idPersona)
                  ->where('role', 'RECIBE');
        })->whereHas('warehouse_movements', function ($query) use ($id) {
            $query->where('productive_unit_warehouse_id', $id)
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
        
        // Cuenta los movimientos con estado "solicitado"
        $pendingMovementsCount = Movement::whereHas('warehouse_movements', function ($query) use ($id) {
            $query->where('productive_unit_warehouse_id', $id)
                  ->where('role', 'RECIBE');
        })->whereHas('movement_responsibilities', function ($r) use ($idPersona){
            $r->where('person_id', $idPersona)
            ->where('role', 'RECIBE');
        })->where('state', 'Solicitado')
        ->where('movement_type_id', 2)->count();

        $data = [
            'title' => $title,
            'movements' => $movements,
            'dataReceive' => $dataReceive,
            'pedingMovements' => $pendingMovementsCount,
        ];
        return view('agroindustria::instructor.movements.pending', $data);
    }

    public function stateMovement(Request $request, $id) {
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

                $receiveWarehouseMovement = $movement->warehouse_movements->first(function ($movement) {
                    return $movement->role === 'Recibe';
                });
                
                if ($receiveWarehouseMovement) {
                    $receive_warehouse = $receiveWarehouseMovement->productive_unit_warehouse_id;
                    $receiverInventory = new Inventory();
                    $receiverInventory->person_id = $detail->inventory->person_id;
                    $receiverInventory->productive_unit_warehouse_id = $receive_warehouse;
                    $receiverInventory->element_id = $detail->inventory->element_id;
                    $receiverInventory->destination = $detail->inventory->destination;
                    $receiverInventory->description = $detail->inventory->description;
                    $receiverInventory->price = $detail->inventory->price;
                    $receiverInventory->amount = $detail->amount; // Aquí usamos la cantidad del detalle
                    $receiverInventory->stock = $detail->inventory->stock;
                    $receiverInventory->production_date = $detail->inventory->production_date;
                    $receiverInventory->lot_number = $detail->inventory->lot_number;
                    $receiverInventory->expiration_date = $detail->inventory->expiration_date;
                    $receiverInventory->state = $detail->inventory->state;
                    $receiverInventory->mark = $detail->inventory->mark;
                    $receiverInventory->inventory_code = $detail->inventory->inventory_code;
                    $receiverInventory->save();      
                }
            }
        }

    
        
        if ($receiverInventory->save()) {
            $icon = 'success';
            $message_line = trans('agroindustria::deliveries.Status of the edited movement');
        } else {
            $icon = 'error';
            $message_line = trans('agroindustria::deliveries.Error when editing movement status');
        }

        if(Auth::check()){
            $user = Auth::user();
            if($user->roles->contains('slug', 'agroindustria.instructor.vilmer') || $user->roles->contains('slug', 'agroindustria.instructor.chocolate') || $user->roles->contains('slug', 'agroindustria.instructor.cerveceria')){
                // Redirige a la página de éxito
                 return redirect()->route('agroindustria.instructor.units.movements.pending')->with([
                    'icon' => $icon,
                    'message_line' => $message_line,
                ]);
            }else{
                return redirect()->route('agroindustria.admin.units.movements.pending')->with([
                    'icon' => $icon,
                    'message_line' => $message_line,
                ]);
            }
        }
    }


    public function anularMovimiento(Request $request, $id){

        $rules=[
            'observation' => 'required',
        ];
        $messages = [
            'observation.required' => trans('agroindustria::deliveries.Required field'),
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
            $message_line = trans('agroindustria::deliveries.Motion successfully cancelled');
        }else{
            $icon = 'error';
            $message_line = trans('agroindustria::deliveries.Movement Cancel Error');
        }

        return redirect()->route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.movements.table')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]);

        
    }

    public function devolverMovimiento(Request $request, $id){

        $rules=[
            'observation' => 'required',
        ];
        $messages = [
            'observation.required' => trans('agroindustria::deliveries.Required field'),
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
            $message_line = trans('agroindustria::deliveries.Movement successfully returned');
        }else{
            $icon = 'error';
            $message_line = trans('agroindustria::deliveries.Error when returning the movement');
        }

        if(Auth::check()){
            $user = Auth::user();
            if($user->roles->contains('slug', 'agroindustria.instructor.vilmer') || $user->roles->contains('slug', 'agroindustria.instructor.chocolate') || $user->roles->contains('slug', 'agroindustria.instructor.cerveceria')){
                // Redirige a la página de éxito
                return redirect()->route('agroindustria.instructor.units.movements.pending')->with([
                    'icon' => $icon,
                    'message_line' => $message_line,
                ]);
            }else{
                return redirect()->route('agroindustria.admin.units.movements.pending')->with([
                    'icon' => $icon,
                    'message_line' => $message_line,
                ]); 
            }
        }    }
}