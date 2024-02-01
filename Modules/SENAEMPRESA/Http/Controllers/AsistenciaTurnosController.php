<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\Asistencia;




class AsistenciaTurnosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        //$asistencias = Asistencia::get();
        
        $courses = Course::orderBy('code','desc')->get();
        $data = ['courses'=>$courses ];
       
        return view('senaempresa::Asistencia.home', $data);

        
    }


    public function buscarLista($id){

        //return $id;
        $asistencias1 = Asistencia::get();
        $asistencias = Apprentice::where('course_id',$id)->get();
        //$asistencias = Asistencia::where('',$id)->get();
        
        //$asistencias->asistencias->syncWithoutDetaching(['asistencia' => 'otro']);

        $data = ['asistencia'=>$asistencias,'asistencia1'=>$asistencias1];
        //$data = ['asistencia'=>$asistencias];
        
        return view('senaempresa::Asistencia.fecha', $data);
    
        
        
    }

    public function listaTurnos(){

        $asistencias = Asistencia::orderBy('id','asc')->get();
        return view('senaempresa::Asistencia.listaTurnos', compact('asistencias'));
    }

    /////{{--
   


    /////

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
  

    public function getAsignarTurno($id)
    {
        //return $id;
        //$asistencias = Asistencia::get();

        //return $asistencias;
        //$aprendices = Apprentice::where('course_id',$id)->orderBy('id','asc')->pluck('id');
        $aprendices = Apprentice::where('course_id',$id)->get() ;
        
        //return $aprendices;
        //$asistencias = Asistencia::where('$this->Apprentice->course_id',$id)->get();
        
        //return $asistencias;

        //$data = ['aprendices'=>$aprendices,'asistencias'=>$asistencias];
        $data = ['aprendices'=>$aprendices];
        //return $asistencias;
        return view('senaempresa::Asistencia.asignar', $data);
        
       
    }

/*
    public function postAsignarTurno(Request $request, Apprentice $apprentice){

        //return $apprentice;
        $aprendices = Apprentice::where('course_id',$id)->get();
        $request->validate(['date'=>'required']);
        //$asistencias = Asistencia::get();
        $asistencia = $request->all();

        Asistencia::create($asistencia); 
        


        

        

    }


*/



public function postAsignarTurno(Request $request){

    //return $apprentice; 
    $request->validate(['date'=>'required']);
    $asistencia = $request->all();
    
    $asistencia = Asistencia::create($asistencia); 

    //$asistencia->apprentices()->sync($request->input('aprendices',[]));
    $asistencia->apprentices()->syncWithoutDetaching($request->input('aprendices',[]));
    return redirect()->route('turnosRutinarios');


}

    

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('senaempresa::show');
    }

   
    public function updateTurno(Request $request)
    {
        //return $asistencia;
        $request->validate(['date'=>'required', 'id'=>'required']);
        $asistencia = $request->all();
        $resultado = Asistencia::findOrFail($request->input('id'));
        $resultado->date = ($request->input('date'));
        $resultado->save();
        
        //return $resultado;
        return redirect(route('listaTurnos'))->with('success', 'Fecha actualizada.');;
        
       

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
