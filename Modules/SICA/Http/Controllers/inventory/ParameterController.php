<?php

namespace Modules\SICA\Http\Controllers\inventory;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;

class ParameterController extends Controller
{

    /* Vista principal de parámetros para inventario */
    public function index(){ // Carga de vista de parametros con la tabla de categorías
        $categories = Category::orderBy('updated_at', 'DESC')->get(); // Consultar categorías de manera descende por el dato updated_at
        $measurementUnit = MeasurementUnit::orderBy('updated_at', 'DESC')->get(); // Consultar measurementUnit de manera descende por el dato updated_at
        $kindOfPurchase = KindOfPurchase::orderBy('updated_at', 'DESC')->get(); // Consultar kindOfPurchase de manera descende por el dato uptaded_at
        $movement_types = MovementType::orderBy('name', 'ASC')->get(); // Consultar todos los registro de MovementType por orden alfabetico ascendente del atributo name
        $data = ['title'=>trans('sica::menu.Parameters'),'categories'=>$categories, 'measurementUnit'=>$measurementUnit, 'kindOfPurchase'=>$kindOfPurchase, 'movement_types'=>$movement_types];
        return view('sica::admin.inventory.parameters.index',$data);
    }

    //Funciones para Categoria
    public function createCategory(){
        return view('sica::admin.inventory.parameters.category.create');
    }

