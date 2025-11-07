<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\HANGARAUTO\Entities\Vehicle;
use Modules\HANGARAUTO\Entities\Tecnomecanic;
use Modules\HANGARAUTO\Entities\CheckList;
use Modules\HANGARAUTO\Entities\Check;
use Modules\HANGARAUTO\Entities\Driver;
use Modules\HANGARAUTO\Entities\VehicleType;
use Carbon\Carbon;


use Validator, Str, Config, Image;

class VehiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function Vehicles()
    {
        $vehicles = Vehicle::orderBy('id','asc')->get();
        $vehicletype = VehicleType::pluck('name','id');
        $data = ['vehicles'=>$vehicles,'vehicletype'=>$vehicletype];
        return view('hangarauto::admin.vehicles', $data); 
        
    }

    public function postVehiclesStore(Request $request)
{
    // Validar los datos enviados por el formulario
    $request->validate([
        'name' => 'required|string',
        'vehicletype' => 'required',
        'status' => 'required|string',
        'license' => 'required|string|unique:vehicles',
        'fuel_level' => 'required|string',
    ]);

    try {
        // Crear una nueva instancia del modelo Vehicle
        $vehicle = new Vehicle();

        // Asignar los valores de los campos
        $vehicle->name = $request->input('name');
        $vehicle->vehicle_type_id = $request->input('vehicletype');
        $vehicle->status = $request->input('status');
        $vehicle->license = $request->input('license');
        $vehicle->fuel_level = $request->input('fuel_level');

        // Guardar el vehículo en la base de datos
        $vehicle->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.vehicles')->with('success', 'Vehículo creado exitosamente.');
    } catch (\Exception $e) {
        // Manejar cualquier excepción que ocurra durante la creación del vehículo
        return redirect()->back()->with('error', 'Ocurrió un error al intentar crear el vehículo: ' . $e->getMessage());
    }
}


    public function postVehiclesAdd(Request $request)
{
    $rules = [
        'name' => 'required',
        'license' => 'required',
    ];

    $messages = [
        'name.required' => 'Debe ingresar el nombre del vehículo',
        'license.required' => 'La license del vehículo es obligatoria',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return back()->withErrors($validator)->with('error', 'Se ha producido un error')->with('typealert', 'danger');
    }

    $path = '/' . date('y-m-d');
    $fileExt = trim($request->file('image')->guessExtension());
    $upload_path = Config::get('filesystems.disks.uploads.root');
    $name = Str::slug(str_replace($fileExt, '', $request->file('image')->getClientOriginalName()));
    $filename = rand(1, 999) . '-' . $name . '.' . $fileExt;
    $final_file = $upload_path . $path . '/' . $filename;

    $vehicle = new Vehicle();
    $vehicle->name = $request->input('name');
    $vehicle->license = $request->input('license');
    $vehicle->file_path = $path . '/';
    $vehicle->image = $filename;

    if ($vehicle->save()) {
        if ($request->hasFile('image')) {
            $fl = $request->image->storeAs($path, $filename, 'uploads');
            $img = Image::make($final_file);
            $img->fit(256, 256, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($upload_path . $path . '/t_' . $filename);
        }

        return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.vehicles'))->with('success', 'Vehículo agregado exitosamente')->with('typealert', 'success');
    }

    return back()->with('error', 'Error al agregar el vehículo')->with('typealert', 'danger');
}
 

    public function getVehiclesEdit($id)
    {   
        $vehicle = Vehicle::with('vehicle_type')->find($id);  
        $vehicletype = VehicleType::pluck('name','id');
        $data = ['vehicle'=>$vehicle ,'vehicletype'=>$vehicletype ];
        return view('hangarauto::admin.vehiculos.edit',$data);
        
    }   

    public function postViajesEdit(Request $request, $id)
 {
     // Validar los datos enviados por el formulario
     $request->validate([
        'name' => 'required|string',
        'vehicletype' => 'required',
        'status' => 'required|string',
        'license' => 'required|string',
        'fuel_level' => 'required|string',
    ]);

    try {
        // Buscar el vehículo por su ID
        $vehicle = Vehicle::findOrFail($id);

        // Actualizar los valores de los campos
        $vehicle->name = $request->input('name');
        $vehicle->vehicle_type_id = $request->input('vehicletype');
        $vehicle->status = $request->input('status');
        $vehicle->license = $request->input('license');
        $vehicle->fuel_level = $request->input('fuel_level');

        // Guardar los cambios en la base de datos
        $vehicle->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.vehicles')->with('success', 'Vehículo actualizado exitosamente.');
    } catch (\Exception $e) {
        // Manejar cualquier excepción que ocurra durante la actualización del vehículo
        return redirect()->back()->with('error', 'Ocurrió un error al intentar actualizar el vehículo: ' . $e->getMessage());
    }
}

    public function getVehiclesDelete($id)
    {
        // Intenta Encontrar El Registro
        try{
            // Encuentra El Registro Por Su ID
        $vehicle = Vehicle::findOrFail($id);

        // Elimina El Registro
        $vehicle->delete();
        return redirect()->back()->with('success', 'Eliminado Satisfactoriamente');
        } catch(\Exception $e) {
            $message = $e->getMessage();
            return redirect()->back()->with('error', $message);
        }
        
    }

    public function reportindex()
    {
        return view('hangarauto::admin.vehiculos.report');
    }

    public function search(Request $request)
    {
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'El Campo Consultar Es Requerido.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect('hangarauto::admin.vehiculos.report')->withErrors($validator)->with('error', 'Se Ha Producido Un Error')->with('typealert', 'danger')->withInput();
        else:
            $currentDate = Carbon::now();

            $vehicle = Vehicle::with([
                'soats' => function ($query) use ($currentDate) {
                    $query->orderBy('review_date', 'desc')
                          ->limit(1);
                },
                'tecnomecanics' => function ($query) use ($currentDate) {
                    $query->orderBy('review_date', 'desc')
                          ->limit(1);
                }
            ])
            ->where('license', $request->input('search'))
            ->first();
            
            $data = ['vehicle' => $vehicle];
            return view('hangarauto::admin.vehiculos.report', $data);
        endif;
    }

    public function check()
    {
       // Obtener todos los chequeos de autos
    $chequeos = Check::with('check_lists')->get();


    $data = ['chequeos'=>$chequeos];
    return view('hangarauto::admin.check.index', $data); 
        
    }

    public function getcheckadd()
    {
       // Obtener todos los chequeos de autos
       $checklist_items = [
        'Licencia Conduccion',
        'SOAT',
        'Seguro Daños',
        'Revision TM',
        'Luces',
        'Limpiabrisas',
        'Frenos',
        'Llantas',
        'Espejos',
        'Nivel Aceite',
        'Nivel Liquido Frenos',
        'Nivel Refrigerante',
        'Cinturones',
        'Extintor',
        'Equipo Carretera',
        'Herramientas'
    ];
    
    $drivers = Driver::get();
    $vehicles = Vehicle::get();


    $data = ['checklist_items'=>$checklist_items,'drivers'=>$drivers,'vehicles'=>$vehicles];
    return view('hangarauto::admin.check.create', $data); 
        
    }

    public function postcheckadd(Request $request)
    {
        try {
            // Validar la solicitud
            $validatedData = $request->validate([
                'driver' => 'required',
                'vehicle' => 'required',
                'date' => 'required|date',
                'initial_kilometer' => 'required|numeric',
                'final_kilometer' => 'required|numeric',
                'initial_hour' => 'required',
                'final_hour' => 'required',
                'observations.*.complete' => 'required', // Asegura que el campo 'complete' esté presente para todas las observaciones
            ]);

            // Obtener los elementos de la lista de verificación
            $checklist_items = $request->checklist_items;

            // Crear el chequeo
            $check = Check::create([
                'driver_id' => $request->driver,
                'vehicle_id' => $request->vehicle,
                'date' => $request->date,
                'initial_kilometer' => $request->initial_kilometer,
                'final_kilometer' => $request->final_kilometer,
                'initial_hour' => $request->initial_hour,
                'final_hour' => $request->final_hour,
            ]);

            // Crear los elementos de la lista de verificación
            foreach ($request->input('observations') as $index => $observation) {
                CheckList::create([
                    'check_id' => $check->id,
                    'inspection' => $checklist_items[$index],
                    'complete' => $observation['complete'] === 'yes' ? 'Si' : 'No',
                    'observation' => $observation['observation'],
                ]);
            }

            // Redirigir con mensaje de éxito
            return redirect()->route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.check')->with('success', '¡El chequeo se ha registrado correctamente!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Redirigir con mensaje de error de validación
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Manejar el error
            Log::error('Error al registrar el chequeo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ha ocurrido un error al registrar el chequeo: ' . $e->getMessage())->withInput();
        }
    }

    public function getcheckedit($id)
    {
        $checkup = Check::findOrFail($id);
            $drivers = Driver::all();
            $vehicles = Vehicle::all();
            $checklist_items = [
                'Licencia Conduccion',
                'SOAT',
                'Seguro Daños',
                'Revision TM',
                'Luces',
                'Limpiabrisas',
                'Frenos',
                'Llantas',
                'Espejos',
                'Nivel Aceite',
                'Nivel Liquido Frenos',
                'Nivel Refrigerante',
                'Cinturones',
                'Extintor',
                'Equipo Carretera',
                'Herramientas'
            ];
        // Aquí puedes cargar cualquier otro dato que necesites, como conductores, vehículos, etc.
        return view('hangarauto::admin.check.edit', compact('checkup', 'drivers', 'vehicles', 'checklist_items'));
    }

    public function updatecheck(Request $request, $id)
    {
        try {
            // Validar la solicitud
            $request->validate([
                'driver' => 'required',
                'vehicle' => 'required',
                'date' => 'required|date',
                'initial_kilometer' => 'required|numeric',
                'final_kilometer' => 'required|numeric',
                'initial_hour' => 'required',
                'final_hour' => 'required',
                'observations.*.complete' => 'required', // Asegura que el campo 'complete' esté presente para todas las observaciones
            ]);

            // Obtener los elementos de la lista de verificación
            $checklist_items = $request->checklist_items;

            // Encontrar el chequeo a actualizar
            $checkup = Check::findOrFail($id);

            // Actualizar el chequeo
            $checkup->update([
                'driver_id' => $request->driver,
                'vehicle_id' => $request->vehicle,
                'date' => $request->date,
                'initial_kilometer' => $request->initial_kilometer,
                'final_kilometer' => $request->final_kilometer,
                'initial_hour' => $request->initial_hour,
                'final_hour' => $request->final_hour,
            ]);

            // Actualizar los elementos de la lista de verificación
            foreach ($request->input('observations') as $index => $observation) {
                $checklist = $checkup->check_lists()->where('inspection', $checklist_items[$index])->firstOrFail();
                $checklist->update([
                    'complete' => $observation['complete'] === 'yes' ? 'Si' : 'No',
                    'observation' => $observation['observation'],
                ]);
            }

            // Redirigir con mensaje de éxito
            return redirect()->route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.check')->with('success', '¡El chequeo se ha actualizado correctamente!');
        } catch (\Exception $e) {
            // Manejar el error
            Log::error('Error al actualizar el chequeo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ha ocurrido un error al actualizar el chequeo: ' . $e->getMessage())->withInput();
        }
    }

    public function deletecheck($id)
    {
        try {
            $checkup = Check::findOrFail($id);
            $checkup->delete();
            return redirect()->back()->with('success', '¡El chequeo ha sido eliminado correctamente!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al eliminar el chequeo: ' . $e->getMessage());
        }
    }

    public function vehicletype()
    {
        $fuel_type = VehicleType::get();
        
        $data = ['vehicletype' => $fuel_type];
        return view('hangarauto::admin.vehicletype.index', $data);
    }

    public function postvehicletypeAdd(Request $request)
{
    $rules = [
        'name' => 'required',
    ];

    $messages = [
        'name.required' => 'Debe ingresar el nombre del tipo de vehiculo',

    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return back()->withErrors($validator)->with('error', 'Se ha producido un error')->with('typealert', 'danger');
    }

    $vehicletype = new VehicleType();
    $vehicletype->name = $request->input('name');

    if ($vehicletype->save()) {
        return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.vehicletype'))->with('success', 'Tipo de Vehiculo agregado exitosamente')->with('typealert', 'success');
    }

    return back()->with('error', 'Error al agregar el Tipo de Vehiculo')->with('typealert', 'danger');
}
 

    public function getvehicletypeEdit ($id)
    {   
        $vehicletype = VehicleType::find($id);  
       
        $data = ['vehicletype'=>$vehicletype ];
        return view('hangarauto::admin.vehicletype.edit',$data);
        
    }   

    public function postvehicletypeEdit(Request $request, $id)
 {
     // Validar los datos enviados por el formulario
     $request->validate([
        'name' => 'required|string',
    ]);

    try {
        // Buscar el vehículo por su ID
        $vehicletype = VehicleType::findOrFail($id);

        // Actualizar los valores de los campos
        $vehicletype->name = $request->input('name');

        // Guardar los cambios en la base de datos
        $vehicletype->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.vehicletype')->with('success', 'Tipo de Vehiculo actualizado exitosamente.');
    } catch (\Exception $e) {
        // Manejar cualquier excepción que ocurra durante la actualización del vehículo
        return redirect()->back()->with('error', 'Ocurrió un error al intentar actualizar el Tipo de Vehiculo: ' . $e->getMessage());
    }
}

    public function getvehicletypeDelete($id)
    {
        // Intenta Encontrar El Registro
        try{
            // Encuentra El Registro Por Su ID
        $vehicletype = VehicleType::findOrFail($id);

        // Elimina El Registro
        $vehicletype->delete();
        return redirect()->back()->with('success', 'Eliminado Satisfactoriamente');
        } catch(\Exception $e) {
            $message = $e->getMessage();
            return redirect()->back()->with('error', $message);
        }
        
    }





}