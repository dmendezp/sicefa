<?php

namespace Modules\HDC\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\EnvironmentalAspectLabor;
use Modules\SICA\Entities\ProductiveUnit;
use TCPDF;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Quarter;

class CarbonfootprintreportController extends Controller
{

    public function generateReport()
    {
        $quarters = Quarter::all();


        return view('hdc::report.carbonfootprintreport', compact('quarters'));
    }
    public function report()
    {

        $data = json_decode($_POST['data']);
        $quarter = Quarter::where('id', $data->selectedQuarterId)->first();
        $start_date = $quarter->start_date;
        $end_date = $quarter->end_date;

        $quarters = Quarter::all();

        $aspectosAmbientales = ProductiveUnit::leftJoin('sectors', 'productive_units.sector_id', '=', 'sectors.id')
            ->leftJoin('activities', 'productive_units.id', '=', 'activities.productive_unit_id')
            ->leftJoin('labors', 'activities.id', '=', 'labors.activity_id')
            ->leftJoin('environmental_aspect_labors', function ($join) use ($start_date, $end_date) {
                $join->on('labors.id', '=', 'environmental_aspect_labors.labor_id')
                    ->whereBetween('labors.execution_date', [$start_date, $end_date]);
            })
            ->leftJoin('environmental_aspects', 'environmental_aspect_labors.environmental_aspect_id', '=', 'environmental_aspects.id')
            ->select(
                'sectors.name as sector_name',
                'productive_units.name as productive_unit_name',
                DB::raw('SUM(environmental_aspect_labors.amount * environmental_aspects.conversion_factor) as carbon_footprint')
            )
            ->havingRaw('carbon_footprint IS NOT NULL') // Filtrar resultados donde carbon_footprint no es null
            ->groupBy('sectors.id', 'productive_units.id', 'sectors.name', 'productive_units.name')
            ->get();

        return view('hdc::report.reporttables', compact('quarters', 'aspectosAmbientales'));
    }


