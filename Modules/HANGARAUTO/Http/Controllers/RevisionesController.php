<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon; // Esta línea ya importa Carbon, no es necesario importarlo de nuevo
use Modules\HANGARAUTO\Entities\Vehicle;
use Modules\HANGARAUTO\Entities\Tecnomecanic;
use Modules\HANGARAUTO\Entities\Soat;
use Modules\HANGARAUTO\Entities\Driver;
use Modules\HANGARAUTO\Entities\FuelConsumption;
use Modules\HANGARAUTO\Entities\FuelType;
use Modules\SICA\Entities\MeasurementUnit;
use Illuminate\Support\Facades\Route;
use Validator, Str;

class RevisionesController extends Controller
{

    // Traer Toda La Información De La Tabla De Soat
    public function seguroobligatorio()
    {
        $Soat = Soat::orderBy('id','asc')->with('person')->get();
        $vehicles = Vehicle::pluck('name', 'id');
        $drivers = Driver::with('person')->get()->pluck('person.fullname', 'person.id');
        $data = ['Soat' => $Soat, 'vehicles' => $vehicles, 'drivers' => $drivers];
        return view('hangarauto::admin.revisiones.SOAT.index', $data);
    }


    
    // Agregar Registro De Soat 
    public function postSoatAdd(Request $request)
    {
        $rules = [
            'vehicle_id' => 'required',
            'person_id' => 'required',
            'review_date' => 'required',
        ];
        $messages = [
            'vehicle_id.required' => 'Ingrese El Nombre Del Vehiculo',
            'person_id.required' => 'Ingrese Quien Realizó La Renovación Del Soat',
            'review_date.required' => 'Ingrese La Fecha En Que Se Renovó El Soat',
           
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('error', 'Se Ha Producido Un Error')->with('typealert','danger');
         else:
            $Soat = new Soat();
            $Soat->vehicle_id = $request->input('vehicle_id');
            $Soat->person_id = $request->input('person_id');
            $Soat->review_date = $request->input('review_date');
            $Soat->expiration_date = Carbon::parse($request->input('review_date'))->addYear();
            if($Soat->save()){
                return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.soat'))->with('success','Nuevo Registro De Soat Agregado Exitosamente')->with('typealert','success');
            }
        endif;
        return view('hangarauto::admin.revisiones.SOAT.index');
    }

    public function getsoatEdit ($id)
    {   
        $soat = Soat::with('person')->find($id);  
        $vehicles = Vehicle::pluck('name', 'id');
        $drivers = Driver::with('person')->get()->pluck('person.fullname', 'person.id');
        $data = ['soat'=>$soat,'vehicles'=>$vehicles,'drivers'=>$drivers ];
        return view('hangarauto::admin.revisiones.soat.edit',$data);
        
    }   

    public function postsoatEdit(Request $request, $id)
 {
     // Validar los datos enviados por el formulario
     $request->validate([
        'vehicle_id' => 'required',
        'person_id' => 'required',
        'review_date' => 'required',
    ]);

    try {
        // Buscar el vehículo por su ID
        $Soat = Soat::findOrFail($id);
        $Soat->vehicle_id = $request->input('vehicle_id');
        $Soat->person_id = $request->input('person_id');
        $Soat->review_date = $request->input('review_date');
        $Soat->expiration_date = $request->input('expiration_date');

        // Guardar los cambios en la base de datos
        $Soat->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.soat')->with('success', 'Soat actualizado exitosamente.');
    } catch (\Exception $e) {
        // Manejar cualquier excepción que ocurra durante la actualización del vehículo
        return redirect()->back()->with('error', 'Ocurrió un error al intentar actualizar el Soat: ' . $e->getMessage());
    }
}

    // Eliminar Registro De Soat
    public function getSoatDelete($id)
    {
        $Soat = Soat::find($id);
        if($Soat->delete()):
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.soat'))->with('success','Registro Elimado Con Exito')->with('typealert','success');
        endif;
    }

    
    // Trae Toda Los Datos De La Tabla De Tecnomecanica
    public function tecnomecanica()
    {
        $Tecnomecanic = Tecnomecanic::with('person')->get();
        $vehicles = Vehicle::pluck('name', 'id');
        $drivers = Driver::with('person')->get()->pluck('person.fullname', 'person.id');
        $data = ['Tecnomecanic' => $Tecnomecanic, 'vehicles' => $vehicles, 'drivers' => $drivers];
        return view('hangarauto::admin.revisiones.tecnomecanica.index', $data);
    }

    // Agregar Tecnomecanica
    public function getTecnomecanicaAdd(){
        return view('hangarauto.admin.tecnomecanica');
    }

    public function postTecnomecanicaAdd(Request $request)
    {
        $rules = [
            'vehicle_id' => 'required',
            'person_id' => 'required',
            'review_date' => 'required|date',
        ];

        $messages = [
            'vehicle_id.required' => 'Debe Ingresar El Nombre Del Vehiculo',
            'person_id.required' => 'Ingrese Quien Hizo La Renovación De La Tecnomecanica',
            'review_date.required' => 'La Fecha En Que Renovó La Tecnomecanica',
            'review_date.date' => 'La Fecha En Que Renovó La Tecnomecanica debe ser una fecha válida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Se Ha Producido Un Error')->with('typealert','danger');
        }

        $Tecnomecanic = new Tecnomecanic();
        $Tecnomecanic->vehicle_id = $request->input('vehicle_id');
        $Tecnomecanic->person_id = $request->input('person_id');
        $Tecnomecanic->review_date = $request->input('review_date');
        $Tecnomecanic->expiration_date = Carbon::parse($request->input('review_date'))->addYear();

        if ($Tecnomecanic->save()) {
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.tecnomecanica'))->with('success','Nuevo Registro De Tecnomecanica Agregado Con Exito')->with('typealert','success');
        }

        return back()->with('error', 'Se Ha Producido Un Error')->with('typealert', 'danger');
    }

