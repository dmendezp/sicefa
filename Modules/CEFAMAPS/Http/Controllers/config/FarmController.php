<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\ClassEnvironment;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Municipality;

class FarmController extends Controller
{
  /**
   * Display a listing of the resource.
    * @return Renderable
   */
  public function index()
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $classenviron = ClassEnvironment::get();
    $farm = Farm::with('municipality')->get();
    $data = ['title'=>trans('cefamaps::farm.Farm'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'classenviron'=>$classenviron];
    return view('cefamaps::admin.farm.index',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function add()
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $classenviron = ClassEnvironment::get();
    $farm = Farm::get();
    $person = Person::get();
    $muni = Municipality::get();
    $data = ['title'=>trans('cefamaps::farm.Add farm'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'person'=>$person, 'muni'=>$muni, 'classenviron'=>$classenviron];
    return view('cefamaps::admin.farm.add',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function addpost(Request $request)
  {
    $add = new Farm;
    $add -> name = e ($request->input('name'));
    $add -> description = e ($request->input('description'));
    $add -> area = e ($request->input('area'));
    $add -> person_id = e ($request->input('person'));
    $add -> municipality_id = e ($request->input('muni'));
    if($add -> save()){
      return redirect(route('cefamaps.admin.config.farm.index'));
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
    $classenviron = ClassEnvironment::get();
    $farm = Farm::get();
    $person = Person::get();
    $muni = Municipality::get();
    $editfarm = Farm::findOrFail($id);
    $data = ['title'=>trans('cefamaps::farm.Edit'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'person'=>$person, 'muni'=>$muni, 'editfarm'=>$editfarm, 'classenviron'=>$classenviron ];
    return view('cefamaps::admin.farm.edit',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function editpost(Request $request)
  {
    $edit = Farm::findOrFail($request->input('id'));
    $edit -> name = e ($request->input('name'));
    $edit -> description = e ($request->input('description'));
    $edit -> area = e ($request->input('area'));
    $edit -> person_id = e ($request->input('person'));
    $edit -> municipality_id = e ($request->input('muni'));
    if($edit -> save()){
      return redirect(route('cefamaps.admin.config.farm.index'));
    }
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function view($id)
  {
    $unit = ProductiveUnit::get();
    $environ = Environment::get();
    $farm = Farm::get();
    $viewfarm = Farm::findOrFail($id);
    $data = ['title'=>trans('cefamaps::unit.View'), 'unit'=>$unit, 'environ'=>$environ, 'farm'=>$farm, 'viewfarm'=>$viewfarm];
    return view('cefamaps::admin.farm.view',$data);
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function destroy($id)
  {
    $remove = Farm::findOrFail($id);
    if($remove->delete());
    return back()->with('message', 'Unidad Borrada Exitosamente')->with('typealert', 'succes');
  }
}
