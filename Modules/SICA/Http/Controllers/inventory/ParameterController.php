<?php

namespace Modules\SICA\Http\Controllers\inventory;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Category;

class ParameterController extends Controller
{

    public function index(){ // Carga de vista de parametros con la tabla de categorías
        $categories = Category::orderBy('updated_at', 'DESC')->get(); // Consultar categorías de manera descende por el dato updated_at
        $data = ['title'=>trans('sica::menu.Parameters'),'categories'=>$categories];
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
        $c = Category::findOrFail($request->input('id'));
        $c->name = e($request->input('name'));
        $card = 'card-category';
        if($c->save()){
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
}
