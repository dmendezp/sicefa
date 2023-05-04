<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Validator;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\ClassEnvironment;
use Modules\CEFAMAPS\Entities\Page;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Sector;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $environ = Environment::get();
        $unit = ProductiveUnit::with('person')->get();
        $farm = Farm::get();
        $classenviron = ClassEnvironment::get();
        $filter = Environment::query()->with('farms','productive_units');
        if ($request->has('id')) {
            $filter->where('farms_id', $request->id);
            $filter->where('productive_units_id', $request->id);
        }
        $result = $filter->get();
        $data = ['title'=>trans('cefamaps::unit.Units'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'classenviron'=>$classenviron, 'filter'=>$filter];
        return view('cefamaps::admin.unit.index',$data, compact('result'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function add(Request $request)
    {
        $person = Person::get();
        $environ = Environment::get();
        $unit = ProductiveUnit::get();
        $classenviron = ClassEnvironment::get();
        $farm = Farm::get();
        $sector = Sector::get();
        $filter = Environment::query()->with('farms','productive_units');
        if ($request->has('id')) {
            $filter->where('farms_id', $request->id);
            $filter->where('productive_units_id', $request->id);
        }
        $result = $filter->get();
        $data = ['title'=>trans('cefamaps::menu.Add'), 'person'=>$person, 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'sector'=>$sector, 'classenviron'=>$classenviron, 'filter'=>$filter];
        return view('cefamaps::admin.unit.add',$data, compact('result'));
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
            $add = new ProductiveUnit;
            $add -> name = e ($request->input('name'));
            $add -> description = e ($request->input('description'));
            $add -> icon = e ($request->input('icon'));
            $add -> person_id = e ($request->input('person'));
            $add -> sector_id = e ($request->input('sector'));
            if($add -> save()){
                return redirect(route('cefamaps.admin.config.unit.index'));
            }
        endif;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function edit($id, Request $request)
    {
        $person = Person::get();
        $unit = ProductiveUnit::get();
        $environ = Environment::get();
        $classenviron = ClassEnvironment::get();
        $farm = Farm::get();
        $sector = Sector::get();
        $editunit = ProductiveUnit::findOrFail($id);
        $filter = Environment::query()->with('farms','productive_units');
        if ($request->has('id')) {
            $filter->where('farms_id', $request->id);
            $filter->where('productive_units_id', $request->id);
        }
        $result = $filter->get();
        $data = ['title'=>trans('cefamaps::menu.Edit'), 'person'=>$person, 'unit'=>$unit, 'environ'=>$environ, 'farm'=>$farm, 'sector'=>$sector, 'editunit'=>$editunit, 'classenviron'=>$classenviron, 'filter'=>$filter];
        return view('cefamaps::admin.unit.edit',$data, compact('result'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function editpost(Request $request)
    {
        $edit = ProductiveUnit::findOrFail($request->input('id'));
        $edit -> name = e ($request->input('name'));
        $edit -> description = e ($request->input('description'));
        $edit -> icon = e ($request->input('icon'));
        $edit -> person_id = e ($request->input('person'));
        $edit -> sector_id = e ($request->input('sector'));
        if($edit -> save()){
            return redirect(route('cefamaps.admin.config.unit.index'));
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function search($document)
    {
        $search = Person::where('document_number', $document)->get();
        return response()->json($search);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function view($id, Request $request)
    {
        $unit = ProductiveUnit::get();
        $environ = Environment::get();
        $classenviron = ClassEnvironment::get();
        $farm = Farm::get();
        $pages = Page::get();
        $viewunit = Environment::where('productive_units_id',$id)->get();
        $filter = Environment::query()->with('farms','productive_units');
        if ($request->has('id')) {
            $filter->where('farms_id', $request->id);
            $filter->where('productive_units_id', $request->id);
        }
        $result = $filter->get();
        $data = ['title'=>trans('cefamaps::unit.Units'), 'unit'=>$unit, 'environ'=>$environ, 'farm'=>$farm, 'viewunit'=>$viewunit, 'classenviron'=>$classenviron, 'pages'=>$pages, 'filter'=>$filter];
        return view('cefamaps::admin.unit.view',$data, compact('result'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function destroy($id)
    {
        $remove = ProductiveUnit::findOrFail($id);
        if($remove->delete());
        return back()->with('message', 'Unidad Borrada Exitosamente')->with('typealert', 'succes');
    }
}
