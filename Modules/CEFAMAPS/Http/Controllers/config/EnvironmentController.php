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
        $classenviron = ClassEnvironment::get();
        $environ = Environment::with('coordinates')->get();
        $filter = Environment::query()->with('farms','productive_units');
        if ($request->has('id')) {
            $filter->where('farms_id', $request->id);
            $filter->where('productive_units_id', $request->id);
        }
        $result = $filter->get();
        $data = ['title'=>trans('cefamaps::environment.Environment'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'classenviron'=>$classenviron, 'filter'=>$filter];
        return view('cefamaps::admin.environment.index',$data, compact('result'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function add(Request $request)
    {
        $environ = Environment::get();
        $unit = ProductiveUnit::get();
        $farm = Farm::get();
        $classenviron = ClassEnvironment::get();
        $filter = Environment::query()->with('farms','productive_units');
        if ($request->has('id')) {
            $filter->where('farms_id', $request->id);
            $filter->where('productive_units_id', $request->id);
        }
        $result = $filter->get();
        $data = ['title'=>trans('cefamaps::menu.Add'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'classenviron'=>$classenviron, 'filter'=>$filter];
        return view('cefamaps::admin.environment.add',$data, compact('result'));
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
            $add -> farms_id = e ($request->input('farm'));
            $add -> productive_units_id = e ($request->input('unit'));
            $add -> class_environments_id = e ($request->input('class'));
            $add -> status = e ($request->input('status'));
            $add -> type_environment = e ($request->input('type'));
            if($add -> save()) {
                $c = 0;
                foreach ($request->input('lengthcoor') as $le) {
                    $addcoor = new Coordinate;
                    $addcoor -> environment_id = $add->id;
                    $addcoor -> length = $le;
                    $addcoor -> latitude = e ($request->input('latitudecoor')[$c]);
                    $c++;
                    if ($addcoor -> save()) {}
                }
                return redirect(route('cefamaps.admin.config.environment.index'));
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
        $farm = Farm::get();
        $classenviron = ClassEnvironment::get();
        $coor = Coordinate::get();
        $editenviron = Environment::with('coordinates')->find($id);
        $filter = Environment::query()->with('farms','productive_units');
        if ($request->has('id')) {
            $filter->where('farms_id', $request->id);
            $filter->where('productive_units_id', $request->id);
        }
        $result = $filter->get();
        $data = ['title'=>trans('cefamaps::menu.Edit'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'coor'=>$coor, 'editenviron'=>$editenviron, 'classenviron'=>$classenviron, 'filter'=>$filter];
        return view('cefamaps::admin.environment.edit',$data, compact('result'));
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
        $edit -> farms_id = e ($request->input('farm'));
        $edit -> productive_units_id = e ($request->input('unit'));
        $edit -> length = e ($request->input('lengthspot'));
        $edit -> latitude = e ($request->input('latitudespot'));
        $edit -> status = e ($request->input('status'));
        $edit -> type_environment = e ($request->input('type'));
        $edit -> class_environments_id = e ($request->input('class'));

        if ($request->file('file')){
            $path = 'uploads/';
            $final_name = Str::slug($request->file('file')->getClientOriginalName().'_'.time()).'.'.trim($request->file('file')->getClientOriginalName());
            $request->file->storeAs($path, $final_name, 'uploads');
            $edit -> picture = e ($final_name);
        }

        $c = 0;
        if(is_object($edit->coordinates)){
            foreach ($edit->coordinates as $editcoor) {
                $editcoor = Coordinate::find($editcoor->id);
                $editcoor -> environment_id = $edit->id;
                $editcoor -> length = e ($request->input('length')[$c]);
                $editcoor -> latitude = e ($request->input('latitude')[$c]);
                $c++;
                $editcoor->save();
            }
        }else{
        }
        foreach($edit->coordinates as $editcoor => $value){
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
        return $editcoor;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function view($id, Request $request)
    {
        $unit = ProductiveUnit::get();
        $environ = Environment::get();
        $farm = Farm::get();
        $classenviron = ClassEnvironment::get();
        $pages = Page::get();
        $viewenviron = Environment::where('class_environments_id',$id)->get();
        $filter = Environment::query()->with('farms','productive_units');
        if ($request->has('id')) {
            $filter->where('farms_id', $request->id);
            $filter->where('productive_units_id', $request->id);
        }
        $result = $filter->get();
        $data = ['title'=>trans('cefamaps::environment.Environment'), 'unit'=>$unit, 'farm'=>$farm, 'environ'=>$environ, 'classenviron'=>$classenviron, 'viewenviron'=>$viewenviron, 'pages'=>$pages, 'filter'=>$filter];
        return view('cefamaps::admin.environment.view',$data, compact('result'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function destroy($id)
    {
        $remove = Environment::findOrFail($id);
        $remove->coordinates()->delete();
        if ($remove->delete()) {
            return back();
        }
    }
}