<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\KindOfPurchase;

class HomeController extends Controller
{

    public function welcome()
    {
        $apps = App::all();
        $productiveunit = ProductiveUnit::where('name','=','Punto de venta')->pluck('id');
        $warehouse = Warehouse::where('name','=','Punto de venta')->pluck('id');
        $kind_of_purchase = KindOfPurchase::where('name','=','Producción de centro')->first();
        $productiveunit_warehouse = ProductiveUnitWarehouse::where('productive_unit_id',$productiveunit)->where('warehouse_id',$warehouse)->pluck('id');
        $category = Category::whereHas('elements.inventories', function ($query) use ($productiveunit_warehouse) {
            $query->where('productive_unit_warehouse_id', $productiveunit_warehouse)->where('amount','>','0');
        })->whereHas('elements', function ($query) use ($kind_of_purchase) {
            $query->where('kind_of_purchase_id', $kind_of_purchase->id);
        })->get();
        
        $inventory = Inventory::with('element.category')->where('productive_unit_warehouse_id', $productiveunit_warehouse)
            ->whereHas('element', function ($query) use ($kind_of_purchase) {
                $query->where('kind_of_purchase_id', $kind_of_purchase->id);
            })
            ->where('amount','>','0')
            ->get()
            ->unique('element_id');
      

        $data = ['apps'=>$apps, 'inventories'=>$inventory, 'categories'=>$category];
        return view('welcome', $data);
    }

    public function developers()
    {
        return view('designners');
    }

    public function index()
    {
        $apps = App::all();
        $data = ['apps'=>$apps];
        return view('home', $data);
    }
}