    public function generatePdf(Request $request)
    {
        $selectedQuarterId = $request->input('selectedQuarterId');
        $quarter = Quarter::findOrFail($selectedQuarterId);

        $start_date = $quarter->start_date;
        $end_date = $quarter->end_date;

        $aspectosAmbientales = ProductiveUnit::leftJoin('sectors', 'productive_units.sector_id', '=', 'sectors.id')
        ->leftJoin('activities', 'productive_units.id', '=', 'activities.productive_unit_id')
        ->leftJoin('labors', 'activities.id', '=', 'labors.activity_id')
        ->leftJoin('environmental_aspect_labors', function ($join) use ($start_date, $end_date) {
            $join->on('labors.id', '=', 'environmental_aspect_labors.labor_id')
                ->whereBetween('labors.execution_date', [$start_date, $end_date]);
        })
        ->leftJoin('environmental_aspects', 'environmental_aspect_labors.environmental_aspect_id', '=', 'environmental_aspects.id')
        ->select(
            'sectors.name as sector_name',
            'productive_units.name as productive_unit_name',
            DB::raw('SUM(environmental_aspect_labors.amount * environmental_aspects.conversion_factor) as carbon_footprint')
        )
        ->groupBy('sectors.id', 'sectors.name', 'productive_units.name')
        ->havingRaw('carbon_footprint IS NOT NULL')
        ->get();

        $carbonFootprintBySector = [];

        // Crear instancia de TCPDF
        // Crear instancia de TCPDF
$pdf = new TCPDF();

// Agregar una página
$pdf->AddPage();

// HTML contenido
$html = '<h1>Reporte Huella de Carbono</h1>';
$html .= '<table border="1">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>Sector</th>';
$html .= '<th>Unidades Productivas</th>';
$html .= '<th>Huella de Carbono</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$lastSector = null;
$sectorGroup = [];

foreach ($aspectosAmbientales as $aspecto) {
    // Verificar huella de carbono mayor a 0
    if ($aspecto->carbon_footprint > 0) {
        $html .= '<tr>';

        // Si el sector actual es diferente al anterior, mostrar el nombre del sector
        if ($lastSector != $aspecto->sector_name) {
            $lastSector = $aspecto->sector_name;

            // Si ya hemos mostrado al menos una celda para este sector, agregar rowspan
            if (!empty($sectorGroup)) {
                $html .= '<td rowspan="' . count($sectorGroup) . '">' . $lastSector . '</td>';
                // Mostrar la primera celda de datos para este sector
                $html .= '<td>' . $sectorGroup[0]->productive_unit_name . '</td>';
                $html .= '<td>' . $sectorGroup[0]->carbon_footprint . '</td>';
                $html .= '</tr>';
                // Mostrar el resto de las celdas para este sector
                for ($i = 1; $i < count($sectorGroup); $i++) {
                    $html .= '<tr>';
                    $html .= '<td>' . $sectorGroup[$i]->productive_unit_name . '</td>';
                    $html .= '<td>' . $sectorGroup[$i]->carbon_footprint . '</td>';
                    $html .= '</tr>';
                }
                // Limpiar el grupo actual
                $sectorGroup = [];
            }
        }

        // Agregar a la lista de celdas para este sector
        $sectorGroup[] = $aspecto;
    }
}

$html .= '</tbody>';
$html .= '</table>';

// ...

// Agregar el contenido HTML al PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF al navegador o guardarlo en un archivo
return $pdf->Output('reporte_huella_carbono.pdf', 'I');



        /* // Obtener el trimestre seleccionado desde el campo oculto
        $selectedQuarterId = $request->input('selectedQuarterId');
        // Obtener el trimestre seleccionado
        $quarter = Quarter::findOrFail($selectedQuarterId);

        // Convertir las fechas a objetos DateTime
        $start_date = $quarter->start_date;
        $end_date = $quarter->end_date;

        $aspectosAmbientales = ProductiveUnit::leftJoin('sectors', 'productive_units.sector_id', '=', 'sectors.id')
            ->leftJoin('activities', 'productive_units.id', '=', 'activities.productive_unit_id')
            ->leftJoin('labors', 'activities.id', '=', 'labors.activity_id')
            ->leftJoin('environmental_aspect_labors', function ($join) use ($start_date, $end_date) {
                $join->on('labors.id', '=', 'environmental_aspect_labors.labor_id')
                    ->whereBetween('labors.execution_date', [$start_date, $end_date]);
            })
            ->leftJoin('environmental_aspects', 'environmental_aspect_labors.environmental_aspect_id', '=', 'environmental_aspects.id')
            ->select(
                'sectors.name as sector_name',
                'productive_units.name as productive_unit_name',
                DB::raw('SUM(environmental_aspect_labors.amount * environmental_aspects.conversion_factor) as carbon_footprint')
            )
            ->havingRaw('carbon_footprint IS NOT NULL') // Filtrar resultados donde carbon_footprint no es null
            ->groupBy('sectors.id', 'productive_units.id', 'sectors.name', 'productive_units.name')
            ->get();


        // Inicializar un array para realizar un seguimiento de la huella de carbono por unidad productiva y sector
        $carbonFootprintByUnitAndSector = [];

        foreach ($aspectosAmbientales as $aspecto) {
            // Verificar huella de carbono mayor a 0
            if ($aspecto->carbon_footprint > 0) {
                // Crear una clave única para cada combinación de sector y unidad productiva
                $key = $aspecto->sector_name . '_' . $aspecto->productive_unit_name;

                // Sumar la huella de carbono al total por combinación de sector y unidad productiva
                $carbonFootprintByUnitAndSector[$key] = ($carbonFootprintByUnitAndSector[$key] ?? 0) + $aspecto->carbon_footprint;
            }
        }

        // Inicializar un array para realizar un seguimiento del total de la huella de carbono por sector
        $totalCarbonFootprintBySector = [];

        foreach ($carbonFootprintByUnitAndSector as $key => $totalCarbonFootprint) {
            // Separar la clave en sector y unidad productiva
            list($sector, $productiveUnit) = explode('_', $key);

            // Sumar la huella de carbono al total por sector
            $totalCarbonFootprintBySector[$sector] = ($totalCarbonFootprintBySector[$sector] ?? 0) + $totalCarbonFootprint;
        }
        // Generar el PDF con TCPDF
        $pdf = new TCPDF('L', 'mm', 'A4'); // 'L' establece la orientación en horizontal
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();

        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetFillColor(200, 220, 255);
        $pdf->Cell(0, 10, 'Informe Trimestral de Huella de Carbono', 1, 1, 'C', 1);

        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(0, 10, "Desde: " . $start_date . "  Hasta: " . $end_date, 'LTRB', 1, 'C');

        // Construir la tabla manualmente
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetFillColor(200, 220, 255);

        $pdf->Cell(80, 10, 'Sector', 1, 0, 'C', 1);
        $pdf->Cell(80, 10, 'Unidad Productiva', 1, 0, 'C', 1);
        $pdf->Cell(37, 10, 'Huella de Carbono', 1, 0, 'C', 1);
        $pdf->Cell(37, 10, 'Total', 0, 1, 'C', 1);
        $pdf->SetFont('helvetica', '', 12);
        $pdf->SetFillColor(255, 255, 255);

        $groupedAspects = collect($aspectosAmbientales)->groupBy('sector_name');
        foreach ($groupedAspects as $sectorName => $aspects) {
            // Muestra el nombre del sector solo una vez
            $pdf->Cell(80, 11, $sectorName, 1);

            // Si hay más de una unidad productiva, usa MultiCell para mostrarlas juntas
            if (count($aspects) > 1) {
                $unitNames = collect($aspects)->pluck('productive_unit_name')->implode("\n");
                $carbonFootprints = collect($aspects)->pluck('carbon_footprint')->implode("\n");
                $pdf->MultiCell(80, 11, $unitNames, 1);
                $pdf->SetXY($pdf->GetX() + 160, $pdf->GetY() - 11); // Ajusta la posición para la huella de carbono
                $pdf->MultiCell(37, 11, $carbonFootprints, 1);
            } else {
                $pdf->Cell(80, 11, $aspects[0]['productive_unit_name'], 1);
                $pdf->Cell(37, 11, $aspects[0]['carbon_footprint'], 1);
            }

            // Actualiza $totalCarbonBySector con la suma de la huella de carbono para el sector actual
            $totalCarbonBySector[$sectorName] = $aspects->sum('carbon_footprint');


            // Calcular la nueva posición X para alinear un poco más a la derecha
            $newXPosition = $pdf->GetPageWidth() - 90; // Ajusta según sea necesario
            $originalYPosition = $pdf->GetY();

            // Iterar sobre las filas
            foreach ($aspects as $aspect) {
                // Ajustar la posición Y para cada fila
                $newYPositionTotal = $originalYPosition -0; // Ajusta según sea necesario

                // Mover solo la celda "Total" y ajustar a la nueva posición X
                $pdf->SetXY($newXPosition, $newYPositionTotal);

                $pdf->Cell(37, 11, $totalCarbonBySector[$sectorName], 1);

                // Mover a la siguiente línea y ajustar la posición original de la fila
                $pdf->Ln();

            }
        }

        // Agregar aquí el contenido del informe trimestral si es necesario

        // Descargar o mostrar en el navegador
        $pdf->Output('carbon_footprint_quarterly_report.pdf', 'D'); */
    }
}
