<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\Convocation;
use Modules\SICA\Entities\Quarter;


class ConvocationsController extends Controller
{
    public function convocatoria()
    {
        // Mostrar el formulario para crear una nueva convocatoria
        return view('bienestar::convocatoria');
        
    }
    
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // Obtenemos Listado Convocatoria
       $convocations=Convocation::all(); 
       //obtenemos el listado de buses
       $convocations = Convocation::with('quarters')->get();
       $quarters = Quarter::pluck('name','id','start_date','end_date');
       $quarters= Quarter::all(); 
       return view('bienestar::convocations',['convocations'=>$convocations,'quarters'=>$quarters]);
    }

    

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        
        // Define las reglas de validación
        $convocations = new Convocation;
        $convocations->name = $request->input('title');
        $convocations->description = $request->input('description');
        $convocations->food_quotas = $request->input('food_quotas');
        $convocations->transport_quotas = $request->input('transport_quotas');
        $convocations->start_date= $request->input('start_date');
        $convocations->end_date= $request->input('end_date');
        $convocations->quarter_id= $request->input('quarter_id');
        $convocations->save();
        
        if($convocations->save()){
            return redirect()->route('cefa.bienestar.Convocations')->with('message', 'Convocatoria registrada Correctamente')->with('typealert', 'success');
        }else{
            return redirect()->route('cefa.bienestar.Convocations')->with('message', 'Se Ha Producido Un Error')->with('typealert', 'danger');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('bienestar::show');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $convocations = Convocation::findOrFail($id);
        $convocations->name = $request->input('name');
        $convocations->description = $request->input('description');
        $convocations->food_quotas = $request->input('food_quotas');
        $convocations->transport_quotas = $request->input('transport_quotas');
        $convocations->start_date = $request->input('start_date');
        $convocations->end_date = $request->input('end_date');
        $convocations->quarter_id= $request->input('quarter_id');
         
        if($convocations->save()){
            return redirect()->route('cefa.bienestar.Convocations')->with('message', 'Registro Actualizado Correctamente')->with('typealert', 'success');
        }
        return redirect()->route('cefa.bienestar.Convocations')->with('message', 'Se Ha Producido Un Error')->with('typealert', 'danger');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try{
            $convocations = Convocation::findOrFail($id);
            $convocations->delete();
            return response()->json(['mensaje' => 'eliminado with success']);      
          }  catch (\Exception $e) {
              return response()->json(['mensaje' =>'Error when deleting the vacancy'], 500);
          }  
    }


}