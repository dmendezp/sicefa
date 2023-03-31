<?php

namespace Modules\GANADERIA\Http\Controllers\reproduction;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GANADERIA\Entities\Page;



class ReproductionController extends Controller
{
<<<<<<< HEAD
   
=======
    public function medicine(){
        
        $data = ['title'=>trans('ganaderia::menu.reproduction')];
        return view('ganaderia::admin.medicine.home',$data);
    }


>>>>>>> 38c7f0aef500bd787694266d92d1596b42416e45
    public function animalrecord(){
        $page = Page::get();
        $data = ['title'=>trans('ganaderia::menu.reproduction'), 'page'=>$page];
        return view('ganaderia::admin.animalrecord.home',$data);        
    }

<<<<<<< HEAD
=======
    public function reproductivebehavior(){
        
        $data = ['title'=>trans('ganaderia::menu.reproduction')];
        return view('ganaderia::admin.reproductivebehavior.home',$data);
    }

>>>>>>> 38c7f0aef500bd787694266d92d1596b42416e45
    public function add(){
        $page = Page::get();
        $data = ['title'=>trans('ganaderia::page.add'), 'page'=>$page];
        return view('ganaderia::admin.animalrecord.add',$data);        
    }

    public function addpost(Request $request){
        $add = new Page;
        $add -> name = e ($request->input('name'));  
        $add -> content = e ($request->input('content'));
        $add -> correo = e ($request->input('correo'));
        if ($add -> save()) {
            return redirect(route('ganaderia.admin.reproduction.animalrecord'));
            # code...
        }
    }

    public function edit($id)
    {
        $page = Page::get();
        $editpage = Page::findOrFail($id);
        $data = ['title'=>trans('ganaderia::page.add'), 'page'=>$page, 'editpage'=>$editpage];
        return view('ganaderia::admin.animalrecord.edit',$data);        
    }

    public function editpost(Request $request)
    {
        $edit = Page::findOrFail($request->input('id'));
        $edit -> name = e ($request->input('name'));
        $edit -> content = e ($request->input('content'));
        $edit -> correo = e ($request->input('correo'));
        if ($edit -> save()) {
            return redirect(route('ganaderia.admin.reproduction.animalrecord'));
        }
             
    }

    public function destroy($id)
    {
        $remove = Page::findOrFail($id);
        if ($remove->delete()) {
            return back();
        }       
    }


    

}
