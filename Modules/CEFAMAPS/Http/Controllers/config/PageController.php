<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Farm;
use Modules\CEFAMAPS\Entities\Page;

class PageController extends Controller
{
  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function index(Request $request)
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $farm = Farm::get();
    // filtro de la pagina con el id
    $query = DB::table('pages');
    if ($request->has('id')) {
      $query->where('environment_id', $request->id);
    }
    $final = $query->get();
    $data = ['title'=>trans('cefamaps::page.Page'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm];
    return view('cefamaps::admin.page.index',$data, compact('final'));
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function add()
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $farm = Farm::get();
    $page = Page::get();
    $data = ['title'=>trans('cefamaps::page.Page'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'page'=>$page];
    return view('cefamaps::admin.page.add',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function addpost(Request $request)
  {
    $add = new Page;
    $add -> name = e ($request->input('name'));
    $add -> environment_id = e ($request->input('environ'));
    $add -> content = e ($request->input('content'));
    if ($add -> save()) {
      return redirect(route('cefamaps.admin.config.page.index'));
    }
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function edit($id)
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $farm = Farm::get();
    $page = Page::get();
    $editpage = Page::findOrFail($id);
    $data = ['title'=>trans('cefamaps::page.Page'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'page'=>$page, 'editpage'=>$editpage];
    return view('cefamaps::admin.page.edit',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function editpost(Request $request)
  {
    $edit = Page::findOrFail($request->input('id'));
    $edit -> name = e ($request->input('name'));
    $edit -> environment_id = e ($request->input('environ'));
    $edit -> content = e ($request->input('content'));
    if ($edit -> save()) {
      return redirect(route('cefamaps.admin.config.page.index'));
    }
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function destroy($id)
  {
    $remove = Page::findOrFail($id);
    if ($remove->delete()) {
      return back();
    }
  }
}
