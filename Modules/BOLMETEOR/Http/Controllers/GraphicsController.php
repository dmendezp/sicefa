<?php

namespace Modules\BOLMETEOR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BOLMETEOR\Imports\ClimaticImport;

use Validator, Str, DB, Excel;

use Modules\BOLMETEOR\Entities\Sensor;
use Modules\BOLMETEOR\Entities\Variable;
use Modules\BOLMETEOR\Entities\Climaticdata;


class GraphicsController extends Controller
{

    
    public $sensors = ['1' => 'Estación Sena'];

    public $variables = [];

    public $agrupados = [
        '1' => 'Día',
        '2' => 'Semana',
        '3' => 'Mes'
    ];

    public $estadisticas = [
        '0' => 'Máximo',
        '1' => 'Mínimo',
        '2' => 'Promedio',
        '3' => 'Sumatoria'
    ];

    public $direccion = [
        ["N",0,(360/16)*1],
        ["NNE",(360/16)*1,(360/16)*2],
        ["NE",(360/16)*2,(360/16)*3],
        ["ENE",(360/16)*3,(360/16)*4],
        ["E",(360/16)*4,(360/16)*5],
        ["ESE",(360/16)*5,(360/16)*6],
        ["SE",(360/16)*6,(360/16)*7],
        ["SSE",(360/16)*7,(360/16)*8],
        ["S",(360/16)*8,(360/16)*9],
        ["SSW",(360/16)*9,(360/16)*10],
        ["SW",(360/16)*10,(360/16)*11],
        ["WSW",(360/16)*11,(360/16)*12],
        ["W",(360/16)*12,(360/16)*13],
        ["WNW",(360/16)*13,(360/16)*14],
        ["NW",(360/16)*14,(360/16)*15],
        ["NNW",(360/16)*15,(360/16)*16]
    ];

    public function __construct()
    {
        $this->variables = Variable::where('status', 'Activo')->pluck('variable as name', 'id');
    }
   
    public function getGraficas(){
        $data = [
            'sensors'=>$this->sensors,
            'variables' => $this->variables,
            'agrupados' => $this->agrupados
        ];
        return view('bolmeteor::general.graficas', $data)->with('estadisticas', $this->estadisticas);
    }

