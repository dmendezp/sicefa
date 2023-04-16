<?php

namespace Modules\SICA\Http\Controllers\inventory;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Category;

class ParameterController extends Controller
{

    public function index(){ // Carga vista de parametros con la tabla de categorías
        $categories = Category::get();
        $data = ['title'=>trans('sica::menu.Parameters'),'categories'=>$categories];
        return view('sica::admin.inventory.parameters.index',$data);
    }

}
