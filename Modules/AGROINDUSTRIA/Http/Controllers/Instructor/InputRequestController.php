<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Instructor;

use Validator, Str;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\SICA\Entities\WarehouseMovement;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use App\Models\User;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Element;
use App\Exports\AGROINDUSTRIA\RequestExport;
use App\Exports\AGROINDUSTRIA\RequestUnifiedExport;
use Carbon\Carbon;

class InputRequestController extends Controller
{

    public function table(){
        $title = 'Solicitudes';

        $user = Auth::user();
        $id = $user->person->id;
        $selectedUnit = session('viewing_unit');

        $warehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->get();
        foreach ($warehouses as $row){
            $productiveUnitWarehouseId = $row->id;
        }

        $movement_type = MovementType::find(6);
        if(auth()->check() && checkRol('agroindustria.admin')){
            $movements = Movement::with(['movement_details.inventory.element', 'movement_responsibilities.person', 'movement_type', 'warehouse_movements'])
            ->whereHas('movement_type', function ($query){
                $query->where('name', 'Movimiento Entrada');
            })->whereHas('warehouse_movements', function ($query) use ($productiveUnitWarehouseId) {
                $query->where('productive_unit_warehouse_id', $productiveUnitWarehouseId)
                    ->where('role', 'RECIBE');
            })->get();            
        }else{
            $movements = Movement::with(['movement_details.inventory.element', 'movement_responsibilities.person', 'movement_type', 'warehouse_movements'])
            ->whereHas('movement_responsibilities', function ($query) use ($id) {
                $query->where('person_id', $id)
                    ->where('role', 'RECIBE');
            })->whereHas('warehouse_movements', function ($query) use ($productiveUnitWarehouseId) {
                $query->where('productive_unit_warehouse_id', $productiveUnitWarehouseId)
                    ->where('role', 'RECIBE');
            })->whereHas('movement_type', function ($query){
                $query->where('name', 'Movimiento Entrada');
            })->get();
        }

        
        $data = [
            'title' => $title,
            'movements' => $movements
        ];

        return view('agroindustria::instructor.request.table', $data);
    }

