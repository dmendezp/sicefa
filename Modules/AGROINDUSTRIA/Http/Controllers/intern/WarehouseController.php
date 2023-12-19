<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Intern;

use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\DeliverController;
use Modules\AGROINDUSTRIA\Http\Controllers\AGROINDUSTRIAController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Element;
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

    public function expirationdate()
    {
        $title = 'Prontos a Caducar';
    
        // Obtén la ID de la categoría "consumibles" 
        $consumiblesCategoryId = Category::where('name', 'Consumibles')->value('id');
        $element = Element::where('category_id', $consumiblesCategoryId)->pluck('id');
    
        // Filtra los elementos del inventario para la categoría de consumibles
        $selectedUnit = session('viewing_unit');
        $ProductiveUnitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->get();
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
            if (now()->greaterThanOrEqualTo($expirationDate) || now()->addDays(60)->greaterThanOrEqualTo($expirationDate)) {
                $state = now()->greaterThanOrEqualTo($expirationDate) ? 'Caducado.' : 'Pronto a caducar.';
                
                $dataInventory[] = [
                    'element_id' => $inventory->element->id,
                    'element_name' => $inventory->element->name,
                    'category' => $inventory->element->category->name,
                    'measurement_unit' => $inventory->element->measurement_unit->name,
                    'amount' => $inventory->amount / $inventory->element->measurement_unit->conversion_factor,
                    'expiration_date' => $expirationDate,
                    'lot_number' => $inventory->lot_number,
                    'description' => $inventory->description,
                    'state' => $state,
                ];
            }
        }
    
        $data = [
            'title' => $title,
            'expirationdate' => $dataInventory,
        ];
    
        return view('agroindustria::storer.inventoryexp', $data);
    }
    
    
    

    //Funcion de listar insumos pronto a agotarse.
    public function inventoryAlert(){
        $title = 'inventoryAlert';
        $selectedUnit = session('viewing_unit');

        // Obtén la ID de la categoría "consumibles" 
        $consumiblesCategoryId = Category::where('name', 'Consumibles')->value('id');
        $element = Element::where('category_id', $consumiblesCategoryId)->pluck('id');
        

        // Filtra los elementos del inventario para la categoría de consumibles
        
        $ProductiveUnitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->get();
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

        return view('agroindustria::storer.inventoryAlert',$data);
    }
    
 
    // Mostrar el listado de inventario
    public function inventory($id){
        $title = 'Inventario';
        session(['viewing_unit' => $id]);
        $selectedUnit = ProductiveUnit::findOrFail($id);
        session(['viewing_unit_name' => $selectedUnit->name]);

        // Obtén los registros de productive_unit_warehouse que coinciden con la unidad productiva seleccionada
        $ProductiveUnitWarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $id)->get();
        $pwId = $ProductiveUnitWarehouses->first()->id;
                        
        // Obtener los registros de inventario que coinciden con las bodegas relacionadas
        $inventories = Inventory::where('productive_unit_warehouse_id', $pwId)->with('element.category', 'element.measurement_unit')->get();
        // Combinar la información del responsable y las bodegas en un solo arreglo
        $data = [
            'title' => $title,
            'inventories' => $inventories,
        ];
        return view('agroindustria::storer.inventory', $data);
    }


    public function obtenerelementos(Request $request)
    {
        try {
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }
    
    public function discharge (){
        $title = "Bajas";
        $user = Auth::user();
        $selectedUnit = session('viewing_unit');
        $unitName = ProductiveUnit::where('id', $selectedUnit)->pluck('name', 'id');
        $puw = ProductiveUnitWarehouse::where('productive_unit_id', $selectedUnit)->pluck('warehouse_id');
        $warehouse = Warehouse::where('id', $puw)->pluck('name', 'id');
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

        //$ProductiveUnitWarehouse = ProductiveUnitWarehouse::where('warehouse_id', $warehouseId)->get();
        //$idProductiveUnitWarehouse = $ProductiveUnitWarehouse->pluck('id');

        /*$result = app(DeliverController::class)->deliveries();
        $elements = $result['elements'];*/
        
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
        ->get();
        $element = $elementInventory->map(function ($e) {
            $id = $e->element->id;
            $name = $e->element->name;

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
        ->get();
        $elementData = $inventoryElement->map(function ($e) {
            $lote = $e->lot_number;
            $fVto = $e->expiration_date;
            $price = $e->price;

            return [
                'lote' => $lote,
                'fVto' => $fVto,
                'price' => $price
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
            'observation.required' => trans('agroindustria::menu.Required field'),
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
        $movementType = MovementType::find(1);

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
        $mo->state = 'Aprobado';

        $mo->save();
        
        //Consulta el elemento seleccionado
        $selectedElementId = $validatedData['element'];

        $productiveUnitId = $request->input('productive_unit');
        $warehouseId = $request->input('warehouse');
        $puw = ProductiveUnitWarehouse::where('productive_unit_id', $productiveUnitId)
        ->where('warehouse_id', $warehouseId)
        ->pluck('id');
        
        // Encontrar el inventario correspondiente a ese elemento
        $inventories = Inventory::whereIn('element_id', $selectedElementId)
        ->where('productive_unit_warehouse_id', $puw)
        ->pluck('id');
    
        //Registra Detalles del Movimiento
        foreach ($amounts as $key => $amount) {
            $detail = new MovementDetail;
            $detail->movement_id = $mo->id;
    
            // Verificar si $inventories[$key] existe antes de asignarlo
            if (isset($inventories[$key])) {
                $detail->inventory_id = $inventories[$key];
            } 
            else {
                // Manejar el caso en el que $inventories[$key] no existe
                // Puedes agregar una acción aquí, como mostrar un mensaje de error o realizar alguna otra lógica personalizada.
                // Por ejemplo:
                return back()
                    ->withInput()
                    ->with('icon', 'error')
                    ->with('message_line', trans('agroindustria::menu.You must select an item'));
            }
            if ($amount<=0) {
                return back()
                    ->withInput()
                    ->with('icon', 'error')
                    ->with('message_line', trans('agroindustria::menu.You must enter an amount'));
            } 
            $detail->amount = $amount;
            $detail->price = $prices[$key];
            $mo->movement_details()->save($detail);
        }
        //Registra Responsable del Movimiento
        $mr = new MovementResponsibility;
        $mr->person_id = $idPersona;
        $mr->movement_id = $mo->id;
        $mr->role = 'REGISTRO';
        $mr->date = $request->input('date');
        $mr->save();

        //Registro del WarehouseMovement (entrega)
        foreach ($puw as $key => $p) {
            $wm = new WarehouseMovement;
            $wm->productive_unit_warehouse_id = $p;
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
            $message_line = trans('agroindustria::menu.Successful check out');
        }else{
            $icon = 'error';
            $message_line = trans('agroindustria::menu.Check out error');
        }

        return redirect()->route('cefa.agroindustria.admin.units.remove')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]);
    }

    

}