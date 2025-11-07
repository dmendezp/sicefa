<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;
use TCPDF;

class InventoryController extends Controller
{
    // Listado del inventario actual
    public function index()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_index_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_index_title_view')];
        $inventories = Inventory::where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
            ->where('amount', '<>', 0)
            ->orderBy('updated_at', 'DESC')
            ->get();
        $groupedInventories = collect(); // Creamos una nueva colección para almacenar el resultado
        $groups = []; // Creamos un array para mantener el seguimiento de los grupos

        foreach ($inventories as $inventory) {
            $elementId = $inventory->element_id;

            // Verificamos si el grupo ya existe en el array de grupos
            if (array_key_exists($elementId, $groups)) {
                // Si el grupo ya existe, agregamos el registro al grupo existente
                $groups[$elementId]->push($inventory);
            } else {
                // Si el grupo no existe, lo creamos y agregamos el registro al nuevo grupo
                $groups[$elementId] = collect([$inventory]);
            }
        }

        // Convertimos los grupos a la colección final
        foreach ($groups as $group) {
            $groupedInventories->push($group);
        }
        return view('cafeto::inventory.index', compact('view', 'groupedInventories'));
    }

    // Formulario de registro (entrada) de inventario
    public function create()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_create_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_create_title_view')];
        return view('cafeto::inventory.create', compact('view'));
    }

    // Lista de productos vencidos y por vencer
    public function status(Request $request)
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_status_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_status_title_view')];
        $productosVencidos = Inventory::where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
            ->where('state', 'Disponible')
            ->where('expiration_date', '<', now())
            ->orderBy('expiration_date')
            ->get();
        $productosPorVencer = Inventory::where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
            ->where('state', 'Disponible')
            ->where('expiration_date', '>', now())
            ->where('expiration_date', '<=', now()->addDays(3))
            ->orderBy('expiration_date')
            ->get();
        return view('cafeto::inventory.status', compact('view', 'productosVencidos', 'productosPorVencer'));
    }

    /* Ingresar a registro de bajas de inventario */
    public function low_create()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_low_create_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_low_create_title_view')];
        return view('cafeto::inventory.low', compact('view'));
    }

    /* Ver detalle de movimiento interno */
    public function show_entry(Movement $movement)
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_show_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_show_title_view')];
        return view('cafeto::inventory.show-entry', compact('view', 'movement'));
    }

    /* Ver detalle de baja de inventario */
    public function showLow(Movement $movement)
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_show_low_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_show_low_title_view')];
        return view('cafeto::inventory.show-low', compact('view', 'movement'));
    }

    //======================================== Funciones para reporte de inventario =========================================
    //Vista principal del panel de reportes
    public function reports()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_reports_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_reports_title_view')];
        return view('cafeto::reports.index', compact('view'));
    }

    // Método para generar el reporte PDF de inventario actual
    public function generateInventoryPDF(Request $request)
    {
        $inventories = Inventory::where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
            ->where('amount', '<>', 0)
            ->orderBy('updated_at', 'DESC')
            ->get();

        // Se accede al nombre de la bodega y unidad productiva
        $puw = PUW::getAppPuw();

        $groupedInventories = collect(); // Creamos una nueva colección para almacenar el resultado
        $groups = []; // Creamos un array para mantener el seguimiento de los grupos

        foreach ($inventories as $inventory) {
            $elementId = $inventory->element_id;

            // Verificamos si el grupo ya existe en el array de grupos
            if (array_key_exists($elementId, $groups)) {
                // Si el grupo ya existe, agregamos el registro al grupo existente
                $groups[$elementId]->push($inventory);
            } else {
                // Si el grupo no existe, lo creamos y agregamos el registro al nuevo grupo
                $groups[$elementId] = collect([$inventory]);
            }
        }

        // Convertimos los grupos a la colección final
        foreach ($groups as $group) {
            $groupedInventories->push($group);
        }

        // Crear una nueva instancia de TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Establecer el título del documento con la fecha actual
        $title = 'Reporte de Inventario - ' . date('Y-m-d');
        $pdf->SetTitle($title);

        // Definir la fuente y el tamaño para el contenido del PDF
        $pdf->SetFont('helvetica', '', 10);

        // Agregar una nueva página
        $pdf->AddPage();

        // Método Header para establecer el contenido centrado del encabezado
        $pdf->SetY(15); // Ajustar la posición vertical del texto del encabezado
        $header = 'Centro de Formación Agroindustrial "La Angostura" | Campoalegre - Huila';
        $pdf->Cell(0, 0, $header, 0, 1, 'C');

        // Establecer el contenido del PDF
        $html = '<h4 style="text-align: center;"><strong>Bodega:</strong> ' . $puw->warehouse->name . ' - <strong>Unidad Productiva:</strong> ' . $puw->productive_unit->name . '</h4>';
        $html .= '<h3 style="text-align: center;">' . $title . '</h3>';
        $html .= '<table style="border-collapse: collapse; width: 100%;">';
        $html .= '<thead style="background-color: #f2f2f2;">';
        $html .= '<tr>';
        // Columna del #
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 25px;"><b>#</b></th>';
        // Resto de columnas
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 130px;"><b>Producto</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 45px;"><b>N° Lote</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 62px;"><b>Fecha Producción</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 62px;"><b>Fecha Vencimiento</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 50px;"><b>Cantidad</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 50px;"><b>Precio Entrada</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 50px;"><b>Precio Venta</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 62px;"><b>Existencias</b></th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        foreach ($groupedInventories as $key => $group) {
            $firstRecord = $group->first();
            $rowspan = $group->count();
            $html .= '<tr>';
            $html .= '<td rowspan="' . $rowspan . '" style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 25px;">' . $key + 1 . '</td>';
            $html .= '<td rowspan="' . $rowspan . '" style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 130px;">' . $firstRecord->element->name . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 45px;">' . $firstRecord->lot_number . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 62px;">' . $firstRecord->production_date . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 62px;">' . $firstRecord->expiration_date . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 50px;">' . $firstRecord->amount . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 50px;">' . priceFormat($firstRecord->price) . '</td>';
            $html .= '<td rowspan="' . $rowspan . '" style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 50px;">' . priceFormat($firstRecord->element->price) . '</td>';
            $html .= '<td rowspan="' . $rowspan . '" style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 62px;">' . $group->sum('amount') . '</td>';
            $html .= '</tr>';
            foreach ($group->slice(1) as $record) {
                $html .= '<tr>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . $record->lot_number . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $record->production_date . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $record->expiration_date . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . $record->amount . '</td>';
                $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . priceFormat($record->price) . '</td>';
                $html .= '</tr>';
            }
        }

        $html .= '</tbody>';
        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Generar el PDF y devolverlo para su descarga con la fecha en el nombre del archivo
        $filename = 'reporte_inventarios_' . date('Ymd') . '.pdf';
        $pdf->Output($filename, 'I');
    }

    // Método para mostrar la vista del formulario de entradas de inventario
    public function showInventoryEntriesForm()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_inventory_show_entries_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_inventory_show_entries_title_view')];
        // Establecer valores predeterminados para $start_date y $end_date si no están presentes en el request
        $start_date = request()->input('start_date', now()->format('Y-m-d'));
        $end_date = request()->input('end_date', now()->format('Y-m-d'));

        return view('cafeto::reports.inventory-entries-form', compact('view', 'start_date', 'end_date'));
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
            $query->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
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
            $query->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
                ->where('role', 'Recibe');
        })
            ->where('movement_type_id', $movement_type->id)
            ->where('state', 'Aprobado')
            ->whereBetween('registration_date', [$startDate, $endDate])
            ->orderBy('registration_date', 'ASC')
            ->get();

        // Se accede al nombre de la bodega y unidad productiva
        $puw = PUW::getAppPuw();

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
        $html = '<h4 style="text-align: center;"><strong>Bodega:</strong> ' . $puw->warehouse->name . ' - <strong>Unidad Productiva:</strong> ' . $puw->productive_unit->name . '</h4>';
        $html .= '<h3 style="text-align: center;">' . $title . '</h3>';

        // Crear el encabezado de la tabla
        $html .= '<table style="border-collapse: collapse; width: 100%;">';
        $html .= '<thead style="background-color: #f2f2f2;">';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 25px;"><b>#</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 52px;"><b>N° de Voucher</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 72px;"><b>Responsable que entrega</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><b>Fecha de ingreso</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 90px;"><b>Producto</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Cantidad</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Precio</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Subtotal</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Total</b></th>';
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

    // Método para mostrar la vista del formulario de ventas
    public function showSalesForm()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_sales_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_sales_title_view')];
        // Establecer valores predeterminados para $start_date y $end_date si no están presentes en el request
        $start_date = request()->input('start_date', now()->format('Y-m-d'));
        $end_date = request()->input('end_date', now()->format('Y-m-d'));

        return view('cafeto::reports.sales-form', compact('view', 'start_date', 'end_date'));
    }

    // Método para realizar la consulta de ventas y redirigir a la vista
    public function generateSales(Request $request)
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

        // Consulta para obtener los registros de MovementType con nombre "Venta"
        $movement_type = MovementType::where('name', 'Venta')->firstOrFail();

        // Consulta para obtener los registros de Movement entre las fechas seleccionadas
        $movements = Movement::whereHas('warehouse_movements', function ($query) {
            $query->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
                ->where('role', 'Entrega');
        })
            ->where('movement_type_id', $movement_type->id)
            ->where('state', 'Aprobado')
            ->whereBetween('registration_date', [$startDate, $endDate])
            ->orderBy('registration_date', 'ASC')
            ->get();

        return $this->showSalesForm()->with('movements', $movements);
    }

    // Método para generar el reporte PDF de ventas
    public function generateSalesPDF(Request $request)
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

        // Consulta para obtener los registros de MovementType con nombre "Venta"
        $movement_type = MovementType::where('name', 'Venta')->firstOrFail();

        // Consulta para obtener los registros de Movement entre las fechas seleccionadas
        $movements = Movement::whereHas('warehouse_movements', function ($query) {
            $query->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
                ->where('role', 'Entrega');
        })
            ->where('movement_type_id', $movement_type->id)
            ->where('state', 'Aprobado')
            ->whereBetween('registration_date', [$startDate, $endDate])
            ->orderBy('registration_date', 'ASC')
            ->get();

        // Se accede al nombre de la bodega y unidad productiva
        $puw = PUW::getAppPuw();

        // Crear una nueva instancia de TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Establecer el título del documento con las fechas seleccionadas
        $title = 'Reporte de Ventas - ' . $startDateInput . ' al ' . $endDateInput;
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
        $html = '<h4 style="text-align: center;"><strong>Bodega:</strong> ' . $puw->warehouse->name . ' - <strong>Unidad Productiva:</strong> ' . $puw->productive_unit->name . '</h4>';
        $html .= '<h3 style="text-align: center;">' . $title . '</h3>';

        // Crear el encabezado de la tabla
        $html .= '<table style="border-collapse: collapse; width: 100%;">';
        $html .= '<thead style="background-color: #f2f2f2;">';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 25px;"><b>#</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 52px;"><b>N° Comprobante</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 72px;"><b>Cliente</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><b>Fecha de ingreso</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 90px;"><b>Producto</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Cantidad</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Precio</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Subtotal</b></th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;"><b>Total</b></th>';
        $html .= '</tr>';
        $html .= '</thead>';

        // Variables para almacenar los totales
        $totalTotal = 0;

        // Crear el cuerpo de la tabla con los datos de los movimientos
        $html .= '<tbody>';
        foreach ($movements as $key => $movement) {
            foreach ($movement->movement_details as $index => $movement_detail) {
                $html .= '<tr>';
                if ($index === 0) {
                    // Solo mostrar información del movimiento en la primera fila
                    $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 25px;" rowspan="' . count($movement->movement_details) . '">' . ($key + 1) . '</td>';
                    $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 52px;" rowspan="' . count($movement->movement_details) . '">' . $movement->voucher_number . '</td>';
                    $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 72px;" rowspan="' . count($movement->movement_details) . '">' . $movement->movement_responsibilities->where('role', 'CLIENTE')->first()->person->full_name . '</td>';
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
            // Actualizar el totalTotal con el precio del movimiento
            $totalTotal += $movement->price;
        }
        $html .= '</tbody>';

        // Pie de pagina que muestra los totales de cantidad, precio, subtotal y total
        $html .= '<tfoot>';
        $html .= '<tr>';
        $html .= '<td style="border: 1px solid #dddddd; text-align: right; padding: 8px; width: 478px;"><strong> Total: </strong></td>'; // Celdas vacías para las columnas sin totales
        $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 60px;"><strong>' . priceFormat($totalTotal) . '</strong></td>';
        $html .= '</tr>';
        $html .= '</tfoot>';
        $html .= '</table>';

        // Agregar el contenido HTML al PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Generar el PDF y devolverlo para su descarga
        $pdf->Output('reporte_ventas.pdf', 'I');
    }
}
