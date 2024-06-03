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
    public function index(){
        $titlePage = 'Seguimiento PQRS';
        $titleView = 'Seguimiento PQRS';

        $pqrs = Pqrs::with(['people' => function($query) {
            $query->orderBy('date_time', 'desc');
        }])->get();
        
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
            if ($days_remaining == 5 && $p->state == 'EN PROCESO') {
                $p->state = 'PROXIMO A VENCER';
                $p->save();
            }                 
        }

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
                'date_time' => now()->format('Y-m-d H:i:s')
            ]);


            DB::commit();

            return redirect()->route('pqrs.tracking.index')->with(['success' => 'Se registro la PQRS exitosamente']); 

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($validatedData)->withInput()->with(['error' => 'Error al registrar la PQRS']);;
        }
    }

    public function create_excel(){
        $titlePage = 'Cargar archivo';
        $titleView = 'Cargar archivo';

        $data = [
            'titlePage' => $titlePage,
            'titleView' => $titleView
        ];

        return view('pqrs::tracking.excel', $data);
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
            $array = Excel::toArray(new PqrsImport, $path); // Convertir el contenido del archivo excel en una arreglo de arreglos
            
            $regional = [];

            //Accede a los codigos del responsable
            foreach($array[0] as $row){
                // Verificar si la fila tiene al menos 2 columnas y si el valor contiene '419116'
                if (isset($row[1]) && strpos($row[1], '419116' ) !== false && strpos($row[10], 'EN PROCESO')) {
                    // Agregar el valor de la columna 2 al arreglo si contiene '419116' y esta EN PROCESO
                    $regional[] = $row;
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
                        $official = preg_replace('/^\*?\s?\(E\)\s?/', '', $official);

                        // Dividir el nombre en partes
                        $official_explode = preg_split('/\s+/', trim($official));
                        
                        $first_name = $official_explode[0] . ' ' . $official_explode[1];
                        $first_last_name = $official_explode[2];
                        $second_last_name = isset($official_explode[3]) ? $official_explode[3] : '';

                        // Consultar la base de datos
                        $person = Person::where('first_name', $first_name)->where('first_last_name', $first_last_name)->where('second_last_name', $second_last_name)->pluck('id')->first();

                        $pqrs = new Pqrs;
                        $pqrs->type_pqrs_id = $type_pqrs[0];
                        $pqrs->filing_number = $filing_number;
                        $pqrs->filing_date = $filing_date;
                        $pqrs->nis = $nis;
                        $pqrs->start_date = '2024-05-31';
                        $pqrs->end_date = $end_date;
                        $pqrs->issue = '...';
                        $pqrs->state = $state;
                        $pqrs->save();

                        $pqrs->people()->attach($person, [
                            'date' => now()->format('Y-m-d')
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
                        $official = preg_replace('/^\*?\s?\(E\)\s?/', '', $official);

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

                        $pqrs = new Pqrs;
                        $pqrs->type_pqrs_id = $type_pqrs->id;
                        $pqrs->filing_number = $filing_number;
                        $pqrs->filing_date = $filing_date;
                        $pqrs->nis = $nis;
                        $pqrs->start_date = '2024-05-31';
                        $pqrs->end_date = $end_date;
                        $pqrs->issue = '...';
                        $pqrs->state = $state;
                        $pqrs->save();

                        $pqrs->people()->attach($person[0], [
                            'date' => now()->format('Y-m-d')
                        ]);

                        $countstate++;
                    }
                }
                
                return redirect()->route('pqrs.tracking.index')->with(['success' => 'Se registraron '. $countstate.' PQRS exitosamente.']); 
            } catch (Exception $e) {
                DB::rollBack(); // Devolver cambios realizados durante la transacción
                return back()->with('error', 'Error al registrar la PQRS')->with('typealert', 'danger');
             }

        }
    }

    public function email()
    {
        $pqrs = Pqrs::where('state', 'PROXIMO A VENCER')->with(['people' => function ($query) {
            $query->orderBy('consecutive', 'desc');
        }])->get();

        
        // Ship the order...
        Mail::send('pqrs::emails.pqrs', compact('pqrs'), function ($msg) use ($pqrs) {
            $emails = [
                'julianjavierramirezdiaz73@gmail.com',
            ];

            $msg->subject('Alerta temprana de PQRS');
            $msg->to($emails);
        });

        // Redirige a una página de confirmación o de vuelta a la vista original
        return redirect()->back()->with('success', 'Correo enviado exitosamente.');
    }
}
