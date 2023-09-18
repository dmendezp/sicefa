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
   
    public function inventoryAlert(){
        $title = ('inventoryAlert');
        $inventoryAlert = Inventory::where('amount', '<=', 10)->with('element')->get();
        return view('agroindustria::storer.inventoryAlert', compact('inventoryAlert','title'));
    }
    

    // Mostrar el listado de inventario
    public function inventory(){
        $title = 'inventory';
        $productiveUnit = ProductiveUnit::where('id', 2)->firstOrFail();
        $Warehouses = Warehouse::where('id', 2)->firstOrFail();
        $app_puw = ProductiveUnitWarehouse::where('productive_unit_id', $productiveUnit->id)
                                          ->where('warehouse_id', $Warehouses->id)
                                          ->pluck('id');
    
        $categories = Category::all();                                     
        $elements = Element::orderBy('name', 'asc')->pluck('name', 'id');
    
        $productiveunitwarehouses = ProductiveUnitWarehouse::whereIn('id', $app_puw)->get();
    
        $inventories = Inventory::whereIn('productive_unit_warehouse_id', $app_puw)
                                ->get();
        $data = [
            'title' => $title,
            'inventories' => $inventories,
            'categories' => $categories,
            'elements' => $elements,
            'productiveunitwarehouses' => $productiveunitwarehouses
        ];
        return view('agroindustria::storer.inventory', $data);
    }
    
    //Funcion de crear.
    public function create(Request $request){
        $request->validate([
            'element_id' => 'required|integer',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'amount' => 'required|integer',
            'expiration_date' => 'required|date',
        ]);

        $inventory = new Inventory();
        $inventory->element_id = $request->post('element_id');
        $inventory->productive_unit_warehouse_id = $request->post('productive_unit_warehouse_id');
        $inventory->person_id = $request->post('person_id');       
        $inventory->price = $request->post('price');
        $inventory->stock = $request->post('stock');
        $inventory->amount = $request->post('amount');
        $inventory->expiration_date = $request->post('expiration_date');
        $inventory->description = $request->post('description');
        $inventory->save();

        if($inventory->save()){
            $icon = 'success';
                $message_line = 'Registro exitoso';
        }else{
            $icon = 'error';
            $message_line = 'Error al registrar';
        }

        return redirect()->route('cefa.agroindustria.storer.inventory')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]); 


        return redirect()->route('cefa.agroindustria.storer.inventory')->with("success" , "AGREGADO CON EXITO"); 
    }  

    public function edit($id){
        $in = Inventory::findOrFail($id);
        return redirect()->route('cefa.agroindustria.storer.inventory', compact('in')); 
    }

    public function show(Request $request){
        $in = Inventory::findOrFail($request->input('id'));
        $in->element_id = $request->input('new_element_id');
        $in->productive_unit_warehouse_id = $request->input('new_productive_unit_warehouse_id');
        $in->person_id = $request->input('new_person_id');
        $in->description = $request->input('new_description');
        $in->price = $request->input('new_price');
        $in->stock = $request->input('new_stock');
        $in->amount = $request->input('new_amount');
        $in->expiration_date = $request->input('new_expiration_date');
        $in->save();    

        if($in->save()){
            $icon = 'success';
                $message_line = 'Edicion exitosa';
        }else{
            $icon = 'error';
            $message_line = 'Erro al editar';
        }

        return redirect()->route('cefa.agroindustria.storer.inventory')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]); 

    }

    //Funcion Eliminar.
    public function destroy($id){
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        
        return redirect()->route('cefa.agroindustria.storer.inventory')->with("destroy", "ELIMINADO CON EXITO");
    }

    public function discharge (){
        $title = "Bajas";
        $user = Auth::user();
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
            //'elements' => $elements,
            'name' => $name,
            'productiveUnit' => $productiveUnit,
            //'productiveUnitWarehouse' => $idProductiveUnitWarehouse,
            'movements' => $movements
        ];

        return view ('agroindustria::admin.discharged.discharge', $data);
    }

    public function dataElement($id){    
        // Asegúrate de que $id sea un arreglo
        if (!is_array($id)) {
            $id = [$id];
        }
    
        $inventoryElement = Inventory::with('element.measurement_unit')->where('element_id', $id)->get();
        $element = $inventoryElement->map(function ($e) {
            $measurementUnit = $e->element->measurement_unit->name;
            $lote = $e->lot_number;
            $fVto = $e->expiration_date;
            $price = $e->price;

            return [
                'measurementUnit' => $measurementUnit,
                'lote' => $lote,
                'fVto' => $fVto,
                'price' => $price
            ];
        });
    
        return response()->json(['id' => $element]);
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


        $puw = json_decode($request->input('productiveUnitWarehouse'));
        
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
        $wm = new WarehouseMovement;
        $wm->warehouse_id = $request->input('warehouseId');
        $wm->movement_id = $mo->id;
        $wm->role = 'Entrega';
        $wm->save();
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

        return redirect()->route('cefa.agroindustria.admin.discharge')->with([
            'icon' => $icon,
            'message_line' => $message_line,
        ]);
    }

    

}