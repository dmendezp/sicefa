<?php

namespace Modules\PQRS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Person;
use Modules\PQRS\Entities\Pqrs;
use Modules\SICA\Entities\Holiday;

class TrackingController extends Controller
{
    public function index(){
        $titlePage = 'Seguimiento PQRS';
        $titleView = 'Seguimiento PQRS';

        $pqrs = Pqrs::with('people')->get();

        $data  = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
            'pqrs' => $pqrs
        ];

        return view('pqrs::tracking.index', $data);
    }

    public function searchOfficial(Request $request){
        $term = $request->input('name');

        $people = Person::whereRaw("CONCAT(first_name, ' ', first_last_name, ' ', second_last_name) LIKE ?", ['%' . $term . '%'])->get();
        $results = [];
        foreach ($people as $person) {
            $results[] = [
                'id' => $person->id,
                'name' => $person->first_name . ' ' . $person->first_last_name . ' ' . $person->second_last_name,
            ];
        }

        return response()->json($results);
    }

    public function create(){
        $titlePage = 'Registrar PQRS';
        $titleView = 'Registrar PQRS';

        $data  = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
        ];

        return view('pqrs::tracking.create', $data);
    }

    public function store(Request $request){
        
        $rules = [
            'filing_number' => 'required',
            'nis' => 'required',
            'filing_date' => 'required',
            'type_pqrs' => 'required',
            'end_date' => 'required',
            'issue' => 'required',
            'responsible' => 'required'
        ];

        $messages =[
            'filing_number.required' => 'Debe registrar el numero de radicación.',
            'nis.required' => 'Debe registrar el NIS.',
            'filing_date.required' => 'Debe registrar la fecha de radicación.',
            'type_pqrs.required' => 'Debe seleccionar un asunto.',
            'end_date.required' => 'Debe registrar la fecha limite de respuesta.',
            'issue.required' => 'Debe registrar una descripción de la PQRS.',
            'responsible.required' => 'Debe asignar un funcionario'
        ];

        $validatedData = $request->validate($rules, $messages);
        try {
            DB::beginTransaction();

            $pqrs = new Pqrs;
            $pqrs->type_pqrs_id = $validatedData['type_pqrs'];
            $pqrs->filing_number = $validatedData['filing_number'];
            $pqrs->filing_date = $validatedData['filing_date'];
            $pqrs->nis = $validatedData['nis'];
            $pqrs->start_date = '2024-05-23';
            $pqrs->end_date = $validatedData['end_date'];
            $pqrs->issue = $validatedData['issue'];
            $pqrs->save();

            $pqrs->people()->attach($validatedData['responsible'], [
                'consecutive' => 1,
                'date' => now()->format('Y-m-d')
            ]);


            DB::commit();

            return redirect()->route('pqrs.tracking.index')->with(['success' => 'Se registro la PQRS exitosamente']); 

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($validatedData)->withInput()->with(['error' => 'Error al registrar la PQRS']);;
        }
    }

    public function store_excel(Request $request){
        ini_set('max_execution_time', 3000); // Ampliar el tiempo máximo de la ejecución del proceso en el servidor
        $validator = Validator::make($request->all(),
            ['excel'  => 'required'],
            ['excel.required'  => 'Debes cargar un archivo Excel.']
        );
        if($validator->fails()){
            return back()->withErrors($validator)->withInput()->with(['message'=>'Ocurrió un error con el formulario.', 'typealert'=>'danger']);
        }else{
            $path = $request->file('excel'); // Obtener ubicación temporal del archivo en el servidor
            $array = Excel::toArray(new ApprenticeLearningOutcomeImport, $path); // Convertir el contenido del archivo excel en una arreglo de arreglos
            $program_name = $array[0][4][2]; // Obtener la ficha del curso y el nombre del programa en un arreglo
            $course_code = $array[0][1][2];
            $apprentices_data = array_splice($array[0], 12, count($array[0])); // Obtener solo los registros de los datos de los aprendices
            try {
                $countstate = 0;
                // Recorrer datos y relizar registros
               
                foreach($apprentices_data as $data){
                    $document_number = $data[1];
                    $learning_outcome = explode(" - ", $data[6]); // Dividir la cadena por el guión ('-')
                    if ($learning_outcome) {
                        if (count($learning_outcome) > 1) {
                            // Si hay más de una parte después de dividir por el guión
                            $name_learning = trim(preg_replace('/^[0-9]+\s*/', '', $learning_outcome[1])); // Eliminar números y espacios al principio de la cadena
                        } else {
                            // Si no hay un guión, entonces tomar el nombre completo sin modificar
                            $name_learning = trim($learning_outcome[0]);
                        }
                        $state = $data[7];
                        $learning_outcome = LearningOutcome::where('name', '=', $name_learning)->first();
                        
                        if ($learning_outcome) {
                            $learning_outcome_id = $learning_outcome->id;

                            $course = Course::where('code',$course_code)->first();
                            if ($course) {
                                $course_id = $course->id;
                                $person = Person::where('document_number',$document_number)->first();
                                $person_id = $person->id;
                                $evaluative_judgments = EvaluativeJudgment::where('person_id',$person_id)->where('learning_outcome_id',$learning_outcome_id)->where('course_id',$course_id)->first();
                                switch ($state) {
                                    case 'APROBADO':
                                        $status = 'Aprobado';
                                        break;
                                    case 'POR EVALUAR':
                                        $status = 'Pendiente';
                                        break;
                                    case 'NO APROBADO':
                                        $status = 'No Aprobado';
                                        break;
                                    
                                    default:
                                        $status = 'Pendiente';
                                        break;
                                }
                                if ($evaluative_judgments) {
                                    
                                    $evaluative_judgments->state = $status;
                                    $evaluative_judgments->save();
                                } else {
                                    $evaluative_judgments = new EvaluativeJudgment;
                                    $evaluative_judgments->person_id = $person_id;
                                    $evaluative_judgments->course_id = $course_id;
                                    $evaluative_judgments->learning_outcome_id = $learning_outcome_id;
                                    $evaluative_judgments->state = $status;
                                    $evaluative_judgments->save();
                                }
                            }
                            
                            if ($state = "APROBADO") {
                                $instructor_programs = InstructorProgram::where('learning_outcome_id',$learning_outcome_id)->get();
                                
                                foreach ($instructor_programs as $instructor_program) {
                                    $instructor_program->state = 2;
                                    $instructor_program->save();
                                    $countstate++;
                                }


                            }
                        }
                    }
                }
                
                return back()->with('success', 'Archivo excel escaneado coerrectamente. '.$countstate.' Programaciones Actualizados exitosamente.')->with('typealert', 'success');
            } catch (Exception $e) {
                DB::rollBack(); // Devolver cambios realizados durante la transacción
                return back()->with('error', 'Ocurrio un error en la importación y/o registro de datos del archivo excel cargado. <hr> <strong>Error: </strong> ('.$e->getMessage().').')->with('typealert', 'danger');
             }

        }
    }
}