    public function storeCategory(Request $request){
        $c = new Category;
        $c->name = e($request->input('name'));
        $c->kind_of_property = e($request->input('kind_of_property'));
        $card = 'card-categories';
        if($c->save()){
            $icon = 'success';
            $message_parameter = 'Categoria agregada exitosamente.';
        }else{
            $icon = 'error';
            $message_parameter = 'No se pudo agregar la categoria.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_parameter'=>$message_parameter]);
    }

    public function editCategory($id){
        $category = Category::find($id);
        return view('sica::admin.inventory.parameters.category.edit',compact('category'));
    }

    public function updateCategory(Request $request){
        $category = Category::findOrFail($request->input('id'));
        $category->name = e($request->input('name'));
        $category->kind_of_property = e($request->input('kind_of_property'));
        $card = 'card-categories';
        if($category->save()){
            $icon = 'success';
            $message_parameter = 'Categoria actualizada exitosamente.';
        }else{
            $icon = 'error';
            $message_parameter = 'No se pudo actualizar la categoria.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_parameter'=>$message_parameter]);
    }

    public function deleteCategory($id){
        $category = Category::find($id);
        return view('sica::admin.inventory.parameters.category.delete',compact('category'));
    }

    public function destroyCategory(Request $request){
        $category = Category::findOrFail($request->input('id'));
        $card = 'card-categories';
        if($category->delete()){
            $icon = 'success';
            $message_parameter = 'Categoría eliminada exitosamente.';
        }else{
            $icon = 'error';
            $message_parameter = 'No se pudo eliminar la categoría.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_parameter'=>$message_parameter]);
    }

    //Funciones para Unidades de Medida
    public function createMeasurementUnit(){
        return view('sica::admin.inventory.parameters.measurementUnit.create');
    }

    public function storeMeasurementUnit(Request $request){
        $m = new MeasurementUnit();
        $m->name = e($request->input('name'));
        $m->abbreviation = e($request->input('abbreviation'));
        $m->minimum_unit_measure = e($request->input('minimum_unit_measure'));
        $m->conversion_factor = e($request->input('conversion_factor'));
        $card = 'card-measurementUnit';
        if($m->save()){
            $icon = 'success';
            $message_config = 'Unidad de medida agregada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo agregar la Unidad de medida.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function editMeasurementUnit($id){
        $measurementUnit = MeasurementUnit::find($id);
        return view('sica::admin.inventory.parameters.measurementUnit.edit',compact('measurementUnit'));
    }

    public function updateMeasurementUnit(Request $request){
        $measurementUnit = MeasurementUnit::findOrFail($request->input('id'));
        $measurementUnit->name = e($request->input('name'));
        $measurementUnit->abbreviation = e($request->input('abbreviation'));
        $measurementUnit->minimum_unit_measure = e($request->input('minimum_unit_measure'));
        $measurementUnit->conversion_factor = e($request->input('conversion_factor'));
        $card = 'card-measurementUnit';
        if($measurementUnit->save()){
            $icon = 'success';
            $message_config = 'Unidad de medida actualizada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo actualizar la Unidad de medida.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function deleteMeasurementUnit($id){
        $measurementUnit = MeasurementUnit  ::find($id);
        return view('sica::admin.inventory.parameters.measurementUnit.delete',compact('measurementUnit'));
    }

    public function destroyMeasurementUnit(Request $request){
        $measurementUnit = MeasurementUnit::findOrFail($request->input('id'));
        $card = 'card-measurementUnit';
        if($measurementUnit->delete()){
            $icon = 'success';
            $message_config = 'Unidad de medida eliminada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo eliminar la Unidad de medida.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    //Funciones para Tipo de compra
    public function createKindOfPurchase(){
        return view('sica::admin.inventory.parameters.kindOfPurchase.create');
    }

    public function storeKindOfPurchase(Request $request){
        $k = new KindOfPurchase;
        $k->name = e($request->input('name'));
        $k->description = e($request->input('description'));
        $card = 'card-kind_of_purchases';
        if($k->save()){
            $icon = 'success';
            $message_parameter = 'Tipo de compra agregada exitosamente.';
        }else{
            $icon = 'error';
            $message_parameter = 'No se pudo agregar el tipo de compra';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_parameter'=>$message_parameter]);
    }

    public function editKindOfPurchase($id){
        $kindOfPurchase = KindOfPurchase::find($id);
        return view('sica::admin.inventory.parameters.kindOfPurchase.edit',compact('kindOfPurchase'));
    }

    public function updateKindOfPurchase(Request $request){
        $k = KindOfPurchase::findOrFail($request->input('id'));
        $k->name = e($request->input('name'));
        $k->description = e($request->input('description'));
        $card = 'card-kind_of_purchases';
        if($k->save()){
            $icon = 'success';
            $message_parameter = 'Tipo de compra actualizada exitosamente.';
        }else{
            $icon = 'error';
            $message_parameter = 'No se pudo actualizar el tipo de compra.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_parameter'=>$message_parameter]);
    }

    public function deleteKindOfPurchase($id){
        $kindOfPurchase = KindOfPurchase::find($id);
        return view('sica::admin.inventory.parameters.kindOfPurchase.delete',compact('kindOfPurchase'));
    }

    public function destroyKindOfPurchase(Request $request){
        $kindOfPurchase = KindOfPurchase::findOrFail($request->input('id'));
        $card = 'card-kind_of_purchases';
        if($kindOfPurchase->delete()){
            $icon = 'success';
            $message_parameter = 'Tipo de compra eliminada exitosamente.';
        }else{
            $icon = 'error';
            $message_parameter = 'No se pudo eliminar el tipo de compra.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_parameter'=>$message_parameter]);
    }

    //Funciones para Tipo de Movimiento
    public function createMovementType(){
        return view('sica::admin.inventory.parameters.movement_type.create');
    }

    public function storeMovementType(Request $request){
        $c = new MovementType;
        $c->name = e($request->input('name'));
        $c->consecutive = e($request->input('consecutive'));
        $card = 'card-movement_type';
        if($c->save()){
            $icon = 'success';
            $message_parameter = 'Tipo de Movimiento agregado exitosamente.';
        }else{
            $icon = 'error';
            $message_parameter = 'No se pudo agregar el Tipo de Movimiento.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_parameter'=>$message_parameter]);
    }

    public function editMovementType($id){
        $movement_type = MovementType::find($id);
        return view('sica::admin.inventory.parameters.movement_type.edit',compact('movement_type'));
    }

    public function updateMovementType(Request $request){
        $movement_type = MovementType::findOrFail($request->input('id'));
        $movement_type->name = e($request->input('name'));
        $movement_type->consecutive = e($request->input('consecutive'));
        $card = 'card-movement_type';
        if($movement_type->save()){
            $icon = 'success';
            $message_parameter = 'Tipo de Movimiento actualizado exitosamente.';
        }else{
            $icon = 'error';
            $message_parameter = 'No se pudo actualizar el Tipo de Movimiento.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_parameter'=>$message_parameter]);
    }

    public function deleteMovementType($id){
        $movement_type = MovementType::find($id);
        return view('sica::admin.inventory.parameters.movement_type.delete',compact('movement_type'));
    }

    public function destroyMovementType(Request $request){
        $movement_type = MovementType::findOrFail($request->input('id'));
        $card = 'card-movement_type';
        if($movement_type->delete()){
            $icon = 'success';
            $message_parameter = 'Tipo de Movimiento eliminado exitosamente.';
        }else{
            $icon = 'error';
            $message_parameter = 'No se pudo eliminar el Tipo de Movimiento.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_parameter'=>$message_parameter]);
    }

}
