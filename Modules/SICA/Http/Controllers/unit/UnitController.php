<?php

namespace Modules\SICA\Http\Controllers\unit;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use Illuminate\Support\Facades\Route;
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
use Modules\SICA\Entities\Consumable;
use Modules\SICA\Entities\Production;

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
            $icon = 'success';
            $message_productive_unit = trans('sica::menu.Productive Unit successfully added');
        }else{
            $icon = 'error';
            $message_productive_unit = trans('sica::menu.Could not add Productive Unit');
        }
        return redirect(route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_unit.index'))->with(['icon'=>$icon, 'message_productive_unit'=>$message_productive_unit]);
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
            $icon = 'success';
            $message_productive_unit = trans('sica::menu.Product Unit successfully updated');
        }else{
            $icon = 'error';
            $message_productive_unit = trans('sica::menu.Failed to update Product Unit');
        }
        return redirect(route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_unit.index'))->with(['icon'=>$icon, 'message_productive_unit'=>$message_productive_unit]);
    }

    /* Formulario de eliminación de unidad productiva */
    public function productive_unit_delete($id){
        $productive_unit = ProductiveUnit::find($id);
        $data = [ 'title' => 'Eliminar Unidad Productiva', 'productive_unit' => $productive_unit];
        return view('sica::admin.units.productive_units.delete', $data);
    }

    /* Eliminar unidad productiva */
    public function productive_unit_destroy(Request $request){
        $productive_unit = ProductiveUnit::findOrFail($request->input('id'));
        if($productive_unit->delete()){
            $icon = 'success';
            $message_productive_unit = trans('sica::menu.Productive Unit successfully removed');
        }else{
            $icon = 'error';
            $message_productive_unit = trans('sica::menu.Could not delete Productive Unit');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_productive_unit'=>$message_productive_unit]);
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
        return redirect(route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_units.environment_pus.index'))->with($message);
    }

    /* Eliminar asociación de ambiente y unidad productiva */
    public function environment_pus_destroy(EnvironmentProductiveUnit $epu){
        if ($epu->delete()){
            $message = ['message'=>'Se eliminó exitosamente la asociación de ambiente y unidad productiva.', 'typealert'=>'success'];
        } else {
            $message = ['message'=>'No se pudo eliminar la asociación de ambiente y unidad productiva.', 'typealert'=>'danger'];
        }
        return redirect(route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.productive_units.environment_pus.index'))->with($message);
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
        return redirect(route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.pu_warehouses.index'))->with($message);
    }


    /* Formulario de eliminación de asociación de unidad productiva y bodega */
    public function pu_warehouses_delete($id){
        $puw = ProductiveUnitWarehouse::find($id);
        $data = [ 'title' => 'Eliminar Unidad Productiva', 'puw' => $puw];
        return view('sica::admin.units.pu_warehouses.delete', $data);
    }

    /* Eliminar asociación de unidad productiva y bodega */
    public function pu_warehouses_destroy(Request $request){
        $productive_unit_warehouses = ProductiveUnitWarehouse::findOrFail($request->input('id'));
        if($productive_unit_warehouses->delete()){
            $icon = 'success';
            $message_puw = trans('sica::menu.Productive Unit successfully removed');
        }else{
            $icon = 'error';
            $message_puw = trans('sica::menu.Could not delete Productive Unit');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_puw'=>$message_puw]);
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
            $icon = 'success';
            $message_activity = trans('sica::menu.Activity successfully added');
        }else{
            $icon = 'error';
            $message_activity = trans('sica::menu.Could not add Activity');
        }
        return redirect(route('sica.admin.units.activities.index'))->with(['icon'=>$icon, 'message_activity'=>$message_activity]);
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
            $icon = 'success';
            $message_activity = trans('sica::menu.Activity successfully updated');
        }else{
            $icon = 'error';
            $message_activity = trans('sica::menu.Failed to update Activity');
        }
        return redirect(route('sica.admin.units.activities.index'))->with(['icon'=>$icon, 'message_activity'=>$message_activity]);
    }
    /* Formulario de eliminación de actividad */
    public function activities_delete($id){
        $activity = Activity::find($id);
        $data = [ 'title' => 'Eliminar Actividad', 'activity' => $activity];
        return view('sica::admin.units.activities.delete', $data);
    }

    /* Eliminar actividad */
    public function activities_destroy(Request $request){
        $activity = Activity::findOrFail($request->input('id'));
        if($activity->delete()){
            $icon = 'success';
            $message_activity = trans('sica::menu.Activity successfully removed');
        }else{
            $icon = 'error';
            $message_activity = trans('sica::menu.Could not delete Activity');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_activity'=>$message_activity]);
    }

    /* Listado de areas disponibles */
	public function areas_index(){
        $areas = Sector::get();
        $data = ['title'=>trans('sica::menu.Areas'),'areas'=>$areas];
        return view('sica::admin.units.areas.home',$data);
    }

    /* Formulario de registro de Area */
    public function areas_create(){
        $data = ['title'=>'Areas - Registro'];
        return view('sica::admin.units.areas.create', $data);
    }

    /* Registrar Area */
    public function areas_store(Request $request){
        $area = new Sector();
        $area->name = e($request->input('name'));
        $area->description = e($request->input('description'));
        if($area->save()){
            $icon = 'success';
            $message_area = trans('sica::menu.Area successfully added');
        }else{
            $icon = 'error';
            $message_area = trans('sica::menu.Could not add Area');
        }
        return back()->with(['icon'=>$icon, 'message_area'=>$message_area]);
    }

    /* Consultar Area para su actualización */
    public function areas_edit($id){
        $area = Sector::find($id);
        $data = ['title'=>'Areas - Actualización', 'area'=>$area];
        return view('sica::admin.units.areas.edit', $data);
    }

    /* Actualizar Area */
    public function areas_update(Request $request){
        $area = Sector::find($request->input('id'));
        $area->name = e($request->input('name'));
        $area->description = e($request->input('description'));
       
        if($area->save()){
            $icon = 'success';
            $message_area = trans('sica::menu.Area successfully updated');
        }else{
            $icon = 'error';
            $message_area = trans('sica::menu.Failed to update Area');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_area'=>$message_area]);
    }

     /* Formulario de eliminación del area */
     public function areas_delete($id){
        $area = Sector::find($id);
        $data = [ 'title' => 'Eliminar area', 'area' => $area];
        return view('sica::admin.units.areas.delete', $data);
    }

     /* Eliminar Area */
     public function areas_destroy(Request $request){
        $area = Sector::findOrFail($request->input('id'));
        if($area->delete()){
            $icon = 'success';
            $message_area = trans('sica::menu.Area successfully removed');
        }else{
            $icon = 'error';
            $message_area = trans('sica::menu.Could not delete Area');
        }
        return redirect()->back()->with(['icon'=>$icon, 'message_area'=>$message_area]);
    }

	public function consumption(){
        $productive_units  = ProductiveUnit::get();

        $data = ['title'=>trans('sica::menu.Consumption'),
        'productive_units' => $productive_units];

        return view('sica::admin.units.consumption.home',$data);
    }

	public function consumption_filter(Request $request){
        $productiveUnitId = $request->input('productive_unit');
        // Obtener las actividades relacionadas con la unidad productiva
        $activities = Activity::with('labors')
        ->whereHas('productive_unit', function ($query) use ($productiveUnitId) {
            $query->where('id', $productiveUnitId);
        })
        ->get();

        // Obtener las labores relacionadas con las actividades
        $labors = collect(); // Inicializar una colección vacía
        foreach ($activities as $activity) {
        $labors = $labors->merge($activity->labors);
        }

        // Obtén los consumibles relacionados con esas labores
        $consumables = Consumable::whereIn('labor_id', $labors->pluck('id'))
        ->with('inventory.element', 'labor')
        ->get();

        
        // Crear un array asociativo para almacenar toda la información agrupada por labor
        $groupedData = [];
        $totalLaborSubtotal = 0;

        foreach ($consumables as $consumable) {
            $laborId = $consumable->labor->id;

            if (!isset($groupedData[$laborId])) {
                // Inicializa el array para esta labor si aún no existe
                $groupedData[$laborId] = [
                    'laborDescription' => $consumable->labor->description,
                    'laborDate' => $consumable->labor->execution_date,
                    'elements' => [],
                    'laborSubtotal' => 0, // Inicializa el subtotal de labor
                ];
            }

            $elementName = $consumable->inventory->element->name;
            $consumableAmount = $consumable->amount;
            $consumablePrice = $consumable->price;
            $expiration_date = $consumable->expiration_date;

            // Calcular el subtotal por elemento
            $elementSubtotal = $consumableAmount * $consumablePrice;

            // Agregar información al array asociativo
            $groupedData[$laborId]['elements'][] = [
                'elementName' => $elementName,
                'consumableAmount' => $consumableAmount,
                'consumablePrice' => $consumablePrice,
                'elementSubtotal' => $elementSubtotal, // Agregar el subtotal al elemento
                'expiration_date' => $expiration_date,
            ];

            // Sumar el subtotal del elemento al subtotal de labor
            $groupedData[$laborId]['laborSubtotal'] += $elementSubtotal;
            $totalLaborSubtotal += $elementSubtotal; // Sumar al total de subtotales de labor
        }

        $data = ['title'=>trans('sica::menu.Consumption'),
        'groupedData' => $groupedData,
        'totalLaborSubtotal' => $totalLaborSubtotal,
        'no_found' => 'No se encontro consumo de la unidad seleccionada'];

        return view('sica::admin.units.consumption.table',$data);
    }

	public function production(){
        $productive_units  = ProductiveUnit::get();

        $data = ['title'=>trans('sica::menu.Production'),
        'productive_units' => $productive_units];
        return view('sica::admin.units.production.home',$data);
    }

    public function production_filter(Request $request){
        $productiveUnitId = $request->input('productive_unit');
        // Obtener las actividades relacionadas con la unidad productiva
        $activities = Activity::with('labors')
        ->whereHas('productive_unit', function ($query) use ($productiveUnitId) {
            $query->where('id', $productiveUnitId);
        })
        ->get();

        // Obtener las labores relacionadas con las actividades
        $labors = collect(); // Inicializar una colección vacía
        foreach ($activities as $activity) {
        $labors = $labors->merge($activity->labors);
        }

        // Obtén los consumibles relacionados con esas labores
        $consumables = Production::whereIn('labor_id', $labors->pluck('id'))
        ->with('element', 'labor')
        ->get();

        
        // Crear un array asociativo para almacenar toda la información agrupada por labor
        $groupedData = [];
        $totalLaborSubtotal = 0;

        foreach ($consumables as $consumable) {
            $laborId = $consumable->labor->id;

            if (!isset($groupedData[$laborId])) {
                // Inicializa el array para esta labor si aún no existe
                $groupedData[$laborId] = [
                    'laborDescription' => $consumable->labor->description,
                    'laborDate' => $consumable->labor->execution_date,
                    'elements' => [],
                    'laborSubtotal' => 0, // Inicializa el subtotal de labor
                ];
            }

            $elementName = $consumable->element->name;
            $consumableAmount = $consumable->amount;
            $consumablePrice = $consumable->element->price;
            $expiration_date = $consumable->expiration_date;

            // Calcular el subtotal por elemento
            $elementSubtotal = $consumableAmount * $consumablePrice;

            // Agregar información al array asociativo
            $groupedData[$laborId]['elements'][] = [
                'elementName' => $elementName,
                'consumableAmount' => $consumableAmount,
                'consumablePrice' => $consumablePrice,
                'elementSubtotal' => $elementSubtotal, // Agregar el subtotal al elemento
                'expiration_date' => $expiration_date,
            ];

            // Sumar el subtotal del elemento al subtotal de labor
            $groupedData[$laborId]['laborSubtotal'] += $elementSubtotal;
            $totalLaborSubtotal += $elementSubtotal; // Sumar al total de subtotales de labor
        }

        $data = ['title'=>trans('sica::menu.Consumption'),
        'groupedData' => $groupedData,
        'totalLaborSubtotal' => $totalLaborSubtotal,
        'no_found' => 'No se encontro produccion de la unidad seleccionada'];

        return view('sica::admin.units.production.table',$data);
    }

}
