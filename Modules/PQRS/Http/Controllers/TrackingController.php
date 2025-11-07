<?php

namespace Modules\PQRS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Person;
use Modules\PQRS\Entities\Pqrs;
use Modules\PQRS\Entities\TypePqrs;
use Modules\SICA\Entities\Holiday;
use Illuminate\Support\Facades\Mail;
use Modules\PQRS\Imports\PqrsImport;
use Illuminate\Support\Facades\Validator;
use Excel, Exception;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class TrackingController extends Controller
{
    public function type_pqrs_index(){
        $type_pqrs = TypePqrs::all();

        $data = [
            'titlePage' => trans('pqrs::tracking.type_of_pqrs'),
            'titleView' => trans('pqrs::tracking.type_of_pqrs'),
            'type_pqrs' => $type_pqrs
        ];

        return view('pqrs::tracking.type_pqrs.index', $data);
    }

    public function type_pqrs_store(Request $request){
        $type_pqrs = new TypePqrs;
        $type_pqrs->name = strtoupper($request->name);
        $type_pqrs->save();

        return redirect()->route('pqrs.tracking.type_pqrs_index')->with(['success' => trans('pqrs::tracking.the_type_of_pqrs_was_successfully_registered')]); 
    }

    public function type_pqrs_delete($id){
        $type_pqrs = TypePqrs::findOrFail($id);
        $type_pqrs->delete();

        if($type_pqrs->delete()){
                return redirect()->route('pqrs.tracking.type_pqrs_index')->with(['success' => trans('pqrs::tracking.pqrs_type_deleted_successfully')]); 
        }else{
            return redirect()->route('pqrs.tracking.type_pqrs_index')->with(['error' => trans('pqrs::tracking.an_error_occurred')]); 
        }
    }

    public function index(){
        $titlePage = trans('pqrs::tracking.pqrs_monitoring');
        $titleView = trans('pqrs::tracking.pqrs_monitoring');        

        $options = [
            '' => 'Seleccione una opción',
            'EN PROCESO' => 'En proceso',
            'PROXIMA A VENCER' => 'Proxima a vencer',
            'RESPUESTA GENERADA' => 'Respuesta generada',
            'RESPUESTA PARCIAL' => 'Respuesta parcial',
        ];

        $data  = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
            'options' => $options
        ];

        return view('pqrs::tracking.index', $data);
    }

    public function search(Request $request){
        $option = $request->input('option');

        $pqrs = Pqrs::with('people')->where('state', $option)->orderBy('end_date', 'asc')->get();

        $holidays = Holiday::pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('Y-m-d');
        })->toArray();
        
        foreach ($pqrs as $p) {
            $end_date = Carbon::parse($p->end_date);
            $diff = Carbon::now()->diffInDays($end_date, false);
            
            $current_date = Carbon::now();
            $days_remaining = 0;
            $weekend_days = 0;
            $holiday_days = 0;
    
            // Contar los días excluyendo los días feriados
            while ($current_date->lessThanOrEqualTo($end_date)) {
                if ($current_date->isWeekend() || in_array($current_date->format('Y-m-d'), $holidays)) {
                    if ($current_date->isWeekend()) {
                        $weekend_days++;
                    }
                    if (in_array($current_date->format('Y-m-d'), $holidays)) {
                        $holiday_days++;
                    }
                } else {
                    $days_remaining++;
                }
                $current_date->addDay();
            }
            
            // Verificar si el estado debe ser actualizado
            if ($days_remaining <= 5 && $p->state == 'EN PROCESO') {
                $p->state = 'PROXIMA A VENCER';
                $p->save();
            }                 
        }
        $data = [
            'pqrs' => $pqrs
        ];

        return view('pqrs::tracking.table', $data);
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
        $titlePage = trans('pqrs::tracking.register_pqrs');
        $titleView = trans('pqrs::tracking.register_pqrs');
        $type_pqrs = TypePqrs::pluck('name', 'id');

        $data  = [
            'titlePage' => $titlePage,
            'titleView' => $titleView,
            'type_pqrs' => $type_pqrs
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
            'filing_number.required' => trans('pqrs::tracking.you_must_register_the_filing_number'),
            'nis.required' => trans('pqrs::tracking.you_must_register_the_nis'),
            'filing_date.required' => trans('pqrs::tracking.you_must_record_the_date_of_filing'),
            'type_pqrs.required' => trans('pqrs::tracking.you_must_select_a_subject'),
            'end_date.required' => trans('pqrs::tracking.you_must_record_the_response_deadline'),
            'issue.required' => trans('pqrs::tracking.you_must_record_a_description_of_the_pqrs'),
            'responsible.required' => trans('pqrs::tracking.you_must_assign_an_official')
        ];

        $validatedData = $request->validate($rules, $messages);
        try {
            DB::beginTransaction();

            $pqrs_existing = Pqrs::where('filing_number', $validatedData['filing_number'])->exists();

            if($pqrs_existing){
                return redirect()->route('pqrs.tracking.index')->with(['error' => trans('pqrs::tracking.there_is_already_a_pqrs_with_that_filing_number')]); 
            }else{
                $pqrs = new Pqrs;
                $pqrs->type_pqrs_id = $validatedData['type_pqrs'];
                $pqrs->filing_number = $validatedData['filing_number'];
                $pqrs->filing_date = $validatedData['filing_date'];
                $pqrs->nis = $validatedData['nis'];
                $pqrs->end_date = $validatedData['end_date'];
                $pqrs->issue = $validatedData['issue'];
                $pqrs->save();

                $pqrs->people()->attach($validatedData['responsible'], [
                    'date_time' => now()->format('Y-m-d H:i:s'),
                    'type' => 'Funcionario'
                ]);

                $pqrs->people()->attach($request->assistant_one, [
                    'date_time' => now()->format('Y-m-d H:i:s'),
                    'type' => 'Apoyo'
                ]);

                $pqrs->people()->attach($request->assistant_two, [
                    'date_time' => now()->format('Y-m-d H:i:s'),
                    'type' => 'Apoyo'
                ]);
            }

            DB::commit();

            return redirect()->route('pqrs.tracking.index')->with(['success' => trans('pqrs::tracking.pqrs_was_successfully_registered')]); 

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($validatedData)->withInput()->with(['error' => trans('pqrs::tracking.error_registering_the_pqrs')]);;
        }
    }

    public function create_excel(){
        $titlePage = trans('pqrs::tracking.file_upload');
        $titleView = trans('pqrs::tracking.file_upload');

        $data = [
            'titlePage' => $titlePage,
            'titleView' => $titleView
        ];

        return view('pqrs::tracking.excel', $data);
    }

    public function store_excel_regional(Request $request){
        ini_set('max_execution_time', 3000); // Ampliar el tiempo máximo de la ejecución del proceso en el servidor
        $validator = Validator::make($request->all(),
            ['excel'  => 'required'],
            ['excel.required'  => trans('pqrs::tracking.you_must_upload_an_excel_file')]
        );
        if($validator->fails()){
            return back()->withErrors($validator)->withInput()->with(['message' => trans('pqrs::tracking.you_must_upload_an_excel_file'), 'typealert'=>'danger']);
        }else{
            $path = $request->file('excel'); // Obtener ubicación temporal del archivo en el servidor
            $array = Excel::toArray(new PqrsImport, $path); // Convertir el contenido del archivo excel en una arreglo de arreglos
            $regional = [];
            $proximo_vencer = [];
            
            //Accede a los codigos del responsable
            foreach($array[0] as $row){
                // Verificar si la fila tiene al menos 2 columnas y si el valor contiene '419116'
                if (isset($row[1]) && strpos($row[1], '419116' ) !== false && strpos($row[10], 'EN PROCESO')) {
                    // Agregar el valor de la columna 2 al arreglo si contiene '419116' y esta EN PROCESO
                    $regional[] = $row;
                }
            }
            
            if(isset($array[1])){
                foreach ($array[1] as $row) {
                    if (isset($row[1]) && strpos($row[1], '419116' ) !== false && strpos($row[10], 'PROXIMA A VENCER')) {
                        
                        // Agregar el valor de la columna 2 al arreglo si contiene '419116' y esta EN PROCESO
                        $proximo_vencer[] = $row;
                    }
                }
            }
            
            
            try {
                $countstate = 0;
                // Recorrer datos y relizar registros
               
                foreach($regional as $data){    
                    $type_pqrs_row = $data[9];
                    // Realizar la búsqueda y almacenar el resultado en $matches
                    preg_match('/"(.*?)"/', $type_pqrs_row, $matches);

                    // El texto entre comillas estará en $matches[1]
                    $type_pqrs_name = $matches[1];

                    $type_pqrs = TypePqrs::where('name', $type_pqrs_name)->pluck('id');
                    if ($type_pqrs->isNotEmpty()) {
                        $filing_number_row = $data[4];
                        preg_match('/"(.*?)"/', $filing_number_row, $matches);
                        $filing_number = $matches[1];

                        $filing_date_row = $data[6];
                        preg_match('/\d{4}\/\d{2}\/\d{2}/', $filing_date_row, $matches);
                        $filing_date = $matches[0];

                        $nis_row = $data[5];
                        preg_match('/"(.*?)"/', $nis_row, $matches);
                        $nis = $matches[1];

                        $end_date_row = $data[7];

                        // Extraer solo el número de días
                        $patron = '/\d+/'; // Expresión regular para encontrar números
                        preg_match($patron, $end_date_row, $matches);
                        if (isset($matches[0])) {
                            $days = $matches[0];
                            
                            try {
                                // Intentar convertir la fecha extraída en un objeto Carbon
                                $end_date_obj = Date::excelToDateTimeObject($days);

                                } catch (\Exception $e) {
                                // Si la conversión falla, manejar el error
                                $mensaje = 'Error al convertir la fecha.';
                                return redirect()->route('pqrs.tracking.index')->with(['error' => $mensaje]); 
    
                            }
                        } else {
                            $mensaje = 'Algunas fechas contienen texto o no estan en el formato correcto.';
                            return redirect()->route('pqrs.tracking.index')->with(['error' => $mensaje]); 
                        }

                        // Formatear la fecha como 'Y-m-d'
                        $end_date = $end_date_obj->format('Y-m-d');
                        
                        $state_row = $data[10];
                        preg_match('/"(.*?)"/', $state_row, $matches);
                        $state = $matches[1];

                        $official_row = $data[3];
                        // Usar expresión regular para extraer el nombre dentro de las comillas
                        preg_match('/"([^"]+)"/', $official_row, $matches);
                        if (isset($matches[1])) {
                            $official = $matches[1];
                        } else {
                            // Si no se encuentran comillas, extraer después de =T(
                            $official = preg_replace('/^=T\("([^"]*)"\)/', '$1', $official_row);
                        }

                        // Eliminar cualquier carácter no deseado (como "* (E) ")
                        $official = preg_replace('/^\*\s*/', '', $official);

                        // Eliminar "(E)" si está presente
                        $official = preg_replace('/\(E\)\s*/', '', $official);

                        // Dividir el nombre en partes
                        $official_explode = preg_split('/\s+/', trim($official));
                        
                        $first_name = $official_explode[0] . ' ' . $official_explode[1];
                        $first_last_name = $official_explode[2];
                        $second_last_name = isset($official_explode[3]) ? $official_explode[3] : '';

                        // Consultar la base de datos
                        $person = Person::where('first_name', $first_name)->where('first_last_name', $first_last_name)->where('second_last_name', $second_last_name)->pluck('id')->first();

                        $filing_number_int = intval($filing_number);

                        $pqrs_existing = Pqrs::where('filing_number', $filing_number_int)->exists();

                        if($pqrs_existing){
                            $filing_exists[] = $filing_number_int;      
                            continue;                                    
                        } 

                        $pqrs = new Pqrs;
                        $pqrs->type_pqrs_id = $type_pqrs[0];
                        $pqrs->filing_number = $filing_number;
                        $pqrs->filing_date = $filing_date;
                        $pqrs->nis = $nis;
                        $pqrs->end_date = $end_date;
                        $pqrs->issue = '...';
                        $pqrs->state = $state;
                        $pqrs->save();
        
                        $pqrs->people()->attach($person, [
                            'date_time' => now()->format('Y-m-d H:i:s'),
                            'type' => 'Funcionario'
                        ]);

                        $countstate++;  
                                                                          
                    }else{
                        $filing_number_row = $data[4];
                        preg_match('/"(.*?)"/', $filing_number_row, $matches);
                        $filing_number = $matches[1];

                        $filing_date_row = $data[6];
                        preg_match('/\d{4}\/\d{2}\/\d{2}/', $filing_date_row, $matches);
                        $filing_date = $matches[0];

                        $nis_row = $data[5];
                        preg_match('/"(.*?)"/', $nis_row, $matches);
                        $nis = $matches[1];

                        $end_date_row = $data[7];

                        // Extraer solo el número de días
                        $patron = '/\d+/'; // Expresión regular para encontrar números
                        preg_match($patron, $end_date_row, $matches);
                        $days = $matches[0];

                        // Convertir el número de días a fecha
                        $end_date_obj = Date::excelToDateTimeObject($days);

                        // Formatear la fecha como 'Y-m-d'
                        $end_date = $end_date_obj->format('Y-m-d');
                        
                        $state_row = $data[10];
                        preg_match('/"(.*?)"/', $state_row, $matches);
                        $state = $matches[1];

                        $official_row = $data[3];
                        // Usar expresión regular para extraer el nombre dentro de las comillas
                        preg_match('/"([^"]+)"/', $official_row, $matches);
                        if (isset($matches[1])) {
                            $official = $matches[1];
                        } else {
                            // Si no se encuentran comillas, extraer después de =T(
                            $official = preg_replace('/^=T\("([^"]*)"\)/', '$1', $official_row);
                        }

                        // Eliminar cualquier carácter no deseado (como "* (E) ")
                        $official = preg_replace('/^\*\s*/', '', $official);

                        // Eliminar "(E)" si está presente
                        $official = preg_replace('/\(E\)\s*/', '', $official);

                        // Dividir el nombre en partes
                        $official_explode = preg_split('/\s+/', trim($official));
                        
                        $first_name = $official_explode[0] . ' ' . $official_explode[1];
                        $first_last_name = $official_explode[2];
                        $second_last_name = isset($official_explode[3]) ? $official_explode[3] : '';

                        // Consultar la base de datos
                        $person = Person::where('first_name', $first_name)->where('first_last_name', $first_last_name)->where('second_last_name', $second_last_name)->pluck('id')->first();
                        $type_pqrs = new TypePqrs;
                        $type_pqrs->name = $type_pqrs_name;
                        $type_pqrs->save();

                        $filing_number_int = intval($filing_number);

                        $pqrs = new Pqrs;
                        $pqrs->type_pqrs_id = $type_pqrs->id;
                        $pqrs->filing_number = $filing_number;
                        $pqrs->filing_date = $filing_date;
                        $pqrs->nis = $nis;
                        $pqrs->end_date = $end_date;
                        $pqrs->issue = '...';
                        $pqrs->state = $state;
                        $pqrs->save();

                        $pqrs->people()->attach($person, [
                            'date_time' => now()->format('Y-m-d H:i:s'),
                            'type' => 'Funcionario'
                        ]);

                        $countstate++;
                    }
                }

                foreach ($proximo_vencer as $p) {
                    $type_pqrs_expirate_row = $p[9];
                    preg_match('/"(.*?)"/', $type_pqrs_expirate_row, $matches);
                    $type_pqrs_name_expire = $matches[1];
                    
                    $type_pqrs_expire = TypePqrs::where('name', $type_pqrs_name_expire)->pluck('id');

                    $filing_number_expirate_row = $p[4];
                    preg_match('/"(.*?)"/', $filing_number_expirate_row, $matches);
                    $filing_number_expire = $matches[1];

                    $filing_date_expirate_row = $p[6];
                    preg_match('/"(.*?)"/', $filing_date_expirate_row, $matches);
                    $filing_date_expire = $matches[1];
                    
                    $nis_row_expirate = $p[5];
                    preg_match('/"(.*?)"/', $nis_row_expirate, $matches);
                    $nis_expire = $matches[1];  

                    $end_date_row_expirate = $p[7];
                    

                    $patron = '/\d{2}\/\d{2}\/\d{4}/'; // Expresión regular para encontrar números
                    preg_match($patron, $end_date_row_expirate, $matches);
                    if (isset($matches[0])) {
                        $days = $matches[0];
                        try {
                            // Intentar convertir la fecha extraída en un objeto Carbon
                            $end_date_row_expirate_obj = Carbon::createFromFormat('d/m/Y', $days);
                        } catch (\Exception $e) {
                            // Si la conversión falla, manejar el error
                            $mensaje = 'Error al convertir la fecha.';
                            return redirect()->route('pqrs.tracking.index')->with(['error' => $mensaje]); 
                        }
                    } else {
                        $mensaje = 'Algunas fechas contienen texto o no estan en el formato correcto.';
                        return redirect()->route('pqrs.tracking.index')->with(['error' => $mensaje]); 
                    }

                    // Formatear la fecha como 'Y-m-d'
                    $end_date_expire = $end_date_row_expirate_obj->format('Y-m-d');
                    
                    $state_row_expirate = $p[10];
                    preg_match('/"(.*?)"/', $state_row_expirate, $matches);
                    $state_expire = $matches[1];   
                    
                    $filing_number_expire_int = intval($filing_number_expire);

                    $pqrs_expirate_exists = Pqrs::where('filing_number', $filing_number_expire_int)->exists();

                    $official_row_expirate = $p[3];
                    // Usar expresión regular para extraer el nombre dentro de las comillas
                    preg_match('/"([^"]+)"/', $official_row_expirate, $matches);
                    if (isset($matches[1])) {
                        $official_expire = $matches[1];
                    } else {
                        // Si no se encuentran comillas, extraer después de =T(
                        $official_expire = preg_replace('/^=T\("([^"]*)"\)/', '$1', $official_row_expirate);
                    }

                    // Eliminar cualquier carácter no deseado (como "* (E) ")
                    $official_expire = preg_replace('/^\*\s*/', '', $official_expire);

                    // Eliminar "(E)" si está presente
                    $official_expire = preg_replace('/\(E\)\s*/', '', $official_expire);

                    // Dividir el nombre en partes
                    $official__expire_explode = preg_split('/\s+/', trim($official_expire));
                        
                    $first_name_expire = $official__expire_explode[0] . ' ' . $official__expire_explode[1];
                    $first_last_name_expire = $official__expire_explode[2];
                    $second_last_name_expire = isset($official__expire_explode[3]) ? $official__expire_explode[3] : '';

                    // Consultar la base de datos
                    $person_expire = Person::where('first_name', $first_name_expire)->where('first_last_name', $first_last_name_expire)->where('second_last_name', $second_last_name_expire)->pluck('id')->first();
                    
                    if($pqrs_expirate_exists){
                        $filing_exists[] = $filing_number_expire_int;      
                        continue;  

                    }

                    $pqrs_expire = new Pqrs;
                    $pqrs_expire->type_pqrs_id = $type_pqrs_expire[0];
                    $pqrs_expire->filing_number = $filing_number_expire;
                    $pqrs_expire->filing_date = $filing_date_expire;
                    $pqrs_expire->nis = $nis_expire;
                    $pqrs_expire->end_date = $end_date_expire;
                    $pqrs_expire->issue = '...';
                    $pqrs_expire->state = $state_expire;
                    $pqrs_expire->save();

                    $pqrs_expire->people()->attach($person_expire, [
                        'date_time' => now()->format('Y-m-d H:i:s'),
                        'type' => 'Funcionario'
                    ]);

                    $countstate++;
                                                              
                }

                DB::commit();

                if (!empty($filing_exists)) {
                    $mensaje = trans('pqrs::tracking.the_following_pqrs_filings_were_not_registered_because_they_already_exist'). implode(', ', $filing_exists) .'.';
                    return redirect()->route('pqrs.tracking.index')->with(['success' => $mensaje]); 
                } else {
                    $mensaje = trans('pqrs::tracking.they_registered'). $countstate .trans('pqrs::tracking.pqrs_successfully');
                    return redirect()->route('pqrs.tracking.index')->with(['success' => $mensaje]); 
                }     
            } catch (Exception $e) {
                DB::rollBack(); // Devolver cambios realizados durante la transacción
                return back()->with('error', trans('pqrs::tracking.error_registering_the_pqrs'))->with('typealert', 'danger');
             }

        }
    }

    public function store_excel_centro(Request $request){
        ini_set('max_execution_time', 3000); // Ampliar el tiempo máximo de la ejecución del proceso en el servidor
        $validator = Validator::make($request->all(),
            ['excel'  => 'required'],
            ['excel.required'  => trans('pqrs::tracking.you_must_upload_an_excel_file')]
        );
        if($validator->fails()){
            return back()->withErrors($validator)->withInput()->with(['message' => trans('pqrs::tracking.an_error_occurred_with_the_form'), 'typealert'=>'danger']);
        }else{
            $path = $request->file('excel'); // Obtener ubicación temporal del archivo en el servidor
            $array = Excel::toArray(new PqrsImport, $path); // Convertir el contenido del archivo excel en una arreglo de arreglos

            $centro = [];

            //Accede a los codigos del responsable
            foreach($array[0] as $row){
                // Verificar si la fila tiene al menos 2 columnas y si el valor contiene '419116'
                if (isset($row[2]) && strpos($row[2], '419116' ) !== false) {
                    // Agregar el valor de la columna 2 al arreglo si contiene '419116' y esta EN PROCESO
                    $centro[] = $row;
                }
            }

            try {
                $countstate = 0;
                // Recorrer datos y relizar registros
               
                foreach($centro as $data){    
                    $type_pqrs_row = $data[7];
                    // Realizar la búsqueda y almacenar el resultado en $matches
                    preg_match('/"(.*?)"/', $type_pqrs_row, $matches);

                    // El texto entre comillas estará en $matches[1]
                    $type_pqrs_name = $matches[1];

                    $type_pqrs = TypePqrs::where('name', $type_pqrs_name)->pluck('id');
                    if ($type_pqrs->isNotEmpty()) {
                        $filing_number_row = $data[0];
                        preg_match('/"(.*?)"/', $filing_number_row, $matches);
                        $filing_number = $matches[1];

                        $filing_date_row = $data[1];
                        preg_match('/\d{2}\/\d{2}\/\d{4}/', $filing_date_row, $matches);
                        $filing_date = $matches[0];

                        $date_object = \DateTime::createFromFormat('d/m/Y', $filing_date);

                        $filing_date_format = $date_object->format('Y-m-d');
                        
                        // Obtener los días festivos de la base de datos
                        $holidays = Holiday::pluck('date')->map(function ($date) {
                            return Carbon::parse($date)->format('Y-m-d');
                        })->toArray();

                        $start_date = Carbon::parse($filing_date_format);
                        
                        $valid_days_count = 0;

                        while ($valid_days_count < 7) {
                            // Incrementar la fecha en un día
                            $start_date->addDay();
                            
                            $valid_days_count++;
                        }

                        $end_date =  $start_date->format('Y-m-d');

                        $issue_row = $data[8];
                        preg_match('/"([^"]+)"/', $issue_row, $matches);
                        $issue = $matches[1];
                                            
                        $state = 'EN PROCESO';

                        $official_row = $data[4];
                        

                        // Usar expresión regular para extraer el nombre dentro de las comillas
                        preg_match('/"([^"]+)"/', $official_row, $matches);
                        if (isset($matches[1])) {
                            $official = $matches[1];
                        } else {
                            // Si no se encuentran comillas, extraer después de =T(
                            $official = preg_replace('/^=T\("([^"]*)"\)/', '$1', $official_row);
                        }

                        // Eliminar cualquier carácter no deseado (como "* (E) ")
                        $official = preg_replace('/^\*\s?/', '', $official);

                        // Dividir el nombre en partes
                        $official_explode = preg_split('/\s+/', trim($official));
                        
                        $first_name = $official_explode[0] . ' ' . $official_explode[1];
                        $first_last_name = $official_explode[2];
                        $second_last_name = isset($official_explode[3]) ? $official_explode[3] : '';

                        $support_row = $data[9];
                        $support_explode = preg_split('/\s+/', trim($support_row));
                        $support_second_last_name = isset($support_explode[3]) ? $support_explode[3] : null;
                        $full_name = trim($support_explode[0] . ' ' . $support_explode[1] . ' ' . $support_explode[2] . ' ' . $support_second_last_name);
                        
                        // Consultar la base de datos
                        $person = Person::where('first_name', $first_name)->where('first_last_name', $first_last_name)->where('second_last_name', $second_last_name)->pluck('id')->first();
                        $support = Person::whereRaw("CONCAT(first_name, ' ', first_last_name, ' ', second_last_name) LIKE ?", [$full_name . '%'])->get();

                        $filing_number_int = intval($filing_number);

                        $pqrs_existing = Pqrs::where('filing_number', $filing_number_int)->exists();

                        if($pqrs_existing){
                            $filing_exists[] = $filing_number_int;      
                            continue;                                    
                        } 

                        $pqrs = new Pqrs;
                        $pqrs->type_pqrs_id = $type_pqrs[0];
                        $pqrs->filing_number = $filing_number;
                        $pqrs->filing_date = $filing_date_format;
                        $pqrs->nis = 0;
                        $pqrs->end_date = $end_date;
                        $pqrs->issue = $issue;
                        $pqrs->state = $state;
                        $pqrs->save();
        
                        $pqrs->people()->attach($person, [
                            'date_time' => now()->format('Y-m-d H:i:s'),
                            'type' => 'Funcionario'
                        ]);

                        $pqrs->people()->attach($support, [
                            'date_time' => now()->format('Y-m-d H:i:s'),
                            'type' => 'Apoyo'
                        ]);

                        $countstate++;  
                                                                          
                    }else{
                        $filing_number_row = $data[0];
                        preg_match('/"(.*?)"/', $filing_number_row, $matches);
                        $filing_number = $matches[1];

                        $filing_date_row = $data[1];
                        preg_match('/\d{2}\/\d{2}\/\d{4}/', $filing_date_row, $matches);
                        $filing_date = $matches[0];

                        $date_object = \DateTime::createFromFormat('d/m/Y', $filing_date);

                        $filing_date_format = $date_object->format('Y-m-d');
                        
                        // Obtener los días festivos de la base de datos
                        $holidays = Holiday::pluck('date')->map(function ($date) {
                            return Carbon::parse($date)->format('Y-m-d');
                        })->toArray();

                        $start_date = Carbon::parse($filing_date_format);
                        
                        $start_date->addDay();

                        $end_date =  $start_date->format('Y-m-d');

                        $issue_row = $data[8];
                        preg_match('/"([^"]+)"/', $issue_row, $matches);
                        $issue = $matches[1];

                        $state = 'EN PROCESO';

                        $official_row = $data[4];
                        // Usar expresión regular para extraer el nombre dentro de las comillas
                        preg_match('/"([^"]+)"/', $official_row, $matches);
                        if (isset($matches[1])) {
                            $official = $matches[1];
                            
                        } else {
                            // Si no se encuentran comillas, extraer después de =T(
                            $official = preg_replace('/^=T\("([^"]*)"\)/', '$1', $official_row);
                        }

                        // Eliminar cualquier carácter no deseado (como "* (E) ")
                        $official = preg_replace('/^\*\s?/', '', $official);

                        // Dividir el nombre en partes
                        $official_explode = preg_split('/\s+/', trim($official));
                        
                        $first_name = $official_explode[0] . ' ' . $official_explode[1];
                        $first_last_name = $official_explode[2];
                        $second_last_name = isset($official_explode[3]) ? $official_explode[3] : '';

                        $support_row = $data[9];
                        $support_explode = preg_split('/\s+/', trim($support_row));
                        $support_first_name = $support_explode[0] . ' ' . $support_explode[1];
                        $support_first_last_name = $support_explode[2];
                        $support_second_last_name = isset($support_explode[3]) ? $support_explode[3] : '';

                        // Consultar la base de datos
                        $person = Person::where('first_name', $first_name)->where('first_last_name', $first_last_name)->where('second_last_name', $second_last_name)->pluck('id')->first();
                        $support = Person::where('first_name', $support_first_name)->where('first_last_name', $support_first_last_name)->where('second_last_name', $support_second_last_name)->pluck('id');

                        $type_pqrs = new TypePqrs;
                        $type_pqrs->name = $type_pqrs_name;
                        $type_pqrs->save();

                        $pqrs = new Pqrs;
                        $pqrs->type_pqrs_id = $type_pqrs->id;
                        $pqrs->filing_number = $filing_number;
                        $pqrs->filing_date = $filing_date;
                        $pqrs->nis = 0;
                        $pqrs->end_date = $end_date;
                        $pqrs->issue = $issue;
                        $pqrs->state = $state;
                        $pqrs->save();

                        $pqrs->people()->attach($person, [
                            'date_time' => now()->format('Y-m-d H:i:s'),
                            'type' => 'Funcionario'
                        ]);

                        $pqrs->people()->attach($support, [
                            'date_time' => now()->format('Y-m-d H:i:s'),
                            'type' => 'Apoyo'
                        ]);

                        $countstate++;
                    }
                }

                DB::commit();

                if (!empty($filing_exists)) {
                    $mensaje = trans('pqrs::tracking.the_following_pqrs_filings_were_not_registered_because_they_already_exist'). implode(', ', $filing_exists) .'.';
                    return redirect()->route('pqrs.tracking.index')->with(['success' => $mensaje]); 
                } else {
                    $mensaje = trans('pqrs::tracking.they_registered'). $countstate .trans('pqrs::tracking.pqrs_successfully');
                    return redirect()->route('pqrs.tracking.index')->with(['success' => $mensaje]); 
                }     
            } catch (Exception $e) {
                DB::rollBack(); // Devolver cambios realizados durante la transacción
                return back()->with('error', trans('pqrs::tracking.error_registering_the_pqrs'))->with('typealert', 'danger');
             }

        }
    }

    public function email()
    {
        try {
            $pqrs = Pqrs::with('people')->where('state', 'PROXIMA A VENCER')->get();

            Mail::send('pqrs::emails.pqrs', compact('pqrs'), function ($msg) use ($pqrs) {
                $emails = [];
                $cc_emails = [];
                $valid_emails = [];
                $cc_valid_emails = ['dmcuellar@sena.edu.co'];

                foreach ($pqrs as $p) {
                    foreach ($p->people as $person) {
                        if ($person->pivot->type == 'Funcionario') {
                            $emails[] = $person->sena_email;
                        } else if ($person->pivot->type == 'Apoyo') {
                            $cc_emails[] = $person->sena_email;
                        }
                    }
                }

                foreach ($emails as $email) {
                    // Eliminar espacios en blanco alrededor de la dirección de correo electrónico
                    $clean_email = trim($email);

                    // Validar la dirección de correo electrónico
                    if (filter_var($clean_email, FILTER_VALIDATE_EMAIL)) {
                        $valid_emails[] = $clean_email;
                    } else {
                        throw new \Exception(trans('pqrs::tracking.the_email_address_is_not_valid'));
                    }
                }

                foreach ($cc_emails as $cc_email) {
                    // Eliminar espacios en blanco alrededor de la dirección de correo electrónico
                    $clean_email = trim($cc_email);

                    // Validar la dirección de correo electrónico
                    if (filter_var($clean_email, FILTER_VALIDATE_EMAIL)) {
                        $cc_valid_emails[] = $clean_email;
                    } else {
                        throw new \Exception(trans('pqrs::tracking.the_email_address_is_not_valid'));
                    }
                }

                $msg->subject('Alerta temprana de PQRS');
                $msg->to($valid_emails);
                $msg->cc($cc_valid_emails);
            });

            // Redirige a una página de confirmación o de vuelta a la vista original
            return redirect()->back()->with('success', trans('pqrs::tracking.email_sent_successfully'));
        } catch (\Exception $e) {
            // Manejar la excepción y redirigir con un mensaje de error
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function answer_store(Request $request){
        $rules = [
            'type_answer' => 'required',
            'response_date' => 'required',
        ];

        $messages = [
            'type_answer.required' => trans('pqrs::answer.you_must_select_a_response_type'),
            'response_date.required' => trans('pqrs::answer.you_must_register_a_date')
        ];

        $validatedData = $request->validate($rules, $messages);
        try {
            DB::beginTransaction();

            $pqrs = Pqrs::find($request->pqrs_id);
            $pqrs->state = $validatedData['type_answer'];
            $pqrs->answer = $request->input('answer');
            $pqrs->filed_response = $request->input('filed_response');
            $pqrs->response_date = $validatedData['response_date'];
            $pqrs->save();

            DB::commit();

            return redirect()->route('pqrs.tracking.index')->with(['success' => trans('pqrs::answer.the_response_was_registered_successfully')]); 

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($validatedData)->withInput()->with(['error' => trans('pqrs::answer.error_registering_response')]);;
        }
    }
}