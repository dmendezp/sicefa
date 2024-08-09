<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\PopulationGroup;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\Line;
use Modules\SICA\Entities\Network;
use Modules\SICA\Entities\KnowledgeNetwork;
use Modules\SICA\Entities\Municipality;
use Modules\SICA\Entities\PensionEntity;
use Modules\SICA\Imports\PeopleImport;
use Modules\SICA\Imports\ApprenticeImport;


use Validator, Excel, Exception;

class TempTablesController extends Controller
{

    /* Formulario para carga de archivo con datos personales de personas */
    public function personal_data_load_create(){
        $data = ['title'=>'Cargar personas'];
        return view('sica::admin.people.personal_data.load',$data);
    }

    /* Registro de datos personales a partir de un archivo */
    public function personal_data_load_store(Request $request){
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
            //$path = $request->file('archivo')->getRealPath();
            $path = $request->file('file')[0];
            $array = Excel::toArray(new PeopleImport, $path);
            //$datos=array_splice($array[0], 1, count($array[0]));
            $datos = $array[0];
            $num=count($datos);
            //return $datos;
            foreach($datos as $d){
                $a=explode(" ",$d[4]);
                //return print_r($d[7]);
                $pg = PopulationGroup::where(['name' => strtoupper($d[7])])->first();
                $pgid = $pg['id'];
                //echo strtoupper($d[7]);
                $person = Person::firstOrNew(['document_number' => $d[2]]);
                    $person->document_type = strtoupper($d[1]);
                    $person->first_name = strtoupper($d[3]);
                    $person->first_last_name = strtoupper($a[0]);
                    $person->second_last_name = strtoupper(substr($d[4], strlen($a[0])+1));
                    $person->telephone1 = ($d[5] == null)? 0:$d[5];
                    if(explode("@misena",$d[6]) == false){
                        $person->misena_email = strtolower($d[6]);
                    }elseif(explode("@sena",$d[6]) == false){
                        $person->sena_email = strtolower($d[6]);
                    }else{
                        $person->personal_email = strtolower($d[6]);
                    }
                    $person->eps_id = 0;
                    $person->population_group_id = $pgid;
                $person->save();
            }
            //return "Hola";
            return back()->with('message', 'Excel importado correctamente. '.$num.' Personas Agregados/Actualizados')->with('typealert', 'success');
        }
    }

    /* Formulario para carga de archivo con datos de aprendices */
    public function apprentices_load_create(){
        $courses = Program::orderBy('name','Asc')->get()->pluck('name','id');
        $data = ['title'=>'Cargar aprendices','courses'=>$courses];
        return view('sica::admin.people.apprentices.load',$data);
    }

    /* Registrar aprendices a partir de un archivo */
    public function apprentices_load_store(Request $request){
        ini_set('max_execution_time', 3000); // Ampliar el tiempo máximo de la ejecución del proceso en el servidor
        $validator = Validator::make($request->all(),
            ['archivo'  => 'required'],
            ['archivo.required'  => 'El archivo es requerido.']
        );
        if($validator->fails()){
            return back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }else{
            $path = $request->file('archivo'); // Obtener ubicación temporal del archivo en el servidor
            $array = Excel::toArray(new ApprenticeImport, $path); // Convertir el contenido del archivo excel en una arreglo de arreglos
            $course_code_program_name = explode(" - ", $array[0][0][2]); // Obtener la ficha del curso y el nombre del programa en un arreglo
            $course_code = $course_code_program_name[0];
            $program_name = $course_code_program_name[1];
            $program_name = str_replace('.', '', $program_name);

            $apprentices_data = array_splice($array[0], 4, count($array[0])); // Obtener solo los registros de los datos de los aprendices

            $municipality = Municipality::where('name','=','Campoalegre')->first(); // Obtener municipio

            try {
                DB::beginTransaction(); // Iniciar transacción

                $line = Line::firstOrCreate(['name' => '---------- (SELECCIONE OTRA LÍNEA) ----------']); // Consultar o registrar línea tecnológica temporal
                $network = KnowledgeNetwork::firstOrCreate(['name' => 'No Registra'],[ // Consultar o registrar red de conocimiento temporal
                    'line_id' => $line->id
                ]);
                $program = Program::where('name', $program_name)->first();
                if (!$program) {
                    DB::rollBack(); // Devolver cambios realizados durante la transacción
                    return back()->with('message', 'El programa no existe.')->with('typealert', 'danger');
                }
                $course = Course::firstOrCreate(['code' => $course_code],[ // Consultar o registrar curso
                    'star_date' => now()->format('Y-m-d'),
                    'end_date' => now()->format('Y-m-d'),
                    'status' => 'Activo',
                    'program_id' => $program->id,
                    'municipality_id' => $municipality->id
                ]);
                $eps = EPS::firstOrCreate(['name' => 'NO REGISTRA']); // Consultar o registrar EPS
                $population_group = PopulationGroup::firstOrCreate(['name' => 'NINGUNA']); // Consultar o registrar Grupo Poblacional
                $pension_entity = PensionEntity::firstOrCreate(['name' => 'NO REGISTRA']); // Consultar o registrar Entidad de pensiones

                // Recorrer datos y relizar registros
                foreach($apprentices_data as $data){
                    switch ($data[0]) { // Definir tipo de documento
                        case 'CC':
                            $document_type = "Cédula de ciudadanía";
                            break;
                        case 'TI':
                            $document_type = "Tarjeta de identidad";
                            break;
                        case 'CE':
                            $document_type = "Cédula de extranjería";
                            break;
                        default:
                            $document_type = "Cédula de ciudadanía";
                        break;
                    }
                    $surnames = explode(" ",$data[3]); // Obtiene los apellidos en un arreglo

                    // Registra o actualizar persona
                    if(strpos($data[5], "@misena")){ // Identificar atributo para la asignación de correo electrónico
                        $attribute = 'misena_email';
                    }elseif(strpos($data[5], "@sena")){
                        $attribute = 'sena_email';
                    }else{
                        $attribute = 'personal_email';
                    }
                    $person = Person::firstOrCreate(['document_number' => intval($data[1])],[ // Consultar o preparar registro de persona
                        'document_type' => $document_type,
                        'first_name' => strtoupper($data[2]),
                        'first_last_name' => strtoupper($surnames[0]),
                        'second_last_name' => strtoupper(substr($data[3], strlen($surnames[0])+1)), // Obtener el segundo apellido
                        'telephone1' => intval($data[4]),
                        $attribute => strtolower($data[5]),
                        'eps_id' => $eps->id,
                        'population_group_id' => $population_group->id,
                        'pension_entity_id' => $pension_entity->id
                    ]);

                    // Consultar o registrar aprendiz
                    Apprentice::firstOrCreate(['person_id' => $person->id, 'course_id' => $course->id],[
                        'apprentice_status' => strtolower($data[6])
                    ]);
                }

                DB::commit(); // Confirmar cambios realizados durante la transacción
                return back()->with('message', 'Archivo excel importado correctamente. '.count($apprentices_data).' Aprendices Registrados/Actualizados exitosamente.')->with('typealert', 'success');

            } catch (Exception $e) {
                DB::rollBack(); // Devolver cambios realizados durante la transacción
                return back()->with('message', 'Ocurrió un error en la importación y/o registro de datos del archivo Excel cargado. <hr> <strong>Error: </strong> ('.$e->getMessage().').')->with('typealert', 'danger');
            }
        }
    }

}
