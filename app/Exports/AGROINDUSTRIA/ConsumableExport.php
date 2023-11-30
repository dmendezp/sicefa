<?php

namespace App\Exports\AGROINDUSTRIA;

use Maatwebsite\Excel\Concerns\FromCollection;
use Modules\SICA\Entities\Consumable;

class ConsumableExport implements FromCollection
{
    public function collection()
    {
        // Obtén los datos de consumables que deseas exportar
        return Consumable::all();
    }
}
