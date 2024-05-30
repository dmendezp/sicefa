<?php

namespace Modules\PQRS\Imports;

use Modules\PQRS\Entities\Pqrs;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PqrsImport implements ToModel, WithStartRow
{

    public function model(array $row)
    {
        if($row[0] != null){
            return new PQRS([
                'tipo' => ($row[9] == null) ? 0 : $row[9],
                'filing_number' => ($row[4] == null) ? 0 : $row[4],
                'filing_date' => ($row[6] == null) ? 0 : $row[6],
                'nis' => ($row[5] == null) ? 0 : $row[5],
                'end_date' => ($row[7] == null) ? 0 : $row[7],
                'state' => ($row[10] == null) ? 0 : $row[10],
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
