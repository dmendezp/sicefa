<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ClassEnvironment;
use Modules\SICA\Entities\Sector;
use Illuminate\Support\Facades\Route;

class ClassController extends Controller
{
    public function index(Request $request)
  {
    $sector = Sector::get();
    $class = ClassEnvironment::get();
    $data = ['titlePage'=>trans('cefamaps::general.Class'),'sector'=>$sector, 'classenviron'=>$class,];
    return view('cefamaps::admin.classenvironment.index',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function add(Request $request)
  {
    $classenviron = ClassEnvironment::get();
    $sector = Sector::get();
    $data = ['titlePage'=>trans('cefamaps::general.Class'),'sector'=>$sector, 'classenviron'=>$classenviron];
    return view('cefamaps::admin.classenvironment.add',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function addpost(Request $request)
  {
    $add = new ClassEnvironment;
    $add -> name = e ($request->input('name'));
    if($add -> save()){
      return redirect(route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.config.class.index'));
    }
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function edit($id, Request $request)
  {
    $sector = Sector::get();
    $classenviron = ClassEnvironment::get();
    $editclass = ClassEnvironment::findOrFail($id);
    $data = ['titlePage'=>trans('cefamaps::general.Class'),'sector'=>$sector, 'editclass'=>$editclass, 'classenviron'=>$classenviron];
    return view('cefamaps::admin.classenvironment.edit',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function editpost(Request $request)
  {
    $edit = ClassEnvironment::findOrFail($request->input('id'));
    $edit -> name = e ($request->input('name'));
    if($edit -> save()){
      return redirect(route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.config.class.index'));
    }
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function destroy($id)
  {
    $remove = ClassEnvironment::findOrFail($id);
    if($remove->delete()){
      return back();
    }
  }
}
