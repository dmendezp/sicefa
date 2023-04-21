<?php

namespace Modules\SICA\Http\Controllers\inventory;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\KindOfPurchase;

class ParameterController extends Controller
{

    public function index(){ // Carga de vista de parametros con la tabla de categorías
        $categories = Category::orderBy('updated_at', 'DESC')->get(); // Consultar categorías de manera descende por el dato updated_at
        $measurementUnit = MeasurementUnit::orderBy('updated_at', 'DESC')->get(); // Consultar measurementUnit de manera descende por el dato updated_at
        $kindOfPurchase = KindOfPurchase::orderBy('updated_at', 'DESC')->get(); // Consultar kindOfPurchase de manera descende por el dato uptaded_at
        $data = ['title'=>trans('sica::menu.Parameters'),'categories'=>$categories, 'measurementUnit'=>$measurementUnit, 'kindOfPurchase'=>$kindOfPurchase];
        return view('sica::admin.inventory.parameters.index',$data);
    }

    public function addCategoryGet(){
        return view('sica::admin.inventory.parameters.category.add');
    }

    public function addCategoryPost(Request $request){
        $c = new Category;
        $c->name = e($request->input('name'));
        $c->kind_of_property = e($request->input('kind_of_property'));
        $card = 'card-category';
        if($c->save()){
            $icon = 'success';
            $message_config = 'Categoria agregada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo agregar la categoria.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function editCategoryGet($id){
        $category = Category::find($id);
        return view('sica::admin.inventory.parameters.category.edit',compact('category'));
    }

    public function editCategoryPost(Request $request){
        $category = Category::findOrFail($request->input('id'));
        $category->name = e($request->input('name'));
        $category->kind_of_property = e($request->input('kind_of_property'));
        $card = 'card-category';
        if($category->save()){
            $icon = 'success';
            $message_config = 'Categoria actualizada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo actualizar la categoria.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function deleteCategoryGet($id){
        $category = Category::find($id);
        return view('sica::admin.inventory.parameters.category.delete',compact('category'));
    }

    public function deleteCategoryPost(Request $request){
        $category = Category::findOrFail($request->input('id'));
        $card = 'card-category';
        if($category->delete()){
            $icon = 'success';
            $message_config = 'Categoría eliminada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo eliminar la categoría.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    //Funciones para Tipo de compra
    public function addKindOfPurchaseGet(){
        return view('sica::admin.inventory.parameters.kindOfPurchase.add');
    }

    public function addKindOfPurchasePost(Request $request){
        $k = new KindOfPurchase;
        $k->name = e($request->input('name'));
        $k->description = e($request->input('description'));
        if($k->save()){
            $icon = 'success';
            $message_config = 'Tipo de compra agregada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo agregar el tipo de compra';
        }
        return back()->with(['icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function editKindOfPurchaseGet($id){
        $kindOfPurchase = KindOfPurchase::find($id);
        return view('sica::admin.inventory.parameters.kindOfPurchase.edit',compact('kindOfPurchase'));
    }

    public function editKindOfPurchasePost(Request $request){
        $k = KindOfPurchase::findOrFail($request->input('id'));
        $k->name = e($request->input('name'));
        $k->description = e($request->input('description'));
        if($k->save()){
            $icon = 'success';
            $message_config = 'Tipo de compra actualizada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo actualizar el tipo de compra.';
        }
        return back()->with(['icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function deleteKindOfPurchaseGet($id){
        $kindOfPurchase = KindOfPurchase::find($id);
        return view('sica::admin.inventory.parameters.kindOfPurchase.delete',compact('kindOfPurchase'));
    }

    public function deleteKindOfPurchasePost(Request $request){
        $kindOfPurchase = KindOfPurchase::findOrFail($request->input('id'));
        if($kindOfPurchase->delete()){
            $icon = 'success';
            $message_config = 'Tipo de compra eliminada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo eliminar el tipo de compra.';
        }
        return back()->with(['icon'=>$icon, 'message_config'=>$message_config]);
    }
}
