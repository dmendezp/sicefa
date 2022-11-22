<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Imports\ApprenticeImport;

use Validator, Str, DB, Excel;

class TempTablesController extends Controller
{

    public function getLoadApprentices(){
        $courses = Program::orderBy('name','Asc')->get()->pluck('name','id');
        $data = ['title'=>trans('sica::menu.Load apprentice'),'courses'=>$courses];
        return view('sica::admin.people.apprentices.load',$data);
    }

    public function postLoadApprentices(Request $request){
        ini_set('max_execution_time', 3000);
        $validator = Validator::make($request->all(), 
            ['archivo'  => 'required'],
            [
                'archivo.required'  => 'El archivo es requerido.'
            ]
        );
        if($validator->fails()){
            return back()->withErrors($validator)->with('danger', 'Se ha producido un error.')
            ->withInput();
        }else{

            $path = $request->file('archivo')->getRealPath();
            //print_r($path);           
            //$data = Excel::import(new ApprenticeImport, $path);
            $array = Excel::toArray(new ApprenticeImport, $path);
            $pro = explode(" - ",$array[0][0][2]);
            $f = $pro[0];
            $p = $pro[1];
            $datos=array_splice($array[0], 4, count($array[0]));
            $num=count($datos);
            foreach($datos as $d){
                switch ($d[0]) {
                    case 'CC':
                        $tipo="Cedula de ciudadania";
                        break;
                    case 'TI':
                        $tipo="Tarjeta de identidad";
                        break;                    
                    case 'CE':
                        $tipo="Cedula de extrangeria";
                        break;
                    default:
                        $tipo="Cedula de ciudadania";
                        break;
                }
                $a=explode(" ",$d[3]);

                $person = Person::firstOrNew(['document_number' => $d[1]]);
                    $person->document_type = $tipo;
                    $person->first_name = strtoupper($d[2]);
                    $person->first_last_name = strtoupper($a[0]);
                    $person->second_last_name = strtoupper(substr($d[3], strlen($a[0])+1));
                    $person->telephone1 = ($d[4] == null)? 0:$d[4];
                    if(explode("@misena",$d[5]) == false){
                        $person->misena_email = strtolower($d[5]);
                    }elseif(explode("@sena",$d[5]) == false){
                        $person->sena_email = strtolower($d[5]);
                    }else{
                        $person->personal_email = strtolower($d[5]);
                    }                    
                    $person->eps_id = 0;
                    $person->population_group_id = 22;
                $person->save();
                //echo "<br>".$person->id;
                //echo "<br>".$p;
                $program = Program::where(['name' => $p])->get();
                $pid = $program[0]['id'];
                $course = Course::firstOrNew(['code' => $f]);
                    $course->star_date=now();
                    $course->end_date=now();
                    $course->program_id=$pid;
                    $course->deschooling="Lunes";
                $course->save();
                //echo "<br>".$course->id;
                $apprentice = Apprentice::firstOrNew(['person_id' => $person->id, 'course_id' => $course->id]);
                    $apprentice->apprentice_status=strtolower($d[6]);
                $apprentice->save();
                //echo "<br>".$apprentice->id;

            }
            //return "Hola";
            return back()->with('message', 'Excel importado correctamente. '.$num.' Aprendices Agregados/Actualizados')->with('typealert', 'success');
        }
    }

}
