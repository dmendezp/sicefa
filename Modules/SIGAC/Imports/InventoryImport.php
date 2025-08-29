<?php

namespace Modules\SIGAC\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class InventoryImport implements ToArray, WithCalculatedFormulas
{

    public function array(array $array)
    {
        return $array;
    }
}
