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

class CarbonfootprintreportController extends Controller
{

    public function generateReport()
    {
        $aspectosAmbientales = ProductiveUnit::leftJoin('sectors', 'productive_units.sector_id', '=', 'sectors.id')
            ->leftJoin('activities', 'productive_units.id', '=', 'activities.productive_unit_id')
            ->leftJoin('labors', 'activities.id', '=', 'labors.activity_id')
            ->leftJoin('environmental_aspect_labors', function ($join) {
                $join->on('labors.id', '=', 'environmental_aspect_labors.labor_id')
                    ->whereBetween('labors.execution_date', [
                        now()->startOfQuarter()->toDateString(),
                        now()->endOfQuarter()->toDateString()
                    ]);
            })            
            ->leftJoin('environmental_aspects', 'environmental_aspect_labors.environmental_aspect_id', '=', 'environmental_aspects.id')
            ->select(
                'sectors.name as sector_name',
                'productive_units.name as productive_unit_name',
                DB::raw('SUM(environmental_aspect_labors.amount * environmental_aspects.conversion_factor) as carbon_footprint')
            )
            ->groupBy('sectors.id', 'productive_units.id', 'sectors.name', 'productive_units.name') // Asegúrate de agrupar por sector y unidad productiva
            ->get();


        return view('hdc::report.carbonfootprintreport', compact('aspectosAmbientales'));
    }

    public function generatePdf()
    {
        $productiveUnits = ProductiveUnit::all();
        $activities = Activity::all();
        $totalAmountByProductiveUnit = [];

        foreach ($productiveUnits as $productiveUnit) {
            $aspectosAmbientalesPorActividad = [];

            foreach ($activities as $activity) {
                $aspectosAmbientales = EnvironmentalAspectLabor::with(['environmental_aspect', 'labor.activity'])
                    ->whereHas('labor', function ($query) use ($activity, $productiveUnit) {
                        $query->where('activity_id', $activity->id)
                            ->whereHas('activity', function ($query) use ($productiveUnit) {
                                $query->where('productive_unit_id', $productiveUnit->id);
                            });
                    })
                    ->get();

                $aspectosAmbientalesPorActividad[$activity->id] = $aspectosAmbientales;
            }

            $totalAmount = collect($aspectosAmbientalesPorActividad)
                ->flatten()
                ->sum(function ($environmentalAspectLabor) {
                    $amount = $environmentalAspectLabor->amount;
                    $conversionFactor = $environmentalAspectLabor->environmental_aspect->conversion_factor;
                    return $amount * $conversionFactor;
                });

            $totalAmountByProductiveUnit[$productiveUnit->id] = $totalAmount;
        }

        $totalAmountBySector = $productiveUnits
            ->groupBy('sector.name')
            ->map(function ($productiveUnits) use ($totalAmountByProductiveUnit) {
                return $productiveUnits->sum(function ($productiveUnit) use ($totalAmountByProductiveUnit) {
                    return $totalAmountByProductiveUnit[$productiveUnit->id] ?? 0;
                });
            });

        $productiveUnitsWithNames = collect($totalAmountByProductiveUnit)->map(function ($huella, $unitId) {
            $productiveUnit = \Modules\SICA\Entities\ProductiveUnit::find($unitId);
            return [
                'name' => $productiveUnit->name,
                'huella' => $huella,
            ];
        })->values();


        // Generar PDF con TCPDF
        $pdf = new TCPDF();
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();

        // Agregar título al PDF con el mismo diseño que los encabezados de las tablas
        $pdf->SetFillColor(200, 220, 255);
        $pdf->SetDrawColor(0, 0, 255);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'Informe de Huella de Carbono', 1, 1, 'C', 1);
        $pdf->Ln(10);

        // Centrar la tabla de Resumen de Unidades Productivas con título
        $pdf->SetX(55); // Ajusta la posición X según sea necesario
        $pdf->SetFont('helvetica', 'B', 12); // Establecer la fuente en negrita
        $pdf->Cell(100, 10, 'Resumen de Unidades Productivas', 1, 1, 'C', 1); // Modificado aquí



$pdf->SetFont('helvetica', '', 10); // Restaurar la fuente regular

foreach ($productiveUnitsWithNames as $unit) {
    // Verificar si la huella es mayor que cero antes de mostrar la unidad productiva
    if ($unit['huella'] >= 0) {
        $pdf->SetX(55); // Ajusta la posición X según sea necesario
        $pdf->Cell(50, 10, $unit['name'], 1);
        $pdf->Cell(50, 10, $unit['huella'], 1);
        $pdf->Ln();
    }
}

$pdf->Ln(10);

// Crear una tabla para mostrar los datos de los sectores
$pdf->SetX(55); // Ajusta la posición X según sea necesario
$pdf->SetFont('helvetica', 'B', 12); // Establecer la fuente en negrita
$pdf->Cell(100, 10, 'Resumen de Sectores', 1, 1, 'C', 1);



$pdf->SetFont('helvetica', '', 10); // Restaurar la fuente regular

foreach ($totalAmountBySector as $sector => $total) {
    $pdf->SetX(55); // Ajusta la posición X según sea necesario
    $pdf->Cell(50, 10, $sector, 1);
    $pdf->Cell(50, 10, $total, 1);
    $pdf->Ln();
}

// Descargar o mostrar en el navegador
$pdf->Output('carbon_footprint_report.pdf', 'D');


        // Descargar o mostrar en el navegador
        /*   return $pdf->download('carbon_footprint_report.pdf'); */
    }
}
