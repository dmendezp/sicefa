<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers\Intern;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Person;
use Collective\Html\FormFacade as Form;
class WarehouseController extends Controller
{
  
    
    // Mostrar el listado de inventario
    public function inventory()
    {
        $title = 'inventory';
        $productiveUnit = ProductiveUnit::where('name', 'Agroindustria')->firstOrFail();
        $Warehouses = Warehouse::where('name', 'agroindustria')->firstOrFail();
        $app_puw = ProductiveUnitWarehouse::where('productive_unit_id', $productiveUnit->id)
                                          ->where('warehouse_id', $Warehouses->id)
                                          ->pluck('id');
    
        $categories = Category::all();                                     
        $elements = Element::all();
    
        $productiveunitwarehouses = ProductiveUnitWarehouse::whereIn('id', $app_puw)->get();
    
        $inventories = Inventory::whereIn('productive_unit_warehouse_id', $app_puw)
                                ->orderBy('updated_at', 'DESC')
                                ->get();
    
        return view('agroindustria::storer.inventory', compact('title', 'inventories', 'categories', 'elements', 'productiveunitwarehouses'));
    }
  //Funcion de crear.
  public function create(Request $request){

    $request->validate([
        'element_id' => 'required|integer',
        'description' => 'required|string|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'expiration_date' => 'required|date',
    ]);

    $inventory = new Inventory();
    $inventory->element_id = $request->post('element_id');
    $inventory->productive_unit_warehouse_id = $request->post('productive_unit_warehouse_id');
    $inventory->person_id = $request->post('person_id');
    $inventory->description = $request->post('description');
    $inventory->price = $request->post('price');
    $inventory->stock = $request->post('stock');
    $inventory->amount = $request->post('stock');
    $inventory->expiration_date = $request->post('expiration_date');
    $inventory->save();

    return redirect()->route('cefa.agroindustria.storer.inventory')->with("success" , "AGREGADO CON EXITO"); 
}  
    

//Funcion de editar.
public function editForm($id)
{
    $inventory = Inventory::findOrFail($id);
    $elements = Element::all();
    $productiveunitwarehouses = ProductiveUnitWarehouse::all();

    return view('agroindustria::storer.inventory', compact('inventory', 'elements', 'productiveunitwarehouses'));
}
//Funcion Eliminar.
public function destroy($id)
{
    $inventory = Inventory::findOrFail($id);
    $inventory->delete();
    
    return redirect()->route('cefa.agroindustria.storer.inventory')->with("destroy", "ELIMINADO CON EXITO");
}

    
        
    

/*     public function edit($id)
{
    $inventory = Inventory::findOrFail($id);
    $elements = Element::all();
    $productiveunitwarehouses = ProductiveUnitWarehouse::all();

    return view('agroindustria::storer.inventory', compact('inventory', 'elements', 'productiveunitwarehouses'));
}

public function update(Request $request, $id)
{
  $request->validate([
            'element_id' => 'required|integer',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'expiration_date' => 'required|date',
        ]);

    $inventory = Inventory::findOrFail($id);
    $inventory->element_id = $request->post('element_id');
    $inventory->productive_unit_warehouse_id = $request->post('productive_unit_warehouse_id');
    $inventory->person_id = $request->post('person_id');
    $inventory->description = $request->post('description');
    $inventory->price = $request->post('price');
    $inventory->stock = $request->post('stock');
    $inventory->amount = $request->post('stock');
    $inventory->expiration_date = $request->post('expiration_date');
    $inventory->save();

    return redirect()->route('cefa.agroindustria.storer.inventory')->with("success", "ACTUALIZADO CON EXITO");
}
 */
         
        
                               
                    
                            

                   
        


}