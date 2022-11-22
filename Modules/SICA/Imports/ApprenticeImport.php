<?php

namespace Modules\SICA\Imports;

use Modules\SICA\Entities\TempAppretice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class ApprenticeImport implements ToModel, WithStartRow
{

    public function model(array $row)
    {
        //return print_r($row);
        if($row[0] != null){
            //$fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]));        
            return new TempAppretice([
                'tipo' => ($row[0] == null)? 0:$row[0],
                'documento' => ($row[1] == null)? 0:$row[1],
                'nombre' => ($row[2] == null)? 0:$row[2],
                'apellidos' => ($row[3] == null)? 0:$row[3],
                'celular' => ($row[4] == null)? 0:$row[4],
                'correo' => ($row[5] == null)? 0:$row[5],
                'estado' => ($row[6] == null)? 0:$row[6],
                'programa' => 1,
                'ficha' => 2999999
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
