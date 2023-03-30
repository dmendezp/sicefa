<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Sector;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $environ = Environment::get();
        $unit = ProductiveUnit::with('person')->get();
        $farm = Farm::get();
        $data = ['title'=>trans('cefamaps::unit.Units'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm];
        return view('cefamaps::admin.unit.index',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function add()
    {
        $person = Person::get();
        $environ = Environment::get();
        $unit = ProductiveUnit::get();
        $farm = Farm::get();
        $sector = Sector::get();
        $data = ['title'=>trans('cefamaps::unit.Add'), 'person'=>$person, 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'sector'=>$sector];
        return view('cefamaps::admin.unit.add',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function addpost(Request $request)
    {
        $add = new ProductiveUnit;
        $add -> name = e ($request->input('name'));
        $add -> description = e ($request->input('description'));
        $add -> icon = e ($request->input('icon'));
        $add -> person_id = e ($request->input('person'));
        $add -> sector_id = e ($request->input('sector'));
        if($add -> save()){
            return redirect(route('cefamaps.admin.config.unit.index'));
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function edit($id)
    {
        $person = Person::get();
        $unit = ProductiveUnit::get();
        $environ = Environment::get();
        $farm = Farm::get();
        $sector = Sector::get();
        $editunit = ProductiveUnit::findOrFail($id);
        $data = ['title'=>trans('cefamaps::unit.Edit'), 'person'=>$person, 'unit'=>$unit, 'environ'=>$environ, 'farm'=>$farm, 'sector'=>$sector, 'editunit'=>$editunit];
        return view('cefamaps::admin.unit.edit',$data);
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
    public function view($id)
    {
        $unit = ProductiveUnit::get();
        $environ = Environment::get();
        $farm = Farm::get();
        $viewunit = ProductiveUnit::findOrFail($id);
        $data = ['title'=>trans('cefamaps::unit.View'), 'unit'=>$unit, 'environ'=>$environ, 'farm'=>$farm, 'viewunit'=>$viewunit];
        return view('cefamaps::admin.unit.view',$data);
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
