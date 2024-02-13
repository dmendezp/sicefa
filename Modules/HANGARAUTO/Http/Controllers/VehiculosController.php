<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\HANGARAUTO\Entities\Vehicle;
use Modules\HANGARAUTO\Entities\Tecnomecanic;
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
        $data = ['vehicles'=>$vehicles];
        return view('hangarauto::admin.vehicles', $data); 
        
    }

    public function postVehiclesStore(Request $request)
{
    // Validar los datos enviados por el formulario
    $request->validate([
        'name' => 'required|string',
        'reference' => 'required|string',
        'status' => 'required|string',
        'license' => 'required|string|unique:vehicles',
        'fuel_level' => 'required|string',
    ]);

    try {
        // Crear una nueva instancia del modelo Vehicle
        $vehicle = new Vehicle();

        // Asignar los valores de los campos
        $vehicle->name = $request->input('name');
        $vehicle->reference = $request->input('reference');
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
        return back()->withErrors($validator)->with('messages', 'Se ha producido un error')->with('typealert', 'danger');
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

        return redirect(route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.vehicles'))->with('messages', 'Vehículo agregado exitosamente')->with('typealert', 'success');
    }

    return back()->with('messages', 'Error al agregar el vehículo')->with('typealert', 'danger');
}
 

    public function getVehiclesEdit($id)
    {   
        $vehicle = Vehicle::find($id);  
        $data = ['vehicle'=>$vehicle];
        return view('hangarauto::admin.vehiculos.edit',$data);
        
    }   

    public function postViajesEdit(Request $request, $id)
 {
     // Validar los datos enviados por el formulario
     $request->validate([
        'name' => 'required|string',
        'reference' => 'required|string',
        'status' => 'required|string',
        'license' => 'required|string',
        'fuel_level' => 'required|string',
    ]);

    try {
        // Buscar el vehículo por su ID
        $vehicle = Vehicle::findOrFail($id);

        // Actualizar los valores de los campos
        $vehicle->name = $request->input('name');
        $vehicle->reference = $request->input('reference');
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
            return redirect('hangarauto::admin.vehiculos.report')->withErrors($validator)->with('messages', 'Se Ha Producido Un Error')->with('typealert', 'danger')->withInput();
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
}