    public function gettecnomecanicaEdit ($id)
    {   
        $tecnomecanica = Tecnomecanic::with('person')->find($id);  
        $vehicles = Vehicle::pluck('name', 'id');
        $drivers = Driver::with('person')->get()->pluck('person.fullname', 'person.id');
        $data = ['tecnomecanica'=>$tecnomecanica,'vehicles'=>$vehicles,'drivers'=>$drivers ];
        return view('hangarauto::admin.revisiones.tecnomecanica.edit',$data);
        
    }   

    public function posttecnomecanicaEdit(Request $request, $id)
 {
     // Validar los datos enviados por el formulario
     $request->validate([
        'vehicle_id' => 'required',
        'person_id' => 'required',
        'review_date' => 'required',
    ]);

    try {
        // Buscar el vehículo por su ID
        $Tecnomecanica = Tecnomecanic::findOrFail($id);
        $Tecnomecanica->vehicle_id = $request->input('vehicle_id');
        $Tecnomecanica->person_id = $request->input('person_id');
        $Tecnomecanica->review_date = $request->input('review_date');
        $Tecnomecanica->expiration_date = $request->input('expiration_date');

        // Guardar los cambios en la base de datos
        $Tecnomecanica->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.tecnomecanica')->with('success', 'Tecnomecanica actualizado exitosamente.');
    } catch (\Exception $e) {
        // Manejar cualquier excepción que ocurra durante la actualización del vehículo
        return redirect()->back()->with('error', 'Ocurrió un error al intentar actualizar el Tecnomecanica: ' . $e->getMessage());
    }
}

    // Eliminar Registro De Tecnomecanica
    public function getTecnomecanicaDelete($id)
    {
        $Tecnomecanic = Tecnomecanic::find($id);
        if($Tecnomecanic->delete()):
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.tecnomecanica'))->with('success', 'Registro Eliminado Con Exito')->with('typealert','success');
        endif;
    }

    // Trae Toda Los Datos De La Tabla De Tecnomecanica
    public function consumo()
    {
        $consumo = FuelConsumption::get();
        $vehicles = Vehicle::pluck('name', 'id');
        $drivers = Driver::with('person')->get()->pluck('person.fullname', 'person.id');
        $measurement_units = MeasurementUnit::where('name','=','Galon')->pluck('name', 'id');
        $fuel_type = FuelType::pluck('name', 'id');
        $data = ['consumo' => $consumo,'measurement_units' => $measurement_units, 'vehicles' => $vehicles, 'drivers' => $drivers, 'fuel_type' => $fuel_type];
        return view('hangarauto::admin.con_gaso.index', $data);
    }



