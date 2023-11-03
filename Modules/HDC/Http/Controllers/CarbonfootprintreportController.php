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
        // Obtener el trimestre seleccionado desde el campo oculto
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
        $pdf->Cell(37, 10, 'Total', 1, 1, 'C', 1);

        $pdf->SetFont('helvetica', '', 12);
        $pdf->SetFillColor(255, 255, 255);

        $groupedAspects = collect($aspectosAmbientales)->groupBy('sector_name');
        foreach ($groupedAspects as $sectorName => $aspects) {
            // Muestra el nombre del sector solo una vez
            $pdf->Cell(80, 10, $sectorName, 1);

            // Si hay más de una unidad productiva, usa MultiCell para mostrarlas juntas
            if (count($aspects) > 1) {
                $unitNames = collect($aspects)->pluck('productive_unit_name')->implode("\n");
                $carbonFootprints = collect($aspects)->pluck('carbon_footprint')->implode("\n");
                $pdf->MultiCell(80, 10, $unitNames, 1);
                $pdf->SetXY($pdf->GetX() + 160, $pdf->GetY() - 11); // Ajusta la posición para la huella de carbono
                $pdf->MultiCell(37, 10, $carbonFootprints, 1);
            } else {
                $pdf->Cell(80, 10, $aspects[0]['productive_unit_name'], 1);
                $pdf->Cell(37, 10, $aspects[0]['carbon_footprint'], 1);
            }

            // Actualiza $totalCarbonBySector con la suma de la huella de carbono para el sector actual
            $totalCarbonBySector[$sectorName] = $aspects->sum('carbon_footprint');
            // Obtener la posición actual
            // Obtener la posición actual
            // Obtener la posición actual
            $xPositionTotal = $pdf->GetX();
            $yPositionTotal = $pdf->GetY();

            // Calcular la nueva posición X para alinear al lado derecho
            $newXPosition = $pdf->GetPageWidth() - 120; // Restar el ancho de la celda al ancho de la página

            // Guardar la posición original de la fila
            $originalXPosition = $pdf->GetX();
            $originalYPosition = $pdf->GetY();

            // Iterar sobre las filas
            foreach ($aspects as $aspect) {
                // Ajustar la posición Y para cada fila
                $newYPositionTotal = $originalYPosition - 10; // Ajusta según sea necesario

                // Mover solo la celda "Total"
                $pdf->SetXY($newXPosition, $newYPositionTotal);
                $pdf->Cell(37, 10, $totalCarbonBySector[$sectorName], 1);

                // Restaurar la posición original de la fila
                $pdf->SetXY($originalXPosition, $originalYPosition);

                $pdf->Ln(); // Mover a la siguiente línea

                // Actualizar la posición original de la fila
                $originalYPosition = $pdf->GetY();
            }

            // Muestra las filas adicionales solo si hay más de una unidad productiva
            if (count($aspects) > 1) {
                // Mueve a la siguiente línea antes de empezar el siguiente sector
                $pdf->Ln();
            }
        }


        // Agregar una línea o un espacio para separar la tabla del informe trimestral
        $pdf->Ln(10); // Espacio de 10 puntos entre la tabla y el informe trimestral
        $pdf->Cell(234, 0, '', 'T'); // Línea que reemplaza el espacio debajo

        // Agregar aquí el contenido del informe trimestral si es necesario

        // Descargar o mostrar en el navegador
        $pdf->Output('carbon_footprint_quarterly_report.pdf', 'D');
    }
}
