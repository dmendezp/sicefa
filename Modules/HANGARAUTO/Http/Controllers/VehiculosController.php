<?php

namespace Modules\HANGARAUTO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\HANGARAUTO\Entities\Vehicle;


use Modules\HANGARAUTO\Entities\Tecnomecanic;


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

    

    public function postVehiclesAdd(Request $request)
    {


        $rules = [
             'name' => 'required',
             
             'license' => 'required'
             
    
        ];
        $messages = [
             'name.required' => 'Debe ingresar el nombre del vehículo',
             
             
             'license.required' => 'La license del vehículo es obligatoria',
             
        ];
        


        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se ha producidor un error')->with('typealert','danger');
            

        else:
            

         /**$path = 'hangarauto/uploads/'.date('Y-m-d');
         $fileExt = trim($request->file('image')->getClientOriginalExtension());
         
         $name = Str::slug(str_replace($fileExt,'',$request->file('image')->getClientOriginalName()));
         $filename = rand(1,999).'-'.$name.'.'.$fileExt;

         */
         $path = '/'.date('y-m-d');
         $fileExt = trim($request->file('image')->guessExtension());
         $upload_path = Config::get('filesystems.disks.uploads.root');
         $name = Str::slug(str_replace($fileExt,'',$request->file('image')->getClientOriginalName()));
         $filename = rand(1,999).'-'.$name.'.'.$fileExt;
         $final_file = $upload_path.'/'.$path.'/'.$filename;

         $vehicle = new Vehicle();
         $vehicle -> name = $request -> input('name');
        
         
         $vehicle -> license = $request -> input('license');
         
         $vehicle -> file_path = $path.'/';
         $vehicle -> image = $filename;

        

        if($vehicle->save()){
            if ($request->hasFile('image')) {

                /**$fl = $request->image->storeAs('public/'.$path, $filename);
                

                $img= Image::make(asset('storage/'.$path.'/'.$filename));
                $img->fit(256, 256, function($constraint){
                    $constraint->upsize();
                });
                $img->save('storage/'.$path.'/t_'.$filename);
                */
                $fl = $request->image->storeAs($path,$filename,'uploads');
                $img = Image::make($final_file);
                $img->fit(256, 256, function($constraint){
                    $constraint->upsize();
                });
                $img->save($upload_path.'/'.$path.'/t_'.$filename);
            }
            
        
                return redirect(route('parking.admin.vehicles'))->with('messages', 'Vehículo agregado exitosamente')->with('typealert','success');
            }
        
            endif;
        return view('hangarauto::admin.drivers');
    }


    

    

    public function getViajesEdit($id)
    {
        $vehicle = Vehicle::find($id);
        
        
        
        $data = ['vehicle'=>$vehicle];
        return view('hangarauto::admin.vehiculos.edit',$data);
        
    }   

    public function postViajesEdit(Request $request, $id)
 {
     $rules = [
         'name' => 'required',
         
         'license' => 'required',
         
     ];
     $messages = [
         'name.required' => 'Debe ingresar el nombre del vehículo',
         
         
         'license.required' => 'La placa del vehículo es obligatoria',
         
     ];

     $validator = Validator::make($request->all(), $rules, $messages);
     if($validator->fails()):
         return back()->withErrors($validator)->with('messages', 'Se ha producidor un error')->with('typealert','danger');

     else:
         $vehicle =  Vehicle::findOrFail($id);
         $vehicle -> name = $request -> input('name');
         
         
         $vehicle -> license = $request -> input('license');
         
         

         if($vehicle->save()){
             return redirect(route('parking.admin.vehicles'))->with('messages', 'Registro modificado exitosamente')->with('typealert','success');
         }
     endif;

    

    
}
public function getVehiclesDelete($id)
    {
        $vehicle = Vehicle::find($id);
        if($vehicle->delete()):
             return redirect(route('parking.admin.vehicles'))->with('messages', 'Vehiculo eliminado exitosamente')->with('typealert','success');
         
     endif;
    }
}