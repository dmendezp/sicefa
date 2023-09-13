<?php

namespace Modules\SICA\Http\Controllers\unit;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Sector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\ActivityType;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;

class UnitController extends Controller
{

    /* Listado de unidades productivas disponibles */
    public function productive_unit_index(){
        $productive_units = ProductiveUnit::orderBy('updated_at','DESC')->get();
        $data = ['title'=>'Unidades productivas','productive_units'=>$productive_units];
        return view('sica::admin.units.productive_units.index', $data);
    }

    /* Formulario de registro de unidad productiva */
    public function productive_unit_create(){
        $sectors = Sector::orderBy('name','ASC')->get();
        $farms = Farm::orderBy('name')->get();
        $data = ['title'=>'Unidades productivas - Registro', 'sectors'=>$sectors, 'farms'=>$farms];
        return view('sica::admin.units.productive_units.create',$data);
    }

    /* Registrar unidad productiva */
    public function productive_unit_store(Request $request){
        $rules = [
            'name'=> 'required|unique:productive_units',
            'description'=> 'required',
            'leader_id'=> 'required',
            'sector_id'=> 'required',
            'farm_id'=> 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Almacenar datos del líder seleccionado de la unidad productiva
            Session::flash('leader_document_number', $request->input('leader_document_number'));
            Session::flash('leader_id', $request->input('leader_id'));
            Session::flash('leader_full_name', $request->input('leader_full_name'));
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Realizar registro
        $request->merge(['person_id'=>$request->input('leader_id')]); // Reasignar el valor de leader_id como person_id
        if (ProductiveUnit::create($request->all())){
            $message = ['message'=>'Se registró exitosamente la unidad productiva.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo realizar el registro de la unidad productiva.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.units.productive_unit.index'))->with($message);
    }

    /* Consultar unidad productiva para su actualización (Administrador) */
    public function productive_unit_edit(ProductiveUnit $productive_unit){
        $sectors = Sector::orderBy('name','ASC')->get();
        $farms = Farm::orderBy('name')->get();
        $data = ['title'=>'Unidades productivas - Actualización', 'sectors'=>$sectors, 'productive_unit'=>$productive_unit, 'farms'=>$farms];
        return view('sica::admin.units.productive_units.edit',$data);
    }

    /* Actualizar unidad productiva */
    public function productive_unit_update(Request $request, ProductiveUnit $productive_unit){
        $rules = [
            'name'=> 'required|unique:productive_units,name,'.$productive_unit->id,
            'description'=> 'required',
            'leader_id'=> 'required',
            'sector_id'=> 'required',
            'farm_id'=> 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Almacenar datos del líder seleccionado de la unidad productiva
            Session::flash('leader_document_number', $request->input('leader_document_number'));
            Session::flash('leader_id', $request->input('leader_id'));
            Session::flash('leader_full_name', $request->input('leader_full_name'));
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Actualizar registro
        $request->merge(['person_id'=>$request->input('leader_id')]); // Reasignar el valor de leader_id como person_id
        if ($productive_unit->update($request->all())){
            $message = ['message'=>'Se actualizó exitosamente la unidad productiva.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo actualizar el registro de la unidad productiva.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.units.productive_unit.index'))->with($message);
    }

    /* Eliminar unidad productiva */
    public function productive_unit_destroy(ProductiveUnit $productive_unit){
        if ($productive_unit->delete()){
            $message = ['message'=>'Se eliminó exitosamente la unidad productiva.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo eliminar la unidad productiva.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.units.productive_unit.index'))->with($message);
    }

    /* Listado de ambientes y unidades productivas asociadas */
    public function environment_pus_index(){
        $environment_pus = EnvironmentProductiveUnit::join('productive_units', 'environment_productive_units.productive_unit_id', '=', 'productive_units.id')
                                    ->join('environments', 'environment_productive_units.environment_id', '=', 'environments.id')
                                    ->select('environment_productive_units.*')
                                    ->orderBy('productive_units.name', 'asc')
                                    ->orderBy('environments.name', 'asc')
                                    ->get();
        $environments = Environment::orderBy('name','ASC')->get();
        $productive_units = ProductiveUnit::orderBy('name','ASC')->get();
        $data = ['title'=>'Ambientes U.P.', 'environment_pus'=>$environment_pus, 'environments'=>$environments, 'productive_units'=>$productive_units];
        return view('sica::admin.units.environment_pus.index', $data);
    }

    /* Registrar asociación de ambiente y unidad productiva */
    public function environment_pus_store(Request $request){
        $rules = [
            'environment_id' => 'required',
            'productive_unit_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Verificar que no exista un registro con los datos recibidos en la base de datos
        $existingRecord = EnvironmentProductiveUnit::where([
            'environment_id' => e($request->input('environment_id')),
            'productive_unit_id' => e($request->input('productive_unit_id'))
        ])->exists();
        if (!$existingRecord) {
            /* Realizar el registro */
            if (EnvironmentProductiveUnit::create($request->all())) {
                $message = ['message' => 'Se sincronizó exitosamente el ambiente y unidad productiva.', 'typealert' => 'success'];
            } else {
                $message = ['message' => 'No se pudo sincronizar el ambiente y unidad productiva.', 'typealert' => 'danger'];
            }
        } else {
            $message = ['message' => 'Ya existe un registro con los datos enviados.', 'typealert' => 'warning'];
        }
        return redirect(route('sica.admin.units.productive_units.environment_pus.index'))->with($message);
    }

    /* Eliminar asociación de ambiente y unidad productiva */
    public function environment_pus_destroy(EnvironmentProductiveUnit $epu){
        if ($epu->delete()){
            $message = ['message'=>'Se eliminó exitosamente la asociación de ambiente y unidad productiva.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo eliminar la asociación de ambiente y unidad productiva.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.units.productive_units.environment_pus.index'))->with($message);
    }

    /* Listado de unidades productivas y bodegas asociadas */
    public function pu_warehouses_index(){
        $productive_unit_warehouses = ProductiveUnitWarehouse::join('productive_units', 'productive_units.id', '=', 'productive_unit_warehouses.productive_unit_id')
                                                                ->select('productive_units.id as pu_id', 'productive_units.name', 'productive_unit_warehouses.*')
                                                                ->orderBy('productive_units.name', 'ASC')
                                                                ->get();
        $productive_units = ProductiveUnit::orderBy('name','ASC')->get();
        $warehouses = Warehouse::orderBy('name','ASC')->get();
        $data = ['title'=>'Bodegas U.P.', 'productive_unit_warehouses'=>$productive_unit_warehouses, 'productive_units'=>$productive_units, 'warehouses'=>$warehouses];
        return view('sica::admin.units.pu_warehouses.index', $data);
    }

    /* Registrar asociación de unidad productiva y bodega */
    public function pu_warehouses_store(Request $request){
        $rules = [
            'productive_unit_id' => 'required',
            'warehouse_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Verificar que no exista un registro con los datos recibidos en la base de datos
        $existingRecord = ProductiveUnitWarehouse::where([
            'productive_unit_id' => e($request->input('productive_unit_id')),
            'warehouse_id' => e($request->input('warehouse_id')),
        ])->exists();
        if (!$existingRecord) {
            /* Realizar el registro */
            if (ProductiveUnitWarehouse::create($request->all())) {
                $message = ['message' => 'Se sincronizó exitosamente la unidad productiva y bodega.', 'typealert' => 'success'];
            } else {
                $message = ['message' => 'No se pudo sincronizar la unidad productiva y bodega.', 'typealert' => 'danger'];
            }
        } else {
            $message = ['message' => 'Ya existe un registro con los datos enviados.', 'typealert' => 'warning'];
        }
        return redirect(route('sica.admin.units.pu_warehouses.index'))->with($message);
    }

    /* Eliminar asociación de unidad productiva y bodega */
    public function pu_warehouses_destroy(ProductiveUnitWarehouse $puw){
        if ($puw->delete()){
            $message = ['message'=>'Se eliminó exitosamente la asociación de unidad productiva y bodega.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo eliminar la asociación de unidad productiva y bodega.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.units.pu_warehouses.index'))->with($message);
    }

    /* Listado de actividades disponibles */
    public function activities_index(){
        $activities = Activity::orderBy('updated_at','DESC')->get();
        $data = ['title'=>'Actividades', 'activities'=>$activities];
        return view('sica::admin.units.activities.index', $data);
    }

    /* Formulario de registro de actividad */
    public function activities_create(){
        $productive_units = ProductiveUnit::orderBy('name','ASC')->get();
        $activity_types = ActivityType::orderBy('name','ASC')->get();
        $data = ['title'=>'Actividades - Registro', 'productive_units'=>$productive_units, 'activity_types'=>$activity_types];
        return view('sica::admin.units.activities.create', $data);
    }

    /* Registrar actividad */
    public function activities_store(Request $request){
        $rules = [
            'name' => 'required',
            'productive_unit_id' => 'required',
            'activity_type_id' => 'required',
            'description' => 'required',
            'period' => 'required',
            'status' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Realizar registro
        if (Activity::create($request->all())){
            $message = ['message'=>'Se registró exitosamente la actividad.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo realizar el registro de la actividad.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.units.activities.index'))->with($message);
    }

    /* Consultar actividad para su actualización */
    public function activities_edit(Activity $activity){
        $productive_units = ProductiveUnit::orderBy('name','ASC')->get();
        $activity_types = ActivityType::orderBy('name','ASC')->get();
        $data = ['title'=>'Actividades - Actualización', 'productive_units'=>$productive_units, 'activity_types'=>$activity_types, 'activity'=>$activity];
        return view('sica::admin.units.activities.edit', $data);
    }

    /* Actualizar actividad */
    public function activities_update(Request $request, Activity $activity){
        $rules = [
            'name' => 'required',
            'productive_unit_id' => 'required',
            'activity_type_id' => 'required',
            'description' => 'required',
            'period' => 'required',
            'status' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Actualizar registro
        if ($activity->update($request->all())){
            $message = ['message'=>'Se actualizó exitosamente la actividad.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo realizar la actualización de la actividad.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.units.activities.index'))->with($message);
    }

    /* Eliminar actividad */
    public function activities_destroy(Activity $activity){
        if ($activity->delete()){
            $message = ['message'=>'Se eliminó exitosamente la actividad.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo eliminar la actividad.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.units.activities.index'))->with($message);
    }

	public function areas(){
        $areas = array();
        $data = ['title'=>trans('sica::menu.Areas'),'areas'=>$areas];
        return view('sica::admin.units.areas.home',$data);
    }

	public function consumption(){
        $consumption = array();
        $data = ['title'=>trans('sica::menu.Consumption'),'consumption'=>$consumption];
        return view('sica::admin.units.consumption.home',$data);
    }

	public function production(){
        $production = array();
        $data = ['title'=>trans('sica::menu.Production'),'production'=>$production];
        return view('sica::admin.units.production.home',$data);
    }

}
