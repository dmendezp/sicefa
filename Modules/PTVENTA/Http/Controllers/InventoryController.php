<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Http\Request;
use Modules\SICA\Entities\Warehouse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Modules\SICA\Entities\Inventory;
use TCPDF;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;

class InventoryController extends Controller
{

    public function index()
    { // Listado del inventario actual
        $inventories = Inventory::orderBy('updated_at', 'DESC')->get(); // Consultar registros de inventario de manera descende por el dato updated_at
        $view = ['titlePage' => 'Inventario - Listado', 'titleView' => 'Administración de inventario'];
        return view('ptventa::inventory.index', compact('view', 'inventories'));
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
    { // Estado de productos vencidos y por vencer

        $inventories = Inventory::orderBy('updated_at', 'DESC')->get();
        $view = ['titlePage' => 'Inventario - Registro', 'titleView' => 'Estado de productos '];
        $productosVencidos = Inventory::where('expiration_date', '<', now())->get();
        $productosPorVencer = Inventory::where('expiration_date', '>=', now())
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
        $view = ['titlePage' => 'Reportes', 'titleView' => 'Panel de Reportes'];
        return view('ptventa::reports.index', compact('view'));
    }

    public function saleReports()
    { //Vista de reportes de ventas
        $view = ['titlePage' => 'Reportes', 'titleView' => 'Reportes de ventas'];
        return view('ptventa::reports.saleReports.index', compact('view'));
    }

    public function generatePDF(Request $request)
    {
        // Realiza la consulta y obtén los datos que cumplan con los criterios requeridos
        $productive_unit = ProductiveUnit::where('name', 'Punto de venta')->firstOrFail();
        $warehouse = Warehouse::where('name', 'Punto de venta')->firstOrFail();
        $puw = ProductiveUnitWarehouse::where('productive_unit_id', $productive_unit->id)->where('warehouse_id', $warehouse->id)->firstOrFail();
        $inventories = Inventory::where('productive_unit_warehouse_id', $puw->id)->where('state', 'Disponible')->get();

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
}
