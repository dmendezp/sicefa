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
        $measurement_units = MeasurementUnit::orderBy('name','ASC')->pluck('name','id'); 
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $kind_of_purchase = KindOfPurchase::orderBy('name','ASC')->pluck('name','id');
        return view('sica::admin.inventory.elements.create', compact('title', 'measurement_units', 'categories', 'kind_of_purchase'));
    }

    public function storeElement(Request $request){
        $element = $request->all();

        if($imagen = $request->file('image')) {
            $extension =  pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION); // Capturar la extensión de la nueva imagen
            $name_image =  $element->slug . '.' . $extension; // Generar el nombre por defecto de la nueva imagen
            $image->move(public_path('modules/sica/images/elements/'), $name_image); 
        }
        Element::create($element);
        return redirect()->route('sica.admin.inventory.elements');
    }

    public function editElement(Element $element){
        $title = 'Agregar Elemento';
        $measurement_units = MeasurementUnit::orderBy('name','ASC')->pluck('name','id'); 
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $kind_of_purchase = KindOfPurchase::orderBy('name','ASC')->pluck('name','id');
        return view('sica::admin.inventory.elements.edit', compact('element', 'measurement_units', 'categories', 'kind_of_purchase', 'title'));
    }

    public function showElement(Element $element){
        $measurement_units = MeasurementUnit::orderBy('name','ASC')->pluck('name','id'); 
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $kind_of_purchase = KindOfPurchase::orderBy('name','ASC')->pluck('name','id');
        return view('sica::admin.inventory.elements.show', compact('element', 'measurement_units', 'categories', 'kind_of_purchase'));
    }

    public function deleteElement($id){
        $element = Element::find($id);
        return view('sica::admin.inventory.elements.delete',compact('element'));
    }

    public function destroyElement(Request $request){
        $element = Element::findOrFail($request->input('id'));
        $card = 'card-element';
        if($element->delete()){
            $icon = 'success';
            $message_config = 'El elemento fue eliminado exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo eliminar el elemento.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
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
