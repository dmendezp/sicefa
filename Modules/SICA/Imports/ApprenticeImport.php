<?php

namespace Modules\SICA\Imports;

//use Modules\BOLMETEOR\Entities\Climaticdata;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class ApprenticeImport implements ToModel, WithStartRow
{

    public function model(array $row)
    {
        if($row[0] != null){
            return $row;
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
