<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Exports\AGROINDUSTRIA\ConsumableExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExcelController extends Controller
{
    public function generarExcelConsumables($laborId)
    {
        // Obtén los datos de consumables asociados al labor
        $consumables = Consumable::where('labor_id', $laborId)->get();

        // Genera y descarga el archivo Excel
        return Excel::download(new ConsumableExport($consumables), 'PPMI_F06 SOLICITUD DE MATERIALES ALMACEN.xlsx');
    }
}