    public function postConsumoAdd(Request $request)
    {
        $rules = [
            'vehicle_id' => 'required',
            'person_id' => 'required',
            'date' => 'required|date',
        ];

        $messages = [
            'vehicle_id.required' => 'Debe Ingresar El Nombre Del Vehiculo',
            'person_id.required' => 'Ingrese Quien Hizo La Renovación De La Tecnomecanica',
            'date.required' => 'La Fecha En Que Renovó La Tecnomecanica es obligatoria',
            'date.date' => 'La Fecha En Que Renovó La Tecnomecanica debe ser una fecha válida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Se Ha Producido Un Error')->with('typealert','danger');
        }

        $consumo = new FuelConsumption();
        $consumo->vehicle_id = $request->input('vehicle_id');
        $consumo->person_id = $request->input('person_id');
        $consumo->date = $request->input('date');
        $consumo->fuel_type_id = $request->input('fuel_type');
        $consumo->measurement_unit_id = $request->input('measurement_unit_id');
        $consumo->amount = $request->input('amount');
        $consumo->price = $request->input('price');
        $consumo->mileage = $request->input('mileage');
        

        if ($consumo->save()) {
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.consumo'))->with('success','Nuevo Registro De Consumo Agregado Con Exito')->with('typealert','success');
        }

