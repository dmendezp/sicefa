<?php

namespace Modules\SICA\Http\Controllers\unit;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Sector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{

    /* Listado de unidades productivas disponibles */
    public function productive_unit_index(){
        $productive_units = ProductiveUnit::orderBy('updated_at','DESC')->get();
        $data = ['title'=>'Unidades productivas','productive_units'=>$productive_units];
        return view('sica::admin.units.productive_units.index',$data);
    }

    /* Formulario de registro de unidad productiva */
    public function productive_unit_create(){
        $sectors = Sector::orderBy('name','ASC')->get();
        $farms = Farm::orderBy('name','ASC')->get();
        $data = ['title'=>'Unidades productivas - Registro','sectors'=>$sectors,'farms'=>$farms];
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
        $farms = Farm::orderBy('name','ASC')->get();
        $data = ['title'=>'Unidades productivas - Actualización', 'sectors'=>$sectors, 'farms'=>$farms, 'productive_unit'=>$productive_unit];
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
