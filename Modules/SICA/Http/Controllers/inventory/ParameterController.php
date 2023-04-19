<?php

namespace Modules\SICA\Http\Controllers\inventory;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Category;

class ParameterController extends Controller
{

    public function index(){ // Carga vista de parametros con la tabla de categorías
        $categories = Category::get();
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
            $message_config = 'Categoria actualizada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo actualizar la categoria.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

    public function editCategoryGet($id){
        $c = Category::find($id);
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
        $c = Category::find($id);
        return view('sica::admin.inventory.parameters.category.delete',compact('category'));
    }

    public function deleteEpsPost(Request $request){
        $c = Category::findOrFail($request->input('id'));
        $card = 'card-category';
        if($c->delete()){
            $icon = 'success';
            $message_config = 'Categoría eliminada exitosamente.';
        }else{
            $icon = 'error';
            $message_config = 'No se pudo eliminar la categoría.';
        }
        return back()->with(['card'=>$card, 'icon'=>$icon, 'message_config'=>$message_config]);
    }

}
