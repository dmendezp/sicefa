<?php

namespace App\Http\Controllers\DpfpApi;

set_time_limit(0);
date_default_timezone_set("America/Bogota");

// Aumentar el límite de memoria a 1024 MB (1 GB)
/* ini_set('memory_limit', '1024M'); */

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DpfpModels\TempFingerprint;
use App\Models\DpfpModels\Fingerprint;
use App\Models\User;
use Modules\SICA\Entities\Person;
use Modules\SENAEMPRESA\Entities\FingerAsistencia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Storage;
use DateTime;
use Validator;


class UserRestApiController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $key = str_replace("Basic ", "", $request->header("Authorization"));
        $api = config("services.mhdpfp.key");
        if ($api == $key) {
            $from = $request->from;
            $query = "SELECT count(*) total FROM people u INNER JOIN fingerprints f on u.id = f.person_id";
            $rs = DB::select($query);
            $count = $rs[0]->total;
            $query2 = "SELECT u.id, f.fingerprint, u.name "
                    . " FROM people u INNER JOIN fingerprints f on u.id = f.person_id ";
            $usuarios = DB::select($query2);
            $array = array("usuarios" => $usuarios, "total" => $count);
            return $array;
        } else {
            return response(array("status" => "No tienes permisos para acceder a este recurso"), 401)
                            ->header("HTTP/1.1 401", "Unauthorized");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $key = str_replace("Basic ", "", $request->header("Authorization"));
        $api = config("services.mhdpfp.key");
        if ($api == $key) {
            $temp = TempFingerprint::where("token_pc", $request->token_pc)->first();
            $dedo = explode("_", $temp->finger_name);
            $fingerprint = new Fingerprint();
            $fingerprint->person_id = $temp->person_id;
            $fingerprint->finger_name = $dedo[0] . " " . $dedo[1];
            $fingerprint->image = $this->saveImage($request->image, $temp->finger_name.$temp->person_id);
            $fingerprint->fingerprint = $request->fingerprint;
            $fingerprint->notified = 0;
            $response = $fingerprint->save();
            TempFingerprint::destroy($temp->id);
            $arrayResponse = array("response" => $response);
            return $arrayResponse;
//            return $temp;
        } else {
            return response(array("status" => "No tienes permisos para acceder a este recurso"), 401)
                            ->header("HTTP/1.1 401", "Unauthorized");
        }
    }

    function saveImage($image, $image_name) {
        $rutaDirectorio = public_path('/storage/image_user');
        if (!File::isDirectory($rutaDirectorio)) {
            File::makeDirectory($rutaDirectorio, 0755, true);
        }
        $image = str_replace("data:image/png;base64,", "", $image);
        $image = str_replace(" ", "+", $image);
        $imageName = $image_name . ".png"; //
//        $url = Storage::put('public/image_user', base64_decode($image));
        \File::put(public_path('/storage/image_user/' . $imageName), base64_decode($image));
        return "storage/image_user/" . $imageName;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $response = 0;
        $key = str_replace("Basic ", "", $request->header("Authorization"));
        $api = config("services.mhdpfp.key");
        if ($api == $key) {
            $text = $request->text;
            //Ver comentario de la linea 119
            if ($request->user_id > 0) {
                $text = self::saveRecord($request->user_id);  
            }

            /* Este response es en el que estan las variables de conexión con el controlador del fingerprint local, hay que tener en cuenta esto */
            $response = TempFingerprint::where("token_pc", $request->token_pc)
                    ->update([
                "fingerprint" => $request->fingerprint,
                "image" => $request->image,
                "person_id" => ($request->user_id > 0) ? $request->user_id : null,
//                "user_id_number" => $request->user_id_number,
                "name" => $request->name, "text" => $text
            ]);
            return array("response" => $response);
        } else {
            return response(array("status" => "No tienes permisos para acceder a este recurso"), 401)
                            ->header("HTTP/1.1 401", "Unauthorized");
        }
    }

    //Esta funcion se comenta debido a que no se implementa en este paquete 
    //el registro de entradas y salidas, pero puedes adaptarlo a tu gusto
