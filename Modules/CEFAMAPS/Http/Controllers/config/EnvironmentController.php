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
    public function index()
    {
        $unit = ProductiveUnit::get();
        $farm = Farm::get();
        $classenviron = ClassEnvironment::get();
        $environ = Environment::with('coordinates')->get();
        $data = ['title'=>trans('cefamaps::menu.Environment'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'classenviron'=>$classenviron];
        return view('cefamaps::admin.environment.index',$data);
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
        $classenviron = ClassEnvironment::get();
        $data = ['title'=>trans('cefamaps::menu.Add'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'classenviron'=>$classenviron];
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
                    if ($addcoor -> save()) {
                        
                    }
                }
                return redirect(route('cefamaps.admin.config.environment.index'));
            }
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
        $farm = Farm::get();
        $classenviron = ClassEnvironment::get();
        $coor = Coordinate::get();
        $editenviron = Environment::with('coordinates')->find($id);
        //return $editenviron;
        $data = ['title'=>trans('cefamaps::menu.Edit'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'coor'=>$coor, 'editenviron'=>$editenviron, 'classenviron'=>$classenviron];
        return view('cefamaps::admin.environment.edit',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function editpost(Request $request)
    {
        
        /* crear imagen */
        $edit = Environment::findOrFail($request->input('id'));
        $edit -> name = e ($request->input('name'));
        $edit -> description = e ($request->input('description'));

         if ($request->file('file')){
            $path = 'uploads/';
            $final_name = Str::slug($request->file('file')->getClientOriginalName().'_'.time()).'.'.trim($request->file('file')->getClientOriginalName());
            $request->file->storeAs($path, $final_name, 'uploads'); 
            $edit -> picture = e ($final_name);

        /* }else{
            $edit -> picture = e ($request->input('imagenAntigua'));  */
        }
 
        $edit -> farms_id = e ($request->input('farm'));
        $edit -> productive_units_id = e ($request->input('unit'));
        $edit -> length = e ($request->input('lengthspot'));
        $edit -> latitude = e ($request->input('latitudespot'));
        $edit -> status = e ($request->input('status'));
        $edit -> type_environment = e ($request->input('type'));
        $edit -> class_environments_id = e ($request->input('class'));
        if($edit->save()) { 
            $c = 0;
            foreach ($edit->coordinates as $co) {
                $editcoor = new Coordinate;
                $editcoor -> environment_id = $edit->id;
                $editcoor -> length = e ($request->input('length')[$c]);
                $editcoor -> latitude = e ($request->input('latitude')[$c]);
                $c++;
                if ($editcoor -> save()) {
                }
            
         }
            return redirect(route('cefamaps.admin.config.environment.index'));
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
        $classenviron = ClassEnvironment::get();
        $pages = Page::get();
        $viewenviron = Environment::where('class_environments_id',$id)->get();
        $data = ['title'=>trans('cefamaps::environment.View'), 'unit'=>$unit, 'farm'=>$farm, 'environ'=>$environ, 'classenviron'=>$classenviron, 'viewenviron'=>$viewenviron, 'pages'=>$pages];
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
        if ($remove->delete()) {
            return back(); 
        }   
    }
}
