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

class EnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $environ = Environment::get();
        $unit = ProductiveUnit::get();
        $farm = Farm::get();
        $data = ['title'=>trans('cefamaps::environment.Environment'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm];
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
        $data = ['title'=>trans('cefamaps::environment.Add'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm];
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
            $add -> description = e ($request->input('description'));
            $add -> picture = e ($final_name);
            $add -> length = e ($request->input('length'));
            $add -> latitude = e ($request->input('latitude'));
            $add -> farms_id = e ($request->input('farm'));
            $add -> productive_units_id = e ($request->input('unit'));
            $add -> status = e ($request->input('status'));
            $add -> type_environment = e ($request->input('type'));
            $add -> environment_classroom = e ($request->input('class'));
            if($add -> save()){
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
        $editenviron = Environment::findOrFail($id);
        $data = ['title'=>trans('cefamaps::environment.Edit'), 'environ'=>$environ, 'unit'=>$unit, 'farm'=>$farm, 'editenviron'=>$editenviron];
        return view('cefamaps::admin.environment.edit',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function editpost(Request $request)
    {
        /* este metodo es para poder guardar imagenes */
        $path = 'uploads/';
        $final_name = Str::slug($request->file('file')->getClientOriginalName().'_'.time()).'.'.trim($request->file('file')->getClientOriginalName());
        
        if($request->file->storeAs($path, $final_name, 'uploads')) {
            $edit = Environment::findOrFail($request->input('id'));
            $edit -> name = e ($request->input('name'));
            $edit -> description = e ($request->input('description'));
            $edit -> picture = e ($final_name);
            $edit -> length = e ($request->input('length'));
            $edit -> latitude = e ($request->input('latitude'));
            $edit -> farms_id = e ($request->input('farm'));
            $edit -> productive_units_id = e ($request->input('unit'));
            $edit -> status = e ($request->input('status'));
            $edit -> type_environment = e ($request->input('type'));
            $edit -> environment_classroom = e ($request->input('class'));
            if($edit -> save()){
                return redirect(route('cefamaps.admin.config.environment.index'));
            }
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
        $viewenviron = Environment::findOrFail($id);
        $data = ['title'=>trans('cefamaps::environment.View'), 'unit'=>$unit, 'environ'=>$environ, 'farm'=>$farm, 'viewenviron'=>$viewenviron];
        return view('cefamaps::admin.environment.view',$data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function destroy($id)
    {
        $remove = Environment::findOrFail($id);
        if($remove->delete());
        return back()->with('message', 'Unidad Borrada Exitosamente')->with('typealert', 'succes');
    }
}
