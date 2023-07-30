<?php

namespace Modules\PTVENTA\Http\Controllers;

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

class InventoryController extends Controller
{

    public $app_puw; // Establecer unidad productiva y bodega general de la aplicación

    // Obtener unidad productiva y bodega general de la aplicación
    public function getAppPuw()
    {
        if (!$this->app_puw) {
            $productive_unit = ProductiveUnit::where('name', 'Punto de venta')->firstOrFail(); // Unidad productiva de la aplicación
            $warehouse = Warehouse::where('name', 'Punto de venta')->firstOrFail(); // Bodega de la aplicación
            $this->app_puw = ProductiveUnitWarehouse::where('productive_unit_id', $productive_unit->id)->where('warehouse_id', $warehouse->id)->firstOrFail();
        }
        return $this->app_puw;
    }

    public function index()
    { // Listado del inventario actual
        $inventories = Inventory::where('productive_unit_warehouse_id', $this->getAppPuw()->id)
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
        $view = ['titlePage' => 'Inventario - Listado', 'titleView' => 'Administración general de inventario'];
        return view('ptventa::inventory.index', compact('view', 'groupedInventories'));
    }

    public function create()
    { // Formulario de registro (entrada) de inventario
        $view = ['titlePage' => 'Inventario - Registro', 'titleView' => 'Registro de inventario'];
        return view('ptventa::inventory.create', compact('view'));
    }

    public function pdf()
    {
        $inventories = Inventory::orderBy('updated_at', 'DESC')->get();
        $pdf = new TCPDF();
        $html = view('ptventa::inventory.pdf', compact('inventories'))->render();
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false);
        $pdf->Output('ReporteProductos');
    }

    public function status(Request $request)
    { // Lista de productos vencidos y por vencer
        $view = ['titlePage' => 'Inventario - Estado', 'titleView' => 'Productos en riesgo por caducidad'];
        $productosVencidos = Inventory::where('productive_unit_warehouse_id', $this->getAppPuw()->id)
            ->where('state', 'Disponible')
            ->where('expiration_date', '<', now())
            ->orderBy('expiration_date')
            ->get();
        $productosPorVencer = Inventory::where('productive_unit_warehouse_id', $this->getAppPuw()->id)
            ->where('state', 'Disponible')
            ->where('expiration_date', '>', now())
            ->where('expiration_date', '<=', now()->addDays(3))
            ->orderBy('expiration_date')
            ->get();
        return view('ptventa::inventory.status', compact('view', 'productosVencidos', 'productosPorVencer'));
    }

    public function low()
    { //registro de bajas
        $view = ['titlePage' => 'Inventario - Registro', 'titleView' => 'Registro de Bajas'];
        return view('ptventa::inventory.low', compact('view'));
    }

    //Funciones para reporte de inventario
    public function reports()
    { //Vista principal del panel de reportes
        $view = ['titlePage' => trans('ptventa::reports.Reports'), 'titleView' => trans('ptventa::reports.Reports Panel')];
        return view('ptventa::reports.index', compact('view'));
    }

    public function generateInventoryPDF(Request $request)
    {
        // Realiza la consulta y obtén los datos que cumplan con los criterios requeridos
        $inventories = Inventory::where('productive_unit_warehouse_id', $this->getAppPuw()->id)->where('state', 'Disponible')->get();

        // Crear una nueva instancia de TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Establecer el título del documento
        $pdf->SetTitle('Reporte de Inventario');

        // Agregar una nueva página
        $pdf->AddPage();

        // Establecer el contenido del PDF
        $html = '<h1 style="text-align: center;">Reporte de Inventario</h1>';
        $html .= '<table style="border-collapse: collapse; width: 100%;">';
        $html .= '<thead style="background-color: #f2f2f2;">';
        $html .= '<tr>';
        // Columna del #
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 25px;">#</th>';
        // Resto de columnas
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 110px;">Elemento</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;">Precio</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;">Cantidad</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: center; padding: 8px;">Stock</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Fecha de Producción</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Fecha de Vencimiento</th>';
        $html .= '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Número de Lote</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        foreach ($inventories as $key => $inventory) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px; width: 25px;">' . $key + 1 . '</td>';
            // Resto de columnas (sin cambios)
            $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; width: 110px;">' . $inventory->element->name . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . $inventory->price . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . $inventory->amount . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: center; padding: 8px;">' . $inventory->stock . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $inventory->production_date . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $inventory->expiration_date . '</td>';
            $html .= '<td style="border: 1px solid #dddddd; text-align: right; padding: 8px;">' . $inventory->lot_number . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Generar el PDF y devolverlo para su descarga
        $pdf->Output('reporte_inventarios.pdf', 'D');
    }

    // Método para mostrar la vista del formulario de entradas de inventario
    public function showInventoryEntriesForm()
    {
        $view = ['titlePage' => 'Reportes', 'titleView' => 'Entradas de Inventario'];

        // Establecer valores predeterminados para $start_date y $end_date si no están presentes en el request
        $start_date = request()->input('start_date', now()->format('Y-m-d'));
        $end_date = request()->input('end_date', now()->format('Y-m-d'));

        return view('ptventa::reports.inventoryEntriesForm', compact('view', 'start_date', 'end_date'));
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

        // Establecer el título del documento
        $pdf->SetTitle('Reporte de Entradas de Inventario');

        // Agregar una nueva página
        $pdf->AddPage();

        // Establecer el contenido del PDF
        $html = '<h1 style="text-align: center;">Reporte de Entradas de Inventario</h1>';

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

        // Generar el PDF y devolverlo para su descarga
        $pdf->Output('reporte_entradas_inventario.pdf', 'D');
    }
}
