<?php

namespace Modules\SICA\Imports;

use Modules\SICA\Entities\TempPeople;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PeopleImport implements ToModel, WithStartRow
{

    public function model(array $row)
    {
        //return print_r($row);
        if($row[0] != null){
            //$fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]));
            return new TempPeople([
                'tipo' => ($row[1] == null) ? 0 : $row[1],
                'documento' => ($row[2] == null) ? 0 : $row[2],
                'nombre' => ($row[3] == null) ? 0 : $row[3],
                'apellidos' => ($row[4] == null) ? 0 : $row[4],
                'celular' => ($row[5] == null) ? 0 : $row[5],
                'correo' => ($row[6] == null) ? 0 : $row[6],
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
