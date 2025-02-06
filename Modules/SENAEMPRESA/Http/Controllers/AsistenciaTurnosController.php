<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;
use Modules\SENAEMPRESA\Entities\Asistencia;
use Modules\SENAEMPRESA\Entities\ApprenticeAsistencia;
use Modules\SENAEMPRESA\Entities\Work;




class AsistenciaTurnosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        //$asistencias = Asistencia::get();
        
        $asistencias = Asistencia::orderBy('start','desc')->get();
        $courses = Course::orderBy('code','desc')->get();
        $data = ['courses'=>$courses, 'asistencias'=>$asistencias ];

       
        return view('senaempresa::Asistencia.home', $data);

        
    }


    public function buscarLista($id){

        //return $id;
        $ids=87;
        $works = Work::get();
        $asistencias1 = ApprenticeAsistencia::where('attendance_id',$id)->get();
        $asistencias = Apprentice::where('course_id',$ids)->get();
        //$asistencias = Asistencia::where('',$id)->get();
        
        //$asistencias->asistencias->syncWithoutDetaching(['asistencia' => 'otro']);

        $data = ['asistencia'=>$asistencias,'asistencia1'=>$asistencias1, 'works'=>$works];
        //$data = ['asistencia'=>$asistencias];
        
       
        return view('senaempresa::Asistencia.fecha', $data);
    
        
        
    }

    public function listaTurnos(){

        $works = Work::get();
        $fechaActual = date('Y-m-d H:i');
        $courses = Course::orderBy('code','desc')->get();
        $asistencias = Asistencia::orderBy('id','asc')->get();
        return view('senaempresa::Asistencia.listaTurnos', compact('asistencias','courses','works'))->with('fechaActual',$fechaActual);
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
        $fechaActual = date('Y-m-d H:i');


        //$aprendices = Apprentice::where('course_id',$id)->orderBy('id','asc')->pluck('id');
        $aprendices = Apprentice::where('course_id',$id)->get();
        
        $size = sizeof($aprendices);
        //$asistencias = Asistencia::where('$this->Apprentice->course_id',$id)->get();
        
        //return $asistencias;

        //$data = ['aprendices'=>$aprendices,'asistencias'=>$asistencias];
        $data = ['aprendices'=>$aprendices, 'size'=>$size, 'fechaActual'=>$fechaActual];
       /*  
        if($size == 0){
            return view('senaempresa::Asistencia.asignar',$data)->with('message_result','Error al asignar, No hay aprendices en el programa')->with('icon','error');
        }else{
        //return $asistencias;
        return view('senaempresa::Asistencia.asignar', $data);
    } */

    return view('senaempresa::Asistencia.asignar', $data)->with(['message_result'=>'No hay aprendices en este programa','icon'=>'error']);    
       
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
    $request->validate(['start'=>'required',
                        'end'=>'required', 
                        'title'=>'required']
                    );

    $asistencia = $request->all();
    $apprenticePost = $request->input('aprendices',[]);

    //if($validator->fails()){
       // return $apprenticePost;

    //Sección para pasar fecha a string y tomar el día 
    $fechaStart = strtotime($asistencia['start']);
    $fechaEnd = strtotime($asistencia['end']); 

    $dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
    $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
    //return $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]." del ".date('Y');
    
    ////Segunda forma de extraer datos 
    $dia1 = date("d", $fechaStart);
    $numero_diaSemana = date("w", $fechaStart);
    //return $dias[date($numero_diaSemana)]." ".$numero_diaSemana;
    $dias[date($numero_diaSemana)]." ".$numero_diaSemana; // Imprime el día de la semana
    
    $hora1 = date('H', $fechaStart);


    $dia2 = date("d", $fechaEnd);
    $numero_diaSemana2 = date("w", $fechaEnd); //Numero segun el día el indice 0 es domingo y así
    // hasta llegar a sabado que es el valor 6 
    $dias[date($numero_diaSemana2)]." ".$numero_diaSemana2;

    $hora2= date('H', $fechaEnd);

    if($numero_diaSemana != 0 and $numero_diaSemana != 6 and $numero_diaSemana2 != 0 and $numero_diaSemana2 != 6 and ($hora1 >= 8 and $hora1 <=15) and ($hora2 >= 8 and $hora2 <=15)  ){
        

        if(!$apprenticePost){
            return redirect(route('listaTurnos'))->with('message_result','Error al asignar, No hay aprendices en el programa')->with('icon','error');
        }
        else{
        $asistencia = Asistencia::create($asistencia); 
    
        //$asistencia->apprentices()->sync($request->input('aprendices',[]));
      
           /*  $asistencia->apprentices()->syncWithoutDetaching($request->input('aprendices',[])); */
            $asistencia->apprentices()->syncWithoutDetaching($request->input('aprendices'), $request->input('activity') );
            return redirect(route('listaTurnos'))->with('message_result','Asignado con exito')->with('icon','success');
        }
    
    }
    else{
        return redirect(route('listaTurnos'))->with('message_result','Los turnos no se pueden programar para fines de semana u horarios antes de las 8 a.m o después de las 3 p.m')->with('icon','error');
    }

    
    ////

    
    
}

    

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

   
    public function updateTurno(Request $request)
    {

      
        //return $asistencia;
        $request->validate(['start'=>'required', 'end'=>'required', 'id'=>'required']);
        $asistencia = $request->all();
        $resultado = Asistencia::findOrFail($request->input('id'));
        $resultado->start = ($request->input('start'));
        $resultado->end = ($request->input('end'));
        $resultado->save();
        
        //return $resultado;
        return redirect(route('listaTurnos'))->with('success', 'Fecha actualizada.');
        
    }

    public function updateAttendance(Request $request)
    {
        $id = $request->id;
        $asistencia = $request->asistencia;
        $apprentices = ApprenticeAsistencia::findOrFail($request->id);
        //$apprentices = ApprenticeAttendance::where('id',$id)->get();
        $apprentices->asistencia = $request->asistencia;
        
        if($apprentices->save()){
            return response()->json(['message' => 'User status updated successfully.'.$id."-".$asistencia.'','icon'=>'success']); //Sirve para enviar mensaje en consola del navegador con javascript de la vista
            //return back()->with(['icon'=>'success', 'message'=>'Asistencia Actualizada']);
        }else{
            return response()->json(['message' => 'User status Error.'.$id."-".$asistencia.'','icon'=>'error']);
            //return back()->with(['icon'=>'success', 'message'=>'Error al actualizar']);
        }  
    }

    public function workAsign(Request $request)
    {
         /* ---------------Variables main--------------- */
        /*  Variables enviadas por ajax  */
        $id = $request->id;
        $work = $request->work;
       /*  ---------------- */

       /* Definir resto de variables */
        $works = Work::findOrFail($work);
        $apprenticesSend = ApprenticeAsistencia::findOrFail($id);
        $aprendiz_id = $apprenticesSend->apprentice_id;
        $productive_unit = $works->productive_unit_id;
        $apprentices_with_id = ApprenticeAsistencia::where('apprentice_id', $aprendiz_id)->get();
        
        /* return response()->json(['message'=>'La unidad es'.$works->productive_unit_id.'']); */  /* dato que viene */
        /* return response()->json(['message'=>'La unidad es'.$apprenticesSend->Work->id.'']); */ /* dato que esta */
        
        $productive_suma_id = []; /* Inicializa un arreglo vacio */
        foreach($apprentices_with_id as $apprentices){

            $apprentice_work_id_isset = $apprentices->work_id; 

            /* codigo nuevo */ 
            if($apprentice_work_id_isset !== null){
                $apprentice_productive_unit_id_isset_search = Work::findOrFail($apprentice_work_id_isset);
                
                $apprentice_productive_unit_id_isset_find = $apprentice_productive_unit_id_isset_search->productive_unit_id;
                $productive_suma_id[] = $apprentice_productive_unit_id_isset_find; /* Agrega los valores de los id al arreglo vacio */      
            }
            /* fin codigo nuevo */       
        }

        if(in_array($productive_unit, $productive_suma_id)){   /* Condicional para recorrer el arreglo y buscar si existe el valor, primero el valor segundo el arreglo de busqueda */
            return response()->json(['message' => 'Aprendiz ya se asignó en esta unidad','icon'=>'info']);
        }else{
            $apprenticesSend->work_id = $work;

                    if($apprenticesSend->save()){
                        return response()->json(['message' => 'Aprendiz asignado con exito.'/* .$id."-".$work.'-'.$aprendiz_id.'-' *//* .$apprentices_with_id.'' */,
                                                'icon'=>'success']);      
                    }else{
                        return response()->json(['message' => 'User status Error.'.$id."-".$work.'','icon'=>'error']);
                    }  
        }
        

        

        

            
        
    }

    public function deleteTurn(Request $request)
    {
        $id = $request->input('id');
        $turns = Asistencia::findOrFail($id);
        //return $turns;
         if($turns->delete()){
            $icon = 'success';
            $message_result = 'Turno eliminado exitosamente.';
        }else{
            $icon = 'error';
            $message_result = 'No se pudo eliminar el turno.';
        }
        return back()->with(['icon'=>$icon, 'message_result'=>$message_result]); 
        //return redirect()->route('listaTurnos');


    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
    }

    
}