    public function postValuesSearch(Request $request){
        
        $rules = [
            'sensor' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
            'estadistica' => 'required_unless:agrupacion,0',
        ];

        $messages = [
            'sensor.required' => 'Debe seleccionar un sensor.',
            'start_date.required' => 'Debe seleccionar una fecha inicial.',
            'end_date.required' => 'Debe seleccionar una fecha final.',
            'end_date.after_or_equal' => 'La fecha inicial debe ser menor o igual a la fecha final.',
            'estadistica.required_unless' => 'Debe selecionar una función estadistica para agrupar datos.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);        
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert', 'danger')
            ->withInput();
        else:
            $sensors = $this->sensors;
            $variables = $this->variables;
            $agrupados = $this->agrupados;
            $estadisticas = $this->estadisticas;    
            $data = [
                'sensors'=>$sensors,
                'variables' => $variables,
                'agrupados' => $agrupados
            ];            
            $values = Variable::where('sensor_id', 1)->where('id',$_REQUEST['variable'])->get();
            $values = $values->toArray();
            
            // Obtener el nombre de la variable
            
            switch ($_REQUEST['variable']) {
                    
                case '1':
                    $variable_nombre="temperature";
                    break;
                case '2':
                    $variable_nombre="relative_humidity";
                    break;
                case '3':
                    $variable_nombre="solar_radiation";
                    break;
                case '4':
                    $variable_nombre="precipitation";
                    break;
                case '5':
                    $variable_nombre= ["winds_direction","winds_peed"];
                    break;
            }

            $est="";
            switch ($_REQUEST['estadistica']) {
                case '0':
                    $est="max";
                break;
                case '1':
                    $est="min";
                break;
                case '2':
                    $est="avg";
                break;
                case '3':
                    $est="count";
                break;
            }
            $formatoFechaSelect = '';
            $formatoFechaGroupBy = 'date_time';
            switch ($_REQUEST['agrupacion']) {
                case '1':
                    $formatoFechaGroupBy = "'%D %M %Y'";
                    break;
                case '2': 
                    $formatoFechaGroupBy = "'%W'";
                    break;

                case '3':
                    $formatoFechaGroupBy = "'%M %Y'";
                    break;
                default:
                    break;
            }
            if($_REQUEST['variable'] != 5){
                $query = Climaticdata::select(
                    DB::raw($est.'('.$variable_nombre.') as value'),
                    ($formatoFechaSelect == "") ? DB::raw("DATE_FORMAT(date_time ,$formatoFechaGroupBy) as date_time"): "date_time",
                    DB::raw($_REQUEST['variable'].' as variable_id')
                )->whereBetween('date_time', [$_REQUEST['start_date'].' 00:00:00', $_REQUEST['end_date'].' 23:59:59'])
                ->groupBy(
                    DB::raw('variable_id'),
                    ($formatoFechaSelect == "") ? DB::raw("DATE_FORMAT(date_time ,$formatoFechaGroupBy)") : "date_time"
                )
                ->orderBy(DB::raw("DAY('date_time')"))
                ->get();
                $query = $query->toArray();
                $values[0]['values'] = $query;
            }else{
                $name = "&lt; 5 m/s";
                $rangoFinal = 0;
                // Calcular los rangos
                $query = Climaticdata::select(DB::raw('max('.$variable_nombre[1].') as max'))
                ->whereBetween('date_time', [$_REQUEST['start_date'].' 00:00:00', $_REQUEST['end_date'].' 23:59:59'])
                ->get();
                $rangoFinal = ceil($query->toArray()[0]['max'] / 5);
                // Consultar velocidades
                for ($i = 0; $i < $rangoFinal; $i++) {
                    // consultar direcciones
                    $cordenadas = [];
                    foreach($this->direccion as $ii => $direccion){
                        $query = Climaticdata::select(DB::raw('max('.$variable_nombre[1].') as max'))
                            ->whereBetween('winds_peed', [((($i == 0)? 1 :$i) - 1)*5, $i*5])
                            ->whereBetween('winds_direction', [$direccion[1], $direccion[2]])
                            ->whereBetween('date_time', [$_REQUEST['start_date'].' 00:00:00', $_REQUEST['end_date'].' 23:59:59'])
                            ->get();
                        ;
                        $cordenadas[] = [
                            $direccion[0], 
                            ($query->toArray()[0]['max'] == null)? 1:floatval($query->toArray()[0]['max'])
                        ];
                    }
                    $name = ($i == 0)? $name: (((($i == 0)? 1 :$i) )*5).'-'.(($i+1)*5).' m/s';
                    $values[0]['values'][] = [
                        'name' => $name,
                        'data' => $cordenadas
                    ];
                }
            }
            
            $data2 = ['values'=>$values];

            return view('bolmeteor::general.graficas', $data, $data2)->with('sensor_name', $sensors)->with('estadisticas', $estadisticas);
        endif;
    }

    public function estadisticas($id){
        if($id!=0):
            $estadisticas = array(0 => array('id'=>'0', 'name'=>'Seleccione...'),1 => array('id'=>'1', 'name'=>'Promedio'), 2 => 
            array('id'=>'2', 'name'=>'Máximo'), 3 => array('id'=>'3', 'name'=>'Minimo'), 4 => array('id'=>'4', 'name'=>'Moda'));
        else:
            $estadisticas = array(0 => array('id'=>'0', 'name'=>'Seleccione...'));
        endif;
        return  response()->json($estadisticas);
    }

    public function getCarga(){
       
        return view('bolmeteor::general.carga');
    }

    public function storeCarga(Request $request){
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
           $data = Excel::import(new ClimaticImport, $path);
           return back()->with('success', 'Excel importado correctamente.');
        }
    }

}
