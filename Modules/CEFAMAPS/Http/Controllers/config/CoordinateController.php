<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Farm;
use Modules\CEFAMAPS\Entities\Coordinate;

class CoordinateController extends Controller
{
  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function index()
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $farm = Farm::get();
    $coor = Coordinate::get();
    $data = ['title'=>trans('cefamaps::coordinate.Coordinate'),'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'coor'=>$coor];
    return view('cefamaps::admin.coordenate.index', $data);
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
    $coor = Coordinate::get();
    $data = ['title'=>trans('cefamaps::coordinate.Coordinate'),'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'coor'=>$coor];
    return view('cefamaps::admin.coordenate.add', $data);
  }

  /**
   * Display a listing of the resource,
   * @return Renderable
   */
  public function addpost(Request $request)
  {
    $c = 0;
    foreach ($request->input('length') as $le) {
      $add = new Coordinate;
      $add -> environment_id = e ($request->input('environ'));
      $add -> length = $le;
      $add -> latitude = e ($request->input('latitude')[$c]);
      $c++;
      if ($add -> save()) {
        
      }
    }
    return redirect(route('cefamaps.admin.config.coordenate.index'));
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
    $coor = Coordinate::get();
    $editcoor = Coordinate::findOrFail($id);
    $data = ['title'=>trans('cefamaps::coordinate.Coordinate'),'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'coor'=>$coor, 'editcoor'=>$editcoor];
    return view('cefamaps::admin.coordenate.edit', $data);
  }

  /**
   * Display a listing of the resource,
   * @return Renderable
   */
  public function destroy($id)
  {
    $remove = Coordinate::findOrFail($id);
    if ($remove->delete());
    return back();
  }
}