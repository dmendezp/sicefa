<?php

namespace Modules\SICA\Http\Controllers\security;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\AppProductiveUnit;
use Modules\SICA\Entities\ProductiveUnit;

class AppController extends Controller
{

    /* Lista de aplicaciones disponibles */
    public function apps_index(){
        $apps = App::orderBy('name','ASC')->get();
        $data = ['title'=>trans('sica::menu.Apps'),'apps'=>$apps];
        return view('sica::admin.security.apps.index',$data);
    }

    /* Listado de aplicaciones y unidades productivas asociadas */
    public function app_pus_index(){
        $app_pus = AppProductiveUnit::join('apps', 'app_productive_units.app_id', '=', 'apps.id')
                                    ->join('productive_units', 'app_productive_units.productive_unit_id', '=', 'productive_units.id')
                                    ->select('app_productive_units.*')
                                    ->orderBy('apps.name', 'asc')
                                    ->orderBy('productive_units.name', 'asc')
                                    ->get();
        $apps = App::orderBy('name','ASC')->get();
        $productive_units = ProductiveUnit::orderBy('name','ASC')->get();
        $data = ['title'=>'Aplicaciones U.P.', 'app_pus'=>$app_pus, 'apps'=>$apps, 'productive_units'=>$productive_units];
        return view('sica::admin.security.app_pus.index', $data);
    }

    /* Registrar asociación de aplicación y unidad productiva */
    public function app_pus_store(Request $request){
        $rules = [
            'app_id' => 'required',
            'productive_unit_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }
        // Verificar que no exista un registro con los datos recibidos en la base de datos
        $existingRecord = AppProductiveUnit::where([
            'app_id' => e($request->input('app_id')),
            'productive_unit_id' => e($request->input('productive_unit_id'))
        ])->exists();
        if (!$existingRecord) {
            /* Realizar el registro */
            if (AppProductiveUnit::create($request->all())) {
                $message = ['message' => 'Se sincronizó exitosamente la aplicación y unidad productiva.', 'typealert' => 'success'];
            } else {
                $message = ['message' => 'No se pudo sincronizar la aplicación y unidad productiva.', 'typealert' => 'danger'];
            }
        } else {
            $message = ['message' => 'Ya existe un registro con los datos enviados.', 'typealert' => 'warning'];
        }
        return redirect(route('sica.admin.security.apps.app_pus.index'))->with($message);
    }

    /* Eliminar asociación de aplicación y unidad productiva */
    public function app_pus_destroy(AppProductiveUnit $apu){
        if ($apu->delete()){
            $message = ['message'=>'Se eliminó exitosamente la asociación de aplicación y unidad productiva.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo eliminar la asociación de aplicación y unidad productiva.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.admin.security.apps.app_pus.index'))->with($message);
    }

}
