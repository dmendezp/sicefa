<?php

namespace Modules\SIGAC\Imports;

use Modules\SIGAC\Entities\TempAppreticeLearningOutcome;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ApprenticeLearningOutcomeImport implements ToModel, WithStartRow
{

    public function model(array $row)
    {
        if($row[0] != null){
            return new TempAppreticeLearningOutcome([
                'tipo' => ($row[0] == null) ? 0 : $row[0],
                'documento' => ($row[1] == null) ? 0 : $row[1],
                'nombre' => ($row[2] == null) ? 0 : $row[2],
                'apellidos' => ($row[3] == null) ? 0 : $row[3],
                'estado' => ($row[4] == null) ? 0 : $row[4],
                'competencia' => ($row[5] == null) ? 0 : $row[5],
                'resultado' => ($row[6] == null) ? 0 : $row[6],
                'juicio' => ($row[7] == null) ? 0 : $row[7]
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
