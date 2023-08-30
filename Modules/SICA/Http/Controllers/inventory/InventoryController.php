<?php

namespace Modules\SICA\Http\Controllers\inventory;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\KindOfPurchase;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{

    /* Listado de bodegas disponible */
    public function warehouse_index(){
        $warehouses = Warehouse::orderBy('updated_at','DESC')->get();
        $data = ['title'=>trans('sica::menu.Warehouses'),'warehouses'=>$warehouses];
        return view('sica::admin.inventory.warehouses.index',$data);
    }

    /* Formulario de registro de bodega */
    public function warehouse_create(){
        $apps = App::orderBy('name','ASC')->get();
        $data = ['title'=>'Bodegas - Registro','apps'=>$apps];
        return view('sica::admin.inventory.warehouses.create',$data);
    }

    /* Registrar bodega */
    public function warehouse_store(Request $request){
        $rules = [
            'name' => 'required|unique:warehouses',
            'description' => 'required',
            'app_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Realizar registro
        if (Warehouse::create($request->all())){
            $message = ['message'=>'Se registró exitosamente la bodega.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo realizar el registro de la bodega.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.inventory.warehouse.index'))->with($message);
    }

    /* Ver bodega a actualizar */
    public function warehouse_edit(Warehouse $warehouse){
        $apps = App::orderBy('name','ASC')->get();
        $data = ['title'=>'Bodegas - Actualizar', 'apps'=>$apps, 'warehouse'=>$warehouse];
        return view('sica::admin.inventory.warehouses.edit',$data);
    }

    /* Actualizar bodega */
    public function warehouse_update(Request $request, Warehouse $warehouse){
        $rules = [
            'name' => 'required|unique:warehouses,name,'.$warehouse->id,
            'description' => 'required',
            'app_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Actualizar registro
        if ($warehouse->update($request->all())){
            $message = ['message'=>'Se actualizó exitosamente la bodega.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo realizar la actualización de la bodega.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.inventory.warehouse.index'))->with($message);
    }

    /* Eliminar bodega */
    public function warehouse_destroy(Warehouse $warehouse){
        if ($warehouse->delete()){
            $message = ['message'=>'Se eliminó exitosamente la bodega.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo eliminar la bodega.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.inventory.warehouse.index'))->with($message);
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
