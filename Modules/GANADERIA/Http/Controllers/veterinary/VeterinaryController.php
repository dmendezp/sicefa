<?php

namespace Modules\GANADERIA\Http\Controllers\veterinary;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GANADERIA\Entities\Treatment;
use Modules\GANADERIA\Entities\Animal;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Person;

class VeterinaryController extends Controller
{
  public function index()
  {
    $data = ['title'=>trans('ganaderia::veterinary.index')];
    return view('ganaderia::admin.veterinary.index', $data);
  }

  public function register()
  {
    $treat = Treatment::get();
    $data = ['title'=>trans('ganaderia::veterinary.register'), 'treat'=>$treat];
    return view('ganaderia::admin.veterinary.register', $data);
  }

  public function add()
  {
    $animal = Animal::pluck('name','id');
    $inven = Inventory::pluck('description','id');
    $data = ['title'=>trans('ganaderia::veterinary.add'), 'animal'=>$animal, 'inven'=>$inven];
    return view('ganaderia::admin.veterinary.add', $data);
  }

  public function addpost(Request $request)
  {
    $add = new Treatment;
    $add -> inventory_id = e ($request->input('inventory_id'));
    $add -> animal_id = e ($request->input('animal_id'));
    $add -> date_treatment = e ($request->input('treat'));
    $add -> dose = e ($request->input('dose'));
    $add -> name_medicine = e ($request->input('medi'));
    $add -> observations = e ($request->input('obser'));
    $add -> person_id = e ($request->input('person'));
    if($add -> save()){
      return redirect(route('ganaderia.admin.vet.register'));
    }
  }

  public function edit($id)
  {
    $treat = Treatment::findOrFail($id);
    $animal = Animal::pluck('name','id');
    $inven = Inventory::pluck('description','id');
    $data = ['title'=>trans('ganaderia::veterinary.register'), 'treat'=>$treat, 'animal'=>$animal, 'inven'=>$inven];
    return view('ganaderia::admin.veterinary.edit', $data);
  }

  public function editpost(Request $request)
  {
    $edit = Treatment::findOrFail($request->input('id'));
    $edit -> inventory_id = e ($request->input('inventory_id'));
    $edit -> animal_id = e ($request->input('animal_id'));
    $edit -> date_treatment = e ($request->input('treat'));
    $edit -> dose = e ($request->input('dose'));
    $edit -> name_medicine = e ($request->input('medi'));
    $edit -> observations = e ($request->input('obser'));
    $edit -> person_id = e ($request->input('person'));
    if($edit -> save()){
      return redirect(route('ganaderia.admin.vet.register'));
    }
  }

  public function search($document)
  {
    $search = Person::where('document_number', $document)->get();
    return response()->json($search);
  }
}