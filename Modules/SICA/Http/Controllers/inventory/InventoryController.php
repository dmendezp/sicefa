<?php

namespace Modules\SICA\Http\Controllers\inventory;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\App;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\ProductiveUnit;
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
            $icon = 'success';
            $message_warehouse = trans('sica::menu.Warehouse successfully added');
        }else{
            $icon = 'error';
            $message_warehouse = trans('sica::menu.Could not add Warehouse');
        }
        return redirect(route('sica.admin.inventory.warehouse.index'))->with(['icon'=>$icon, 'message_warehouse'=>$message_warehouse]);
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
            $icon = 'success';
            $message_warehouse = trans('sica::menu.Warehouse successfully updated');
        }else{
            $icon = 'error';
            $message_warehouse = trans('sica::menu.Failed to update Warehouse');
        }
        return redirect(route('sica.admin.inventory.warehouse.index'))->with(['icon'=>$icon, 'message_warehouse'=>$message_warehouse]);
    }

     /* Formulario de eliminación de bodega */
     public function warehouse_delete($id){
        $warehouse = Warehouse::find($id);
        $data = [ 'title' => 'Eliminar Bodega', 'warehouse' => $warehouse];
        return view('sica::admin.inventory.warehouses.delete', $data);
    }

    /* Eliminar bodega */
    public function warehouse_destroy(Request $request){
        $warehouse = Warehouse::findOrFail($request->input('id'));
        if($warehouse->delete()){
            $icon = 'success';
            $message_warehouse = trans('sica::menu.Warehouse successfully removed');
        }else{
            $icon = 'error';
            $message_warehouse = trans('sica::menu.Could not delete Warehouse');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_warehouse'=>$message_warehouse]);
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
        $warehouses = Warehouse::get();
        $data = ['title'=>trans('sica::menu.Inventory'),'warehouses'=>$warehouses];
        return view('sica::admin.inventory.inventory.home',$data);
    }

    public function inventory_filter(Request $request){

       $warehouse_id = Warehouse::where('id',$request->input('warehouse_id'))->pluck('id');
       
       // Obtener los registros de 'productive_unit_warehouses' que coinciden con la unidad productiva seleccionada
       $unitWarehouses = ProductiveUnitWarehouse::where('warehouse_id', $warehouse_id)->pluck('id');

       $datenow = Carbon::now();

       // Obtener los registros de inventario que coinciden con las bodegas relacionadas
       $inventory = Inventory::whereIn('productive_unit_warehouse_id', $unitWarehouses)->where('state','=','Disponible')->where('amount','>','0')->get();

       // Inicializa un array para almacenar la información de las bodegas
       $warehouseData = [];

       
       $datas = [];
       
       foreach ($inventory as $inventor) {
           $id = $inventor['id'];

   
           // Agregar información al array asociativo
           $datas[] = [
               'id' => $id,
           ];
           
       }

       // Contar el número de registros después de obtener los datos
       $lowCount = count($datas);

       Session::put('notificationlow', $lowCount);

       return view('sica::admin.inventory.inventory.table', [
           'inventory' => $inventory,
           'notificationlow' => $lowCount,
           'no_found' => 'No se encontraron elementos de la bodega seleccionada'
       ]);
    }
}
