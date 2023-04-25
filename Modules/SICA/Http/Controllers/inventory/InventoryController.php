<?php

namespace Modules\SICA\Http\Controllers\inventory;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\KindOfPurchase;

class InventoryController extends Controller
{
    public function warehouses(){
        $warehouses = Warehouse::get();
        $data = ['title'=>trans('sica::menu.Warehouses'),'warehouses'=>$warehouses];
        return view('sica::admin.inventory.warehouses.home',$data);
    }
    
    /* Inicio de funciones de elementos */
    public function elements(){
        $elements = Element::orderBy('updated_at', 'DESC')->get();
        $categories = Category::orderBy('updated_at', 'DESC')->get(); // Consultar categorías de manera descende por el dato updated_at
        $measurementUnit = MeasurementUnit::orderBy('updated_at', 'DESC')->get(); // Consultar measurementUnit de manera descende por el dato updated_at
        $kindOfPurchase = KindOfPurchase::orderBy('updated_at', 'DESC')->get();
        $data = ['title'=>trans('sica::menu.Inventory'),'elements'=>$elements, 'categories'=>$categories, 'measurementUnit'=>$measurementUnit, 'kindOfPurchase'=>$kindOfPurchase];
        return view('sica::admin.inventory.elements.home',$data);
    }

    public function createElement()
    {
        $title = 'Agregar Elemento';
        return view('sica::admin.inventory.elements.create', compact('title'));
    }

    public function storeElement(){

    }

    public function editElement(Element $elements){
        $categories = Category::orderBy('updated_at', 'DESC')->get(); // Consultar categorías de manera descende por el dato updated_at
        $measurementUnit = MeasurementUnit::orderBy('updated_at', 'DESC')->get(); // Consultar measurementUnit de manera descende por el dato updated_at
        $kindOfPurchase = KindOfPurchase::orderBy('updated_at', 'DESC')->get();
        $title = 'Editar Elemento';
        return view('sica::admin.inventory.elements.edit', compact('elements','categories', 'measurementUnit', 'kindOfPurchase', 'title'));
    }

    public function showElement($id){
        $elements = Element::find($id);
        $categories = Category::orderBy('updated_at', 'DESC')->get(); // Consultar categorías de manera descende por el dato updated_at
        $measurementUnit = MeasurementUnit::orderBy('updated_at', 'DESC')->get(); // Consultar measurementUnit de manera descende por el dato updated_at
        $kindOfPurchase = KindOfPurchase::orderBy('updated_at', 'DESC')->get();
        return view('sica::admin.inventory.elements.show', compact('elements', 'categories', 'measurementUnit', 'kindOfPurchase', 'title'));
    }

    /* Fin de funciones de elementos */

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
