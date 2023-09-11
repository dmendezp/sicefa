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
class WarehouseController extends Controller
{
    public $app_puw;
   
    // Obtener la relación entre la unidad productiva y el almacén
    public function getAppPuw()
    { 
        if (!$this->app_puw){
            $productiveUnit = ProductiveUnit::where('name','Agroindustria')->firstOrFail();
            $Warehouses = Warehouse::where('name','agroindustria')->firstOrFail();
            $this->app_puw = ProductiveUnitWarehouse::where('productive_unit_id', $productiveUnit->id)
                                                   ->where('warehouse_id', $Warehouses->id)
                                                   ->firstOrFail();


        } 

        
        return $this->app_puw;
    }

    

    // Mostrar el listado de inventario
    public function inventory()
    {
        
     
        $categories = Category::all();
        $elements = Element::all();
        $title = 'inventory';
        $inventories = Inventory::where('productive_unit_warehouse_id', $this->getAppPuw()->id)
                                ->orderBy('updated_at', 'DESC')
                                ->get();

                      
           

        return view('agroindustria::storer.inventory', compact('title', 'inventories', 'categories', 'elements',));
    }



    public function create(Request $request){

     /*    $inventory = new Inventory();
        $inventory->element_id = $request->post('element_id');
        $inventory->productive_unit_warehouse_id = $request->post('productive_unit_warehouse_id');
        $inventory->person_id = $request->post('person_id');
        $inventory->description = $request->post('description');
        $inventory->category_id = $request->post('category_id');
        $inventory->price = $request->post('price');
        $inventory->stock = $request->post('stock');
        $inventory->expiration_date = $request->post('expiration_date');
        $inventory->save();


        return redirect()->route('agroindustria::storer.inventory')->with("success" , "AGREGADO CON EXITO"); */
         
dd($_POST);
        
        


       

    }

}

       
                  
         
        
                               
                    
                            

                   
        


