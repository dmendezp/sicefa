<?php

namespace Modules\SICA\Http\Controllers\inventory;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Element;

class InventoryController extends Controller
{
    public function warehouses(){
        $warehouses = Warehouse::get();
        $data = ['title'=>trans('sica::menu.Warehouses'),'warehouses'=>$warehouses];
        return view('sica::admin.inventory.warehouses.home',$data);
    }

    public function elements(){
        $elements = Element::get();
        $data = ['title'=>trans('sica::menu.Inventory'),'elements'=>$elements];
        return view('sica::admin.inventory.elements.home',$data);
    }

    public function transactions(){
        $data = ['title'=>trans('sica::menu.Inventory')];
        return view('sica::admin.inventory.transactions.home',$data);
    }

    public function inventory(){
        $warehouses = Warehouse::pluck('name','id');
        $data = ['title'=>trans('sica::menu.Inventory'),'warehouses'=>$warehouses];
        return view('sica::admin.inventory.inventory.home',$data);
    }
}
