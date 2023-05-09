<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Validator;
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
    $filter = Environment::query()->with('farms','productive_units');
    if ($request->has('id')) {
      $filter->where('farms_id', $request->id);
      $filter->where('productive_units_id', $request->id);
    }
    $result = $filter->get();
    $data = ['title'=>trans('cefamaps::sector.Index'), 'environ'=>$environ, 'unit'=>$unit, 'sector'=>$sector, 'classenviron'=>$classenviron, 'filter'=>$filter];
    return view('cefamaps::admin.sector.index',$data, compact('result'));
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
    $filter = Environment::query()->with('farms','productive_units');
    if ($request->has('id')) {
      $filter->where('farms_id', $request->id);
      $filter->where('productive_units_id', $request->id);
    }
    $result = $filter->get();
    $data = ['title'=>trans('cefamaps::sector.Add'), 'environ'=>$environ, 'unit'=>$unit, 'sector'=>$sector, 'classenviron'=>$classenviron, 'filter'=>$filter];
    return view('cefamaps::admin.sector.add',$data, compact('result'));
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
    $filter = Environment::query()->with('farms','productive_units');
    if ($request->has('id')) {
      $filter->where('farms_id', $request->id);
      $filter->where('productive_units_id', $request->id);
    }
    $result = $filter->get();
    $data = ['title'=>trans('cefamaps::sector.Edit'), 'environ'=>$environ, 'unit'=>$unit, 'sector'=>$sector, 'editsector'=>$editsector, 'classenviron'=>$classenviron, 'filter'=>$filter];
    return view('cefamaps::admin.sector.edit',$data, compact('result'));
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
