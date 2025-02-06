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
        $sector = Sector::get();
        $classenviron = ClassEnvironment::get();
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Unit_Index_title_page'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'classenviron'=>$classenviron, 'sector'=>$sector];
        return view('cefamaps::admin.unit.index',$data);
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
        $farm = Farm::pluck('name','id');
        $sector = Sector::get();
        $sectoradd = Sector::pluck('name','id');
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Unit_Add_title_page'), 'person'=>$person, 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'sector'=>$sector, 'classenviron'=>$classenviron, 'sectoradd'=>$sectoradd];
        return view('cefamaps::admin.unit.add',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function addpost(Request $request)
    {
        $rules = [
            "person" => "required",
            "icon" => "required"
        ];
        $messages = [
            "person.required" => 'Algo salio mal en tu numero de documento, intenta de nuevo buscandolo',
            "icon.required" => 'No seleccionaste ningun icono'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Algo fallo en el proceso')->with('typealert', 'danger')->withInput();
            else:
            $add = new ProductiveUnit;
            $add -> name = e ($request->input('name'));
            $add -> description = e ($request->input('description'));
            $add -> icon = e ($request->input('icon'));
            $add -> person_id = e ($request->input('person'));
            $add -> sector_id = e ($request->input('sector_id'));
            $add -> farm_id = e ($request->input('farm_id'));
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
        $farm = Farm::pluck('name','id');
        $sector = Sector::get();
        $sectoredit = Sector::pluck('name','id');
        $editunit = ProductiveUnit::findOrFail($id);
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Unit_Edit_title_page'), 'person'=>$person, 'unit'=>$unit, 'environ'=>$environ, 'farm'=>$farm, 'sector'=>$sector, 'editunit'=>$editunit, 'classenviron'=>$classenviron, 'sectoredit'=>$sectoredit];
        return view('cefamaps::admin.unit.edit',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function editpost(Request $request)
    {
        $rules = [
            "person" => "required",
            "sector_id" => "required",
            "farm_id" => "required",
        ];
        $messages = [
            "person.required" => 'Algo salio mal en tu numero de documento, intenta de nuevo buscandolo',
            "sector_id.required" => 'El sector es requerido',
            "farm_id.required" => 'La granja es requerida',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Algo fallo en el proceso')->with('typealert', 'danger')->withInput();
            else:
            $edit = ProductiveUnit::findOrFail($request->input('id'));
            $edit -> name = e ($request->input('name'));
            $edit -> description = e ($request->input('description'));
            $edit -> icon = e ($request->input('icon'));
            $edit -> person_id = e ($request->input('person'));
            $edit -> sector_id = e ($request->input('sector_id'));
            $edit -> farm_id = e ($request->input('farm_id'));
            if($edit -> save()){
                return redirect(route('cefamaps.admin.config.unit.index'));
            }
        endif;
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
        $sector = Sector::get();
        $pages = Page::get();
        $viewunit = Environment::where('productive_unit_id',$id)->get();
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Unit_View_title_page'), 'unit'=>$unit, 'environ'=>$environ, 'sector'=>$sector, 'viewunit'=>$viewunit, 'classenviron'=>$classenviron, 'pages'=>$pages];
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
