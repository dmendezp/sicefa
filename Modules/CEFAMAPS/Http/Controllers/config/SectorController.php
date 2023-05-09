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
    $farm = Farm::get();
    $person = Person::get();
    $muni = Municipality::get();
    $filter = Environment::query()->with('farms','productive_units');
    if ($request->has('id')) {
      $filter->where('farms_id', $request->id);
      $filter->where('productive_units_id', $request->id);
    }
    $result = $filter->get();
    $data = ['title'=>trans('cefamaps::farm.Add farm'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'person'=>$person, 'muni'=>$muni, 'classenviron'=>$classenviron, 'filter'=>$filter];
    return view('cefamaps::admin.sector.add',$data, compact('result'));
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function addpost(Request $request)
  {
    $rules = [
      "person" => "required|max:5"
    ];
    $messages = [
      "person.required" => 'Algo salio mal en tu numero de documento, intenta de nuevo buscandolo',
    ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
      return back()->withErrors($validator)->with('message', 'Algo fallo en el proceso')->with('typealert', 'danger');
      else:
      $add = new Farm;
      $add -> name = e ($request->input('name'));
      $add -> description = e ($request->input('description'));
      $add -> area = e ($request->input('area'));
      $add -> person_id = e ($request->input('person'));
      $add -> municipality_id = e ($request->input('muni'));
      if($add -> save()){
        return redirect(route('cefamaps.admin.config.sector.index'));
      }
    endif;
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function edit($id, Request $request)
  {
    $environ = Environment::get();
    $unit = ProductiveUnit::get();
    $classenviron = ClassEnvironment::get();
    $farm = Farm::get();
    $person = Person::get();
    $muni = Municipality::get();
    $editfarm = Farm::findOrFail($id);
    $filter = Environment::query()->with('farms','productive_units');
    if ($request->has('id')) {
      $filter->where('farms_id', $request->id);
      $filter->where('productive_units_id', $request->id);
    }
    $result = $filter->get();
    $data = ['title'=>trans('cefamaps::menu.Edit'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'person'=>$person, 'muni'=>$muni, 'editfarm'=>$editfarm, 'classenviron'=>$classenviron, 'filter'=>$filter];
    return view('cefamaps::admin.sector.edit',$data, compact('result'));
  }

  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function editpost(Request $request)
  {
    $rules = [
      "person" => "required|max:5"
    ];
    $messages = [
      "person.required" => 'Algo salio mal en tu numero de documento, intenta de nuevo buscandolo',
    ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
      return back()->withErrors($validator)->with('message', 'Algo fallo en el proceso')->with('typealert', 'danger');
    else:
      $edit = Farm::findOrFail($request->input('id'));
      $edit -> name = e ($request->input('name'));
      $edit -> description = e ($request->input('description'));
      $edit -> area = e ($request->input('area'));
      $edit -> person_id = e ($request->input('person'));
      $edit -> municipality_id = e ($request->input('muni'));
      if($edit -> save()){
        return redirect(route('cefamaps.admin.config.sector.index'));
      }
    endif;
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
