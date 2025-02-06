<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Intern;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\WarehouseMovement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator, Str;

class WarehouseController extends Controller
{
    // Mostrar el listado de inventario
    public function inventory($id){
        $title = 'Inventario';
        session(['viewing_unit' => $id]);
        $selectedUnit = ProductiveUnit::findOrFail($id);
        session(['viewing_unit_name' => $selectedUnit->name]);

        // Obtén los registros de productive_unit_warehouse que coinciden con la unidad productiva seleccionada
        $ProductiveUnitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $id)->pluck('warehouse_id');
        $warehouses = Warehouse::whereIn('id', $ProductiveUnitWarehouses)->get();
        
        $principal_warehouse = ProductiveUnitWarehouse::where('productive_unit_id', $id)->get();
        $pwId = $principal_warehouse->first()->id;
                        
        // Obtener los registros de inventario que coinciden con las bodegas relacionadas
        $inventories = Inventory::where('productive_unit_warehouse_id', $pwId)->with('element.category', 'element.measurement_unit')->get();
        // Combinar la información del responsable y las bodegas en un solo arreglo
        $data = [
            'title' => $title,
            'inventories' => $inventories,
            'warehouses' => $warehouses
        ];
        return view('agroindustria::storer.inventory.inventoryTable', $data);
    }

    public function elements($warehouseId){
        $selectedUnit = session('viewing_unit');

        $productiveUnitWarehouse = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->where('warehouse_id', $warehouseId)->pluck('id');

        $inventories = Inventory::whereIn('productive_unit_warehouse_id', $productiveUnitWarehouse)->with('element.category', 'element.measurement_unit')->get();

        return response()->json(['inventories' => $inventories]);
    }


    public function expirationdate($wId)
    {
        $title = 'Prontos a Caducar';
    
        // Obtén la ID de la categoría "consumibles" 
        $groceries = Category::where('name', 'Abarrotes')->pluck('id');
        $additives = Category::where('name', 'Aditivos')->pluck('id');
        $packaging = Category::where('name', 'Empaques')->pluck('id');
        $hygiene = Category::where('name', 'Higiene')->pluck('id');
        $utensils = Category::where('name', 'Utensilios')->pluck('id');
        $element = Element::whereIn('category_id', $groceries)->orWhereIn('category_id', $additives)->orWhereIn('category_id', $packaging)->orWhereIn('category_id', $hygiene)->orWhereIn('category_id', $utensils)->pluck('id');
    
        // Filtra los elementos del inventario para la categoría de consumibles
        $selectedUnit = session('viewing_unit');
        $ProductiveUnitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->where('warehouse_id', $wId)->get();
        $pwId = $ProductiveUnitWarehouses->first()->id;
    
        // Obtén los elementos y sus fechas de vencimiento con información adicional
        $elementsAndExpiryDates = Inventory::whereIn('element_id', $element)
            ->where('productive_unit_warehouse_id', $pwId)
            ->with(['element.category', 'element.measurement_unit'])
            ->get();
        // Combina la información de fechas de vencimiento con la información detallada de los elementos y asigna el estado
        $dataInventory = [];
        foreach ($elementsAndExpiryDates as $inventory) {
            $expirationDate = $inventory->expiration_date;
            // Comparar la fecha de expiración con la fecha actual
            if($expirationDate > 0){
                if (now()->greaterThanOrEqualTo($expirationDate) || now()->addDays(60)->greaterThanOrEqualTo($expirationDate)) {
                    $state = now()->greaterThanOrEqualTo($expirationDate) ? 'Caducado.' : 'Pronto a caducar.';
                    
                    $dataInventory[] = [
                        'inventory_id' => $inventory->id,
                        'element_name' => $inventory->element->name,
                        'category' => $inventory->element->category->name,
                        'measurement_unit' => $inventory->element->measurement_unit->name,
                        'amount' => $inventory->amount / $inventory->element->measurement_unit->conversion_factor,
                        'price' => $inventory->price,
                        'expiration_date' => $expirationDate,
                        'lot_number' => $inventory->lot_number,
                        'description' => $inventory->description,
                        'state' => $state,
                    ];
                   
                }
            }
        }
    
        $data = [
            'title' => $title,
            'expirationdate' => $dataInventory,
            'wId' => $wId
        ];
    
        return view('agroindustria::storer.inventory.inventoryexp', $data);
    }  

    //Funcion de listar insumos pronto a agotarse.
    public function inventoryAlert($waId){
        $title = 'Prontos a Agotarse';
        $selectedUnit = session('viewing_unit');

        // Obtén la ID de la categoría "consumibles" 
        $groceries = Category::where('name', 'Abarrotes')->pluck('id');
        $additives = Category::where('name', 'Aditivos')->pluck('id');
        $packaging = Category::where('name', 'Empaques')->pluck('id');
        $hygiene = Category::where('name', 'Higiene')->pluck('id');
        $utensils = Category::where('name', 'Utensilios')->pluck('id');
        $element = Element::whereIn('category_id', $groceries)->orWhereIn('category_id', $additives)->orWhereIn('category_id', $packaging)->orWhereIn('category_id', $hygiene)->orWhereIn('category_id', $utensils)->pluck('id');
        

        // Filtra los elementos del inventario para la categoría de consumibles
        
        $ProductiveUnitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->where('warehouse_id', $waId)->get();
        $pwId = $ProductiveUnitWarehouses->first()->id;
        $inventory = Inventory::whereIn('element_id', $element)
        ->where('productive_unit_warehouse_id', $pwId)
        ->get();

        $inventoryAlert = [];
        
        foreach ($inventory as $i) {
            $inventory_id = $i->id;
            $amount = $i->amount / $i->element->measurement_unit->conversion_factor;
            
            // Realiza la comparación y agrega a $inventoryAlert si es mayor que el stock
            if ($i->stock > $amount) {
                $inventoryAlert[] = $i;
            }
        }

        $data = [
            'title' => $title,
            'inventoryAlert' => $inventoryAlert
        ];

        return view('agroindustria::storer.inventory.inventoryAlert',$data);
    }

    
    public function discharge (){
        $title = "Bajas";
        $user = Auth::user();
        $selectedUnit = session('viewing_unit');
        $unitName = ProductiveUnit::where('id', $selectedUnit)->pluck('name', 'id');
        $puw = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('warehouse_id');
        $warehouse = Warehouse::whereIn('id', $puw)->pluck('name', 'id');
        if ($user->person) {
            $idPersona = $user->person->id;
            $name = $user->person->first_name . ' ' . $user->person->first_last_name . ' ' . $user->person->second_last_name;
        }

        $warehouseApp = Warehouse::with('productive_unit_warehouses.productive_unit')->where('app_id', 10)->get();

        $productiveUnit = $warehouseApp->flatMap(function ($w) {
            return $w->productive_unit_warehouses->map(function ($puw) {
                return [
                    'id' => $puw->productive_unit->id,
                    'name' => $puw->productive_unit->name,
                ];
            });
        })->prepend(['id' => null, 'name' => 'Seleccione una unidad productiva'])->pluck('name', 'id');
        
        $movements = Movement::with(['movement_details.inventory.element', 'movement_responsibilities.person', 'movement_type', 'warehouse_movements'])
        ->whereHas('movement_responsibilities', function ($query) use ($idPersona) {
            $query->where('person_id', $idPersona)
                  ->where('role', 'REGISTRO');
        })->get();

        $data = [
            'title' => $title,
            'name' => $name,
            'unitName' => $unitName,
            'warehouse' => $warehouse,
            'productiveUnit' => $productiveUnit,
            //'productiveUnitWarehouse' => $idProductiveUnitWarehouse,
            'movements' => $movements
        ];

        return view ('agroindustria::admin.discharged.discharge', $data);
    }


    public function warehouse($id){    
        // Asegúrate de que $id sea un arreglo
        if (!is_array($id)) {
            $id = [$id];
        }
    
        $warehouseProductiveUnit = ProductiveUnitWarehouse::with('warehouse')->where('productive_unit_id', $id)->get();
        $warehouse = $warehouseProductiveUnit->map(function ($wp) {
            $id = $wp->warehouse->id;
            $name = $wp->warehouse->name;

            return [
                'id' => $id,
                'name' => $name,
            ];
        });
        
        return response()->json(['id' => $warehouse]);
    }

    public function element ($productiveUnitId, $warehouseId){
        $warehouse = ProductiveUnitWarehouse::where('productive_unit_id', $productiveUnitId)
        ->where('warehouse_id', $warehouseId)
        ->pluck('id');

        $elementInventory = Inventory::with('element')
        ->whereIn('productive_unit_warehouse_id', $warehouse)
        ->groupBy('element_id')->select('element_id', \DB::raw('SUM(amount) as totalAmount'), \DB::raw('GROUP_CONCAT(price) as prices'))->get();
        $element = $elementInventory->map(function ($e) {
            $id = $e->element->id;
            $name = $e->element->name . ' (' . $e->element->measurement_unit->abbreviation . ')';

            return [
                'id' => $id,
                'name' => $name,
            ];
        });
    
        return response()->json(['id' => $element]);
    }
    
    public function dataElement($productiveUnitId, $warehouseId, $elementId){    

        $productiveUnitWarehouse = ProductiveUnitWarehouse::where('productive_unit_id', $productiveUnitId)
        ->where('warehouse_id', $warehouseId)
        ->pluck('id');

        $inventoryElement = Inventory::with('element')->where('productive_unit_warehouse_id', $productiveUnitWarehouse)
        ->where('element_id', $elementId)
        ->groupBy('element_id')->select('element_id', \DB::raw('SUM(amount) as totalAmount'), \DB::raw('GROUP_CONCAT(price) as prices') , \DB::raw('MAX(lot_number) as lot'))->get();

        $elementData = $inventoryElement->map(function ($e) {
            $lote = $e->lot;
            $fVto = $e->expiration_date;
            $price = $e->prices;
            $amount = $e->totalAmount / $e->element->measurement_unit->conversion_factor;

            return [
                'lote' => $lote,
                'fVto' => $fVto,
                'price' => $price,
                'amount' => $amount
            ];
        });
        
        return response()->json(['id' => $elementData]);
    }

    public function createDischarge(Request $request) {
        Validator::extend('at_least_one_element', function ($attribute, $value, $parameters, $validator) use ($request) {
            $elements = $request->input('element');
            return !empty($elements);
        });

        $rules=[
            'observation' => 'required',
            'element' => 'required|at_least_one_element',
            'amount' => 'required'
        ];

        $messages = [
            'observation.required' => trans('agroindustria::deliveries.Required field'),
            'element.required' => trans('agroindustria::deliveries.You must select an item'),
            'amount.required' => trans('agroindustria::deliveries.You must enter an amount')
        ];
        $validatedData = $request->validate($rules, $messages);
        //Se trae el id de la persona logueada para registrar el responsable
        $user = Auth::user();
        if ($user->person) {
            $idPersona = $user->person->id;
        }

        //Consulta el tipo de movimiento con el id 2 que es Movimiento Interno
        $movementType = MovementType::find(1);

        //Trae la cantidad ingresada y el precio del inventario
        $totalPrice = 0;
        $amounts = $validatedData['amount'];
        $prices = $request->input('price');

        $priceMovement = $amounts*$prices;
        
        //Registra el movimiento
        $mo = new Movement;
        $mo->registration_date = $request->input('date');
        $mo->movement_type_id = $movementType->id;
        $mo->voucher_number = $movementType->consecutive;
        $mo->price = $priceMovement;
        $mo->observation = $request->input('observation');
        $mo->state = 'Aprobado';

        $mo->save();
        
        //Consulta el elemento seleccionado
        $inventoryId = $validatedData['element'];

        $selectedUnit = session('viewing_unit');
        $warehouseId = $request->input('warehouse');
        $puw = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)
        ->where('warehouse_id', $warehouseId)
        ->pluck('id');

        $element = Inventory::where('id', $inventoryId)->pluck('element_id');
        $measurement_unit = Element::whereIn('id', $element)->pluck('measurement_unit_id');
        $conversion_factor = MeasurementUnit::where('id', $measurement_unit)->pluck('conversion_factor');
        
        foreach ($conversion_factor as $c) {
            $amount = $amounts * $c;
        }

        //Registra Detalles del Movimiento
        $detail = new MovementDetail;
        $detail->movement_id = $mo->id;
        $detail->inventory_id = $inventoryId;
        $detail->amount = $amount;
        $detail->price = $priceMovement;
        $mo->movement_details()->save($detail);

        //Registra Responsable del Movimiento
        $mr = new MovementResponsibility;
        $mr->person_id = $idPersona;
        $mr->movement_id = $mo->id;
        $mr->role = 'REGISTRO';
        $mr->date = $request->input('date');
        $mr->save();

        //Registro del WarehouseMovement (entrega)
        foreach ($puw as $key => $idPuw) {
            $wm = new WarehouseMovement;
            $wm->productive_unit_warehouse_id = $idPuw;
            $wm->movement_id = $mo->id;
            $wm->role = 'Entrega';
            $wm->save();
        }
       
        if ($mo->state === 'Aprobado') {
            // Recorre los detalles del movimiento
            foreach ($mo->movement_details as $detail) {
                // Actualiza la cantidad en el inventario restando la cantidad del movimiento
                $inventory = $detail->inventory;
                $inventory->amount -= $detail->amount;
                $inventory->save();
            }
        }
        if($wm->save()){
            $icon = 'success';
            $message_line = trans('agroindustria::deliveries.Successful check out');
        }else{
            $icon = 'error';
            $message_line = trans('agroindustria::deliveries.Check out error');
        }

        return redirect()->route('agroindustria.admin.units.remove.view')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]);
    }

    

}