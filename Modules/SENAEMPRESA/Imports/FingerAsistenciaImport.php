<?php

namespace Modules\SENAEMPRESA\Imports;

use Carbon\Carbon;

use Modules\SENAEMPRESA\Entities\FingerAsistencia;
use Modules\SICA\Entities\Person;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithStartRow;
/* use Maatwebsite\Excel\Concerns\WithHeadingRow; */ // Se egrega para implementar row por nombre definido y si se coloca solo buscará por heading
use Maatwebsite\Excel\Concerns\WithBatchInserts; //Ayuda a limitar la carga de los elementos del excel
use Maatwebsite\Excel\Concerns\WithChunkReading; // se usa para cargar documentos extensos

class FingerAsistenciaImport implements ToModel, WithChunkReading, WithBatchInserts, WithStartRow //WithHeadingRow se importa para row definido en el excel
{
    private $people;
    public function __construct(){
        $this->people = Person::pluck('id','document_number');
    }
   
    public function model(array $row)
    {
        return new FingerAsistencia([
        
            /* 'area' => $row['dept'], //el nombre en la base de datos es el primero el de $row es el de la tabla de excel
            'Date_In_Exit' => $row['hora_ingreso_salida'],
            'name_equipment' => $row['nombre'],
            //'user_id' => ($row['N_º']),
            'user_id' => $this->people[$row['n']], */


            /* Calcular las horas de trabajo */
            /* $in = $row[3],
            $exit = $row[4],
            $inicio = strtotime($in),
            $fin = strtotime($exit) ,
            $hours = ($fin-$inicio)/3600, */

            'area' => $row[2], //el nombre en la base de datos es el primero el de $row es el de la tabla de excel
            'date_turn' => $row[3],
            'time_in' => $row[4],
            'time_exit' => $row[5],
           /*  'hours_work' =>$hours, */
            /* 'user_id' => ($user), */
            'person_id' => $this->people[$row[1]],

            

            //2023-03-09 17:43:31

            /* 'tipo' => ($row[0] == null)? 0:$row[0],
            'documento' => ($row[1] == null)? 0:$row[1],
            'nombre' => ($row[2] == null)? 0:$row[2],
            'apellidos' => ($row[3] == null)? 0:$row[3],
            'celular' => ($row[4] == null)? 0:$row[4],
            'correo' => ($row[5] == null)? 0:$row[5],
            'estado' => ($row[6] == null)? 0:$row[6],
            'programa' => 1,
            'ficha' => 2999999 */
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        return 1000; // se limita en esta cantidad de datos
    }

    public function chunkSize(): int
    {
        return 1000;
    }

  
    
}
