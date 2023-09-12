<?php

namespace Modules\CEFAMAPS\Http\Controllers\config;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
// Para validar las imagenes
use Validator, Str;
//Para hacer los crud del administrador
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\ClassEnvironment;
use Modules\CEFAMAPS\Entities\Coordinate;
use Modules\CEFAMAPS\Entities\Page;
use Modules\SICA\Entities\Sector;

class EnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $unit = ProductiveUnit::get();
        $farm = Farm::get();
        $sector = Sector::get();
        $classenviron = ClassEnvironment::get();
        $environ = Environment::with('coordinates')->get();
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Environment_Index_title_page'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'sector'=>$sector, 'classenviron'=>$classenviron];
        return view('cefamaps::admin.environment.index',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function add(Request $request)
    {
        $environ = Environment::get();
        $unit = ProductiveUnit::get();
        $unitadd = ProductiveUnit::pluck('name','id');
        $farm = Farm::pluck('name','id');
        $sector = Sector::get();
        $classenviron = ClassEnvironment::get();
        $classenvironadd = ClassEnvironment::pluck('name','id');
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Environment_Add_title_page'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'classenviron'=>$classenviron, 'sector'=>$sector, 'unitadd'=>$unitadd, 'classenvironadd'=>$classenvironadd];
        return view('cefamaps::admin.environment.add',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function addpost(Request $request)
    {
        /* este metodo es para poder guardar imagenes */
        $path = 'uploads/';
        $final_name = Str::slug($request->file('file')->getClientOriginalName().'_'.time()).'.'.trim($request->file('file')->getClientOriginalName());

        if($request->file->storeAs($path, $final_name, 'uploads')) {
            $add = new Environment;
            $add -> name = e ($request->input('name'));
            $add -> picture = e ($final_name);
            $add -> description = e ($request->input('description'));
            $add -> length = e ($request->input('lengthspot'));
            $add -> latitude = e ($request->input('latitudespot'));
            $add -> farm_id = e ($request->input('farm_id'));
            $add -> productive_unit_id = e ($request->input('productive_unit_id'));
            $add -> class_environment_id = e ($request->input('class_environment_id'));
            $add -> status = e ($request->input('status'));
            $add -> type_environment = e ($request->input('type'));
            if($add -> save()) {
                if ($request->input('lengthcoor') == '') {
                    return redirect(route('cefamaps.admin.config.environment.index'));
                } else {
                    $c = 0;
                    foreach ($request->input('lengthcoor') as $le) {
                        $addcoor = new Coordinate;
                        $addcoor -> environment_id = $add -> id;
                        $addcoor -> length = $le;
                        $addcoor -> latitude = e ($request->input('latitudecoor')[$c]);
                        $c++;
                        if ($addcoor -> save()) {}
                    }
                    return redirect(route('cefamaps.admin.config.environment.index'));
                }
            } 
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
        $unitedit = ProductiveUnit::pluck('name','id');
        $farm = Farm::pluck('name','id');
        $sector = Sector::get();
        $classenviron = ClassEnvironment::get();
        $classenvironedit = ClassEnvironment::pluck('name','id');
        $coor = Coordinate::find($id);
        $editenviron = Environment::with('coordinates')->find($id);
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Environment_Edit_title_page'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'coor'=>$coor, 'editenviron'=>$editenviron, 'classenviron'=>$classenviron, 'sector'=>$sector, 'unitedit'=>$unitedit, 'classenvironedit'=>$classenvironedit];
        return view('cefamaps::admin.environment.edit',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function editpost(Request $request)
    {
        $edit = Environment::findOrFail($request->input('id'));
        $edit -> name = e ($request->input('name'));
        $edit -> description = e ($request->input('description'));
        $edit -> farm_id = e ($request->input('farm_id'));
        $edit -> productive_unit_id = e ($request->input('productive_unit_id'));
        $edit -> length = e ($request->input('lengthspot'));
        $edit -> latitude = e ($request->input('latitudespot'));
        $edit -> status = e ($request->input('status'));
        $edit -> type_environment = e ($request->input('type'));
        $edit -> class_environment_id = e ($request->input('class_environment_id'));

        if ($request->file('file')){
            $path = 'uploads/';
            $final_name = Str::slug($request->file('file')->getClientOriginalName().'_'.time()).'.'.trim($request->file('file')->getClientOriginalName());
            $request->file->storeAs($path, $final_name, 'uploads');
            $edit -> picture = e ($final_name);
        }

        if($request->input('length')){
            $c = 0;
            foreach ($edit->coordinates as $editcoor) {
                $editcoor = Coordinate::find($editcoor->id);
                $editcoor -> environment_id = $edit->id;
                $editcoor -> length = e ($request->input('length')[$c]);
                $editcoor -> latitude = e ($request->input('latitude')[$c]);
                $c++;
                if ($editcoor->save()){}
            }
        }else{
        }
        if($edit->save()) {
            return redirect(route('cefamaps.admin.config.environment.index'));
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function eliminar($id)
    {
        $remove = Coordinate::findOrFail($id);
        $remove->delete();
        return response()->json($remove);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function addinput(Request $request)
    {
        try {
            $editcoor = new Coordinate;
            $editcoor -> environment_id = $request->id;
            $editcoor -> length = $request->long;
            $editcoor -> latitude =$request->ltn ;
            $editcoor->save();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function view($id, Request $request)
    {
        $unit = ProductiveUnit::get();
        $environ = Environment::get();
        $sector = Sector::get();
        $classenviron = ClassEnvironment::get();
        $viewenviron = Environment::where('class_environment_id',$id)->get();
        $pages = Page::get();
        $data = ['titlePage'=>trans('cefamaps::controllers.CEFAMAPS_Environment_View_title_page'), 'unit'=>$unit, 'sector'=>$sector, 'environ'=>$environ, 'classenviron'=>$classenviron, 'viewenviron'=>$viewenviron, 'pages'=>$pages];
        return view('cefamaps::admin.environment.view',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function destroy($id)
    {
        $remove = Environment::findOrFail($id);
        $remove->coordinates()->delete();
        $remove->pages()->delete();
        if ($remove->delete()) {
            return back();
        }
    }
}