    public function form(){
        $title = 'Formulario de Solicitud';
        $selectedUnit = session('viewing_unit');
        $unitName = ProductiveUnit::findOrFail($selectedUnit);

        $user = Auth::user();
        if ($user->person) {
            $people = [$user->person->id => $user->person->first_name . ' ' . $user->person->first_last_name . ' ' . $user->person->second_last_name];
        }
        
        $warehouseDeliver = Warehouse::where('name', 'Almacen General')->get();

        $productiveUnitWarehouseReceive = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('warehouse_id');
        $warehouseReceive = Warehouse::whereIn('id', $productiveUnitWarehouseReceive)->get();

        $elements = Element::with('measurement_unit')->get();
        $element = $elements->map(function ($e){
            $id = $e->id;
            $name = $e->name . ' (' . $e->measurement_unit->abbreviation . ')';

            return [
                'id' => $id,
                'name' => $name,
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un elemento'])->pluck('name', 'id');

        $data = [
            'title' => $title,
            'people' => $people,
            'warehouseDeliver' => $warehouseDeliver,
            'warehouseReceive' => $warehouseReceive,
            'elements' => $element
        ];

        return view('agroindustria::instructor.request.form', $data);
    }

    public function searchProduct(Request $request)
    {
        $term = $request->input('element_id');

        $elements = Element::whereRaw("name LIKE ?", ['%' . $term . '%'])->get();
        $results = [];
        foreach ($elements as $element) {
            $results[] = [
                'id' => $element->id,
                'name' => $element->name,
            ];
        }

        return response()->json($results);
    }
 
    public function create(Request $request){  
        $idPersona = null;
        $user = Auth::user();
        if ($user->person) {
            $idPersona = $user->person->id;
        }
        $selectedUnit = session('viewing_unit');

        $rules = [
            'element' => 'required',
            'amount' => 'required',
        ];
        $messages = [
            'product_name.required' => trans('agroindustria::menu.You must select a product'),
            'amount.required' => trans('agroindustria::menu.You must enter an amount'),
        ];

        $validatedData = $request->validate($rules, $messages);
        
        $movementType = MovementType::where('name', 'Movimiento Entrada')->first();

        $amounts = $validatedData['amount'];
        $prices = $request->input('price');
        $available = $request->input('available');
        $totalPrice = 0;
        
        //Multiplicacion entre la cantidad ingresada y el precio
        foreach ($amounts as $key => $amount){ 
            $a = $amount;
            $p = $prices[$key];
            
            $priceMovement = $amount*$p;
            $totalPrice += $priceMovement;
        }
        
        $movement = new Movement;
        $movement->registration_date = $request->input('date');
        $movement->movement_type_id = $movementType->id;
        $movement->voucher_number = $movementType->consecutive;
        $movement->price = $totalPrice;
        $movement->observation = $request->input('observation');
        $movement->state = 'Solicitado';
        $movement->save();
        
        
        $productiveUnitWarehouse = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('id');
        foreach ($productiveUnitWarehouse as $key => $pr) {
            $productiveUnitWarehouseId = $pr;
        }
        
        //Multiplicacion entre la cantidad ingresada y el precio        
        $elements = $validatedData['element'];
        $inventory = Inventory::whereIn('element_id', $elements)->get();
        
       
        foreach ($elements as $key => $e) {
            $element_id = $e;
            $conversion = Element::where('id', $element_id)->with('measurement_unit')->get();
            
            foreach ($conversion as $c){
                $factor = $c->measurement_unit->conversion_factor;
            }
            // Verifica si el elemento está presente en el inventario
            $elementInInventory = $inventory->where('element_id', $element_id)->first();

            if ($elementInInventory === null) {
                // El elemento no está en el inventario, así que créalo
                $i = new Inventory;
                $i->person_id = $idPersona;
                $i->productive_unit_warehouse_id = $pr;
                $i->element_id = $element_id;
                $i->destination = 'Producción';
                $i->price = 0;
                $i->amount = 0;
                $i->stock = 0;
                $i->state = 'Disponible';
                $i->save();

                $amount = $amounts[$key] * $factor;

                // Registra el nuevo inventario en los detalles del movimiento
                $movement_detail = new MovementDetail;
                $movement_detail->movement_id = $movement->id;
                $movement_detail->inventory_id = $i->id;
                $movement_detail->amount = $amount;
                $movement_detail->price = $i->price;
                $movement_detail->save();
            } else {
                $amount = $amounts[$key] * $factor;
                // El elemento está en el inventario, así que registra el detalle del movimiento
                $md = new MovementDetail;
                $md->movement_id = $movement->id;
                $md->inventory_id = $elementInInventory->id;
                $md->amount = $amount;
                $md->price = $elementInInventory->price;
                $md->save();
            }
        }

        $mr = new MovementResponsibility;
        $mr->person_id = $request->input('responsible');
        $mr->movement_id = $movement->id;
        $mr->role = 'RECIBE';
        $mr->date = $request->input('date');
        $mr->save();
        
        //Registro del WarehouseMovement (entrega)
        $productiveexterna = ProductiveUnit::where('name','=','Almacen Sena')->get()->pluck('id');
        $productiveUnitWarehouseDeliver = ProductiveUnitWarehouse::where('productive_unit_id',$productiveexterna)->get();
        foreach($productiveUnitWarehouseDeliver as $wd){
            $warehouseDeliverId = $wd->id;
        }

        $wm = new WarehouseMovement;
        $wm->productive_unit_warehouse_id = $warehouseDeliverId;
        $wm->movement_id = $movement->id;
        $wm->role = 'Entrega';
        $wm->save();

        //Registro del WarehouseMovement (recibe)
        $selectedUnit = session('viewing_unit');
        $ProductiveUnitWarehouseDeliver = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->get();
        foreach($ProductiveUnitWarehouseDeliver as $pd){
            $idD = $pd->id;
        }

        $wm = new WarehouseMovement;
        $wm->productive_unit_warehouse_id = $idD;
        $wm->movement_id = $movement->id;
        $wm->role = 'Recibe';
        $wm->save();
    
        if($wm->save()){
            $icon = 'success';
            $message_line = trans('agroindustria::request.registeredEntry');
        }else{
            $icon = 'error';
            $message_line = trans('agroindustria::request.error');
        }

        return redirect()->route('agroindustria.instructor.units.view.request')->with([
            'icon' => $icon,
            'message_line' => $message_line
        ]);
    }

    public function generateExcel($movementId){
        // Obtén los datos de consumables asociados al labor
        $supplies = MovementDetail::where('movement_id', $movementId)->with('inventory.element.measurement_unit')->get();

        $movement = Movement::where('id', $movementId)->get();
        foreach($movement as $m){
            foreach($m->movement_responsibilities as $responsibilitie){
                $personName = $responsibilitie->person->first_name . ' ' . $responsibilitie->person->first_last_name . ' ' . $responsibilitie->person->second_last_name; 
                $document_number = $responsibilitie->person->document_number;
            }
        }
        
        $currentDate = Carbon::now();

        // Obtener solo la fecha en formato 'Y-m-d'
        $planning_date = $currentDate->toDateString();
        // Genera y descarga el archivo Excel
        $excelFileName = 'PPMI_F06 SOLICITUD DE MATERIALES ALMACEN.xlsx';

        $excel = new RequestExport($supplies, $personName, $document_number, $planning_date);

        // Descarga el archivo Excel
        return $excel->download($excelFileName);
    }

    public function generateExcelUnified(){
        // Obtén los datos de consumables asociados al labor

        $movement_type = MovementType::where('name', 'Movimiento Entrada')->pluck('id');

        $movementsPending = Movement::where('state', 'Solicitado')->where('movement_type_id', $movement_type)->pluck('id');

        $supplies = MovementDetail::whereIn('movement_id', $movementsPending)->with('inventory.element.measurement_unit')->get();
        
        $groupedSupplies = $supplies->groupBy('inventory_id')->map(function ($group) {
            return [
                'element_name' => $group->first()->inventory->element->name,
                'measurement_unit' => $group->first()->inventory->element->measurement_unit->abbreviation,
                'total_quantity' => $group->sum('amount') / $group->first()->inventory->element->measurement_unit->conversion_factor,
                'code_sena' => $group->first()->inventory->inventory_code,
            ];
        });
        $currentDate = Carbon::now();

        // Obtener solo la fecha en formato 'Y-m-d'
        $planning_date = $currentDate->toDateString();
        // Genera y descarga el archivo Excel
        $excelFileName = 'PPMI_F06 SOLICITUD DE MATERIALES ALMACEN.xlsx';

        $excel = new RequestUnifiedExport($groupedSupplies, $planning_date);

        // Descarga el archivo Excel
        return $excel->download($excelFileName);
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

                $receiveWarehouseMovement = $movement->warehouse_movements->first(function ($movement) {
                    return $movement->role === 'Recibe';
                });

                $movementResponsibilitie = MovementResponsibility::where('movement_id', $id)->where('role', 'RECIBE')->get();
                foreach ($movementResponsibilitie as $mr) {
                    $person_id = $mr->person_id;
                }
                
                if ($receiveWarehouseMovement) {
                    $receive_warehouse = $receiveWarehouseMovement->productive_unit_warehouse_id;
                    $receiverInventory = new Inventory();
                    $receiverInventory->person_id = $person_id;
                    $receiverInventory->productive_unit_warehouse_id = $receive_warehouse;
                    $receiverInventory->element_id = $detail->inventory->element_id;
                    $receiverInventory->destination = $detail->inventory->destination;
                    $receiverInventory->price = $detail->inventory->element->price;
                    $receiverInventory->amount = $detail->amount; // Aquí usamos la cantidad del detalle
                    $receiverInventory->stock = 10;
                    $receiverInventory->production_date = $detail->inventory->production_date;
                    $receiverInventory->lot_number = $detail->inventory->lot_number;
                    $receiverInventory->expiration_date = $detail->inventory->expiration_date;
                    $receiverInventory->state = $detail->inventory->state;
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

        return redirect()->route('agroindustria.admin.units.view.request')->with(['icon' => $icon, 'message_line' => $message_line]);
    }

    public function cancelRequest(Request $request, $id){

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

        return redirect()->route('agroindustria.'.getRoleRouteName(Route::currentRouteName()).'.units.view.request')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]);

        
    }

}