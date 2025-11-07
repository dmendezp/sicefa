<?php

namespace Modules\BOLMETEOR\Imports;

use Modules\BOLMETEOR\Entities\Climaticdata;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class ClimaticImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        if($row[0] != null){
            $fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]));        
            return new Climaticdata([
                'person_id' => 1,
                'date_time' => $fecha->format('Y-m-d H:i:s'),
                'temperature' => ($row[7] == null)? 0:$row[7],
                'precipitation' => ($row[8] == null)? 0:$row[8],
                'relative_humidity' => ($row[6] == null)? 0:$row[6],
                'solar_radiation' => ($row[5] == null)? 0:$row[5],
                'winds_direction' => ($row[9] == null)? 0:$row[9],
                'winds_peed' => ($row[11] == null)? 0:$row[11]
            ]);
        }
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
