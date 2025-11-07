<?php

namespace Modules\AGROINDUSTRIA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Exports\AGROINDUSTRIA\ConsumableExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Consumable;
use Carbon\Carbon;


class ExcelController extends Controller
{
    public function generateExcel($laborId){
        // Obtén los datos de consumables asociados al labor
        $consumables = Consumable::where('labor_id', $laborId)->with('inventory.element.measurement_unit')->get();

        $labor = Labor::find($laborId);
        $personName = $labor->person->first_name . ' ' . $labor->person->first_last_name . ' ' . $labor->person->second_last_name; 
        $document_number = $labor->person->document_number;
        $currentDate = Carbon::now();

        // Obtener solo la fecha en formato 'Y-m-d'
        $planning_date = $currentDate->toDateString();
        // Genera y descarga el archivo Excel
        $excelFileName = 'PPMI_F06 SOLICITUD DE MATERIALES ALMACEN.xlsx';

        $excel = new ConsumableExport($consumables, $personName, $document_number, $planning_date);

        // Descarga el archivo Excel
        return $excel->download($excelFileName);
    }
}
