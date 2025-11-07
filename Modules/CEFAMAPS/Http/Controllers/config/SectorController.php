<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Sector;
use Modules\SICA\Entities\ClassEnvironment;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Municipality;

class SectorController extends Controller
{
  /**
   * Display a listing of the resource.
    * @return Renderable
   */
  public function index(Request $request)
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $classenviron = ClassEnvironment::get();
    $sector = Sector::get();
    $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Sector_Index_title_page'), 'environ'=>$environ, 'unit'=>$unit, 'sector'=>$sector, 'classenviron'=>$classenviron];
    return view('cefamaps::admin.sector.index',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function add(Request $request)
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $classenviron = ClassEnvironment::get();
    $sector = Sector::get();
    $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Sector_Add_title_page'), 'environ'=>$environ, 'unit'=>$unit, 'sector'=>$sector, 'classenviron'=>$classenviron];
    return view('cefamaps::admin.sector.add',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function addpost(Request $request)
  {
    $add = new Sector;
    $add -> name = e ($request->input('name'));
    $add -> description = e ($request->input('description'));
    if($add -> save()){
      return redirect(route('cefamaps.admin.config.sector.index'));
    }
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function edit($id, Request $request)
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $sector = Sector::get();
    $classenviron = ClassEnvironment::get();
    $editsector = Sector::findOrFail($id);
    $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Sector_Edit_title_page'), 'environ'=>$environ, 'unit'=>$unit, 'sector'=>$sector, 'editsector'=>$editsector, 'classenviron'=>$classenviron];
    return view('cefamaps::admin.sector.edit',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function editpost(Request $request)
  {
    $edit = Sector::findOrFail($request->input('id'));
    $edit -> name = e ($request->input('name'));
    $edit -> description = e ($request->input('description'));
    if($edit -> save()){
      return redirect(route('cefamaps.admin.config.sector.index'));
    }
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function destroy($id)
  {
    $remove = Sector::findOrFail($id);
    if($remove->delete()){
      return back();
    }
  }
}