//    public static function saveRecord($userId) {
//        $typeRecord = "";
//        $text = "";
//        $hoy = date("Y-m-d");
//        $query = "SELECT type_record FROM records_users WHERE user_id = " . $userId . " "
//                . "and date_record like '%" . $hoy . "%' order by date_record desc limit 1";
//        $rs = DB::select($query);
//        if (count($rs) > 0 && $rs[0]->type_record == "chek out") {
//            $text = "Ya registraste salida..!";
//        }
//        if (count($rs) == 0) {
//            $text = "Ingreso Regitrado..!";
//            $typeRecord = "chek in";
//        }
//        if (count($rs) == 1 && $text == "") {
//            $text = "Salida Registrada..!";
//            $typeRecord = "chek out";
//        }
//        if ($text != "Ya registraste salida..!") {
//            $record = new RecordUser();
//            $record->user_id = $userId;
//            $record->date_record = date("Y-m-d H:i:s");
//            $record->type_record = $typeRecord;
//            $record->save();
//        }
//        return $text;
//    }

    public function saveRecord($personId){
        $text = 'Correcto';
        $today = now()->toDateString(); //Obtiene la fecha en YY-MM-DD
        $time = now()->toTimeString();

        $asistencia_person = FingerAsistencia::where('person_id', $personId)->where('date_turn', $today)->count();

        $person = FingerAsistencia::where('person_id', $personId)->where('date_turn', $today)->first();
        
        if(!$person){
            $text='No hay entrada';
            $asistencia = new FingerAsistencia();
            $asistencia->date_turn = $today;
            $asistencia->time_in = $time;
            $asistencia->person_id = $personId;
            $asistencia->save();
            $text = 'Registro de ingreso exitoso!';
        }
        elseif(!$person->time_exit){
            
            $datetime1 = new DateTime($person->time_in);
            $datetime2 = new DateTime($time);
            $horas = $datetime1->diff($datetime2);
            
            $registro_salida = FingerAsistencia::where('id', $person->id)->update([
                'time_exit'=>$time,
                'hours_work'=>$horas->format('%H'),
            ]);
            if($registro_salida){
                $text='Registró salida con éxito';
            }else{
                $text='Problemas al registrar salida.. Repita por favor!';
            }
            
        }else{
            $text = 'Usted registró salida a las: '.$person->time_exit;
        }

        return $text;
    }


    public function document_search(Request $request){
        $rules = ['document' => 'required'];
        $messages = ['document.required' => 'El documento es requerido'];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->route('index');
        }else{
            $doc = $request->input('document');
            $person = Person::where('document_number', $doc)->with('users')->first();

            return redirect('users/'.$person->id.'/finger-list');
        }
    }

    ///////////

    public function sincronizar(Request $request) {
        $key = str_replace("Basic ", "", $request->header("Authorization"));
        $api = config("services.mhdpfp.key");
        if ($api == $key) {
            $query = "SELECT u.id, f.person_id, f.fingerprint, f.id, finger_id,"
                    . " u.name"
                    . "FROM people u INNER JOIN fingerprints f on u.id = f.person_id "
                    . "WHERE f.id > " . $request->finger_id;
            $usuarios = DB::select($query);
            return $usuarios;
        } else {
            return response(array("status" => "No tienes permisos para acceder a este recurso"), 401)
                            ->header("HTTP/1.1 401", "Unauthorized");
        }
    }

    public function verify_users() {
        return view("dpfp_views.verify-users");
    }

    public function users_list() {
        $people = Person::paginate(30);
        return view("dpfp_views.index", compact('people'));
    }

    public function fingerList(Person $person) {
        $finger_list = $person->fingerprints;
        return view("dpfp_views.finger-list", compact("person", "finger_list"));
    }

    public function get_finger(Person $person) {
        $response = Fingerprint::where("notified", 0)->where("person_id", $person->id)->get();
        if (count($response) > 0) {
            Fingerprint::where("id", $response[0]->id)->update(["notified" => 1]);
        }
        return $response;
    }



}
