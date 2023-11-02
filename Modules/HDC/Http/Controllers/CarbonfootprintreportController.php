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
        $start_date = new \DateTime($quarter->start_date);
        $end_date = new \DateTime($quarter->end_date);

        // Obtener todos los trimestres (no sé si los necesitas, pero los incluí)
        $quarters = Quarter::all();

        // Consulta para obtener datos relevantes
        $aspectosAmbientales = ProductiveUnit::leftJoin('sectors', 'productive_units.sector_id', '=', 'sectors.id')
            ->leftJoin('activities', 'productive_units.id', '=', 'activities.productive_unit_id')
            ->leftJoin('labors', 'activities.id', '=', 'labors.activity_id')
            ->leftJoin('environmental_aspect_labors', function ($join) use ($start_date, $end_date) {
                $join->on('labors.id', '=', 'environmental_aspect_labors.labor_id')
                    ->whereBetween('labors.execution_date', [$start_date, $end_date])
                    ->where('environmental_aspect_labors.amount', '>', 0); // Condición para huella de carbono mayor a 0
            })
            ->leftJoin('environmental_aspects', 'environmental_aspect_labors.environmental_aspect_id', '=', 'environmental_aspects.id')
            ->select(
                'sectors.name as sector_name',
                'productive_units.name as productive_unit_name',
                'labors.execution_date',
                DB::raw('SUM(environmental_aspect_labors.amount * environmental_aspects.conversion_factor) as carbon_footprint')
            )
            ->groupBy('sectors.id', 'productive_units.id', 'sectors.name', 'productive_units.name', 'labors.execution_date')
            ->havingRaw('carbon_footprint > 0') // Agregar condición HAVING para filtrar huella de carbono mayor a 0
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
        $pdf = new TCPDF();
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();

        // Agregar título al PDF con colores diferentes para el título principal y la fecha
        $pdf->SetDrawColor(0, 0, 255);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetFillColor(200, 220, 255); // Color de fondo para el título principal
        $pdf->Cell(0, 10, 'Informe Trimestral de Huella de Carbono', 1, 1, 'C', 1);

        // Mostrar el rango de fechas del trimestre seleccionado en el título
        $pdf->SetFont('helvetica', '', 10); // Reducir el tamaño de letra solo para esta línea
        $pdf->SetFillColor(255, 255, 255); // Restablecer el color de fondo a blanco para la fecha
        $pdf->Cell(0, 10, "Desde: " . $start_date->format('Y-m-d') . "  Hasta: " . $end_date->format('Y-m-d'), 'LTRB', 1, 'C');
        $pdf->SetFont('helvetica', '', 12); // Restaurar el tamaño de letra
        $pdf->Ln(10);

        // Crear una tabla con tres columnas: Nombre, Tipo (Sector/Unidad Productiva), Huella de Carbono
        $pdf->SetX(30);
        $pdf->SetFont('helvetica', 'B', 12);

        // Títulos con colores de fondo
        $pdf->SetFillColor(200, 220, 255); // Color de fondo para el título "Sector"
        $pdf->Cell(50, 10, 'Sector', 1, 0, 'C', 1);

        $pdf->SetFillColor(200, 220, 255); // Color de fondo para el título "Unidad Productiva"
        $pdf->Cell(50, 10, 'Unidad Productiva', 1, 0, 'C', 1);

        $pdf->SetFillColor(200, 220, 255); // Color de fondo para el título "Huella de Carbono"
        $pdf->Cell(50, 10, 'Huella de Carbono', 1, 1, 'C', 1);

        // Mostrar resultados en el PDF
        foreach ($carbonFootprintByUnitAndSector as $key => $totalCarbonFootprint) {
            // Separar la clave en sector y unidad productiva
            list($sector, $productiveUnit) = explode('_', $key);

            $pdf->SetX(30);
            $pdf->Cell(50, 10, $sector, 1); // Mostrar el nombre del sector
            $pdf->Cell(50, 10, $productiveUnit, 1); // Mostrar el nombre de la unidad productiva
            $pdf->Cell(50, 10, $totalCarbonFootprint, 1); // Mostrar el total de la huella de carbono
            $pdf->Ln();
        }

       
        $anchoPagina = $pdf->GetPageWidth();

        // Obtener el ancho del encabezado
        $anchoEncabezado = 100; // Ajusta este valor según el ancho de tu encabezado

        // Calcular la posición X para centrar el encabezado
        $posicionXCentrado = ($anchoPagina - $anchoEncabezado) / 2;

        $pdf->SetX($posicionXCentrado); // Establecer la posición X centrada
        $pdf->Cell(100, 10, 'Totales por Sector', 1, 1, 'C', 1);

        foreach ($totalCarbonFootprintBySector as $sector => $totalCarbonFootprint) {
            $pdf->SetX($posicionXCentrado); // Establecer la posición X centrada para el contenido
            $pdf->Cell(50, 10, $sector, 1);
            $pdf->Cell(50, 10, $totalCarbonFootprint, 1);
            $pdf->Ln();
        }

        // Descargar o mostrar en el navegador
        $pdf->Output('carbon_footprint_quarterly_report.pdf', 'D');
    }
}
