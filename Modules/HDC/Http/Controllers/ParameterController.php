<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\SICA\Entities\Resource;
use Modules\SICA\Entities\EnvironmentalAspect;
use Modules\SICA\Entities\MeasurementUnit;
use Illuminate\Support\Facades\Validator;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function parameters()
    {
        //Aspecto ambiental
        $envs = EnvironmentalAspect::get();
        $resource = Resource::get();
        $resources = $resource->map(function ($r) {
            $id = $r->id;
            $name = $r->name;
            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione un recurso'])->pluck('name', 'id');

        $measurement = MeasurementUnit::get();
        $measurement_unit = $measurement->map(function ($m) {
            $id = $m->id;
            $name = $m->name;
            return [
                'id' => $id,
                'name' => $name
            ];
        })->prepend(['id' => null, 'name' => 'Seleccione una unidad de medida'])->pluck('name', 'id');


        $data = [
            'envs' => $envs,
            'resource' => $resource,
            'resources' => $resources,
            'measurement_unit' => $measurement_unit,
        ];

        return view('hdc::Parameters.parameter', $data);
    }

    public function resource_store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        $validatedData = $request->validate($rules);

        if($validatedData){
            $r = new Resource;
            $r->name = $validatedData['name'];
            $r->save();
            if($r->save()){
                return redirect()->route('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameter')->with(['success'=> 'Registro creado correctamente']);
            }else{
                return redirect()->route('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameter')->with(['error'=> 'Error al crear el registro']);
            }
        }else{
            return redirect()->back()->withErrors($validatedData)->withInput()->with(['message'=> 'Todos los campos son obligatorios', 'typealert'=>'danger']);
        }
    }

    public function resource_update(Request $request)
    {
        // Validar ls datos del formulario si es necesario
        $rules = [
            'name' => 'required',
        ];

        $validatedData = $request->validate($rules);
        if($validatedData){
            $r = Resource::findOrFail($request->id);
            $r->name = $validatedData['name'];
            $r->save();
            if($r->save()){
                return redirect()->route('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameter')->with(['success'=> 'Registro creado correctamente']);
            }else{
                return redirect()->route('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameter')->with(['success'=> 'Error al crear el registro']);
            }
        }else{
            return redirect()->back()->withErrors($validatedData)->withInput()->with(['message'=> 'Todos los campos son obligatorios', 'typealert'=>'danger']);
        }
    }

    public function resource_destroy($id)
    {
         // Obtener la actividad por su ID
         $r = Resource::findOrFail($id);

         // Realizar la eliminación
         $r->delete();
 
         return redirect()->back()->with('success', 'Recurso eliminado exitosamente');
    }

    public function enviromental_aspect_store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'resource_id' => 'required',
            'measurement_unit_id' => 'required',
            'aspect_type' => 'required',
            'conversion_factor' => 'required',
            'personal' => 'required'
        ];

        $validatedData = $request->validate($rules);

        if($validatedData){
            $e = new EnvironmentalAspect;
            $e->name = $validatedData['name'];
            $e->resource_id = $validatedData['resource_id'];
            $e->measurement_unit_id = $validatedData['measurement_unit_id'];
            $e->aspect_type = $validatedData['aspect_type'];
            $e->conversion_factor = $validatedData['conversion_factor'];
            $e->personal = $validatedData['personal'];
            $e->save();
            if($e->save()){
                return redirect()->route('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameter')->with(['success'=> 'Registro creado correctamente']);
            }else{
                return redirect()->route('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameter')->with(['success'=> 'Error al crear el registro']);
            }
        }else{
            return redirect()->back()->withErrors($validatedData)->withInput()->with(['message'=> 'Todos los campos son obligatorios', 'typealert'=>'danger']);
        }
    }

    public function enviromental_aspect_update(Request $request)
    {
        // Validar ls datos del formulario si es necesario
        $rules = [
            'name' => 'required',
            'resource_id' => 'required',
            'measurement_unit_id' => 'required',
            'aspect_type' => 'required',
            'conversion_factor' => 'required',
            'personal' => 'required',
            'state' => 'required'
        ];

        $validatedData = $request->validate($rules);
        if($validatedData){
            $e = EnvironmentalAspect::findOrFail($request->id);
            $e->name = $validatedData['name'];
            $e->resource_id = $validatedData['resource_id'];
            $e->measurement_unit_id = $validatedData['measurement_unit_id'];
            $e->aspect_type = $validatedData['aspect_type'];
            $e->conversion_factor = $validatedData['conversion_factor'];
            $e->personal = $validatedData['personal'];
            $e->state = $validatedData['state'];
            $e->save();
            if($e->save()){
                return redirect()->route('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameter')->with('success', 'Parametro Registrado');
            }else{
                return redirect()->route('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameter')->with('success', 'Error Al Crear El Registro');
            }
        }else{
            return redirect()->back()->withErrors($validatedData)->withInput()->with(['message'=> 'Todos los campos son obligatorios', 'typealert'=>'danger']);
        }
    }

    public function enviromental_aspect_destroy($id)
    {
         // Obtener la actividad por su ID
         $e = EnvironmentalAspect::findOrFail($id);

         // Realizar la eliminación
         $e->delete();
 
         return redirect()->back()->with('success', 'Aspecto ambiental eliminado exitosamente');
    }
}
