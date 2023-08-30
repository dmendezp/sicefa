<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Http\Request;
use Modules\SICA\Entities\Warehouse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use TCPDF;
use Modules\SICA\Entities\App;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $view = ['titlePage'=>'Inventario', 'titleView'=>'Administración de inventario'];
        $apps = App::get();
        return view('cafeto::inventory.index', compact('apps', 'view'));
    }

    public function create()
    { // Formulario de registro (entrada) de inventario
        $view = ['titlePage' => trans('ptventa::inventory.titlePage2'), 'titleView' => trans('ptventa::inventory.titleView2')];
        $apps = App::get();
        return view('cafeto::inventory.create', compact('view', 'apps'));
    }

    //Funciones Para Reporte de inventario
    public function reports()
    { //Vista principal del panel de reportes
        $view = ['titlePage' => 'Reportes', 'titleView' => 'Panel de Reportes'];
        $apps = App::get();
        return view('cafeto::reports.index', compact('view', 'apps'));
    }

    // Método para mostrar la vista del formulario de entradas de inventario
    public function showInventoryEntriesForm()
    {
        $view = ['titlePage' => 'Reportes', 'titleView' => 'Entrada de inventario'];
        $apps = App::get();

        // Establecer valores predeterminados para $start_date y $end_date si no están presentes en el request
        $start_date = request()->input('start_date', now()->format('Y-m-d'));
        $end_date = request()->input('end_date', now()->format('Y-m-d'));

        return view('cafeto::reports.inventory-entries-form', compact('view', 'apps', 'start_date', 'end_date'));
    }

    // Método para realizar la consulta de entradas de inventario y redirigir a la vista
    public function generateInventoryEntries(Request $request)
    {
        // Captura las fechas ingresadas en el formulario.
        $startDateInput = $request->input('start_date');
        $endDateInput = $request->input('end_date');

        // Convertir las fechas al formato "Y-m-d" (año-mes-día) si es necesario.
        $startDateInput = Carbon::parse($startDateInput)->format('Y-m-d');
        $endDateInput = Carbon::parse($endDateInput)->format('Y-m-d');

        // Convertir las fechas a objetos Carbon y establecer las horas específicas.
        $startDate = Carbon::createFromFormat('Y-m-d', $startDateInput)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $endDateInput)->endOfDay();

        // Consulta para obtener los registros de MovementType con nombre "Movimiento Interno"
        $movement_type = MovementType::where('name', 'Movimiento Interno')->firstOrFail();

        // Consulta para obtener los registros de Movement entre las fechas seleccionadas
        $movements = Movement::whereHas('warehouse_movements', function ($query) {
            $query->where('productive_unit_warehouse_id', $this->getAppPuw()->id)
                ->where('role', 'Recibe');
        })
            ->where('movement_type_id', $movement_type->id)
            ->where('state', 'Aprobado')
            ->whereBetween('registration_date', [$startDate, $endDate])
            ->orderBy('registration_date', 'ASC')
            ->get();

        return $this->showInventoryEntriesForm()->with('movements', $movements);
    }

    // Método para generar el reporte PDF de entradas de inventario
    public function generateInventoryEntriesPDF(Request $request)
    {
        // Captura las fechas ingresadas en el formulario.
        $startDateInput = $request->input('start_date');
        $endDateInput = $request->input('end_date');

        // Convertir las fechas al formato "Y-m-d" (año-mes-día) si es necesario.
        $startDateInput = Carbon::parse($startDateInput)->format('Y-m-d');
        $endDateInput = Carbon::parse($endDateInput)->format('Y-m-d');

        // Convertir las fechas a objetos Carbon y establecer las horas específicas.
        $startDate = Carbon::createFromFormat('Y-m-d', $startDateInput)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $endDateInput)->endOfDay();

        // Consulta para obtener los registros de MovementType con nombre "Movimiento Interno"
        $movement_type = MovementType::where('name', 'Movimiento Interno')->firstOrFail();

        // Consulta para obtener los registros de Movement entre las fechas seleccionadas
        $movements = Movement::whereHas('warehouse_movements', function ($query) {
            $query->where('productive_unit_warehouse_id', $this->getAppPuw()->id)
                ->where('role', 'Recibe');
        })
            ->where('movement_type_id', $movement_type->id)
            ->where('state', 'Aprobado')
            ->whereBetween('registration_date', [$startDate, $endDate])
            ->orderBy('registration_date', 'ASC')
            ->get();

        // Crear una nueva instancia de TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Establecer el título del documento con las fechas seleccionadas
        $title = 'Reporte de Entradas de Inventario - ' . $startDateInput . ' al ' . $endDateInput;
        $pdf->SetTitle($title);

        // Definir la fuente y el tamaño para el contenido del PDF
        $pdf->SetFont('helvetica', '', 10);

        // Agregar una nueva página
        $pdf->AddPage();

        // Método Header para establecer el contenido centrado del encabezado
        $pdf->SetY(15); // Ajustar la posición vertical del texto del encabezado
        $header = 'Centro de Formación Agroindustrial "La Angostura" | Campoalegre - Huila';
        $pdf->Cell(0, 0, $header, 0, 1, 'C');

        // Establecer el contenido del PDF con el título (incluyendo las fechas)
        $html = '<h3 style="text-align: center;">' . $title . '</h3>';

        // Crear el encabezado de la tabla
        $html .= '<table style="border-collapse: collapse; width: 100%;">';
        $html .= '<thead style="background-color: #f2f2f2;">';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 25px;">#</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 52px;">Número de Voucher</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 72px;">Responsable que entrega</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Fecha de ingreso</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 90px;">Producto</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;">Cantidad</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;">Precio</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;">Subtotal</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;">Total</th>';
        $html .= '</tr>';
        $html .= '</thead>';

        // Crear el cuerpo de la tabla con los datos de los movimientos
        $html .= '<tbody>';
        foreach ($movements as $key => $movement) {
            foreach ($movement->movement_details as $index => $movement_detail) {
                $html .= '<tr>';
                if ($index === 0) {
                    // Solo mostrar información del movimiento en la primera fila
                    $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 25px;" rowspan="' . count($movement->movement_details) . '">' . ($key + 1) . '</td>';
                    $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 52px;" rowspan="' . count($movement->movement_details) . '">' . $movement->voucher_number . '</td>';
                    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 72px;" rowspan="' . count($movement->movement_details) . '">' . $movement->movement_responsibilities->where('role', 'ENTREGA')->first()->person->full_name . '</td>';
                    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;" rowspan="' . count($movement->movement_details) . '">' . $movement->registration_date . '</td>';
                }
                $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 90px;">' . $movement_detail->inventory->element->product_name . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . $movement_detail->amount . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . priceFormat($movement_detail->price) . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . priceFormat($movement_detail->amount * $movement_detail->price) . '</td>';
                if ($index === 0) {
                    // Solo mostrar el precio en la primera fila del movimiento
                    $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;" rowspan="' . count($movement->movement_details) . '">' . priceFormat($movement->price) . '</td>';
                }
                $html .= '</tr>';
            }
        }
        $html .= '</tbody>';
        $html .= '</table>';

        // Agregar el contenido HTML al PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Generar el PDF y devolverlo para su descarga con las fechas en el nombre del archivo
        $filename = 'Reporte_entradas_inventario_' . $startDateInput . '_al_' . $endDateInput . '.pdf';
        $pdf->Output($filename, 'I');
    }
}
