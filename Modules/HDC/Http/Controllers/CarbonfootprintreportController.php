<?php

namespace Modules\HDC\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use TCPDF;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\Quarter;
use Illuminate\Validation\ValidationException;



class CarbonfootprintreportController extends Controller
{

    public function generateReport()
    {
        $quarters = Quarter::all();


        return view('hdc::report.carbonfootprintreport', compact('quarters'));
    }
    public function report(Request $request)
    {
        try {


            $data = json_decode($request->data);

            // Validar que se ha seleccionado un trimestre
            if (!$data || !isset($data->selectedQuarterId) || empty($data->selectedQuarterId)) {
                throw ValidationException::withMessages(['selectedQuarterId' => 'Por favor, selecciona un trimestre.']);
            }

            $quarter = Quarter::where('id', $data->selectedQuarterId)->first();
            $start_date = $quarter->start_date;
            $end_date = $quarter->end_date;

            // Resto de tu lógica aquí

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
                ->havingRaw('carbon_footprint IS NOT NULL')
                ->groupBy('sectors.id', 'productive_units.id', 'sectors.name', 'productive_units.name')
                ->get();


            return view('hdc::report.reporttables', compact('quarters', 'aspectosAmbientales'));
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        }
    }




    public function generatePdf(Request $request)
    {
        $selectedQuarterId = $request->input('selectedQuarterId');
        $quarter = Quarter::findOrFail($selectedQuarterId);

        $start_date = $quarter->start_date;
        $end_date = $quarter->end_date;
        $name = $quarter->name;

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

        // Crear instancia de TCPDF
        $pdf = new TCPDF('L', 'mm', 'A4');
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();

        // Construir la tabla manualmente
        $html = '
        <table border="1" cellspacing="0" cellpadding="5" width="100%">
            <thead>
                <tr>
                    <th colspan="4" style="background-color: #e6f7ff; text-align: center;">
                        <h3 style="color: #000; font-weight: bold;">Reporte Huella de Carbono</h3>
                        <p style="color: #000; font-weight: bold;">' . $name . ': ' . $quarter->start_date . ' - ' . $quarter->end_date . '</p>
                    </th>
                </tr>
                <tr>
                    <th style="background-color: #e6f7ff; font-weight: bold; text-align: center;">Sector</th>
                    <th style="background-color: #e6f7ff; font-weight: bold; text-align: center;">Unidad Productiva</th>
                    <th style="background-color: #e6f7ff; font-weight: bold; text-align: center;">Huella de Carbono</th>
                    <th style="background-color: #e6f7ff; font-weight: bold; text-align: center;">Total</th>
                </tr>
            </thead>
            <tbody>';

        $totalCarbonBySector = [];
        $groupedAspects = collect($aspectosAmbientales)->groupBy('sector_name');

        foreach ($groupedAspects as $sectorName => $aspects) {
            $rowCount = count($aspects);

            // Muestra el nombre del sector solo en la primera fila
            $html .= '<tr>';
            $html .= '<td rowspan="' . $rowCount . '" style="vertical-align: middle; text-align: center;">' . $sectorName . '</td>';

            // Primera fila de la unidad productiva y huella de carbono
            $html .= '<td style="vertical-align: middle; text-align: center;">' . $aspects[0]['productive_unit_name'] . '</td>';
            $html .= '<td style="vertical-align: middle; text-align: center;">' . number_format($aspects[0]['carbon_footprint'], 2) . '</td>'; // 2 es el número de decimales
            $html .= '<td rowspan="' . $rowCount . '" style="vertical-align: middle; text-align: center;">' . number_format(array_sum(array_column($aspects->toArray(), 'carbon_footprint')), 2) . '</td>';
            $html .= '</tr>';

            // Resto de las filas
            for ($i = 1; $i < $rowCount; $i++) {
                // Verifica si hay carbon_footprint antes de mostrar la fila
                if ($aspects[$i]['carbon_footprint'] > 0) {
                    $html .= '<tr>';
                    $html .= '<td style="vertical-align: middle; text-align: center;">' . $aspects[$i]['productive_unit_name'] . '</td>';
                    $html .= '<td style="vertical-align: middle; text-align: center;">' . number_format($aspects[$i]['carbon_footprint'], 2) . '</td>'; // 2 es el número de decimales
                    $html .= '</tr>';
                }
            }
        }

        $html .= '
            </tbody>
        </table>';

        // Agregar el contenido HTML al PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Salida del PDF al navegador o guardarlo en un archivo
        $pdf->Output('reporte_huella_carbono.pdf');

    }
}