        return back()->with('error', 'Se Ha Producido Un Error al guardar el registro')->with('typealert', 'danger');
    }

    public function getconsumoEdit ($id)
    {   
        $consumo = FuelConsumption::with('person')->find($id);  
        $vehicles = Vehicle::pluck('name', 'id');
        $drivers = Driver::with('person')->get()->pluck('person.fullname', 'person.id');
        $fuel_type = FuelType::pluck('name', 'id');
        $measurement_units = MeasurementUnit::where('name','=','Galon')->pluck('name', 'id');
        $data = ['consumo'=>$consumo,'vehicles'=>$vehicles,'drivers'=>$drivers,'fuel_type'=>$fuel_type,'measurement_units'=>$measurement_units ];
        return view('hangarauto::admin.con_gaso.edit',$data);
        
    }   

    public function postconsumoEdit(Request $request, $id)
 {
     // Validar los datos enviados por el formulario
     $request->validate([
        'vehicle_id' => 'required',
        'person_id' => 'required',
    ]);

    try {
        // Buscar el vehículo por su ID
        $FuelConsumption = FuelConsumption::findOrFail($id);
        $FuelConsumption->vehicle_id = $request->input('vehicle_id');
        $FuelConsumption->person_id = $request->input('person_id');
        $FuelConsumption->fuel_type_id = $request->input('fuel_type_id');
        $FuelConsumption->date = $request->input('date');
        $FuelConsumption->measurement_unit_id = $request->input('measurement_unit_id');
        $FuelConsumption->price = $request->input('price');
        $FuelConsumption->amount = $request->input('amount');
        $FuelConsumption->mileage = $request->input('mileage');

        // Guardar los cambios en la base de datos
        $FuelConsumption->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.consumo')->with('success', 'Consumo actualizado exitosamente.');
    } catch (\Exception $e) {
        // Manejar cualquier excepción que ocurra durante la actualización del vehículo
        return redirect()->back()->with('error', 'Ocurrió un error al intentar actualizar el Consumo: ' . $e->getMessage());
    }
}


    // Eliminar Registro De Tecnomecanica
    public function getConsumoDelete($id)
    {
        $Tecnomecanic = FuelConsumption::find($id);
        if($Tecnomecanic->delete()):
            return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.consumo'))->with('success', 'Registro Eliminado Con Exito')->with('typealert','success');
        endif;
    }

    public function notificationsoat()
    {
         // Obtener la fecha actual
        $currentDate = Carbon::now();

        // Obtener el registro más reciente de Soat
        $latestSoat = Soat::latest()->first();

        // Arreglos para almacenar las notificaciones de vencimiento
        $notificationsSoat = [];

        // Contadores para contar las notificaciones de vencimiento
        $countSoat = 0;

        // Verificar Soat más reciente
        if ($latestSoat) {
            // Calcular la diferencia en meses entre la fecha actual y la fecha de vencimiento del Soat
            $diffMonths = $currentDate->diffInMonths($latestSoat->expiration_date, false);

            // Si quedan menos de dos meses para que se venza el Soat, agregarlo a las notificaciones
            if ($diffMonths < 2) {
                $notificationsSoat[] = [
                    'vehicle' => $latestSoat->vehicle->name,
                    'responsability' => $latestSoat->person->fullname,
                    'review_date' => $latestSoat->review_date,
                    'expiration_date' => $latestSoat->expiration_date,
                ];
                $countSoat++;
            }
        }

        
        // Almacenar las notificaciones en la sesión
        Session::put('notificationsSoat', $notificationsSoat);

        // Almacenar el recuento de notificaciones en la sesión
        Session::put('countSoat', $countSoat);


        $title = 'Soat';
    
        // Devolver la vista con las notificaciones
        return view('hangarauto::admin.revisiones.SOAT.notification', [
            'notifications' => $notificationsSoat,
            'title' => $title,
        ]);
    
    
    }

    public function notificationtecno()
{
    // Obtener la fecha actual
    $currentDate = Carbon::now();

    // Obtener el registro más reciente de Tecnomecánica
    $latestTecnomecanica = Tecnomecanic::latest()->first();

    // Arreglos para almacenar las notificaciones de vencimiento
    $notificationsTecnomecanica = [];

    // Contadores para contar las notificaciones de vencimiento
    $countTecnomecanica = 0;



    // Verificar Tecnomecánica más reciente
    if ($latestTecnomecanica) {
        // Calcular la diferencia en meses entre la fecha actual y la fecha de vencimiento de la Tecnomecánica
        $diffMonths = $currentDate->diffInMonths($latestTecnomecanica->expiration_date, false);

        // Si quedan menos de dos meses para que se venza la Tecnomecánica, agregarlo a las notificaciones
        if ($diffMonths < 2) {
            $notificationsTecnomecanica[] = [
                'vehicle' => $latestTecnomecanica->vehicle->name,
                'responsability' => $latestTecnomecanica->person->fullname,
                'review_date' => $latestTecnomecanica->review_date,
                'expiration_date' => $latestTecnomecanica->expiration_date,
            ];
            $countTecnomecanica++;
        }
    }

    // Almacenar las notificaciones en la sesión
    Session::put('notificationsTecnomecanica', $notificationsTecnomecanica);

    // Almacenar el recuento de notificaciones en la sesión
    Session::put('countTecnomecanica', $countTecnomecanica);

    $title = 'Tecnomecanica';

    // Devolver la vista con las notificaciones
    return view('hangarauto::admin.revisiones.Soat.notification', [
        'notifications' => $notificationsTecnomecanica,
        'title' => $title,
    ]);
}

    public function fueltype()
    {
        $fuel_type = FuelType::get();
        
        $data = ['fueltype' => $fuel_type];
        return view('hangarauto::admin.fueltype.index', $data);
    }

    public function postfueltypeAdd(Request $request)
{
    $rules = [
        'name' => 'required',
    ];

    $messages = [
        'name.required' => 'Debe ingresar el nombre del tipo de combustible',

    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return back()->withErrors($validator)->with('error', 'Se ha producido un error')->with('typealert', 'danger');
    }

    $fueltype = new FuelType();
    $fueltype->name = $request->input('name');

    if ($fueltype->save()) {
        return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.fueltype'))->with('success', 'Tipo de combustible agregado exitosamente')->with('typealert', 'success');
    }

    return back()->with('error', 'Error al agregar el Tipo de combustible')->with('typealert', 'danger');
}
 

    public function getfueltypeEdit ($id)
    {   
        $fueltype = FuelType::find($id);  
       
        $data = ['fueltype'=>$fueltype ];
        return view('hangarauto::admin.fueltype.edit',$data);
        
    }   

    public function postfueltypeEdit(Request $request, $id)
 {
     // Validar los datos enviados por el formulario
     $request->validate([
        'name' => 'required|string',
    ]);

    try {
        // Buscar el vehículo por su ID
        $fueltype = FuelType::findOrFail($id);

        // Actualizar los valores de los campos
        $fueltype->name = $request->input('name');

        // Guardar los cambios en la base de datos
        $fueltype->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.fueltype')->with('success', 'Tipo de Combustible actualizado exitosamente.');
    } catch (\Exception $e) {
        // Manejar cualquier excepción que ocurra durante la actualización del vehículo
        return redirect()->back()->with('error', 'Ocurrió un error al intentar actualizar el Tipo de Combustible: ' . $e->getMessage());
    }
}

    public function getfueltypeDelete($id)
    {
        // Intenta Encontrar El Registro
        try{
            // Encuentra El Registro Por Su ID
        $fueltype = FuelType::findOrFail($id);

        // Elimina El Registro
        $fueltype->delete();
        return redirect()->back()->with('success', 'Eliminado Satisfactoriamente');
        } catch(\Exception $e) {
            $message = $e->getMessage();
            return redirect()->back()->with('error', $message);
        }
        
    }

    
}
