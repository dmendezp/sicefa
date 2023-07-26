<?php

namespace Modules\GANADERIA\Http\Controllers\animal;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Modules\GANADERIA\Entities\Animal;
use Modules\GANADERIA\Entities\Race;

class AnimalController extends Controller
{
  public function index()
  {
    $data = ['title' => trans('ganaderia::leader.index')];
    return view('ganaderia::admin.leader.index', $data);
  }

  public function register()
  {
    $animal = Animal::get();
    $data = ['title'=> trans('ganaderia::leader.register'), 'animal'=>$animal];
    return view('ganaderia::admin.leader.register',$data);
  }

  public function add()
  {
    $animal = Animal::get();
    $raceadd = Race::pluck('name','id');
    $data = ['title'=> trans('ganaderia::leader.add'), 'animal'=>$animal, 'raceadd'=>$raceadd];
    return view('ganaderia::admin.leader.add', $data);
  }

  public function addpost(Request $request)
  {
    $add = new Animal;
    $add -> name = e ($request->input('name'));
    $add -> code = e ($request->input('code'));
    $add -> races_id = e ($request->input('races_id'));
    $add -> mother = e ($request->input('mother'));
    $add -> weight = e ($request->input('peso'));
    $add -> sex = e ($request->input('sex'));
    $add -> color = e ($request->input('color'));
    $add -> date_of_birth = e ($request->input('date'));
    if($add -> save()){
      return redirect(route('ganaderia.admin.leader.register.index'));
    }
  }

  public function edit($id)
  {
    $raceedit = Race::pluck('name','id');
    $editAnimal = Animal::findOrFail($id);
    $data = ['title' => trans('ganaderia::leader.edit'), 'editAnimal'=>$editAnimal, 'raceedit'=>$raceedit];
    return view('ganaderia::admin.leader.edit', $data);
  }

  public function editpost(Request $request)
  {
    $edit = Animal::findOrFail($request->input('id'));
    $edit -> name = e ($request->input('name'));
    $edit -> code = e ($request->input('code'));
    $edit -> races_id = e ($request->input('races_id'));
    $edit -> mother = e ($request->input('mother'));
    $edit -> weight = e ($request->input('peso'));
    $edit -> sex = e ($request->input('sex'));
    $edit -> color = e ($request->input('color'));
    $edit -> date_of_birth = e ($request->input('date'));
    if ($edit -> save()) {
      return redirect(route('ganaderia.admin.leader.register.index'));
    }
  }


  public function destroy($id)
  {
    $remove = Animal::findOrFail($id);
    if ($remove -> delete()) {
      return back()->with('message','El registro del animal fue borrado exitosamente')->with('typealert', 'success');
    }
  }

  public function search(Request $request)
  {
    $code = $request->input('code');
    $searchcode = [];

    if (!empty($code)) {
      $searchcode = Animal::where('code', $code)->get();
    }
    $data = ['title'=>trans('ganaderia::leader.search'), 'searchcode'=>$searchcode];
    return view('ganaderia::admin.leader.search',$data);
  }

  public function searchcrud($mother)
  {
    $search = Animal::where('code', $mother)->get();
    return response()->json($search);
  }

  /* Todas las funciones para las razas */

  public function indexRace()
  {
    $race = Race::get();
    $data = ['title' => trans('ganaderia::race.index'), 'race' => $race];
    return view('ganaderia::admin.leader.race.index', $data);
  }

  public function addRace()
  {
    $data = ['title' => trans('ganaderia::race.add')];
    return view('ganaderia::admin.leader.race.add', $data);
  }

  public function addpostRace(Request $request)
  {
    $rules = ["name" => "required|min:3"];
    $messages = ["name.required" => 'El nombre es muy corto'];
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
      return back()->withErrors($validator)->with('message', 'Algo fallo en el proceso')->with('typealert', 'danger')->withInput();
    } else {
      $add = new Race;
      $add -> name = e ($request->input('name'));
      if($add -> save()){
        return redirect(route('ganaderia.admin.leader.race.index'));
      }
    }
  }

  public function editRace($id)
  {
    $editRace = Race::findOrFail($id);
    $data = ['title' => trans('ganaderia::race.edit'), 'editRace'=>$editRace];
    return view('ganaderia::admin.leader.race.edit', $data);
  }

  public function editpostRace(Request $request)
  {
    $rules = ["name" => "required|min:3"];
    $messages = ["name.required" => 'El nombre es muy corto'];
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
      return back()->withErrors($validator)->with('message', 'Algo fallo en el proceso')->with('typealert', 'danger')->withInput();
    } else {
      $edit = Race::findOrFail($request->input('id'));
      $edit -> name = e ($request->input('name'));
      if($edit -> save()){
        return redirect(route('ganaderia.admin.leader.race.index'));
      }
    }
  }

  public function destroyRace($id)
  {
    $remove = Race::findOrFail($id);
    if ($remove -> delete()) {
      return back()->with('message','La raza fue borrada exitosamente')->with('typealert', 'success');
    }
  }
}
